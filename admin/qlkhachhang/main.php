<?php include("../inc/top.php"); ?>

<h2>Quản lý Khách Hàng</h2>
<h4 class="text-info">Danh sách khách hàng</h4>
<table class="table table-hover">
    <tr>
        <th>Họ Tên</th>
        <th>Email</th>
        <th>Số Điện Thoại</th>
        <th>Giới Tính</th>
        <th>Ngày Sinh</th>
        <th>Địa Chỉ</th>
        <th>Điểm Thưởng</th>
        <th>Hành Động</th>
    </tr>
    <?php
    foreach ($khachhangs as $kh):
    ?>
        <tr>
            <td><?php echo $kh['HoTen']; ?></td>
            <td><?php echo $kh['Email']; ?></td>
            <td><?php echo $kh['SoDT']; ?></td>
            <td><?php echo $kh['GioiTinh']; ?></td>
            <td><?php echo $kh['NgaySinh']; ?></td>
            <td><?php echo $kh['DiaChi']; ?></td>
            <td><?php echo $kh['DiemThuong']; ?></td>
            <td>
                <a class="btn btn-primary" href="index.php?action=sua&id=<?=$kh['MaKhachHang']?>">Sửa</a>
                <script>
                    function confirmDelete() {
                        return confirm("Bạn có chắc chắn muốn xóa khách hàng này không?");
                    }
                </script>
                <a class="btn btn-danger" href="index.php?action=xoa&id=<?=$kh['MaKhachHang']?>" onclick="return confirmDelete();">Xóa</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<!-- Thêm mới danh mục -->
<button class="btn btn-info" data-bs-toggle="collapse" data-bs-target="#themkhachhang">Thêm khách hàng</button>
<div id="themkhachhang" class="collapse mt-3 mb-3">
    <h4 class="text-info">Thêm mới</h4>
    <form method="post">
        <div class="row">
            <input type="hidden" name="action" value="them">
            <div class="col">
                <label>Họ Tên:</label>
                <input type="text" name="hoten" class="form-control" required>
                <label>Email:</label>
                <input type="email" name="email" class="form-control" required>
                <label>Số Điện Thoại:</label>
                <input type="text" name="sodienthoai" class="form-control" required>
                <label>Giới Tính:</label>
                <select name="gioitinh" class="form-control" required>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
                <label>Ngày Sinh:</label>
                <input type="date" name="ngaysinh" class="form-control" required>
                <label>Địa Chỉ:</label>
                <input type="text" name="diachi" class="form-control" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Thêm khách hàng</button>
    </form>
</div>
<?php include("../inc/bottom.php"); ?>