<?php include("../inc/top.php"); ?>

<h3>Thêm Kho Hàng Mới</h3>

<form method="POST" action="index.php?action=qlkhohang&act=them">
    <div class="mb-3">
        <label class="form-label">Tên kho hàng <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="tenkho" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Địa chỉ <span class="text-danger">*</span></label>
        <textarea class="form-control" name="diachi" rows="3" required></textarea>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Cửa hàng</label>
        <select class="form-select" name="macuahang">
            <option value="">-- Chọn cửa hàng --</option>
            <?php
            $danhSachCH = $ch->layCuaHang();
            foreach ($danhSachCH as $cuahang):
            ?>
            <option value="<?php echo $cuahang['MaCuaHang']; ?>">
                <?php echo $cuahang['TenCuaHang']; ?>
            </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <button type="submit" class="btn btn-primary">
        <i class="align-middle" data-feather="save"></i> Lưu
    </button>
    <a href="index.php?action=qlkhohang" class="btn btn-secondary">
        <i class="align-middle" data-feather="x"></i> Hủy
    </a>
</form>

<?php include("../inc/bottom.php"); ?>
