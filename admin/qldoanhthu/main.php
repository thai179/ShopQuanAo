<?php include("../inc/top.php"); ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="text-dark mb-0">Quản lý doanh thu</h3>
    
    <!-- Bộ lọc compact -->
    <form method="get" action="index.php" class="d-flex gap-2 align-items-center">
        <input type="hidden" name="view" value="<?= $view ?>">
        
        <!-- Dropdown nhanh -->
        <select name="preset" class="form-control form-control-sm" style="width: 150px;" onchange="if(this.value) this.form.submit()">
            <option value="">Chọn khoảng thời gian</option>
            <option value="today">Hôm nay</option>
            <option value="7days">7 ngày qua</option>
            <option value="30days">30 ngày qua</option>
            <option value="thismonth">Tháng này</option>
        </select>
        
        <span class="text-muted">hoặc</span>
        
        <!-- Tùy chỉnh từ ngày đến ngày -->
        <input type="date" name="tungay" class="form-control form-control-sm" style="width: 140px;" 
               value="<?= $tuNgay ?>" placeholder="Từ ngày">
        <span class="text-muted">-</span>
        <input type="date" name="denngay" class="form-control form-control-sm" style="width: 140px;" 
               value="<?= $denNgay ?>" placeholder="Đến ngày">
        
        <button type="submit" class="btn btn-sm btn-primary">
            <i data-feather="filter" style="width: 14px; height: 14px;"></i> Lọc
        </button>
        
        <?php if ($tuNgay || $denNgay): ?>
            <a href="index.php?view=<?= $view ?>" class="btn btn-sm btn-secondary">
                <i data-feather="x" style="width: 14px; height: 14px;"></i>
            </a>
        <?php endif; ?>
    </form>
</div>

<!-- Menu tab compact -->
<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a class="nav-link <?= ($view == 'tongquan') ? 'active' : '' ?>" href="index.php?view=tongquan">
            <i data-feather="bar-chart-2"></i> Tổng quan
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($view == 'theo-ngay') ? 'active' : '' ?>" href="index.php?view=theo-ngay">
            <i data-feather="calendar"></i> Theo ngày
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($view == 'san-pham') ? 'active' : '' ?>" href="index.php?view=san-pham">
            <i data-feather="package"></i> Sản phẩm
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($view == 'danh-muc') ? 'active' : '' ?>" href="index.php?view=danh-muc">
            <i data-feather="grid"></i> Danh mục
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?= ($view == 'khach-hang') ? 'active' : '' ?>" href="index.php?view=khach-hang">
            <i data-feather="users"></i> Khách hàng
        </a>
    </li>
</ul>

<!-- Thống kê tổng quan compact -->
<?php if ($tongQuan): ?>
<div class="row mb-3">
    <div class="col-md-4">
        <div class="card bg-primary text-white">
            <div class="card-body py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-white-50">Tổng doanh thu</small>
                        <h4 class="mb-0"><?= number_format($tongQuan['TongDoanhThu'] ?? 0) ?>đ</h4>
                    </div>
                    <i data-feather="dollar-sign"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-success text-white">
            <div class="card-body py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-white-50">Tổng đơn hàng</small>
                        <h4 class="mb-0"><?= number_format($tongQuan['TongDonHang'] ?? 0) ?></h4>
                    </div>
                    <i data-feather="shopping-cart"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card bg-info text-white">
            <div class="card-body py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-white-50">Sản phẩm đã bán</small>
                        <h4 class="mb-0"><?= number_format($tongQuan['TongSanPhamBan'] ?? 0) ?></h4>
                    </div>
                    <i data-feather="package"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Nội dung theo view -->
