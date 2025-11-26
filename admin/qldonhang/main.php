<?php include("../inc/top.php"); ?>

<h3>Quản lý đơn hàng</h3>
<a href="index.php?action=them" class="btn btn-success"><i class="align-middle" data-feather="plus-circle"></i> Thêm mới</a>
<br>
<table class="table table-hover">
    <tr class="table-primary">
        <th>Tên khách hàng</th>
        <th>Địa chỉ giao hàng</th>
        <th>Ngày đặt</th>
        <th>Tổng tiền</th>
        <th>Trạng thái</th>
        <th>Xem</th>
        <th>Cập nhật</th>
        <th>Xóa</th>
    </tr>
    <?php
    foreach ($donhang as $d) :
    ?>
        <tr>
            <form method="post">
                <input type="hidden" name="action" value="capnhat">
                <input type="hidden" name="id" value="<?php echo $d["id"]; ?>">
                <td><?php echo $d["hoten"]; ?></td>
                <td><?php echo $d["diachi"]; ?></td>
                <td><?php echo date("d/m/Y", strtotime($d["ngay"])); ?></td>
                <td><?php echo number_format($d["tongtien"]); ?> VNĐ</td>
                <td>
                    <select name="trangthai" class="form-select">
                        <option value="0" <?php if ($d["trangthai"] == 0) echo "selected"; ?>>Mới đặt</option>
                        <option value="1" <?php if ($d["trangthai"] == 1) echo "selected"; ?>>Đang giao</option>
                        <option value="2" <?php if ($d["trangthai"] == 2) echo "selected"; ?>>Đã hủy</option>
                        <option value="3" <?php if ($d["trangthai"] == 3) echo "selected"; ?>>Hoàn tất</option>
                    </select>
                </td>
                <td><a class="btn btn-info" href="index.php?action=chitiet&id=<?php echo $d["id"]; ?>"><i class="align-middle" data-feather="eye"></i></a></td>
                <td><button type="submit" class="btn btn-primary"><i class="align-middle" data-feather="save"></i></button></td>
            </form>
            <td><a class="btn btn-danger" href="index.php?action=xoa&id=<?php echo $d["id"]; ?>" onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này?');"><i class="align-middle" data-feather="trash"></i></a></td>
        </tr>
    <?php
    endforeach;
    ?>
</table>

<?php include("../inc/bottom.php"); ?>
