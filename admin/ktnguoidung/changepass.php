<?php include("../inc/top.php"); ?>
<div class="row">
    <div class="col-12 col-md-8 m-auto">
        <div class="card p-4">
            <div class="card-header">
                <h4 class="text-info text-center">ĐỔI MẬT KHẨU</h4>
            </div>
            <div class="card-body">
                <form method="post" action="../ktnguoidung/index.php">
                    <input type="hidden" name="action" value="doimatkhau">
                    <input type="hidden" name="txtusername" value="<?php echo isset($_SESSION['nguoidung']) ? htmlspecialchars($_SESSION['nguoidung']['email']) : ''; ?>">
                    <div class="my-3">
                        <label>Username</label>
                        <input disabled class="form-control" type="text" value="<?php echo isset($_SESSION['nguoidung']) ? htmlspecialchars($_SESSION['nguoidung']['email']) : ''; ?>">
                    </div>
                    <div class="my-3">
                        <label>Mật khẩu mới</label>
                        <input class="form-control" type="password" name="txtmatkhaumoi" placeholder="Mật khẩu mới" required>
                    </div>
                    <div class="my-3 text-center">
                        <input class="btn btn-primary" type="submit" value="Lưu">
                        <input class="btn btn-warning" type="reset" value="Hủy">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include("../inc/bottom.php"); ?>