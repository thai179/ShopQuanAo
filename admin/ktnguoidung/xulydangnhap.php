<?php
// Xử lý đăng nhập (xulydangnhap.php)
// file này được include từ index.php với session đã được start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../model/database.php';
require_once __DIR__ . '/../../model/taikhoan.php';

$username = isset($_POST['txtusername']) ? trim($_POST['txtusername']) : '';
$password = isset($_POST['txtmatkhau']) ? $_POST['txtmatkhau'] : '';

$tk = new TAIKHOAN();

if (empty($username) || empty($password)) {
    header('Location: index.php?action=dangnhap&error=missing');
    exit();
}

try {
    if ($tk->kiemtrataikhoanhople($username, $password) === true) {
        $_SESSION['nguoidung'] = $tk->laythongtin($username);
        header('Location: index.php?action=macdinh');
        exit();
    } else {
        header('Location: index.php?action=dangnhap&error=invalid');
        exit();
    }
} catch (Exception $e) {
    error_log('Login error: ' . $e->getMessage());
    header('Location: index.php?action=dangnhap&error=server');
    exit();
}
