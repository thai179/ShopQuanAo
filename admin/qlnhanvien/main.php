<?php include("../inc/top.php"); ?>
<h3>Quản lý nhân viên</h3>
<a href="index.php?action=them" class="btn btn-info">Thêm nhân viên</a>
<br><br>
<table class="table table-hover">
    <tr><th>ID</th><th>Họ tên</th><th>Giới tính</th><th>SĐT</th><th>Email</th><th>Cửa hàng</th><th>Chức vụ</th><th>Sửa</th><th>Xóa</th></tr>
    <?php foreach ($nhanvien as $n): ?>
    <tr>
        <td><?php echo $n["MaNV"]; ?></td>
        <td><?php echo htmlspecialchars($n["HoTen"]); ?></td>
        <td><?php echo $n["GioiTinh"]; ?></td>
        <td><?php echo htmlspecialchars($n["SoDT"]); ?></td>
        <td><?php echo htmlspecialchars($n["Email"]); ?></td>
        <td><?php echo htmlspecialchars($n["TenCuaHang"]); ?></td>
        <td><?php echo htmlspecialchars($n["TenCV"]); ?></td>
        <td><a class="btn btn-warning" href="index.php?action=sua&id=<?php echo $n["MaNV"]; ?>">Sửa</a></td>
        <td><a class="btn btn-danger" href="index.php?action=xoa&id=<?php echo $n["MaNV"]; ?>" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include("../inc/bottom.php"); ?>
