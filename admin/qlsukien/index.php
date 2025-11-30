<?php
session_start();
if(!isset($_SESSION["nguoidung"])){
    header("location:../index.php");
    exit();
}
require("../../model/database.php");
require("../../model/sukien.php");

if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action="xem";
}

$sk = new SUKIEN();

switch($action){
    case "xem":
        $sukien = $sk->laysukien();
		include("main.php");
        break;
	case "them":
		include("addform.php");
        break;
	case "xulythem":	
        $sukienmoi = new SUKIEN();
		$sukienmoi->setTenSuKien($_POST["txttensukien"]);
		$sukienmoi->setNgayBatDau($_POST["txtngaybatdau"]);
		$sukienmoi->setNgayKetThuc($_POST["txtngayketthuc"]);
		$sukienmoi->setGiamGia($_POST["txtgiamgia"]);

        // Xử lý upload hình ảnh
        $hinhanh_path = null;
        if(isset($_FILES["filehinhanh"]) && $_FILES["filehinhanh"]["error"] == 0){
            $upload_dir = __DIR__ . "/../../images/carousel/"; // Thư mục lưu ảnh
            $file_name = basename($_FILES["filehinhanh"]["name"]);
            
            // Tạo tên file duy nhất để tránh ghi đè
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $unique_name = pathinfo($file_name, PATHINFO_FILENAME) . '_' . time() . '.' . $file_ext;
            $target_file = $upload_dir . $unique_name;

            if (move_uploaded_file($_FILES["filehinhanh"]["tmp_name"], $target_file)) {
                // Lưu đường dẫn tương đối vào database
                $hinhanh_path = "images/carousel/" . $unique_name;
            }
        }
        $sukienmoi->setHinhAnh($hinhanh_path);

		$sk->themsukien($sukienmoi);

        // Tải lại danh sách và hiển thị
		$sukien = $sk->laysukien();
		include("main.php");
        break;
	case "xoa":
        // Thêm logic xóa file ảnh khi xóa sự kiện
        $s = $sk->laysukientheoid($_GET["MaSuKien"]);
        if ($s && !empty($s['HinhAnh']) && file_exists(__DIR__ . "/../../" . $s['HinhAnh'])) {
            unlink(__DIR__ . "/../../" . $s['HinhAnh']);
        }
		if(isset($_GET["MaSuKien"])){
            $sukienxoa = new SUKIEN();        
            $sukienxoa->setMaSuKien($_GET["MaSuKien"]);
			$sk->xoasukien($sukienxoa);
        }
		$sukien = $sk->laysukien();
		include("main.php");
		break;	
    case "sua":
        if(isset($_GET["MaSuKien"])){ 
            $s = $sk->laysukientheoid($_GET["MaSuKien"]);
            include("updateform.php");
        }
        else{
            $sukien = $sk->laysukien();        
            include("main.php");            
        }
        break;
    case "xulysua":
        $sukiensua = new SUKIEN();
        $sukiensua->setMaSuKien($_POST["txtid"]);
        $sukiensua->setTenSuKien($_POST["txttensukien"]);
        $sukiensua->setNgayBatDau($_POST["txtngaybatdau"]);
        $sukiensua->setNgayKetThuc($_POST["txtngayketthuc"]);
        $sukiensua->setGiamGia($_POST["txtgiamgia"]);
        
        $hinhanh_path = $_POST["txthinhcu"]; // Giữ lại ảnh cũ làm mặc định

        // Nếu có file mới được upload
        if(isset($_FILES["filehinhanh"]) && $_FILES["filehinhanh"]["error"] == 0 && !empty($_FILES["filehinhanh"]["name"])){
            $upload_dir = __DIR__ . "/../../images/carousel/";
            $file_name = basename($_FILES["filehinhanh"]["name"]);
            
            // Tạo tên file duy nhất
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $unique_name = pathinfo($file_name, PATHINFO_FILENAME) . '_' . time() . '.' . $file_ext;
            $target_file = $upload_dir . $unique_name;

            if (move_uploaded_file($_FILES["filehinhanh"]["tmp_name"], $target_file)) {
                // Xóa ảnh cũ nếu upload ảnh mới thành công và ảnh cũ tồn tại
                if (!empty($_POST["txthinhcu"]) && file_exists(__DIR__ . "/../../" . $_POST["txthinhcu"])) {
                    unlink(__DIR__ . "/../../" . $_POST["txthinhcu"]);
                }
                // Cập nhật đường dẫn ảnh mới
                $hinhanh_path = "images/carousel/" . $unique_name;
            }
        }
        $sukiensua->setHinhAnh($hinhanh_path);
        
        $sk->suasukien($sukiensua);         
    
        $sukien = $sk->laysukien();    
        include("main.php");
        break;
    default:
        break;
}
?>