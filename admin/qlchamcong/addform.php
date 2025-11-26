<?php include("../inc/top.php"); ?>
<h3>Thêm chấm công</h3>
<form method="post" action="index.php">
    <input type="hidden" name="action" value="add">
    <div class="mb-3">
        <label class="form-label">Nhân viên</label>
        <select class="form-select" name="MaNhanVien" required>
            <option value="">-- Chọn nhân viên --</option>
            <?php foreach($dsnhanvien as $item): ?>
                <option value="<?php echo $item['MaNV']; ?>"><?php echo htmlspecialchars($item['HoTen']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Ngày chấm công</label>
        <input class="form-control" name="NgayCham" type="date" value="<?php echo date('Y-m-d'); ?>" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Giờ vào</label>
        <input class="form-control" name="GioVao" type="time" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Giờ ra</label>
        <input class="form-control" name="GioRa" type="time" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Thời gian làm (giờ)</label>
        <input class="form-control" name="ThoiGianLam" type="number" step="0.5" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Đánh giá</label>
        <select class="form-select" name="DanhGia">
            <option value="Xuất sắc">Xuất sắc</option>
            <option value="Tốt">Tốt</option>
            <option value="Khá">Khá</option>
            <option value="Trung bình">Trung bình</option>
            <option value="Kém">Kém</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Ghi chú</label>
        <input class="form-control" name="GhiChu" type="text" maxlength="255">
    </div>
    <div class="mb-3">
        <input class="btn btn-success" type="submit" value="Lưu">
        <input class="btn btn-warning" type="reset" value="Hủy">
        <a href="index.php" class="btn btn-secondary">Quay lại</a>
    </div>
</form>
<?php include("../inc/bottom.php"); ?>
