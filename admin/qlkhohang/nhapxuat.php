<?php
// File này được include từ index.php, không cần session_start() và require model
// $kho và các biến đã được khởi tạo trong index.php

if (!isset($mh)) {
    require("../../model/mathang.php");
    $mh = new MATHANG();
}

if (!isset($_GET['id'])) {
    echo "<script>alert('Không tìm thấy kho hàng!'); window.location='index.php?action=qlkhohang';</script>";
    exit();
}

$maKho = $_GET['id'];
$thongTinKho = $kho->layKhoHangTheoID($maKho);

if (!$thongTinKho) {
    echo "<script>alert('Kho hàng không tồn tại!'); window.location='index.php?action=qlkhohang';</script>";
    exit();
}

// Xử lý nhập kho
if (isset($_POST['action']) && $_POST['action'] == 'nhapkho') {
    $maSP = $_POST['masp'];
    $soLuong = (int)$_POST['soluong'];
    
    if ($soLuong > 0) {
        $result = $kho->nhapKho($maKho, $maSP, $soLuong);
        if ($result) {
            echo "<script>alert('Nhập kho thành công!'); window.location='index.php?action=qlkhohang&act=nhapxuat&id=$maKho';</script>";
        } else {
            echo "<script>alert('Có lỗi xảy ra!'); window.location='index.php?action=qlkhohang&act=nhapxuat&id=$maKho';</script>";
        }
    }
}

// Xử lý xuất kho
if (isset($_POST['action']) && $_POST['action'] == 'xuatkho') {
    $maSP = $_POST['masp'];
    $soLuong = (int)$_POST['soluong'];
    
    if ($soLuong > 0) {
        $result = $kho->xuatKho($maKho, $maSP, $soLuong);
        if ($result) {
            echo "<script>alert('Xuất kho thành công!'); window.location='index.php?action=qlkhohang&act=nhapxuat&id=$maKho';</script>";
        } else {
            echo "<script>alert('Không đủ hàng trong kho hoặc có lỗi xảy ra!'); window.location='index.php?action=qlkhohang&act=nhapxuat&id=$maKho';</script>";
        }
    }
}

$danhSachSP = $mh->laymathang();
$danhSachSPTrongKho = $kho->layDanhSachSanPhamTrongKho($maKho);

include("../inc/top.php");
?>

<h3>Nhập/Xuất Kho: <?php echo $thongTinKho['TenKhoHang']; ?></h3>

<a href="index.php?action=qlkhohang&act=chitiet&id=<?php echo $maKho; ?>" class="btn btn-secondary">
    <i class="align-middle" data-feather="arrow-left"></i> Quay lại
</a>
<br><br>

<div class="row">
    <!-- Form Nhập Kho -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-success">
                <h5 class="card-title mb-0 text-white">Nhập Kho</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="action" value="nhapkho">
                    <div class="mb-3">
                        <label class="form-label">Chọn sản phẩm <span class="text-danger">*</span></label>
                        <select class="form-select" name="masp" required>
                            <option value="">-- Chọn sản phẩm --</option>
                            <?php foreach ($danhSachSP as $sp): ?>
                            <option value="<?php echo $sp['MaSP']; ?>">
                                <?php echo $sp['TenSP']; ?> - Giá: <?php echo number_format($sp['GiaGoc']); ?>đ
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số lượng nhập <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="soluong" min="1" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">
                        <i class="align-middle" data-feather="plus-circle"></i> Nhập Kho
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Form Xuất Kho -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-danger">
                <h5 class="card-title mb-0 text-white">Xuất Kho</h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <input type="hidden" name="action" value="xuatkho">
                    <div class="mb-3">
                        <label class="form-label">Chọn sản phẩm <span class="text-danger">*</span></label>
                        <select class="form-select" name="masp" id="selectXuatKho" required onchange="showSoLuongTon(this.value)">
                            <option value="">-- Chọn sản phẩm --</option>
                            <?php foreach ($danhSachSPTrongKho as $sp): ?>
                            <option value="<?php echo $sp['MaSP']; ?>" data-soluong="<?php echo $sp['SoLuongTon']; ?>">
                                <?php echo $sp['TenSP']; ?> - Tồn: <?php echo $sp['SoLuongTon']; ?>
                            </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Số lượng xuất <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="soluong" id="soluongXuat" min="1" required>
                        <small class="text-muted" id="thongBaoTon"></small>
                    </div>
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="align-middle" data-feather="minus-circle"></i> Xuất Kho
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<br>
<h5>Sản phẩm hiện có trong kho</h5>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Mã SP</th>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng tồn</th>
            <th>Giá gốc</th>
            <th>Giá trị tồn</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($danhSachSPTrongKho) > 0): ?>
            <?php foreach ($danhSachSPTrongKho as $sp): ?>
            <tr>
                <td><?php echo $sp['MaSP']; ?></td>
                <td>
                    <img src="../../images/products/<?php echo $sp['HinhAnh']; ?>" 
                         width="50" class="img-thumbnail">
                </td>
                <td><?php echo $sp['TenSP']; ?></td>
                <td>
                    <span class="badge <?php echo $sp['SoLuongTon'] <= 10 ? 'bg-danger' : 'bg-success'; ?>">
                        <?php echo $sp['SoLuongTon']; ?>
                    </span>
                </td>
                <td><?php echo number_format($sp['GiaGoc']); ?> đ</td>
                <td><?php echo number_format($sp['GiaTriTon']); ?> đ</td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">Kho hàng trống</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<script>
function showSoLuongTon(maSP) {
    const select = document.getElementById('selectXuatKho');
    const option = select.options[select.selectedIndex];
    const soLuongTon = option.getAttribute('data-soluong');
    const input = document.getElementById('soluongXuat');
    const thongBao = document.getElementById('thongBaoTon');
    
    if (soLuongTon) {
        input.max = soLuongTon;
        thongBao.textContent = `Số lượng tồn kho: ${soLuongTon}`;
    } else {
        input.max = '';
        thongBao.textContent = '';
    }
}
</script>

<?php include("../inc/bottom.php"); ?>
