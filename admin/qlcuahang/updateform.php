<?php include("../inc/top.php"); ?>
<h3>Cập nhật cửa hàng</h3>
<form method="post" action="index.php">
    <input type="hidden" name="action" value="xulysua">
    <input type="hidden" name="txtid" value="<?php echo $ch['MaCuaHang']; ?>">
    <div class="mb-3">
        <label class="form-label">Tên cửa hàng</label>
        <input class="form-control" name="txtten" value="<?php echo htmlspecialchars($ch['TenCuaHang']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Số chi nhánh</label>
        <input class="form-control" type="number" name="txtsochinhanh" value="<?php echo $ch['SoChiNhanh']; ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Số điện thoại</label>
        <input class="form-control" name="txtsodt" value="<?php echo htmlspecialchars($ch['SoDT']); ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Địa chỉ</label>
        <input class="form-control" name="txtdiachi" value="<?php echo htmlspecialchars($ch['DiaChi']); ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Quản lý (Nhân viên)</label>
        <select class="form-select" name="optmanv">
            <option value="">-- Chọn --</option>
            <?php foreach ($nhanvien as $n): ?>
                <option value="<?php echo $n["MaNV"]; ?>" <?php if ($n["MaNV"] == $ch["MaNVQuanLy"]) echo "selected"; ?>><?php echo htmlspecialchars($n["HoTen"]); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <input class="btn btn-primary" type="submit" value="Lưu">
        <a href="index.php" class="btn btn-secondary">Quay lại</a>
    </div>
</form>
<?php include("../inc/bottom.php"); ?>
