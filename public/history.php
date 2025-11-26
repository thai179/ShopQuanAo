<?php include("inc/top.php"); ?>

<div class="container my-5">
    <h3 class="text-info mb-4">
        <i class="bi bi-clock-history"></i> Lịch sử mua hàng
    </h3>

    <?php
    // Dữ liệu mẫu - các đơn hàng
    $donhangs = [
        [
            'madonhang' => 'DH001',
            'ngaydat' => '2025-11-10',
            'tongtien' => 500000,
            'trangthai' => 'Đã giao',
            'diachi' => '123 Nguyễn Huệ, Q.1, TP.HCM',
            'chitiet' => [
                ['tensanpham' => 'Áo thun trắng', 'soluong' => 2, 'dongia' => 150000, 'hinhanh' => 'images/products/ao_trang.jpg'],
                ['tensanpham' => 'Quần jean nam', 'soluong' => 1, 'dongia' => 350000, 'hinhanh' => 'images/products/quan_jean.jpg'],
            ]
        ],
        [
            'madonhang' => 'DH002',
            'ngaydat' => '2025-11-08',
            'tongtien' => 280000,
            'trangthai' => 'Đang giao',
            'diachi' => '456 Lê Lợi, Q.3, TP.HCM',
            'chitiet' => [
                ['tensanpham' => 'Áo sơ mi xanh', 'soluong' => 1, 'dongia' => 200000, 'hinhanh' => 'images/products/ao_somi.jpg'],
                ['tensanpham' => 'Mũ lưỡi trai', 'soluong' => 1, 'dongia' => 80000, 'hinhanh' => 'images/products/mu.jpg'],
            ]
        ],
        [
            'madonhang' => 'DH003',
            'ngaydat' => '2025-11-05',
            'tongtien' => 450000,
            'trangthai' => 'Đã hủy',
            'diachi' => '789 Trần Hưng Đạo, Q.5, TP.HCM',
            'chitiet' => [
                ['tensanpham' => 'Áo khoác da', 'soluong' => 1, 'dongia' => 450000, 'hinhanh' => 'images/products/ao_khoac.jpg'],
            ]
        ],
    ];
    ?>

    <?php if(empty($donhangs)): ?>
        <div class="alert alert-info text-center">
            <i class="bi bi-info-circle"></i> Bạn chưa có đơn hàng nào.
        </div>
    <?php else: ?>
        <div class="accordion" id="accordionOrders">
            <?php foreach($donhangs as $index => $dh): ?>
                <div class="accordion-item mb-3">
                    <h2 class="accordion-header" id="heading<?php echo $index; ?>">
                        <button class="accordion-button <?php echo $index > 0 ? 'collapsed' : ''; ?>" type="button" 
                                data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $index; ?>" 
                                aria-expanded="<?php echo $index == 0 ? 'true' : 'false'; ?>">
                            <div class="w-100 d-flex justify-content-between align-items-center pe-3">
                                <div>
                                    <strong class="text-primary">Đơn hàng #<?php echo $dh['madonhang']; ?></strong>
                                    <span class="ms-3 text-muted">
                                        <i class="bi bi-calendar"></i> <?php echo date('d/m/Y', strtotime($dh['ngaydat'])); ?>
                                    </span>
                                </div>
                                <div class="text-end">
                                    <span class="badge 
                                        <?php 
                                        if($dh['trangthai'] == 'Đã giao') echo 'bg-success';
                                        elseif($dh['trangthai'] == 'Đang giao') echo 'bg-warning';
                                        else echo 'bg-danger';
                                        ?>">
                                        <?php echo $dh['trangthai']; ?>
                                    </span>
                                    <span class="ms-3 fw-bold text-danger">
                                        <?php echo number_format($dh['tongtien']); ?>đ
                                    </span>
                                </div>
                            </div>
                        </button>
                    </h2>
                    <div id="collapse<?php echo $index; ?>" 
                         class="accordion-collapse collapse <?php echo $index == 0 ? 'show' : ''; ?>" 
                         data-bs-parent="#accordionOrders">
                        <div class="accordion-body">
                            <!-- Địa chỉ giao hàng -->
                            <div class="mb-3">
                                <h6><i class="bi bi-geo-alt"></i> Địa chỉ giao hàng:</h6>
                                <p class="ms-4 text-muted"><?php echo $dh['diachi']; ?></p>
                            </div>

                            <!-- Chi tiết sản phẩm -->
                            <h6><i class="bi bi-box-seam"></i> Chi tiết đơn hàng:</h6>
                            <div class="table-responsive">
                                <table class="table table-sm table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Hình ảnh</th>
                                            <th>Sản phẩm</th>
                                            <th>Đơn giá</th>
                                            <th>Số lượng</th>
                                            <th>Thành tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($dh['chitiet'] as $sp): ?>
                                        <tr>
                                            <td>
                                                <img src="../images/products/<?php echo $sp['hinhanh']; ?>" 
                                                     width="50" height="50" 
                                                     class="rounded"
                                                     style="object-fit: cover;">
                                            </td>
                                            <td class="align-middle"><?php echo $sp['tensanpham']; ?></td>
                                            <td class="align-middle"><?php echo number_format($sp['dongia']); ?>đ</td>
                                            <td class="align-middle"><?php echo $sp['soluong']; ?></td>
                                            <td class="align-middle fw-bold text-primary">
                                                <?php echo number_format($sp['dongia'] * $sp['soluong']); ?>đ
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-end fw-bold">Tổng cộng:</td>
                                            <td class="fw-bold text-danger">
                                                <?php echo number_format($dh['tongtien']); ?>đ
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <!-- Các nút hành động -->
                            <div class="text-end mt-3">
                                <?php if($dh['trangthai'] == 'Đã giao'): ?>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-star"></i> Đánh giá
                                    </button>
                                    <button class="btn btn-sm btn-outline-success">
                                        <i class="bi bi-arrow-repeat"></i> Mua lại
                                    </button>
                                <?php elseif($dh['trangthai'] == 'Đang giao'): ?>
                                    <button class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-truck"></i> Theo dõi đơn hàng
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-x-circle"></i> Hủy đơn
                                    </button>
                                <?php else: ?>
                                    <button class="btn btn-sm btn-outline-success">
                                        <i class="bi bi-arrow-repeat"></i> Đặt lại
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Phân trang (mẫu) -->
        <nav aria-label="Page navigation" class="mt-4">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#"><i class="bi bi-chevron-left"></i></a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#"><i class="bi bi-chevron-right"></i></a>
                </li>
            </ul>
        </nav>
    <?php endif; ?>

    <!-- Nút quay lại -->
    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Quay lại trang chủ
        </a>
    </div>
</div>

<?php include("inc/bottom.php"); ?>
