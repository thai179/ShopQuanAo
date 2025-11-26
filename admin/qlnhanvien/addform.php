<?php include("../inc/top.php"); ?>
<h3>Thêm nhân viên</h3>
<form method="post" action="index.php">
    <input type="hidden" name="action" value="xulythem">
    <div class="mb-3">
        <label class="form-label">Họ tên</label>
        <input class="form-control" name="txthoten" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Giới tính</label>
        <select class="form-select" name="optgioitinh">
            <option value="Nam">Nam</option>
            <option value="Nữ">Nữ</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Số điện thoại</label>
        <input class="form-control" name="txtsodt">
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input class="form-control" name="txtemail" type="email">
    </div>
    <div class="mb-3">
        <label class="form-label">Địa chỉ</label>
        <input class="form-control" name="txtdiachi">
    </div>
    <div class="mb-3">
        <label class="form-label">Năm sinh</label>
        <input class="form-control" name="txtnamsinh" type="number" placeholder="YYYY">
    </div>
    <div class="mb-3">
        <label class="form-label">Cửa hàng</label>
        <select class="form-select" name="optcuahang">
            <option value="">-- Chọn --</option>
            <?php foreach ($cuahang as $c): ?>
                <option value="<?php echo $c["MaCuaHang"]; ?>"><?php echo htmlspecialchars($c["TenCuaHang"]); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Chức vụ</label>
        <select class="form-select" name="optchucvu">
            <option value="">-- Chọn --</option>
            <?php foreach ($chucvu as $cv): ?>
                <option value="<?php echo $cv["MaCV"]; ?>"><?php echo htmlspecialchars($cv["TenCV"]); ?></option>
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
