<?php include("../inc/top.php"); ?>
<h3>Cập nhật nhân viên</h3>
<form method="post" action="index.php">
    <input type="hidden" name="action" value="xulysua">
    <input type="hidden" name="txtid" value="<?php echo $m['MaNV']; ?>">
    <div class="mb-3">
        <label class="form-label">Họ tên</label>
        <input class="form-control" name="txthoten" value="<?php echo htmlspecialchars($m['HoTen']); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Giới tính</label>
        <select class="form-select" name="optgioitinh">
            <option value="Nam" <?php if($m['GioiTinh']=='Nam') echo 'selected'; ?>>Nam</option>
            <option value="Nữ" <?php if($m['GioiTinh']=='Nữ') echo 'selected'; ?>>Nữ</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Số điện thoại</label>
        <input class="form-control" name="txtsodt" value="<?php echo htmlspecialchars($m['SoDT']); ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Email</label>
        <input class="form-control" name="txtemail" type="email" value="<?php echo htmlspecialchars($m['Email']); ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Địa chỉ</label>
        <input class="form-control" name="txtdiachi" value="<?php echo htmlspecialchars($m['DiaChi']); ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Năm sinh</label>
        <input class="form-control" name="txtnamsinh" type="number" value="<?php echo $m['NamSinh']; ?>">
    </div>
    <div class="mb-3">
        <label class="form-label">Cửa hàng</label>
        <select class="form-select" name="optcuahang">
            <option value="">-- Chọn --</option>
            <?php foreach ($cuahang as $c): ?>
                <option value="<?php echo $c["MaCuaHang"]; ?>" <?php if ($c["MaCuaHang"] == $m["MaCuaHang"]) echo "selected"; ?>><?php echo htmlspecialchars($c["TenCuaHang"]); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Chức vụ</label>
        <select class="form-select" name="optchucvu">
            <option value="">-- Chọn --</option>
            <?php foreach ($chucvu as $cv): ?>
                <option value="<?php echo $cv["MaCV"]; ?>" <?php if ($cv["MaCV"] == $m["MaCV"]) echo "selected"; ?>><?php echo htmlspecialchars($cv["TenCV"]); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <input class="btn btn-primary" type="submit" value="Lưu">
        <a href="index.php" class="btn btn-secondary">Quay lại</a>
    </div>
</form>
<?php include("../inc/bottom.php"); ?>
