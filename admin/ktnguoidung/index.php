<?php
session_start();
require("../../model/database.php");
require("../../model/taikhoan.php");
// Biến $isLogin cho biết người dùng đăng nhập chưa
$isLogin = isset($_SESSION["nguoidung"]);
// Kiểm tra hành động $action: yêu cầu đăng nhập nếu chưa xác thực
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} elseif ($isLogin == false) {
    $action = "dangnhap";
} else {
    $action = "macdinh";
}
$tk = new TAIKHOAN();
switch ($action) {
    case "macdinh":
        include("main.php");
        break;
    case "dangnhap":
        include("login.php");
        break;
    case "xulydangnhap":
        // xử lý đăng nhập chuyển sang file xử lý riêng
        include("xulydangnhap.php");
        break;
    case "xldangnhap":
        // legacy: process inline login (kept for compatibility)
        $username = isset($_POST["txtusername"]) ? $_POST["txtusername"] : '';
        $password = isset($_POST["txtmatkhau"]) ? $_POST["txtmatkhau"] : '';
        if ($tk->kiemtrataikhoanhople($username, $password) == true) {
            $_SESSION["nguoidung"] = $tk->laythongtin($username);
            include("main.php");
        } else {
            include("login.php");
        }
        break;
    case "hoso":
        // show account info (TaiKhoan has limited fields)
        include("profile.php");
        break;
    case "xlhoso":
        // TaiKhoan table does not store profile details in this schema;
        // no-op or future extension; just reload main
        include("main.php");
        break;
    case "matkhau":
        include("changepass.php");
        break;
    case "doimatkhau":
        if (isset($_POST["txtusername"]) && isset($_POST["txtmatkhaumoi"])) {
            $tk->doimatkhau($_POST["txtusername"], $_POST["txtmatkhaumoi"]);
            // update session info if logged in user changed own password
            if (isset($_SESSION["nguoidung"]) && $_SESSION["nguoidung"]["email"] === $_POST["txtusername"]) {
                $_SESSION["nguoidung"] = $tk->laythongtin($_POST["txtusername"]);
            }
        } else {
            echo "chưa đổi được mật khẩu";
        }
        include("main.php");
        break;
    case "dangxuat":
        unset($_SESSION["nguoidung"]);
        include("login.php");
        break;
    default:
        break;
}
?>