<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mailer {
    /**
     * Gửi email xác nhận đơn hàng cho khách hàng.
     */
    public static function guiEmailXacNhanDonHang($emailNguoiNhan, $tenNguoiNhan, $donhangId, $chiTietDonHang, $tongTien) {
        if (!class_exists('PHPMailer\PHPMailer\PHPMailer')) {
            error_log("Lớp PHPMailer không tìm thấy. Hãy chắc chắn bạn đã cài đặt và autoload đúng cách.");
            return false;
        }

        $mail = new PHPMailer(true);

        try {
            // Cấu hình Server
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'thailxag1122@gmail.com'; // Email của bạn
            $mail->Password   = 'fnlcdzwttgziavdf';    // Mật khẩu ứng dụng Gmail của bạn
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;
            $mail->CharSet    = 'UTF-8';

            // Người gửi và người nhận
            $mail->setFrom('thailxag1122@gmail.com', 'Shop Thời Trang UNI');
            $mail->addAddress($emailNguoiNhan, $tenNguoiNhan);

            // Nội dung Email
            $mail->isHTML(true);
            $mail->Subject = 'Xác nhận đơn hàng #' . $donhangId . ' từ Shop Thời Trang UNI';

            // Tạo nội dung HTML cho email
            $body = '<html><body>';
            $body .= '<h2>Cảm ơn bạn đã mua hàng tại Shop Thời Trang UNI!</h2>';
            $body .= '<p>Xin chào ' . htmlspecialchars($tenNguoiNhan) . ',</p>';
            $body .= '<p>Đơn hàng #' . $donhangId . ' của bạn đã được xác nhận thành công.</p>';
            $body .= '<h3>Chi tiết đơn hàng:</h3><table border="1" cellpadding="5" cellspacing="0" style="width:100%; border-collapse: collapse;"><thead style="background-color:#f2f2f2;"><tr><th>Tên sản phẩm</th><th>Số lượng</th><th>Đơn giá</th><th>Thành tiền</th></tr></thead><tbody>';
            foreach ($chiTietDonHang as $item) {
                $body .= '<tr><td>' . htmlspecialchars($item['TenSP']) . '</td><td>' . $item['SoLuong'] . '</td><td>' . number_format($item['GiaBan']) . ' đ</td><td>' . number_format($item['ThanhTien']) . ' đ</td></tr>';
            }
            $body .= '</tbody><tfoot><tr><td colspan="3" style="text-align:right; font-weight:bold;">Tổng cộng:</td><td style="font-weight:bold;">' . number_format($tongTien) . ' đ</td></tr></tfoot></table>';
            $body .= '<p>Chúng tôi sẽ sớm xử lý và giao hàng cho bạn. Cảm ơn bạn đã tin tưởng và mua sắm!</p><p>Trân trọng,<br>Đội ngũ Shop Thời Trang UNI</p></body></html>';
            $mail->Body = $body;
            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Không thể gửi mail. Lỗi PHPMailer: {$mail->ErrorInfo}");
            return false;
        }
    }
}
