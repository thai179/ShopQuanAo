<?php
session_start();
if (!isset($_SESSION["nguoidung"])) {
    header("location:../index.php");
    exit();
}
require("../../model/database.php");
require("../../model/danhmuc.php");
require("../../model/mathang.php");
require("../../model/hinhanhsanpham.php");
require("../../model/bienthesp.php"); 

if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {
    $action = "xem";
}

$dm = new DANHMUC();
$mh = new MATHANG();
$ha = new HINHANHSANPHAM();
$bt = new BIENTHESP();

switch ($action) {
    case "xem":
        $mathang = $mh->laymathang();
        include("main.php");
        break;
    case "timkiem":
        if(isset($_REQUEST["txttimkiem"])){
            $tukhoa = $_REQUEST["txttimkiem"];
            $mathang = $mh->timkiemmathang($tukhoa);
        } else {
            $mathang = $mh->laymathang();
        }
        include("main.php");
        break;
    case "them":
        $danhmuc = $dm->laydanhmuc();
        include("addform.php");
        break;
    case "xulythem":
        if (!isset($_POST["txttenmathang"]) || !isset($_FILES["filehinhanh"])) {
            throw new Exception("Thiếu dữ liệu bắt buộc.");
        }

        $mathanghh = new MATHANG();
        $mathanghh->settenmathang($_POST["txttenmathang"]);
        $mathanghh->setgiagoc($_POST["txtgianhap"]);
        $mathanghh->setgiaban($_POST["txtgiaban"]);
        $mathanghh->setdanhmuc_id($_POST["optdanhmuc"]);
        $mathanghh->setMoTa($_POST['txtmota']);

        // Tính tổng số lượng từ các size
        $soluong_sizes = isset($_POST['soluong']) && is_array($_POST['soluong']) ? $_POST['soluong'] : [];
        $tong_soluong = 0;
        foreach ($soluong_sizes as $soluong) {
            $tong_soluong += (int)$soluong;
        }
        $mathanghh->setSoLuongTon($tong_soluong);

        // Thêm mặt hàng vào CSDL
        $mh->themmathang($mathanghh);

        $maSP = $mh->laymathangvuathem();

        // Thêm biến thể sản phẩm
        foreach ($soluong_sizes as $ten_size => $soluong) {
            $bt->thembienthe($maSP, strtoupper($ten_size), (int)$soluong);
        }

        // Thư mục lưu ảnh
        $uploadFolder = __DIR__ . "/../../images/products/";
        if (!is_dir($uploadFolder)) {
            mkdir($uploadFolder, 0775, true);
        }

        // Duyệt file upload (dự kiến input name="filehinhanh[]" multiple)
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $order = 1;
        foreach ($_FILES["filehinhanh"]["tmp_name"] as $key => $tmp_name) {
            if (!is_uploaded_file($tmp_name)) continue;

            $originalName = basename($_FILES["filehinhanh"]["name"][$key]);
            $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
            if (!in_array($ext, $allowedExt)) continue; // hoặc báo lỗi

            // tạo tên file duy nhất tránh trùng
            $safeBase = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", pathinfo($originalName, PATHINFO_FILENAME));
            $uniqueName = $safeBase . '_' . time() . '_' . $key . '.' . $ext;
            $relativePath = "images/products/" . $uniqueName;
            $dest = $uploadFolder . $uniqueName;

            if (!move_uploaded_file($tmp_name, $dest)) {
                continue;
            }

            $hinhAnhSP = new HINHANHSANPHAM();
            $hinhAnhSP->setMaSP($maSP);
            $hinhAnhSP->setDuongdan($relativePath);
            $hinhAnhSP->themHinhAnh();
        }

        $duongdanAnh = $ha->layHinhAnhTheoMaSP($maSP);
        $mh->capNhatHinhAnh($maSP, $duongdanAnh);

        $mathang = $mh->laymathang();
        include("main.php");
        break;
    case "xoa":
        if (isset($_GET["MaSP"])) {
            $mathanghh = new MATHANG();
            $mathanghh->setid($_GET["MaSP"]);
            $mh->xoamathang($mathanghh);
        }
        $mathang = $mh->laymathang();
        include("main.php");
        break;
    case "chitiet":
        if (isset($_GET["MaSP"])) {
            $m = $mh->laymathangtheoid($_GET["MaSP"]);
            include("detail.php");
        } else {
            $mathang = $mh->laymathang();
            include("main.php");
        }
        break;
    case "sua":
        if (isset($_GET["MaSP"])) {
            $m = $mh->laymathangtheoid($_GET["MaSP"]);
            $danhmuc = $dm->laydanhmuc();

            // Lấy số lượng tồn kho theo size
            $bienthe_sp = $bt->laybienthetheosanpham($_GET["MaSP"]);
            $soluong_ton = ['s' => 0, 'm' => 0, 'l' => 0, 'xl' => 0, 'free' => 0];
            foreach ($bienthe_sp as $b) {
                $ten_size_db = strtolower($b['TenKichCo']); // chuyển về chữ thường để khớp key của mảng
                if (array_key_exists($ten_size_db, $soluong_ton)) {
                    $soluong_ton[$ten_size_db] = $b['SoLuongTon'];
                }            }
            include("updateform.php");
        } else {
            $mathang = $mh->laymathang();
            include("main.php");
        }
        break;
    case "xulysua":
        $idSP = isset($_POST["txtid"]) ? (int)$_POST["txtid"] : 0;
        if ($idSP <= 0) {
            throw new Exception("ID sản phẩm không hợp lệ.");
        }

        // Chuẩn bị thư mục và danh sách đuôi file cho phép (Dùng chung cho cả 2)
        $uploadFolder = __DIR__ . "/../../images/products/";
        if (!is_dir($uploadFolder)) mkdir($uploadFolder, 0775, true);
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        // 1. Cập nhật thông tin cơ bản
        $mathanghh = new MATHANG();
        $mathanghh->setid($idSP);
        $mathanghh->setdanhmuc_id($_POST["optdanhmuc"]);
        $mathanghh->settenmathang($_POST["txttenhang"]);
        $mathanghh->setgiagoc($_POST["txtgiagoc"]);
        $mathanghh->setgiaban($_POST["txtgiaban"]);
        $mathanghh->setMoTa($_POST['txtmota']);

        // Tính tổng số lượng từ các size
        $soluong_sizes = isset($_POST['soluong']) && is_array($_POST['soluong']) ? $_POST['soluong'] : [];
        $tong_soluong = 0;
        foreach ($soluong_sizes as $soluong) {
            $tong_soluong += (int)$soluong;
        }
        $mathanghh->setSoLuongTon($tong_soluong);

        // 2. Xử lý ảnh đại diện (Main Image)
        $imageToSet = $_POST["txthinhcu"] ?? null; // Mặc định giữ ảnh cũ

        if (isset($_FILES["hinhanh"]) && !empty($_FILES["hinhanh"]["name"])) {
            $orig = basename($_FILES["hinhanh"]["name"]);
            $ext = strtolower(pathinfo($orig, PATHINFO_EXTENSION));

            // [FIX] Kiểm tra bảo mật đuôi file cho ảnh chính
            if (in_array($ext, $allowedExt)) {
                $safeBase = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", pathinfo($orig, PATHINFO_FILENAME));
                $uniqueMain = $safeBase . '_' . time() . '.' . $ext;
                $destMain = $uploadFolder . $uniqueMain;

                if (is_uploaded_file($_FILES["hinhanh"]["tmp_name"]) && move_uploaded_file($_FILES["hinhanh"]["tmp_name"], $destMain)) {
                    $imageToSet = $uniqueMain; // Cập nhật tên ảnh mới

                    // [FIX] Xóa ảnh cũ khỏi server để tránh rác
                    $oldImageName = $_POST["txthinhcu"] ?? "";
                    if (!empty($oldImageName) && file_exists($uploadFolder . $oldImageName)) {
                        @unlink($uploadFolder . $oldImageName);
                    }
                }
            }
        }
        $mathanghh->sethinhanh($imageToSet);

        // Thực hiện update vào DB
        $mh->suamathang($mathanghh);

        // Cập nhật biến thể sản phẩm
        foreach ($soluong_sizes as $ten_size => $soluong) {
            $ten_size_upper = strtoupper($ten_size);
            $bienthe_hientai = $bt->laymotbienthe($idSP, $ten_size_upper);

            if ($bienthe_hientai) {
                // Nếu biến thể đã tồn tại, cập nhật nó
                $bt->capnhatbienthe($bienthe_hientai['MaBienThe'], $ten_size_upper, (int)$soluong);
            } else {
                // Nếu biến thể chưa tồn tại, thêm mới
                $bt->thembienthe($idSP, $ten_size_upper, (int)$soluong);
            }

        }

        // 3. Xử lý ảnh Gallery
        $hasNewGallery = false;
        if (isset($_FILES["filehinhanh"]["name"])) {
            foreach ($_FILES["filehinhanh"]["name"] as $nm) {
                if (!empty($nm)) {
                    $hasNewGallery = true;
                    break;
                }
            }
        }

        if ($hasNewGallery) {
            $movedFiles = [];

            foreach ($_FILES["filehinhanh"]["tmp_name"] as $key => $tmp_name) {
                if (!is_uploaded_file($tmp_name)) continue;

                $originalName = basename($_FILES["filehinhanh"]["name"][$key]);
                $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

                if (!in_array($ext, $allowedExt)) continue;

                $safeBase = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", pathinfo($originalName, PATHINFO_FILENAME));
                // Thêm $key vào tên file để tránh trùng khi up nhiều file cùng lúc
                $uniqueName = $safeBase . '_' . time() . '_' . $key . '.' . $ext;

                // LƯU Ý: Ở đây mình giữ logic cũ của bạn là lưu đường dẫn 'images/products/...'
                // Nếu muốn đồng bộ với ảnh chính (chỉ lưu tên), hãy sửa dòng dưới thành: $relativePath = $uniqueName;
                $relativePath = "images/products/" . $uniqueName;
                $dest = $uploadFolder . $uniqueName;

                if (move_uploaded_file($tmp_name, $dest)) {
                    $movedFiles[] = $relativePath;
                }
            }

            // Nếu có ít nhất 1 file mới upload thành công
            if (!empty($movedFiles)) {
                // lay all anh cu
                $existingImages = $ha->layTatCaHinhAnhTheoMaSP($idSP);

                // xac dinh anh chinh
                $finalMainImage = $mathanghh->getHinhAnh();
                // tao duong dan
                $finalMainImageBasename = $finalMainImage ? basename($finalMainImage) : null;

                // xoa anh cu
                $keptOldImage = null; 
                foreach ($existingImages as $image) {
                    // Đường dẫn trong DB của bạn là: images/products/abc.jpg
                    // Nên path file thực tế là: __DIR__ /../../ + images/products/abc.jpg
                    $filePath = __DIR__ . "/../../" . $image['DuongDan'];
                    $basename = basename($image['DuongDan']);
                    if ($finalMainImageBasename && $basename === $finalMainImageBasename) {
                        // giu anh main
                        $keptOldImage = $image['DuongDan'];
                        continue;
                    }
                    if (file_exists($filePath)) {
                        @unlink($filePath);
                    }
                }

                //xoa anh cu
                $ha->xoaHinhAnhTheoMaSP($idSP);

                $finalGallery = $movedFiles;
                if ($keptOldImage) {
                    if (!in_array($keptOldImage, $finalGallery)) {
                        array_unshift($finalGallery, $keptOldImage);
                    }
                }

                // 2.5 Chen cac anh moi vao DB
                $order = 1;
                foreach ($finalGallery as $rel) {
                    $hinhAnhSP = new HINHANHSANPHAM();
                    $hinhAnhSP->setMaSP($idSP);
                    $hinhAnhSP->setDuongdan($rel);
                    $hinhAnhSP->themHinhAnh();
                }
            }
        }
        // Load lại danh sách
        $mathang = $mh->laymathang();
        include("main.php");
        break;
        
    default:
        break;
}
