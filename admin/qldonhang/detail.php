<?php include("../inc/top.php"); ?>

<div class="container">
    <h3>Chi tiết đơn hàng</h3>
    <br>

    <div class="row">
        <div class="col-md-6">
            <h4>Thông tin khách hàng</h4>
            <p><strong>Họ tên:</strong> <?php echo $donhang["hoten"]; ?></p>
            <p><strong>Email:</strong> <?php echo $donhang["email"]; ?></p>
            <p><strong>Số điện thoại:</strong> <?php echo $donhang["sodienthoai"]; ?></p>
        </div>
        <div class="col-md-6">
            <h4>Thông tin đơn hàng</h4>
            <p><strong>Ngày đặt:</strong> <?php echo date("d/m/Y H:i:s", strtotime($donhang["ngay"])); ?></p>
            <p><strong>Người đặt:</strong> <?php echo $donhang["hoten"]; ?></p>
            <p><strong>Địa chỉ giao hàng:</strong> <?php echo $donhang["diachi"]; ?></p>
            <p><strong>Tổng tiền:</strong> <?php echo number_format($donhang["tongtien"]); ?> VNĐ</p>
            <p><strong>Trạng thái:</strong>
                <?php
                if ($donhang["trangthai"] == 0) echo "Mới đặt";
                elseif ($donhang["trangthai"] == 1) echo "Đang giao";
                elseif ($donhang["trangthai"] == 2) echo "Đã hủy";
                else echo "Hoàn tất";
                ?>
            </p>
        </div>
    </div>

    <hr>

    <h4>Sản phẩm trong đơn hàng</h4>
    <table class="table table-hover">
        <tr class="table-primary">
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
        </tr>
        <?php
        if (isset($chitietdonhang) && !empty($chitietdonhang)) :
            foreach ($chitietdonhang as $ct) :
        ?>
                <tr>
                    <td><img src="../../images/products/<?php echo $ct["HinhAnh"]; ?>" width="50"></td>
                    <td><?php echo $ct["TenSP"]; ?></td>
                    <td><?php echo number_format($ct["GiaBan"]); ?> VNĐ</td>
                    <td><?php echo $ct["SoLuong"]; ?></td>
                    <td><?php echo number_format($ct["ThanhTien"]); ?> VNĐ</td>
                </tr>
        <?php
            endforeach;
        else :
        ?>
            <tr>
                <td colspan="5">Không có sản phẩm nào trong đơn hàng.</td>
            </tr>
        <?php endif; ?>
    </table>
    <a href="index.php?action=xem" class="btn btn-primary">Quay lại</a>
</div>

<?php include("../inc/bottom.php"); ?>
