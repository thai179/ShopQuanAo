<?php include("inc/top.php"); ?>
<div class="detail-product px-lg-5">
    <div class="d-flex flex-md-row flex-column mb-5">
        <div class="product-image me-4">
            <img id="main-img" src="../images/products/<?= $mhct['HinhAnh'] ?>" alt="Áo nỉ màu xám" />
            <div class="img-more d-flex justify-content-evenly mt-3">
                <?php foreach ($dsHinhAnh as $ha): ?>
                    <img class="img-item" src="../<?= $ha['DuongDan'] ?>" alt="<?= $mhct['TenSP'] ?>" />
                <?php endforeach; ?>
            </div>
        </div>
        <div class="product-description">
            <div class="detail">
                <h4>Danh mục: <?= $tenDM['TenDanhMuc'] ?></h4>
                <h2 class="fw-bold"> <?= $mhct['TenSP'] ?></h2>
                <h3>Giá gốc: <?= $mhct['GiaGoc'] ?>VNĐ</h3>
                <h3>Giá bán: <?= $mhct['GiaBan'] ?>VNĐ</h3>
            </div>
            <div class="action row">
                <hr>
                <form method="get" action="index.php">
                    <input type="hidden" name="action" value="chovaogio">
                    <input type="hidden" name="id" value="<?php echo $mhct['MaSP']; ?>">
                    <div class="size-selector">
                        <input type="radio" id="size-s" name="size" value="S">
                        <label for="size-s">S</label>

                        <input type="radio" id="size-m" name="size" value="M">
                        <label for="size-m">M</label>

                        <input type="radio" id="size-l" name="size" value="L">
                        <label for="size-l">L</label>

                        <input type="radio" id="size-xl" name="size" value="XL">
                        <label for="size-xl">XL</label>
                    </div>

                    <div class="d-flex align-items-center mt-3">
                        <input type="number" name="soluong" min="1" value="1" class="form-control w-25 me-3" />
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="bi bi-cart-plus"></i> Thêm vào giỏ hàng
                        </button>
                    </div>
                </form>
                <hr class="mt-4">
            </div>
            <span> Thể loại: <a href="" class="text-decoration-none"> <?= $tenDM['TenDanhMuc'] ?> </a></span><br />
        </div>
    </div>
    <div class="product-detail-tab mt-5">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#menu1">Mô tả sản phẩm</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#menu2">Đánh giá</a>
            </li>
        </ul>
        <div class="tab-content p-3 border border-top-0">
            <div id="menu1" class="container tab-pane active"><br>
                <h4>Mô tả sản phẩm</h4>
                <p> <?= $mhct['MoTa'] ?>
                </p>
            </div>
            <div id="menu2" class="container tab-pane fade"><br>
                <br>
                <h4>Đánh giá</h4>

                <!-- Form thêm phản hồi mới -->
                <?php if (isset($_SESSION['user'])): ?>
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Gửi phản hồi của bạn</h5>
                        <form action="index.php" method="post">
                            <input type="hidden" name="action" value="themphanhoi">
                            <input type="hidden" name="MaSP" value="<?= $mhct['MaSP'] ?>">
                            
                            <!-- Giả sử người dùng đã đăng nhập, lấy MaND từ session -->
                            <!-- <input type="hidden" name="MaND" value="<?= $_SESSION['nguoidung']['id'] ?>"> -->

                            <div class="mb-3">
                                <label for="HoTen" class="form-label">Họ và Tên</label>                                
                                <input type="text" class="form-control" id="HoTen" name="HoTen" value="<?= htmlspecialchars($_SESSION['user']['HoTen']) ?>" readonly required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Đánh giá</label>
                                <div class="rating">
                                    <input type="radio" id="star5" name="DanhGia" value="5" /><label for="star5" title="5 sao">5</label>
                                    <input type="radio" id="star4" name="DanhGia" value="4" /><label for="star4" title="4 sao">4</label>
                                    <input type="radio" id="star3" name="DanhGia" value="3" /><label for="star3" title="3 sao">3</label>
                                    <input type="radio" id="star2" name="DanhGia" value="2" /><label for="star2" title="2 sao">2</label>
                                    <input type="radio" id="star1" name="DanhGia" value="1" /><label for="star1" title="1 sao">1</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="ChiTietPH" class="form-label">Nội dung phản hồi</label>
                                <textarea class="form-control" id="ChiTietPH" name="ChiTietPH" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Gửi phản hồi</button>
                        </form>
                    </div>
                </div>
                <?php else: ?>
                <div class="alert alert-info">
                    Vui lòng <a href="index.php?action=dangnhap">đăng nhập</a> để gửi phản hồi của bạn.
                </div>
                <?php endif; ?>

                <?php
                if (!empty($phanhoi)): foreach ($phanhoi as $ph):
                    $danhGiaSo = (int) $ph["DanhGia"]; 
                    $stars = str_repeat('⭐', $danhGiaSo) . str_repeat('☆', 5 - $danhGiaSo);
                    ?>

                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <h6 class="card-title mb-0">
                                    <strong><?= htmlspecialchars($ph["HoTen"]) ?></strong>
                                </h6>
                                <div class="text-warning">
                                    <?= $stars ?>
                                </div>
                            </div>

                            <p class="card-text">
                                <?= htmlspecialchars($ph["ChiTietPH"]) ?>
                            </p>

                            <!-- Các nút Sửa và Xóa -->
                            <?php // Chỉ hiển thị nút xóa nếu người dùng đã đăng nhập và là chủ của phản hồi
                            if (isset($_SESSION['user']) && $_SESSION['user']['MaKH'] == $ph['MaKhachHang']): ?>
                            <div class="d-flex justify-content-end align-items-center">
                                <!-- Nút Sửa (mở modal) -->
                                <button type="button" class="btn btn-sm btn-outline-secondary me-2" data-bs-toggle="modal" data-bs-target="#suaPhanHoiModal-<?= $ph['MaKhachHang'] ?>">
                                    Sửa
                                </button>

                                <!-- Form Xóa -->
                                <form method="POST" action="index.php?action=xoaphanhoi" onsubmit="return confirm('Bạn có chắc chắn muốn xóa phản hồi này?');" style="margin: 0;">
                                    <input type="hidden" name="MaKhachHang" value="<?= $ph['MaKhachHang'] ?>">
                                    <input type="hidden" name="MaSP" value="<?= $mhct['MaSP'] ?>">
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        Xóa
                                    </button>
                                </form>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php
                endforeach; else: ?>
                    <p>Chưa có đánh giá nào cho sản phẩm này. Hãy là người đầu tiên để lại đánh giá!</p>
                <?php endif;
                ?>
            </div>
            
            <!--Sửa Phản Hồi -->
            <?php if (!empty($phanhoi)) foreach ($phanhoi as $ph): 
                if (isset($_SESSION['user']) && $_SESSION['user']['MaKH'] == $ph['MaKhachHang']): ?>
                <div class="modal fade" id="suaPhanHoiModal-<?= $ph['MaKhachHang'] ?>" tabindex="-1" aria-labelledby="suaPhanHoiModalLabel-<?= $ph['MaKhachHang'] ?>" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="index.php" method="post">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="suaPhanHoiModalLabel-<?= $ph['MaKhachHang'] ?>">Chỉnh sửa phản hồi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="action" value="suaphanhoi">
                                    <input type="hidden" name="MaKhachHang" value="<?= $ph['MaKhachHang'] ?>">
                                    <input type="hidden" name="MaSP" value="<?= $mhct['MaSP'] ?>">

                                    <div class="mb-3">
                                        <label class="form-label">Đánh giá</label>
                                        <div class="rating">
                                            <?php for ($i = 5; $i >= 1; $i--): ?>
                                                <input type="radio" id="star<?= $i ?>-sua-<?= $ph['MaKhachHang'] ?>" name="DanhGia" value="<?= $i ?>" <?= ($i == $ph['DanhGia']) ? 'checked' : '' ?> /><label for="star<?= $i ?>-sua-<?= $ph['MaKhachHang'] ?>" title="<?= $i ?> sao"></label>
                                            <?php endfor; ?>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="ChiTietPH-sua-<?= $ph['MaKhachHang'] ?>" class="form-label">Nội dung phản hồi</label>
                                        <textarea class="form-control" id="ChiTietPH-sua-<?= $ph['MaKhachHang'] ?>" name="ChiTietPH" rows="3" required><?= htmlspecialchars($ph['ChiTietPH']) ?></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endif; endforeach; ?>

        </div>
    </div>
    <div class="related-products py-3">
        <h3 class="mb-4">Sản phẩm liên quan</h3>
        <div class="d-flex justify-content-around">
            <?php foreach ($dsSPLienQuan as $splq): ?>
                <a class="text-decoration-none px-1 w-25 d-inline-block"
                    href="index.php?action=detail&id=<?= $splq['MaSP'] ?>">
                    <div class="products h-100">
                        <div class="card h-100">
                            <img src="../images/products/<?= $splq['HinhAnh'] ?>" class="card-img-top h-75"
                                alt="<?= $splq["TenSP"] ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= $splq['TenSP'] ?></h5>
                                <p class="card-text text-danger fw-bold"><?= $splq['GiaBan'] ?>VNĐ</p>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>

    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const mainImg = document.getElementById("main-img");
            const thumbnails = document.querySelectorAll(".img-item");

            thumbnails.forEach(img => {
                img.addEventListener("click", function () {
                    mainImg.style.opacity = 0;
                    setTimeout(() => {
                        mainImg.src = this.src;
                        mainImg.style.opacity = 1;
                    }, 200);

                    thumbnails.forEach(i => i.classList.remove("active"));
                    this.classList.add("active");
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function () {
            const productSection = document.querySelector(".detail-product");
            if (productSection) {
                productSection.scrollIntoView({
                    behavior: "smooth"
                });
            }
        });
    </script>
    <style>
        .rating {
            display: inline-block;
            direction: rtl;
        }
        .rating input {
            display: none;
        }
        .rating label {
            float: right;
            cursor: pointer;
            color: #ccc;
            font-size: 2rem;
            transition: color 0.2s;
        }
        .rating label:before {
            content: '☆';
        }
        .rating input:checked ~ label,
        .rating label:hover,
        .rating label:hover ~ label {
            color: #ffc700;
        }
    </style>

    <?php include("inc/bottom.php"); ?>