<?php
session_start();

if (!isset($_SESSION['nguoidung'])) {
    header('Location: ../ktnguoidung/login.php');
    exit();
}

require_once '../../model/khachhang.php';
require_once '../../model/database.php';

if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];
} else {
    $action = 'xem'; // default action is to view the list
}

$kh = new KhachHang();
switch ($action) {
    case 'xem':
        $khachhangs = $kh->layTatCaKhachHang();
        include 'main.php';
        break;
    case 'them':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $kh->setHoTen($_POST['hoten']);
            $kh->setEmail($_POST['email']);
            $kh->setSoDienThoai($_POST['sodienthoai']);
            $kh->setGioiTinh($_POST['gioitinh']);
            $kh->setNamSinh($_POST['ngaysinh']);
            $kh->setDiaChi($_POST['diachi']);
            $kh->setDiemThuong(0);

            $kh->themKhachHang($kh);
            echo '<script>alert("Thêm khách hàng thành công!"); window.location="index.php";</script>';
        }
        break;
    case 'sua':
        $id = $_GET['id'];
        $khachhang = $kh->layKhachHangTheoId($id);
        include('sua.php');
        break;
    case 'capnhat':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $kh->setMaKhachHang($_POST['id']);
            $kh->setHoTen($_POST['txthoten']);
            $kh->setEmail($_POST['txtemail']);
            $kh->setSoDienThoai($_POST['txtsodienthoai']);
            $kh->setDiaChi($_POST['txtdiachi']);
            $kh->setNamSinh($_POST['txtngaysinh']);
            $kh->setGioiTinh($_POST['txtgioitinh']);

            $kh->capNhatKhachHang($kh);
            header('Location: index.php');
        }
        break;
    case 'xoa':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $kh->xoaKhachHang($id);
            echo '<script>alert("Xóa khách hàng thành công!"); window.location="index.php";</script>';
        }
        break;
    default:
        break;
}