<?php if ($view == 'tongquan'): ?>
    <!-- Tổng quan compact -->
    <div class="row">
        <div class="col-md-8 mb-3">
            <div class="card">
                <div class="card-header text-dark bg-white">
                    <i data-feather="trending-up"></i> Doanh thu 30 ngày gần nhất
                </div>
                <div class="card-body p-3">
                    <canvas id="doanhThuChart" height="60"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-header text-dark bg-white">
                    <i data-feather="pie-chart"></i> Phân bổ trạng thái
                </div>
                <div class="card-body p-3">
                    <canvas id="trangThaiChart" height="180"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header text-dark bg-white">
                    <i data-feather="bar-chart"></i> Top 5 danh mục
                </div>
                <div class="card-body p-3">
                    <canvas id="danhMucChart" height="80"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-header text-dark bg-white">
                    <i data-feather="package"></i> Top 5 sản phẩm bán chạy
                </div>
                <div class="card-body p-2">
                    <table class="table table-sm table-hover mb-0">
                        <tbody>
                            <?php foreach ($topSanPham as $sp): ?>
                            <tr>
                                <td class="py-2">
                                    <img src="../../images/products/<?= $sp['HinhAnh'] ?>" width="24" class="me-2">
                                    <?= $sp['TenSP'] ?>
                                </td>
                                <td class="py-2 text-end"><small><?= number_format($sp['TongSoLuong']) ?> sp</small></td>
                                <td class="py-2 text-end text-success"><small><strong><?= number_format($sp['TongDoanhThu']/1000) ?>k</strong></small></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php elseif ($view == 'theo-ngay'): ?>
    <!-- Doanh thu theo ngày -->
    <div class="card">
        <div class="card-header text-dark bg-white">
            <i data-feather="calendar"></i> Doanh thu theo ngày
        </div>
        <div class="card-body p-3">
            <canvas id="doanhThuNgayChart" height="60"></canvas>
            <hr>
            <div style="max-height: 400px; overflow-y: auto;">
                <table class="table table-sm table-hover mb-0">
                    <thead class="sticky-top bg-white">
                        <tr>
                            <th>Ngày</th>
                            <th class="text-end">Đơn hàng</th>
                            <th class="text-end">Số lượng</th>
                            <th class="text-end">Doanh thu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($danhSach)): ?>
                            <?php foreach ($danhSach as $item): ?>
                            <tr>
                                <td><?= date('d/m/Y', strtotime($item['Ngay'])) ?></td>
                                <td class="text-end"><?= number_format($item['SoDonHang']) ?></td>
                                <td class="text-end"><?= number_format($item['SoLuongBan']) ?></td>
                                <td class="text-end text-success fw-bold"><?= number_format($item['DoanhThu']) ?>đ</td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="4" class="text-center text-muted py-3">Chưa có dữ liệu</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php elseif ($view == 'san-pham'): ?>
    <!-- Top sản phẩm bán chạy -->
    <div class="card">
        <div class="card-header text-dark bg-white">
            <i data-feather="package"></i> Top sản phẩm bán chạy
        </div>
        <div class="card-body p-0">
            <div style="max-height: 600px; overflow-y: auto;">
                <table class="table table-hover mb-0">
                    <thead class="sticky-top bg-white">
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Danh mục</th>
                            <th class="text-end">Đơn hàng</th>
                            <th class="text-end">Đã bán</th>
                            <th class="text-end">Doanh thu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($danhSach)): ?>
                            <?php foreach ($danhSach as $sp): ?>
                            <tr>
                                <td>
                                    <img src="../../images/products/<?= $sp['HinhAnh'] ?>" width="40" class="me-2">
                                    <?= $sp['TenSP'] ?>
                                </td>
                                <td><small><?= $sp['TenDanhMuc'] ?></small></td>
                                <td class="text-end"><?= number_format($sp['SoDonHang']) ?></td>
                                <td class="text-end"><?= number_format($sp['TongSoLuong']) ?></td>
                                <td class="text-end text-success fw-bold"><?= number_format($sp['TongDoanhThu']) ?>đ</td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="text-center text-muted py-3">Chưa có dữ liệu</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php elseif ($view == 'danh-muc'): ?>
    <!-- Doanh thu theo danh mục -->
    <div class="card">
        <div class="card-header text-dark bg-white">
            <i data-feather="grid"></i> Doanh thu theo danh mục
        </div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>Danh mục</th>
                        <th class="text-end">Đơn hàng</th>
                        <th class="text-end">Số lượng</th>
                        <th class="text-end">Doanh thu</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($danhSach)): ?>
                        <?php foreach ($danhSach as $dm): ?>
                        <tr>
                            <td><?= $dm['TenDanhMuc'] ?></td>
                            <td class="text-end"><?= number_format($dm['SoDonHang'] ?? 0) ?></td>
                            <td class="text-end"><?= number_format($dm['SoLuongBan'] ?? 0) ?></td>
                            <td class="text-end text-success fw-bold"><?= number_format($dm['DoanhThu'] ?? 0) ?>đ</td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="4" class="text-center text-muted py-3">Chưa có dữ liệu</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

