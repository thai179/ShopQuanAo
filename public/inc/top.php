<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" href="worldwide.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <title>Shop Thời Trang</title>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet " />
</head>

<body id="top">
    <header>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark shadow">
            <div class="container">
                <a class="navbar-brand fw-bold" href="index.php"><i class="bi bi-shop-window"></i> Shop Thời Trang</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item fw-bold"><a class="nav-link active" aria-current="page" href="index.php">Trang chính</a></li>
                        <li class="nav-item fw-bold"><a class="nav-link" href="index.php?action=gioithieu">Giới thiệu</a></li>
                        <li class="nav-item fw-bold"><a class="nav-link" href="index.php#sanpham">Sản phẩm</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-bold" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Danh mục sản phẩm</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php foreach ($danhmuc as $d): ?>
                                    <li><a class="dropdown-item" href="?action=group&id=<?php echo $d["MaDM"]; ?>">
                                        <?php echo $d["TenDanhMuc"]; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li class="nav-item fw-bold"><a class="nav-link" href="index.php?action=lienhe">Liên hệ</a></li>
                    </ul>

                    <?php if (isset($_SESSION['user'])): ?>
                        <!-- Cart button - Chỉ hiển thị khi đã đăng nhập -->
                        <div class="d-flex align-items-center me-3">
                            <a href="index.php?action=giohang" class="btn btn-outline-light position-relative">
                                <i class="bi bi-cart-fill me-1"></i>
                                Giỏ hàng
                                <?php
                                $cartCount = 0;
                                if (isset($_SESSION['cart'])) {
                                    $cartCount = array_sum($_SESSION['cart']);
                                }
                                if ($cartCount > 0):
                                ?>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        <?php echo $cartCount; ?>
                                    </span>
                                <?php endif; ?>
                            </a>
                        </div>

                        <!-- User Info - Đã đăng nhập -->
                        <div class="dropdown align-items-center">
                            <a class="dropdown-toggle me-3 text-decoration-none" href="#"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle"></i> <?php echo $_SESSION['user']['HoTen']; ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="index.php?action=thongtin">Thông tin</a></li>
                                <li><a class="dropdown-item" href="index.php?action=giohang">Giỏ hàng</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="index.php?action=dangxuat">Đăng xuất</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <!-- Guest Menu - Chưa đăng nhập -->
                        <div class="d-flex align-items-center">
                            <a href="index.php?action=dangnhap" class="btn btn-outline-light me-2">
                                <i class="bi bi-box-arrow-in-right"></i> Đăng nhập
                            </a>
                            <a href="index.php?action=dangky" class="btn btn-light">
                                <i class="bi bi-person-plus"></i> Đăng ký
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </nav>

        <!-- Search -->
        <div class="search-bar px-5 py-2 d-flex justify-content-end">
            <form class="d-flex" action="index.php" method="get" role="search" style="width: 470px;">
                <input type="hidden" name="action" value="timkiem">
                <input class="form-control form-control-lg me-2" type="search" name="tukhoa" placeholder="Tìm kiếm sản phẩm" aria-label="Search">
                <button class="btn btn-outline-light btn-lg" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>

        <!-- Content -->
        <div class="content d-flex flex-column justify-content-center align-items-start px-5 mb-4 h-100">
            <h1 class="fw-bold text-white">
                <?php if (isset($_SESSION['user'])): ?>
                    Xin chào, <?php echo $_SESSION['user']['HoTen']; ?>!
                <?php else: ?>
                    Chào mừng đến với Shop UNI
                <?php endif; ?>
            </h1>
            <p class="fw-bold"> No rules. No gender. Just UNI <br>
                Ở đây, không có "đúng" hay "sai" - Chỉ có phong cách mang tên bạn</p>
            <?php if (!isset($_SESSION['user'])): ?>
                <div class="row">
                    <div class="col-auto me-2">
                        <a href="index.php?action=dangnhap"><button class="btn btn-info"> Đăng nhập</button></a>
                    </div>
                    <div class="col-auto me-2">
                        <a href="index.php?action=dangky"><button class="btn btn-info"> Đăng ký</button></a>
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col-auto me-2">
                        <a href="index.php"><button class="btn btn-success"><i class="bi bi-house-fill"></i> Mua sắm ngay</button></a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </header>
    <!-- Section-->
    <section class="py-5">