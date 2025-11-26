<?php
session_start();
if (!isset($_SESSION["nguoidung"])) {
    header("location:../index.php");
    exit();
}
require("../../model/database.php");
require("../../model/nhanvien.php");
require("../../model/cuahang.php");

$nv = new NHANVIEN();
$chModel = new CUAHANG();

$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "xem";

switch ($action) {
    case "xem":
        $nhanvien = $nv->layNhanVien();
        include("main.php");
        break;
    case "them":
        $cuahang = $chModel->layCuaHang();
        // lấy list chức vụ để chọn (ChucVu table)
        $db = DATABASE::connect();
        $cmd = $db->prepare("SELECT * FROM ChucVu");
        $cmd->execute();
        $chucvu = $cmd->fetchAll(PDO::FETCH_ASSOC);
        include("addform.php");
        break;
    case "xulythem":
        $data = [
            "HoTen" => $_POST["txthoten"],
            "GioiTinh" => $_POST["optgioitinh"],
            "SoDT" => $_POST["txtsodt"],
            "DiaChi" => $_POST["txtdiachi"],
            "NamSinh" => $_POST["txtnamsinh"],
            "Email" => $_POST["txtemail"],
            "MaCuaHang" => $_POST["optcuahang"] ?: null,
            "MaCV" => $_POST["optchucvu"] ?: null
        ];
        $nv->themNhanVien($data);
        $nhanvien = $nv->layNhanVien();
        include("main.php");
        break;
    case "sua":
        $id = $_GET["id"];
        $m = $nv->layNhanVienTheoId($id);
        $cuahang = $chModel->layCuaHang();
        $db = DATABASE::connect();
        $cmd = $db->prepare("SELECT * FROM ChucVu");
        $cmd->execute();
        $chucvu = $cmd->fetchAll(PDO::FETCH_ASSOC);
        include("updateform.php");
        break;
    case "xulysua":
        $id = $_POST["txtid"];
        $data = [
            "HoTen" => $_POST["txthoten"],
            "GioiTinh" => $_POST["optgioitinh"],
            "SoDT" => $_POST["txtsodt"],
            "DiaChi" => $_POST["txtdiachi"],
            "NamSinh" => $_POST["txtnamsinh"],
            "Email" => $_POST["txtemail"],
            "MaCuaHang" => $_POST["optcuahang"] ?: null,
            "MaCV" => $_POST["optchucvu"] ?: null
        ];
        $nv->capNhatNhanVien($id, $data);
        $nhanvien = $nv->layNhanVien();
        include("main.php");
        break;
    case "xoa":
        if (isset($_GET["id"])) {
            $nv->xoaNhanVien($_GET["id"]);
        }
        $nhanvien = $nv->layNhanVien();
        include("main.php");
        break;
    default:
        break;
}
?>
