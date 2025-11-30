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
        $username = isset($_POST["txtusername"]) ? $_POST["txtusername"] : '';
        $password = isset($_POST["txtmatkhau"]) ? $_POST["txtmatkhau"] : '';
        if ($tk->kiemtrataikhoanadmin($username, $password) == true) {
            $_SESSION["nguoidung"] = $tk->laythongtin($username);
            include("main.php");
        } else {
            echo '<script>alert("Tên đăng nhập hoặc mật khẩu không đúng."); window.location="index.php?action=dangnhap";</script>';
            include("login.php");
        }
        break;
    case "hoso":
        include("profile.php");
        break;
    case "xlhoso":
        include("main.php");
        break;
    case "matkhau":
        include("changepass.php");
        break;
    case "doimatkhau":
        if (isset($_POST["txtusername"], $_POST["txtmatkhaumoi"], $_POST["txtxacnhanmatkhau"])) {
            $matkhaumoi = $_POST["txtmatkhaumoi"];
            $xacnhanmatkhau = $_POST["txtxacnhanmatkhau"];

            if ($matkhaumoi !== $xacnhanmatkhau) {
                echo '<script>alert("Mật khẩu mới và mật khẩu xác nhận không khớp!"); window.location="index.php?action=matkhau";</script>';
                exit();
            }

            $tk->doimatkhau($_POST["txtusername"], md5($matkhaumoi));
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