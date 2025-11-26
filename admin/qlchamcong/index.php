<?php
session_start();
if(!isset($_SESSION["nguoidung"])) {
    header("location:../ktnguoidung/login.php");
    exit();
}

require("../../model/database.php");
require("../../model/chamcong.php");
require("../../model/nhanvien.php");

$cc = new CHAMCONG();
$nv = new NHANVIEN();

// Xử lý action
$action = $_GET['action'] ?? 'list';

switch($action) {
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $manv = $_POST['MaNhanVien'];
            $ngaycham = $_POST['NgayCham'];
            $giovao = $_POST['GioVao'];
            $giora = $_POST['GioRa'];
            $thoigianlam = $_POST['ThoiGianLam'];
            $danhgia = $_POST['DanhGia'];
            $ghichu = $_POST['GhiChu'];
            $result = $cc->themchamcong($manv, $ngaycham, $giovao, $giora, $thoigianlam, $danhgia, $ghichu);
            if ($result) {
                echo '<script>alert("Thêm chấm công thành công!"); window.location="index.php";</script>';
            } else {
                echo '<script>alert("Thêm chấm công thất bại!"); window.history.back();</script>';
            }
            exit();
        }
        $dsnhanvien = $nv->laynhanvien();
        include("addform.php");
        break;
        
    case 'edit':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['MaChamCong'];
            $manv = $_POST['MaNhanVien'];
            $ngaycham = $_POST['NgayCham'];
            $giovao = $_POST['GioVao'];
            $giora = $_POST['GioRa'];
            $thoigianlam = $_POST['ThoiGianLam'];
            $danhgia = $_POST['DanhGia'];
            $ghichu = $_POST['GhiChu'];
            $result = $cc->capnhatchamcong($id, $manv, $ngaycham, $giovao, $giora, $thoigianlam, $danhgia, $ghichu);
            if ($result) {
                echo '<script>alert("Cập nhật chấm công thành công!"); window.location="index.php";</script>';
            } else {
                echo '<script>alert("Cập nhật chấm công thất bại!"); window.history.back();</script>';
            }
            exit();
        }
        $id = $_GET['id'];
        $chamcong = $cc->laychamcongtheoid($id);
        $dsnhanvien = $nv->laynhanvien();
        include("updateform.php");
        break;
        
    case 'delete':
        $id = $_GET['id'];
        $result = $cc->xoachamcong($id);
        if ($result) {
            echo '<script>alert("Xóa chấm công thành công!"); window.location="index.php";</script>';
        } else {
            echo '<script>alert("Xóa chấm công thất bại!"); window.history.back();</script>';
        }
        exit();
        break;
        
    case 'list':
    default:
        $dschamcong = $cc->laytatcachamcong();
        include("main.php");
        break;
}
?>
