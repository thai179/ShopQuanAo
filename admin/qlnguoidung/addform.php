<?php include("../inc/top.php"); ?>

<div class="container-fluid p-0">
    <h1 class="h3 mb-3">
        <i class="align-middle" data-feather="user-plus"></i> Thêm người dùng mới
    </h1>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Thông tin người dùng</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="index.php?action=xulythem">
                        <div class="mb-3">
                            <label class="form-label">Username (Email) <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="txtemail" required 
                                   placeholder="Nhập username (dạng email)">
                            <small class="form-text text-muted">Username để đăng nhập hệ thống</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" name="txtmatkhau" required 
                                   placeholder="Nhập mật khẩu">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Quyền <span class="text-danger">*</span></label>
                            <select class="form-select" name="optloai" required>
                                <option value="">-- Chọn quyền --</option>
                                <option value="1">Admin</option>
                                <option value="2" selected>Nhân viên</option>
                                <option value="3">Khách hàng</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">
                                <i data-feather="save"></i> Lưu
                            </button>
                            <a href="index.php" class="btn btn-secondary">
                                <i data-feather="x"></i> Hủy
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Hướng dẫn</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <i class="text-primary" data-feather="info"></i>
                            Email sẽ được dùng làm Username để đăng nhập
                        </li>
                        <li class="mb-2">
                            <i class="text-primary" data-feather="info"></i>
                            Mật khẩu sẽ được mã hóa MD5
                        </li>
                        <li class="mb-2">
                            <i class="text-primary" data-feather="info"></i>
                            Admin: Toàn quyền hệ thống
                        </li>
                        <li class="mb-2">
                            <i class="text-primary" data-feather="info"></i>
                            Nhân viên: Quản lý cửa hàng
                        </li>
                        <li class="mb-2">
                            <i class="text-primary" data-feather="info"></i>
                            Khách hàng: Mua sắm online
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("../inc/bottom.php"); ?>
