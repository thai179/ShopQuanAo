<?php
session_start();

if (!isset($_SESSION["nguoidung"])) {
    echo "<script>alert('Vui lòng đăng nhập!'); window.location='../index.php?action=dangnhap';</script>";
    exit();
}

require("../../model/database.php");
require("../../model/khohang.php");
require("../../model/cuahang.php");

$kho = new KHOHANG();
$ch = new CUAHANG();

// Xử lý action
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {
    $action = "";
}

// Lấy action từ query parameter 'act'
$act = isset($_GET['act']) ? $_GET['act'] : '';

switch ($act) {
    case "them":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tenKho = trim($_POST['tenkho']);
            $diaChi = trim($_POST['diachi']);
            $maCuaHang = !empty($_POST['macuahang']) ? $_POST['macuahang'] : null;
            
            $result = $kho->themKhoHang($tenKho, $diaChi, $maCuaHang);
            
            if ($result) {
                echo "<script>alert('Thêm kho hàng thành công!'); window.location='index.php?action=qlkhohang';</script>";
            } else {
                echo "<script>alert('Có lỗi xảy ra!'); window.location='index.php?action=qlkhohang';</script>";
            }
        } else {
            include("addform.php");
        }
        break;
        
    case "sua":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $maKho = $_POST['makho'];
            $tenKho = trim($_POST['tenkho']);
            $diaChi = trim($_POST['diachi']);
            $maCuaHang = !empty($_POST['macuahang']) ? $_POST['macuahang'] : null;
            
            $result = $kho->capNhatKhoHang($maKho, $tenKho, $diaChi, $maCuaHang);
            
            if ($result) {
                echo "<script>alert('Cập nhật kho hàng thành công!'); window.location='index.php?action=qlkhohang';</script>";
            } else {
                echo "<script>alert('Có lỗi xảy ra!'); window.location='index.php?action=qlkhohang';</script>";
            }
        } else {
            if (isset($_GET['id'])) {
                $khoHang = $kho->layKhoHangTheoID($_GET['id']);
                include("updateform.php");
            }
        }
        break;
        
    case "xoa":
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $result = $kho->xoaKhoHang($id);
            
            if ($result) {
                echo "<script>alert('Xóa kho hàng thành công!'); window.location='index.php?action=qlkhohang';</script>";
            } else {
                echo "<script>alert('Không thể xóa kho hàng!'); window.location='index.php?action=qlkhohang';</script>";
            }
        }
        break;
        
    case "chitiet":
        if (isset($_GET['id'])) {
            $maKho = $_GET['id'];
            $thongTinKho = $kho->layKhoHangTheoID($maKho);
            $danhSachSP = $kho->layDanhSachSanPhamTrongKho($maKho);
            $thongKe = $kho->thongKeTonKho($maKho);
            $sanPhamSapHet = $kho->laySanPhamSapHetHang($maKho, 10);
            include("main.php");
        } else {
            include("main.php");
        }
        break;
        
    case "nhapxuat":
        include("nhapxuat.php");
        break;
        
    default:
        include("main.php");
        break;
}
?>
