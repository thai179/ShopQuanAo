<?php
session_start();
if (!isset($_SESSION['nguoidung'])) {
    header('location:../ktnguoidung/login.php');
    exit();
}

require_once("../../model/database.php");
require_once("../../model/doanhthu.php");

$dt = new DOANHTHU();

// Xử lý preset nhanh
if (isset($_GET['preset'])) {
    switch ($_GET['preset']) {
        case 'today':
            $tuNgay = date('Y-m-d');
            $denNgay = date('Y-m-d');
            break;
        case '7days':
            $tuNgay = date('Y-m-d', strtotime('-7 days'));
            $denNgay = date('Y-m-d');
            break;
        case '30days':
            $tuNgay = date('Y-m-d', strtotime('-30 days'));
            $denNgay = date('Y-m-d');
            break;
        case 'thismonth':
            $tuNgay = date('Y-m-01');
            $denNgay = date('Y-m-d');
            break;
    }
} else {
    // Xử lý tham số lọc thủ công
    $tuNgay = isset($_GET['tungay']) ? $_GET['tungay'] : date('Y-m-d', strtotime('-30 days'));
    $denNgay = isset($_GET['denngay']) ? $_GET['denngay'] : date('Y-m-d');
}

$nam = isset($_GET['nam']) ? $_GET['nam'] : date('Y');
$view = isset($_GET['view']) ? $_GET['view'] : 'tongquan';

// Khởi tạo biến mặc định
$danhSach = [];
$tongQuan = null;

// Lấy dữ liệu theo view
switch ($view) {
    case 'theo-ngay':
        $danhSach = $dt->layDoanhThuTheoNgay($tuNgay, $denNgay);
        $tongQuan = $dt->layTongDoanhThu($tuNgay, $denNgay);
        break;
    
    case 'theo-thang':
        $danhSach = $dt->layDoanhThuTheoThang($nam, $tuNgay, $denNgay);
        $tongQuan = $dt->layTongDoanhThu($tuNgay, $denNgay);
        break;
    
    case 'trang-thai':
        $danhSach = $dt->layDoanhThuTheoTrangThai($tuNgay, $denNgay);
        $tongQuan = $dt->layTongDoanhThu($tuNgay, $denNgay);
        break;
    
    case 'san-pham':
        $danhSach = $dt->layTopSanPhamBanChay(20, $tuNgay, $denNgay);
        $tongQuan = $dt->layTongDoanhThu($tuNgay, $denNgay);
        break;
    
    case 'danh-muc':
        $danhSach = $dt->layDoanhThuTheoDanhMuc($tuNgay, $denNgay);
        $tongQuan = $dt->layTongDoanhThu($tuNgay, $denNgay);
        break;
    
    case 'khach-hang':
        $danhSach = $dt->layTopKhachHang(20, $tuNgay, $denNgay);
        $tongQuan = $dt->layTongDoanhThu($tuNgay, $denNgay);
        break;
    
    case 'tongquan':
    default:
        $tongQuan = $dt->layTongDoanhThu($tuNgay, $denNgay);
        $doanhThuTheoNgay = $dt->layDoanhThuTheoNgay($tuNgay, $denNgay);
        $topSanPham = $dt->layTopSanPhamBanChay(5, $tuNgay, $denNgay);
        $doanhThuTheoDanhMuc = $dt->layDoanhThuTheoDanhMuc($tuNgay, $denNgay);
        $topKhachHang = $dt->layTopKhachHang(5, $tuNgay, $denNgay);
        $doanhThuTheoTrangThai = $dt->layDoanhThuTheoTrangThai($tuNgay, $denNgay);
        break;
}

include("main.php");
?>
