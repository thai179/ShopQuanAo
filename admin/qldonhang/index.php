<?php 
require('../../model/donhang.php');
require('../../model/ctdonhang.php');
require('../../model/khachhang.php');
require('../../model/mathang.php');
require('../../model/database.php');
session_start();
if(!isset($_SESSION["nguoidung"]))
    header("location:../index.php");
if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action="xem";
}
$dh = new DONHANG();
$kh = new KHACHHANG();
$mh = new MATHANG();


switch($action){
    case "xem":
        $tungay = isset($_GET['tungay']) && !empty($_GET['tungay']) ? $_GET['tungay'] : null;
        $denngay = isset($_GET['denngay']) && !empty($_GET['denngay']) ? $_GET['denngay'] : null;
        $filter = isset($_GET['filter']) ? $_GET['filter'] : null;

        if ($filter) {
            $today = new DateTime();
            switch ($filter) {
                case 'today':
                    $tungay = $denngay = $today->format('Y-m-d');
                    break;
                case 'yesterday':
                    $yesterday = (new DateTime())->modify('-1 day');
                    $tungay = $denngay = $yesterday->format('Y-m-d');
                    break;
                case 'thisweek':
                    $startOfWeek = (new DateTime())->modify('monday this week');
                    $tungay = $startOfWeek->format('Y-m-d');
                    $denngay = $today->format('Y-m-d');
                    break;
                case 'thismonth':
                    $tungay = $today->format('Y-m-01');
                    $denngay = $today->format('Y-m-d');
                    break;
            }
            // Cập nhật lại giá trị cho GET để hiển thị trên form
            $_GET['tungay'] = $tungay;
            $_GET['denngay'] = $denngay;
        }

        // Gọi hàm xemdsdonhang với các tham số đã được xử lý
        $donhang = $dh->xemdsdonhang($tungay, $denngay);

		include("main.php");
        break;
	case "chitiet":
        if(isset($_GET["id"])){
            $donhang = $dh->laydonhangtheoid($_GET["id"]);
            $dhct = new DONHANGCT();
            $chitietdonhang = $dhct->laychitiettheodonhang($_GET["id"]);
            include("detail.php");
        }
        break;
    case "capnhat":
        if(isset($_POST["id"]) && isset($_POST["trangthai"])){
            $dh->capnhattrangthai($_POST["id"], $_POST["trangthai"]);
        }
        $donhang = $dh->xemdsdonhang();
        include("main.php");
        break;
    case "them":
        $khachhang = $kh->layTatCaKhachHang();
        $mathang = $mh->laymathang();
        include("add.php");
        break;
    case "xulythem":
        $MaKhachHang = $_POST["khachhang_id"];
        $TrangThai = $_POST["trangthai"];
        $sanpham_ids = $_POST["sanpham_id"];
        $soluongs = $_POST["soluong"];
        $sizes = $_POST["size"]; // Lấy mảng size từ form

        $chi_tiet_don_hang = [];
        for ($i = 0; $i < count($sanpham_ids); $i++) {
            if(!empty($sanpham_ids[$i]) && !empty($soluongs[$i]) && $soluongs[$i] > 0){
                $sp = $mh->laymathangtheoid($sanpham_ids[$i]);
                $chi_tiet_don_hang[] = [
                    'MaSP' => $sanpham_ids[$i],
                    'SoLuong' => $soluongs[$i],
                    'ThanhTien' => $soluongs[$i] * $sp['GiaBan'],
                    'Size' => $sizes[$i] // Thêm size vào chi tiết
                ];
            }
        }
        
        if($MaKhachHang && !empty($chi_tiet_don_hang)){
            $dh->themdonhang($MaKhachHang, $TrangThai, $chi_tiet_don_hang, $chi_tiet_don_hang[0]['Size']); // Truyền size vào hàm
        }
        
        $donhang = $dh->xemdsdonhang();
        include("main.php");
        break;
    case "xoa":
        $dh->xoadonhang($_GET["id"]);
        header("Location: index.php?action=xem");
        break;
    default:
        break;
}
?>
