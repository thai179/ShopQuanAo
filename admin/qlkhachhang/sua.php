<?php
include("../inc/top.php");
?>

<h2>Quản lý Khách Hàng</h2>
<h4 class="text-info">Sửa thông tin khách hàng</h4>
<div class="row">
    <div class="col-md-6">
        <form method="post">
            <input type="hidden" name="action" value="capnhat">
            <input type="hidden" name="id" value="<?php echo $khachhang['MaKhachHang']; ?>">
            <div class="mb-3">
                <label for="txthoten" class="form-label">Họ tên khách hàng</label>
                <input type="text" class="form-control" id="txthoten" name="txthoten" value="<?php echo $khachhang['HoTen']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="txtemail" class="form-label">Email</label>
                <input type="email" class="form-control" id="txtemail" name="txtemail" value="<?php echo $khachhang['Email']; ?>" readonly required>
            </div>
            <div class="mb-3">
                <label for="txtsodienthoai" class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" id="txtsodienthoai" name="txtsodienthoai" value="<?php echo $khachhang['SoDT']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="txtdiachi" class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" id="txtdiachi" name="txtdiachi" value="<?php echo $khachhang['DiaChi']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="txtngaysinh" class="form-label">Ngày sinh</label>
                <input type="date" class="form-control" id="txtngaysinh" name="txtngaysinh" value="<?php echo $khachhang['NgaySinh']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="txtgioitinh" class="form-label">Giới tính</label>
                <select class="form-select" id="txtgioitinh" name="txtgioitinh" required>
                    <option value="Nam" <?php if ($khachhang['GioiTinh'] == 'Nam') echo 'selected'; ?>>Nam</option>
                    <option value="Nữ" <?php if ($khachhang['GioiTinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                    <option value="Khác" <?php if ($khachhang['GioiTinh'] == 'Khác') echo 'selected'; ?>>Khác</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật khách hàng</button>
        </form>
    </div>
</div>
<?php include("../inc/bottom.php"); ?>

?>