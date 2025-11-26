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
        $donhang= $dh->xemdsdonhang();
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

        $chi_tiet_don_hang = [];
        for ($i = 0; $i < count($sanpham_ids); $i++) {
            if(!empty($sanpham_ids[$i]) && !empty($soluongs[$i]) && $soluongs[$i] > 0){
                $sp = $mh->laymathangtheoid($sanpham_ids[$i]);
                $chi_tiet_don_hang[] = [
                    'MaSP' => $sanpham_ids[$i],
                    'SoLuong' => $soluongs[$i],
                    'ThanhTien' => $soluongs[$i] * $sp['GiaBan']
                ];
            }
        }
        
        if($MaKhachHang && !empty($chi_tiet_don_hang)){
            $dh->themdonhang($MaKhachHang, $TrangThai, $chi_tiet_don_hang);
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
