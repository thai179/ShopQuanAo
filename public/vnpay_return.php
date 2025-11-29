<?php

include("inc/top.php");
?>

<div class="container my-5 text-center">
    <div class="card shadow-sm mx-auto" style="max-width: 600px;">
        <div class="card-body p-5">
            <?php
            if ($thongbao_vnpay == "Thanh toán thành công!"):
            ?>
                <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                <h3 class="text-success mt-3">Thanh toán thành công!</h3>
                <p>Cảm ơn bạn đã mua hàng. Mã đơn hàng của bạn là: <strong><?= htmlspecialchars($vnp_TxnRef) ?></strong></p>
                <p>Số tiền đã thanh toán: <strong><?= number_format($vnp_Amount / 100) ?> VNĐ</strong></p>
                <a href="index.php" class="btn btn-primary mt-3"><i class="bi bi-house-door"></i> Về trang chủ</a>
            
            <?php elseif ($thongbao_vnpay == "Thanh toán không thành công!"): ?>
                <i class="bi bi-x-circle-fill text-danger" style="font-size: 5rem;"></i>
                <h3 class="text-danger mt-3">Thanh toán không thành công!</h3>
                <p>Đã có lỗi xảy ra trong quá trình xử lý. Vui lòng thử lại.</p>
                <p>Mã lỗi VNPAY: <?= htmlspecialchars($vnp_ResponseCode) ?></p>
                <a href="index.php?action=giohang" class="btn btn-warning mt-3"><i class="bi bi-arrow-left"></i> Quay lại giỏ hàng</a>
            
            <?php else: // Lỗi bảo mật ?>
                echo '<i class="bi bi-shield-exclamation text-danger" style="font-size: 5rem;"></i>';
                echo '<h3 class="text-danger mt-3">Lỗi bảo mật!</h3>';
                echo "<p>Chữ ký không hợp lệ. Giao dịch có thể đã bị giả mạo.</p>";
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include("inc/bottom.php"); ?>
