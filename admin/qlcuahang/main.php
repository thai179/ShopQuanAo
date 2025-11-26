<?php include("../inc/top.php"); ?>
<h3>Quản lý cửa hàng</h3>
<a href="index.php?action=them" class="btn btn-info">Thêm cửa hàng</a>
<br><br>
<table class="table table-hover">
    <tr><th>ID</th><th>Tên</th><th>Số chi nhánh</th><th>SĐT</th><th>Địa chỉ</th><th>Mã NV Quản lý</th><th>Sửa</th><th>Xóa</th></tr>
    <?php foreach ($cuahang as $ch): ?>
    <tr>
        <td><?php echo $ch["MaCuaHang"]; ?></td>
        <td><?php echo htmlspecialchars($ch["TenCuaHang"]); ?></td>
        <td><?php echo $ch["SoChiNhanh"]; ?></td>
        <td><?php echo htmlspecialchars($ch["SoDT"]); ?></td>
        <td><?php echo htmlspecialchars($ch["DiaChi"]); ?></td>
        <td><?php echo $ch["MaNVQuanLy"] ?: '-'; ?></td>
        <td><a class="btn btn-warning" href="index.php?action=sua&id=<?php echo $ch["MaCuaHang"]; ?>">Sửa</a></td>
        <td><a class="btn btn-danger" href="index.php?action=xoa&id=<?php echo $ch["MaCuaHang"]; ?>" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include("../inc/bottom.php"); ?>
