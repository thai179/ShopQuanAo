<?php
session_start();
if (!isset($_SESSION["nguoidung"])) {
    header("location:../index.php");
    exit();
}
require("../../model/database.php");
require("../../model/cuahang.php");
require("../../model/nhanvien.php");

$c = new CUAHANG();
$nvModel = new NHANVIEN();

$action = isset($_REQUEST["action"]) ? $_REQUEST["action"] : "xem";

switch ($action) {
    case "xem":
        $cuahang = $c->layCuaHang();
        include("main.php");
        break;
    case "them":
        // show add form, need list of employees for manager selection
        $nhanvien = $nvModel->layNhanVien();
        include("addform.php");
        break;
    case "xulythem":
        $data = [
            "TenCuaHang" => $_POST["txtten"],
            "SoChiNhanh" => $_POST["txtsochinhanh"],
            "SoDT" => $_POST["txtsodt"],
            "DiaChi" => $_POST["txtdiachi"],
            "MaNVQuanLy" => $_POST["optmanv"] ?: null
        ];
        $c->themCuaHang($data);
        $cuahang = $c->layCuaHang();
        include("main.php");
        break;
    case "sua":
        $id = $_GET["id"];
        $ch = $c->layCuaHangTheoId($id);
        $nhanvien = $nvModel->layNhanVien();
        include("updateform.php");
        break;
    case "xulysua":
        $id = $_POST["txtid"];
        $data = [
            "TenCuaHang" => $_POST["txtten"],
            "SoChiNhanh" => $_POST["txtsochinhanh"],
            "SoDT" => $_POST["txtsodt"],
            "DiaChi" => $_POST["txtdiachi"],
            "MaNVQuanLy" => $_POST["optmanv"] ?: null
        ];
        $c->capNhatCuaHang($id, $data);
        $cuahang = $c->layCuaHang();
        include("main.php");
        break;
    case "xoa":
        if (isset($_GET["id"])) {
            $c->xoaCuaHang($_GET["id"]);
        }
        $cuahang = $c->layCuaHang();
        include("main.php");
        break;
    default:
        break;
}
?>
