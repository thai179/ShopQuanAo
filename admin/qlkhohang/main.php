<?php include("../inc/top.php"); ?>

<h3>Quản lý Kho Hàng</h3>

<?php if (isset($_GET['act']) && $_GET['act'] == "chitiet" && isset($thongTinKho)): ?>
    <!-- Chi tiết kho hàng -->
    <a href="index.php?action=qlkhohang" class="btn btn-secondary">
        <i class="align-middle" data-feather="arrow-left"></i> Quay lại
    </a>
    <a href="index.php?action=qlkhohang&act=nhapxuat&id=<?php echo $thongTinKho['MaKhoHang']; ?>" class="btn btn-success">
        <i class="align-middle" data-feather="arrow-down-up"></i> Nhập/Xuất kho
    </a>
    <br><br>

    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">Thông tin kho: <?php echo $thongTinKho['TenKhoHang']; ?></h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Mã kho:</strong> <?php echo $thongTinKho['MaKhoHang']; ?></p>
                    <p><strong>Địa chỉ:</strong> <?php echo $thongTinKho['DiaChi']; ?></p>
                    <p><strong>Cửa hàng:</strong> <?php echo $thongTinKho['TenCuaHang'] ?? 'Chưa gắn'; ?></p>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-info">
                        <h6>Thống kê tồn kho:</h6>
                        <p class="mb-1"><strong>Tổng sản phẩm:</strong> <?php echo $thongKe['TongSanPham'] ?? 0; ?> loại</p>
                        <p class="mb-1"><strong>Tổng số lượng:</strong> <?php echo number_format($thongKe['TongSoLuong'] ?? 0); ?> sản phẩm</p>
                        <p class="mb-0"><strong>Tổng giá trị:</strong> <?php echo number_format($thongKe['TongGiaTri'] ?? 0); ?> đ</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (count($sanPhamSapHet) > 0): ?>
    <br>
    <div class="alert alert-warning">
        <h6>⚠️ Cảnh báo: Có <?php echo count($sanPhamSapHet); ?> sản phẩm sắp hết hàng (≤ 10)</h6>
        <ul class="mb-0">
            <?php foreach ($sanPhamSapHet as $sp): ?>
                <li><?php echo $sp['TenSP']; ?> - Còn: <?php echo $sp['SoLuongTon']; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <br>
    <h5>Danh sách sản phẩm trong kho</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Mã SP</th>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Danh mục</th>
                <th>Giá gốc</th>
                <th>Số lượng tồn</th>
                <th>Giá trị tồn</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($danhSachSP) > 0): ?>
                <?php foreach ($danhSachSP as $sp): ?>
                <tr>
                    <td><?php echo $sp['MaSP']; ?></td>
                    <td>
                        <img src="../../images/products/<?php echo $sp['HinhAnh']; ?>" 
                             alt="<?php echo $sp['TenSP']; ?>" 
                             width="50" class="img-thumbnail">
                    </td>
                    <td><?php echo $sp['TenSP']; ?></td>
                    <td><?php echo $sp['TenDanhMuc'] ?? 'N/A'; ?></td>
                    <td><?php echo number_format($sp['GiaGoc']); ?> đ</td>
                    <td>
                        <span class="badge <?php echo $sp['SoLuongTon'] <= 10 ? 'bg-danger' : ($sp['SoLuongTon'] <= 50 ? 'bg-warning' : 'bg-success'); ?>">
                            <?php echo $sp['SoLuongTon']; ?>
                        </span>
                    </td>
                    <td><?php echo number_format($sp['GiaTriTon']); ?> đ</td>
                    <td>
                        <?php if ($sp['SoLuongTon'] <= 10): ?>
                            <span class="badge bg-danger">Sắp hết</span>
                        <?php elseif ($sp['SoLuongTon'] <= 50): ?>
                            <span class="badge bg-warning text-dark">Ít hàng</span>
                        <?php else: ?>
                            <span class="badge bg-success">Đủ hàng</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" class="text-center">Kho hàng trống</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

<?php else: ?>
    <!-- Danh sách kho hàng -->
    <a href="index.php?action=qlkhohang&act=them" class="btn btn-info">
        <i class="align-middle" data-feather="plus-circle"></i> Thêm kho hàng
    </a>
    <br><br>
    
    <table class="table table-hover">
        <tr>
            <th>Mã kho</th>
            <th>Tên kho</th>
            <th>Địa chỉ</th>
            <th>Cửa hàng</th>
            <th>Chi tiết</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
        <?php
        $danhSachKho = $kho->layTatCaKhoHang();
        if (count($danhSachKho) > 0):
            foreach ($danhSachKho as $k):
        ?>
        <tr>
            <td><?php echo $k['MaKhoHang']; ?></td>
            <td><strong><?php echo $k['TenKhoHang']; ?></strong></td>
            <td><?php echo $k['DiaChi']; ?></td>
            <td><?php echo $k['TenCuaHang'] ?? 'Chưa gắn'; ?></td>
            <td>
                <a class="btn btn-info" href="index.php?action=qlkhohang&act=chitiet&id=<?php echo $k['MaKhoHang']; ?>">
                    <i class="align-middle" data-feather="eye"></i>
                </a>
            </td>
            <td>
                <a class="btn btn-warning" href="index.php?action=qlkhohang&act=sua&id=<?php echo $k['MaKhoHang']; ?>">
                    <i class="align-middle" data-feather="edit"></i>
                </a>
            </td>
            <td>
                <a class="btn btn-danger" href="index.php?action=qlkhohang&act=xoa&id=<?php echo $k['MaKhoHang']; ?>" 
                   onclick="return confirm('Bạn có chắc muốn xóa kho hàng này?')">
                    <i class="align-middle" data-feather="trash-2"></i>
                </a>
            </td>
        </tr>
        <?php
            endforeach;
        else:
        ?>
        <tr>
            <td colspan="7" class="text-center">Chưa có kho hàng nào</td>
        </tr>
        <?php endif; ?>
    </table>
<?php endif; ?>

<?php include("../inc/bottom.php"); ?>
