<?php
session_start();
if(!isset($_SESSION["nguoidung"])){
    header("location:../index.php");
    exit();
}
require("../../model/database.php");
require("../../model/nguoidung.php");

// Xét xem có thao tác nào được chọn
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {
    $action = "xem";
}

$nd = new NGUOIDUNG();

switch ($action) {
    case "xem":
        $nguoidung = $nd->laydanhsachnguoidung();
        include("main.php");
        break;
        
    case "them":
        include("addform.php");
        break;
        
    case "xulythem":
        // Thêm người dùng
        $ndmoi = new NGUOIDUNG();
        $ndmoi->setEmail($_POST['txtemail']);
        $ndmoi->setMatkhau($_POST['txtmatkhau']);
        $ndmoi->setLoai(intval($_POST['optloai']));
        $ndmoi->setTrangthai(1); // Mặc định kích hoạt
        
        $nd->themNguoidung($ndmoi);
        
        // Load lại danh sách
        $nguoidung = $nd->laydanhsachnguoidung();
        include("main.php");
        break;
        
    case "khoa":
        // Khóa/Mở khóa tài khoản
        $username = $_GET["username"];
        $trangthai = $_GET["trangthai"];
        $nd->thayDoiTrangThai($username, $trangthai);
        
        // Load lại danh sách
        $nguoidung = $nd->laydanhsachnguoidung();
        include("main.php");
        break;
        
    case "doiquyen":
        // Đổi quyền người dùng
        $username = $_GET["username"];
        $loai = $_GET["loai"];
        $nd->doiQuyen($username, $loai);
        
        // Load lại danh sách
        $nguoidung = $nd->laydanhsachnguoidung();
        include("main.php");
        break;
        
    default:
        $nguoidung = $nd->laydanhsachnguoidung();
        include("main.php");
        break;
}
?>
    default:
        break;
}
?>