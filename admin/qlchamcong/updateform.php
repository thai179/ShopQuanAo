<?php include("../inc/top.php"); ?>
<h3>Sửa chấm công</h3>
<form method="post" action="index.php">
    <input type="hidden" name="action" value="edit">
    <input type="hidden" name="MaChamCong" value="<?php echo $chamcong['MaChamCong']; ?>">
    <div class="mb-3">
        <label class="form-label">Nhân viên</label>
        <select class="form-select" name="MaNhanVien" required>
            <option value="">-- Chọn nhân viên --</option>
            <?php foreach($dsnhanvien as $item): ?>
                <option value="<?php echo $item['MaNV']; ?>" <?php echo ($item['MaNV'] == $chamcong['MaNhanVien']) ? 'selected' : ''; ?>>
                    <?php echo htmlspecialchars($item['HoTen']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Ngày chấm công</label>
        <input class="form-control" name="NgayCham" type="date" value="<?php echo $chamcong['NgayCham']; ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Giờ vào</label>
        <input class="form-control" name="GioVao" type="time" value="<?php echo $chamcong['GioVao']; ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Giờ ra</label>
        <input class="form-control" name="GioRa" type="time" value="<?php echo $chamcong['GioRa']; ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Thời gian làm (giờ)</label>
        <input class="form-control" name="ThoiGianLam" type="number" step="0.5" value="<?php echo $chamcong['ThoiGianLam']; ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Đánh giá</label>
        <select class="form-select" name="DanhGia">
            <option value="Xuất sắc" <?php echo ($chamcong['DanhGia'] == 'Xuất sắc') ? 'selected' : ''; ?>>Xuất sắc</option>
            <option value="Tốt" <?php echo ($chamcong['DanhGia'] == 'Tốt') ? 'selected' : ''; ?>>Tốt</option>
            <option value="Khá" <?php echo ($chamcong['DanhGia'] == 'Khá') ? 'selected' : ''; ?>>Khá</option>
            <option value="Trung bình" <?php echo ($chamcong['DanhGia'] == 'Trung bình') ? 'selected' : ''; ?>>Trung bình</option>
            <option value="Kém" <?php echo ($chamcong['DanhGia'] == 'Kém') ? 'selected' : ''; ?>>Kém</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Ghi chú</label>
        <input class="form-control" name="GhiChu" type="text" maxlength="255" value="<?php echo $chamcong['GhiChu']; ?>">
    </div>
    <div class="mb-3">
        <input class="btn btn-success" type="submit" value="Cập nhật">
        <input class="btn btn-warning" type="reset" value="Hủy">
        <a href="index.php" class="btn btn-secondary">Quay lại</a>
    </div>
</form>
<?php include("../inc/bottom.php"); ?>
