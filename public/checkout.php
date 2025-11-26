<?php include("inc/top.php"); ?>

<div class="container my-5">
    <?php if(demhangtronggio() == 0) { ?>
        <div class="text-center py-5">
            <i class="bi bi-cart-x" style="font-size: 5rem; color: #ccc;"></i>
            <h3 class="text-danger mt-3">Giỏ hàng rỗng!</h3>
            <p>Vui lòng thêm sản phẩm vào giỏ hàng trước khi thanh toán.</p>
            <a href="index.php" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Tiếp tục mua sắm
            </a>
        </div>
    <?php } else { 
        // Lấy thông tin khách hàng
        $username = $_SESSION['user']['Username'];
        $khachHang = KHACHHANG::layKhachHangTheoUsername($username);
        
        // Tính tổng tiền giỏ hàng
        $tongtien = 0;
        $giohang = [];
        foreach ($_SESSION['cart'] as $masp => $soluong) {
            $sp = $mh->laymathangtheoid($masp);
            if ($sp) {
                $thanhtien = $sp['GiaBan'] * $soluong;
                $tongtien += $thanhtien;
                $giohang[] = [
                    'MaSP' => $sp['MaSP'],
                    'TenSP' => $sp['TenSP'],
                    'HinhAnh' => $sp['HinhAnh'],
                    'GiaBan' => $sp['GiaBan'],
                    'SoLuong' => $soluong,
                    'ThanhTien' => $thanhtien
                ];
            }
        }
    ?>
        <h3 class="text-info mb-4">
            <i class="bi bi-credit-card-fill"></i> Thanh toán đơn hàng
        </h3>

        <div class="row">
            <!-- Thông tin giao hàng -->
            <div class="col-md-7">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-person-fill"></i> Thông tin giao hàng</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="index.php?action=xulythanhtoan" id="checkoutForm">
                            <div class="mb-3">
                                <label class="form-label">Họ tên <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="hoten" 
                                       value="<?php echo htmlspecialchars($khachHang['HoTen'] ?? ''); ?>" 
                                       required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                <input type="tel" class="form-control" name="sodienthoai" 
                                       value="<?php echo htmlspecialchars($khachHang['SoDT'] ?? ''); ?>" 
                                       required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" 
                                       value="<?php echo htmlspecialchars($khachHang['Email'] ?? ''); ?>" 
                                       required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Địa chỉ giao hàng <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="diachi" rows="3" 
                                          required><?php echo htmlspecialchars($khachHang['DiaChi'] ?? ''); ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Ghi chú đơn hàng</label>
                                <textarea class="form-control" name="ghichu" rows="2" 
                                          placeholder="Ghi chú về đơn hàng, ví dụ: thời gian hay chỉ dẫn địa điểm giao hàng chi tiết hơn."></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Phương thức thanh toán</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="phuongthuc" 
                                           id="cod" value="COD" checked>
                                    <label class="form-check-label" for="cod">
                                        <i class="bi bi-cash"></i> Thanh toán khi nhận hàng (COD)
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="phuongthuc" 
                                           id="bank" value="Chuyển khoản">
                                    <label class="form-check-label" for="bank">
                                        <i class="bi bi-bank"></i> Chuyển khoản ngân hàng
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tóm tắt đơn hàng -->
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="bi bi-cart-check-fill"></i> Đơn hàng của bạn</h5>
                    </div>
                    <div class="card-body">
                        <div style="max-height: 400px; overflow-y: auto;">
                            <?php foreach($giohang as $item): ?>
                            <div class="d-flex mb-3 pb-3 border-bottom">
                                <img src="../images/products/<?php echo $item['HinhAnh']; ?>" 
                                     class="rounded" 
                                     style="width: 60px; height: 60px; object-fit: cover;">
                                <div class="ms-3 flex-grow-1">
                                    <div class="fw-bold"><?php echo $item['TenSP']; ?></div>
                                    <small class="text-muted">
                                        <?php echo number_format($item['GiaBan']); ?>đ × <?php echo $item['SoLuong']; ?>
                                    </small>
                                    <div class="text-primary fw-bold">
                                        <?php echo number_format($item['ThanhTien']); ?>đ
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="border-top pt-3 mt-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Tạm tính:</span>
                                <span class="fw-bold"><?php echo number_format($tongtien); ?>đ</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Phí vận chuyển:</span>
                                <span class="text-success">Miễn phí</span>
                            </div>
                            <div class="d-flex justify-content-between border-top pt-2 mt-2">
                                <span class="fs-5 fw-bold">Tổng cộng:</span>
                                <span class="fs-5 fw-bold text-danger">
                                    <?php echo number_format($tongtien); ?>đ
                                </span>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-3">
                            <button type="submit" form="checkoutForm" class="btn btn-success btn-lg">
                                <i class="bi bi-check-circle"></i> Đặt hàng
                            </button>
                            <a href="index.php?action=giohang" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left"></i> Quay lại giỏ hàng
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<?php include("inc/bottom.php"); ?>
