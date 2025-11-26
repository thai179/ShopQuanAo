<?php include("../inc/top.php"); ?>

<div class="container-fluid p-0">
    <h1 class="h3 mb-3">
        <i class="align-middle" data-feather="users"></i> Quản lý người dùng
    </h1>

    <?php if (isset($tb)) { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Thành công!</strong> <?php echo $tb; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php } ?>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="index.php?action=them" class="btn btn-primary">
                        <i class="align-middle" data-feather="plus-circle"></i> Thêm người dùng
                    </a>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Username</th>
                                <th>Quyền</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $stt = 1;
                            foreach ($nguoidung as $nd): 
                                $username = $nd->getEmail();
                                $loai = $nd->getLoai();
                                $trangthai = $nd->getTrangthai();
                            ?>
                            <tr>
                                <td><?php echo $stt++; ?></td>
                                <td><?php echo $username; ?></td>
                                <td>
                                    <?php 
                                    if ($loai == 1) {
                                        echo '<span class="badge bg-danger">Admin</span>';
                                    } elseif ($loai == 2) {
                                        echo '<span class="badge bg-primary">Nhân viên</span>';
                                    } else {
                                        echo '<span class="badge bg-secondary">Khách hàng</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                    if ($trangthai == 1) {
                                        echo '<span class="badge bg-success">Hoạt động</span>';
                                    } else {
                                        echo '<span class="badge bg-warning">Khóa</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php if ($loai != 1): ?>
                                        <!-- Không cho khóa Admin -->
                                        <?php if ($trangthai == 1): ?>
                                            <a href="?action=khoa&trangthai=0&username=<?php echo urlencode($username); ?>" 
                                               class="btn btn-sm btn-warning"
                                               onclick="return confirm('Bạn có chắc muốn khóa tài khoản này?')">
                                                <i data-feather="lock"></i> Khóa
                                            </a>
                                        <?php else: ?>
                                            <a href="?action=khoa&trangthai=1&username=<?php echo urlencode($username); ?>" 
                                               class="btn btn-sm btn-success">
                                                <i data-feather="unlock"></i> Mở khóa
                                            </a>
                                        <?php endif; ?>
                                        
                                        <!-- Đổi quyền -->
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button type="button" class="btn btn-secondary dropdown-toggle" 
                                                    data-bs-toggle="dropdown">
                                                <i data-feather="settings"></i> Quyền
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="?action=doiquyen&username=<?php echo urlencode($username); ?>&loai=2">Nhân viên</a></li>
                                                <li><a class="dropdown-item" href="?action=doiquyen&username=<?php echo urlencode($username); ?>&loai=3">Khách hàng</a></li>
                                            </ul>
                                        </div>
                                    <?php else: ?>
                                        <span class="text-muted"><i>Admin chính</i></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("../inc/bottom.php"); ?>