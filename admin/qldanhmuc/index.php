<?php
session_start();
if (!isset($_SESSION["nguoidung"])) {
    header("location:../index.php");
    exit();
}
require("../../model/database.php");
require("../../model/danhmuc.php");

// Xét xem có thao tác nào được chọn
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {   // mặc định là xem danh sách
    $action = "xem";
}

$dm = new DANHMUC();
$idsua = 0; // Khởi tạo biến $idsua với giá trị mặc định


switch ($action) {
    case "xem":
        $danhmuc = $dm->laydanhmuc();
        include("main.php");
        break;
    case "them":
        $danhmucmoi = new DANHMUC();
        $danhmucmoi->settendanhmuc($_POST["ten"]);
        $dm->themdanhmuc($danhmucmoi);
        $danhmuc = $dm->laydanhmuc();
        include("main.php");
        break;
    case "xoa":
        $danhmucxoa = new DANHMUC();
        $danhmucxoa->setid($_GET["MaDM"]);
        $dm->xoadanhmuc($danhmucxoa);
        $danhmuc = $dm->laydanhmuc();
        include("main.php");
        break;
    case "sua":
        $idsua = $_GET["MaDM"];
        $danhmuc = $dm->laydanhmuc();
        include("main.php");
        break;
    case "capnhat":
        $danhmucsua = new DANHMUC();
        $danhmucsua->setid($_POST["id"]);
        $danhmucsua->settendanhmuc($_POST["ten"]);
        $dm->capnhatdanhmuc($danhmucsua);
        $danhmuc = $dm->laydanhmuc();
        include("main.php");
        break;
    default:
        break;
}
?>
