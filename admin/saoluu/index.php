<?php
session_start();

if (!$_SESSION['nguoidung']) {
    header('Location: ../login.php');
    exit();
}

require_once '../../model/saoluu.php';
require_once '../../model/database.php';

if (isset($_REQUEST['action']))
    $action = $_REQUEST['action'];
else
    $action = 'xem';

$sl = new SAOLUU();

switch ($action) {
    case 'xem':
        $dsSaoLuu = $sl->layLichSu();
        include 'main.php';
        break;
    case 'taosaoluu':
        $sl->taoSaoLuu();
        header('Location: index.php');
        break;
    case 'phuchoi':
        if (isset($_POST['TenFile'])) {
            $tenfile = trim($_POST['TenFile']);

            if (empty($tenfile)) {
                echo "<script>alert('Tên file sao lưu bị trống!'); window.location.href='index.php';</script>";
                exit;
            }

            try {
                $sl->phucHoi($tenfile);
                echo "<script>alert('Phục hồi sao lưu thành công!'); window.location.href='index.php';</script>";
            } catch (Exception $e) {
                echo "<script>alert('Lỗi: " . addslashes($e->getMessage()) . "'); window.location.href='index.php';</script>";
            }
        } else {
            echo "<script>alert('Không nhận được tên file sao lưu!'); window.location.href='index.php';</script>";
        }
        break;
    default:
        break;
}