<?php elseif ($view == 'khach-hang'): ?>
    <!-- Top khách hàng -->
    <div class="card">
        <div class="card-header text-dark bg-white">
            <i data-feather="users"></i> Top khách hàng
        </div>
        <div class="card-body p-0">
            <div style="max-height: 600px; overflow-y: auto;">
                <table class="table table-hover mb-0">
                    <thead class="sticky-top bg-white">
                        <tr>
                            <th>Họ tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th class="text-end">Đơn hàng</th>
                            <th class="text-end">Tổng chi tiêu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($danhSach)): ?>
                            <?php foreach ($danhSach as $kh): ?>
                            <tr>
                                <td><?= $kh['HoTen'] ?></td>
                                <td><small><?= $kh['Email'] ?></small></td>
                                <td><small><?= $kh['SoDT'] ?></small></td>
                                <td class="text-end"><?= number_format($kh['SoDonHang']) ?></td>
                                <td class="text-end text-success fw-bold"><?= number_format($kh['TongChiTieu']) ?>đ</td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="text-center text-muted py-3">Chưa có dữ liệu</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
<?php if ($view == 'tongquan'): ?>
    // Biểu đồ doanh thu theo ngày
    const doanhThuData = <?= json_encode(array_slice(array_reverse($doanhThuTheoNgay), 0, 30)) ?>;
    const doanhThuCtx = document.getElementById('doanhThuChart').getContext('2d');
    new Chart(doanhThuCtx, {
        type: 'line',
        data: {
            labels: doanhThuData.map(item => {
                const date = new Date(item.Ngay);
                return date.getDate() + '/' + (date.getMonth() + 1);
            }),
            datasets: [{
                label: 'Doanh thu (đ)',
                data: doanhThuData.map(item => item.DoanhThu),
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.3,
                fill: true
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: true },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Doanh thu: ' + context.parsed.y.toLocaleString('vi-VN') + 'đ';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return (value/1000000).toFixed(1) + 'tr';
                        }
                    }
                }
            }
        }
    });

    // Biểu đồ tròn theo trạng thái
    const trangThaiData = <?= json_encode($doanhThuTheoTrangThai) ?>;
    const trangThaiCtx = document.getElementById('trangThaiChart').getContext('2d');
    new Chart(trangThaiCtx, {
        type: 'doughnut',
        data: {
            labels: trangThaiData.map(item => item.TrangThai),
            datasets: [{
                data: trangThaiData.map(item => item.DoanhThu),
                backgroundColor: [
                    'rgba(40, 167, 69, 0.8)',
                    'rgba(23, 162, 184, 0.8)',
                    'rgba(255, 193, 7, 0.8)',
                    'rgba(220, 53, 69, 0.8)'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'bottom' },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.label + ': ' + context.parsed.toLocaleString('vi-VN') + 'đ';
                        }
                    }
                }
            }
        }
    });

    // Biểu đồ cột danh mục
    const danhMucData = <?= json_encode(array_slice($doanhThuTheoDanhMuc, 0, 5)) ?>;
    const danhMucCtx = document.getElementById('danhMucChart').getContext('2d');
    new Chart(danhMucCtx, {
        type: 'bar',
        data: {
            labels: danhMucData.map(item => item.TenDanhMuc),
            datasets: [{
                label: 'Doanh thu (đ)',
                data: danhMucData.map(item => item.DoanhThu),
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Doanh thu: ' + context.parsed.y.toLocaleString('vi-VN') + 'đ';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return (value/1000000).toFixed(1) + 'tr';
                        }
                    }
                }
            }
        }
    });

<?php elseif ($view == 'theo-ngay'): ?>
    // Biểu đồ doanh thu theo ngày (view detail)
    const ngayData = <?= json_encode(array_reverse($danhSach)) ?>;
    const ngayCtx = document.getElementById('doanhThuNgayChart').getContext('2d');
    new Chart(ngayCtx, {
        type: 'bar',
        data: {
            labels: ngayData.map(item => {
                const date = new Date(item.Ngay);
                return date.getDate() + '/' + (date.getMonth() + 1);
            }),
            datasets: [{
                label: 'Doanh thu (đ)',
                data: ngayData.map(item => item.DoanhThu),
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Doanh thu: ' + context.parsed.y.toLocaleString('vi-VN') + 'đ';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return (value/1000000).toFixed(1) + 'tr';
                        }
                    }
                }
            }
        }
    });
<?php endif; ?>
</script>

<?php include("../inc/bottom.php"); ?>
