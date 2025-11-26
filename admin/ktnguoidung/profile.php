<?php include("../inc/top.php"); ?>
<div class="row">
    <div class="col-12 col-md-8 m-auto">
        <div class="card p-4">
            <div class="card-header">
                <h4 class="text-info text-center">HỒ SƠ TÀI KHOẢN</h4>
            </div>
            <div class="card-body">
                <?php if (isset($_SESSION["nguoidung"])): 
                    $u = $_SESSION["nguoidung"];
                ?>
                <p><strong>Username:</strong> <?php echo htmlspecialchars($u["nguoidung"]); ?></p>
                <p><strong>Quyền:</strong> <?php echo ($u["loai"]==1) ? 'Admin' : (($u["loai"]==2)?'Nhân viên':'Khách hàng'); ?></p>
                <p><strong>Trạng thái:</strong> <?php echo ($u["trangthai"]==1) ? 'Hoạt động' : 'Khóa'; ?></p>
                <p><a class="btn btn-primary" href="index.php?action=matkhau">Đổi mật khẩu</a></p>
                <?php else: ?>
                <p>Chưa đăng nhập.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php include("../inc/bottom.php"); ?>