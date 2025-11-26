<?php include("../inc/top.php"); ?>

<h3>Thêm đơn hàng mới</h3>

<form method="post" action="index.php">
    <input type="hidden" name="action" value="xulythem">

    <div class="mb-3">
        <label for="khachhang_id" class="form-label">Chọn khách hàng</label>
        <select class="form-select" name="khachhang_id" required>
            <option value="">-- Chọn khách hàng --</option>
            <?php foreach ($khachhang as $kh): ?>
                <option value="<?php echo $kh['MaKhachHang']; ?>"><?php echo $kh['HoTen']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="trangthai" class="form-label">Trạng thái</label>
        <select class="form-select" name="trangthai">
            <option value="0">Chờ xác nhận</option>
            <option value="1">Đang giao</option>
            <option value="2">Hủy</option>
            <option value="3">Hoàn tất</option>
        </select>
    </div>

    <h4>Chi tiết đơn hàng</h4>
    <div id="product-list">
        <div class="row product-item mb-2">
            <div class="col-md-6">
                <label class="form-label">Sản phẩm</label>
                <select class="form-select" name="sanpham_id[]">
                    <option value="">-- Chọn sản phẩm --</option>
                    <?php foreach ($mathang as $mh): ?>
                        <option value="<?php echo $mh['MaSP']; ?>"><?php echo $mh['TenSP']; ?> (Giá: <?php echo number_format($mh['GiaBan']); ?> VNĐ)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Số lượng</label>
                <input type="number" class="form-control" name="soluong[]" value="1" min="1">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger remove-product-btn" style="display:none;">Xóa</button>
            </div>
        </div>
    </div>

    <button type="button" id="add-product-btn" class="btn btn-info mt-2">Thêm sản phẩm</button>
    <hr>
    <button type="submit" class="btn btn-primary">Lưu đơn hàng</button>
    <a href="index.php" class="btn btn-secondary">Quay lại</a>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('add-product-btn').addEventListener('click', function() {
        var productList = document.getElementById('product-list');
        var firstItem = productList.querySelector('.product-item');
        var newItem = firstItem.cloneNode(true);
        newItem.querySelector('input[type=number]').value = '1';
        newItem.querySelector('select').selectedIndex = 0;
        
        var removeBtn = newItem.querySelector('.remove-product-btn');
        removeBtn.style.display = 'inline-block';
        removeBtn.addEventListener('click', function() {
            newItem.remove();
        });

        productList.appendChild(newItem);
    });

    // For the very first item, which doesn't have a remove button initially
    var firstRemoveBtn = document.querySelector('.product-item .remove-product-btn');
    if(firstRemoveBtn) {
        firstRemoveBtn.style.display = 'none'; // Ensure it's hidden if it's the only one
    }
});
</script>

<?php include("../inc/bottom.php"); ?>
