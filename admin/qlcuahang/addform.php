<?php include("../inc/top.php"); ?>
<h3>Thêm cửa hàng</h3>
<form method="post" action="index.php">
    <input type="hidden" name="action" value="xulythem">
    <div class="mb-3">
        <label class="form-label">Tên cửa hàng</label>
        <input class="form-control" name="txtten" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Số chi nhánh</label>
        <input class="form-control" type="number" name="txtsochinhanh" value="1">
    </div>
    <div class="mb-3">
        <label class="form-label">Số điện thoại</label>
        <input class="form-control" name="txtsodt">
    </div>
    <div class="mb-3">
        <label class="form-label">Địa chỉ</label>
        <input class="form-control" name="txtdiachi">
    </div>
    <div class="mb-3">
        <label class="form-label">Quản lý (Nhân viên)</label>
        <select class="form-select" name="optmanv">
            <option value="">-- Chọn --</option>
            <?php foreach ($nhanvien as $n): ?>
                <option value="<?php echo $n["MaNV"]; ?>"><?php echo htmlspecialchars($n["HoTen"]); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <input class="btn btn-success" type="submit" value="Lưu">
        <input class="btn btn-warning" type="reset" value="Hủy">
        <a href="index.php" class="btn btn-secondary">Quay lại</a>
    </div>
</form>
<?php include("../inc/bottom.php"); ?>
