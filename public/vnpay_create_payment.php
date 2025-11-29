<?php
session_start();
require_once("vnpay_config.php");
require_once("../model/database.php");
require_once("../model/donhang.php");
require_once("../model/mathang.php");

// Kiểm tra xem người dùng đã đăng nhập và có đủ thông tin khách hàng chưa
if (!isset($_SESSION['user']['Username']) || !isset($_SESSION['user']['HoTen'])) {
    // Có thể chuyển hướng đến trang đăng nhập hoặc hiển thị thông báo lỗi
    die("Bạn cần đăng nhập đầy đủ thông tin để thực hiện thanh toán. Vui lòng đăng nhập lại.");
}

// Lưu đơn hàng vào database với trạng thái "Chưa thanh toán" (mã 0)
$dh = new DONHANG();
$mh = new MATHANG();
$ma_kh = $_SESSION['user']['MaKhachHang']; // Lấy mã khách hàng từ session, đã được kiểm tra ở trên

// Chuẩn bị chi tiết đơn hàng
$chitietdonhang = [];
$size = null; // Khởi tạo biến size
foreach ($_SESSION['cart'] as $cart_key => $item) {
    $sp = $mh->laymathangtheoid($item['id']);
    if ($sp) {
        $chitietdonhang[] = [
            'MaSP' => $sp['MaSP'],
            'SoLuong' => $item['soluong'],
            'ThanhTien' => $sp['GiaBan'] * $item['soluong']
        ];
        $size = $item['size']; // Lấy size từ giỏ hàng
    }
}

$ma_don_hang_db = $dh->themdonhang($ma_kh, 0, $chitietdonhang, $size);

// Nếu thêm đơn hàng thất bại, dừng lại
if(!$ma_don_hang_db) {
    die("Có lỗi xảy ra khi tạo đơn hàng. Vui lòng thử lại.");
}

$vnp_TxnRef = $ma_don_hang_db; // Sử dụng mã đơn hàng từ DB để làm mã giao dịch VNPAY
$vnp_OrderInfo = 'Thanh toán đơn hàng tại Shop Quần Áo';
$vnp_OrderType = 'billpayment';
$vnp_Amount = $_POST['tongtien'] * 100;
$vnp_Locale = 'vn';
$vnp_BankCode = ''; // Để trống để khách hàng tự chọn ngân hàng
$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

$inputData = array(
    "vnp_Version" => "2.1.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => $vnp_OrderInfo,
    "vnp_OrderType" => $vnp_OrderType,
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,
);

if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}

ksort($inputData);
$query = "";
$i = 0;
$hashdata = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashdata .= urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}

$vnp_Url = $vnp_Url . "?" . $query;
if (isset($vnp_HashSecret)) {
    $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
}

header('Location: ' . $vnp_Url);
die();