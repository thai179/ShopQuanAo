<?php include("inc/top.php"); ?>

<div class="container my-5">
    <?php if(demhangtronggio() == 0) { ?>
        <div class="text-center py-5">
            <i class="bi bi-cart-x" style="font-size: 5rem; color: #ccc;"></i>
            <h3 class="text-info mt-3">Giỏ hàng rỗng!</h3>
            <p>Vui lòng chọn sản phẩm...</p>
            <a href="index.php" class="btn btn-primary">
                <i class="bi bi-arrow-left"></i> Tiếp tục mua sắm
            </a>
        </div>
    <?php } else { ?>
        <h3 class="text-info mb-4">
            <i class="bi bi-cart-fill"></i> Giỏ hàng của bạn:
        </h3>
        
        <form action="index.php">
            <input type="hidden" name="action" value="capnhatgio">
            
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Hình ảnh</th>
                            <th>Tên hàng</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($giohang as $id => $mh): ?>
                        <tr>
                            <td>
                                <img width="80" src="../images/products/<?php echo $mh["hinhanh"]; ?>" 
                                     class="rounded" style="height: 80px; object-fit: cover;">
                            </td>
                            <td class="align-middle">
                                <a href="index.php?action=chitiet&id=<?php echo $mh["id"]; ?>" 
                                   class="text-decoration-none text-dark">
                                    <strong><?php echo $mh["tenmathang"]; ?></strong>
                                </a>
                            </td>
                            <td class="align-middle text-danger fw-bold">
                                <?php echo number_format($mh["giaban"]); ?> đ
                            </td>
                            <td class="align-middle">
                                <input type="number" 
                                       name="mh[<?php echo $mh["id"]; ?>]" 
                                       value="<?php echo $mh["soluong"]; ?>" 
                                       min="0" 
                                       class="form-control" 
                                       style="width: 80px;">
                            </td>
                            <td class="align-middle fw-bold text-primary">
                                <?php echo number_format($mh["thanhtien"]); ?> đ
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td class="fw-bold">Tổng tiền</td>
                            <td class="text-danger fw-bold fs-5">
                                <?php 
                                $tongtien = 0;
                                foreach($giohang as $item) {
                                    $tongtien += $item["thanhtien"];
                                }
                                echo number_format($tongtien); 
                                ?> đ
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            
            <div class="alert alert-warning">
                <i class="bi bi-info-circle"></i> 
                <strong>Lưu ý:</strong> Nhập số lượng = 0 để xóa sản phẩm khỏi giỏ hàng.
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <a href="index.php?action=xoagiohang" 
                       class="btn btn-danger"
                       onclick="return confirm('Bạn có chắc muốn xóa toàn bộ giỏ hàng?')">
                        <i class="bi bi-trash"></i> Xóa tất cả
                    </a>
                    <a href="index.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Tiếp tục mua
                    </a>
                </div>
                <div class="col-md-6 text-end">    
                    <input type="submit" class="btn btn-warning" value="Cập nhật">
                    <a href="index.php?action=thanhtoan" class="btn btn-success">
                        <i class="bi bi-credit-card"></i> Thanh toán
                    </a>
                </div>
            </div>
        </form>
    <?php } ?>
</div>

<?php include("inc/bottom.php"); ?>
