<?php
    include("inc/top.php");
?>
<section id="sanpham" class="py-5">
<div class="container px-4 px-lg-5 mt-5">
<style>
    /* === GIAO DIỆN MỚI: TỐI GIẢN & HIỆN ĐẠI === */
    :root {
        --color-primary: #030213; /* Màu chữ chính, tương đương primary */
        --color-secondary: #6c757d; /* Màu chữ phụ/mờ */
        --color-card-bg: #ffffff; /* Nền thẻ sản phẩm */
        --color-card-border: rgba(0, 0, 0, 0.1); /* Viền mờ */
        --color-accent: #0d6efd; /* Màu nhấn */
        --color-sale: #dc3545; /* Màu giảm giá */
    }

    /* Thẻ Sản phẩm (Card) */
    .card {
        border-radius: 0.625rem !important; /* Bo góc nhẹ */
        border: 1px solid var(--color-card-border) !important; 
        background-color: var(--color-card-bg); 
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05); /* Đổ bóng nhẹ ban đầu */
        transition: transform 0.3s ease, box-shadow 0.3s ease; 
    }

    .card:hover {
        transform: translateY(-5px); /* Nâng lên nhẹ */
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important; /* Đổ bóng rõ hơn khi hover */
        border-color: rgba(0, 0, 0, 0.2) !important;
    }

    .card .card-title {
        color: var(--color-primary) !important; 
        font-weight: 600;
    }
    
    .card-text.text-danger {
        color: var(--color-sale) !important; /* Giá bán màu đỏ */
        font-size: 1.25rem; /* Giá lớn hơn */
        font-weight: 700;
    }

    /* Tiêu đề Danh mục */
    h3 {
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--color-card-border);
        margin-bottom: 1.5rem;
    }
    
    h3 a {
        color: var(--color-primary) !important; 
        font-size: 1.75rem;
        font-weight: 700;
        transition: color 0.2s ease; 
    }

    h3 a:hover {
        color: var(--color-accent) !important; 
        text-shadow: none;
    }

    /* Nút Chọn Mua */
    .btn-outline-dark-custom {
        color: var(--color-primary); 
        background-color: transparent; 
        border-color: var(--color-primary); 
        border-radius: 0.375rem;
        font-weight: 500;
        transition: all 0.2s;
    }

    .btn-outline-dark-custom:hover {
        color: #ffffff; 
        background-color: var(--color-primary); 
        border-color: var(--color-primary);
    }

    /* Nút Xem Thêm */
    .btn-xem-them {
        transition: all 0.3s ease;
        border-radius: 0.375rem; 
        padding: 0.5rem 1.5rem;
        font-weight: 500;
        border-color: var(--color-primary) !important;
        color: var(--color-primary) !important;
    }

    .btn-xem-them:hover {
        background-color: var(--color-primary) !important; 
        color: white !important;
        box-shadow: 0 0 0 0.25rem rgba(3, 2, 19, 0.25); /* Shadow nhẹ từ màu primary */
    }

    /* Hình ảnh */
    .card-img-top {
        height: 250px; /* Tăng chiều cao ảnh */
        object-fit: cover; 
        border-top-left-radius: 0.625rem; 
        border-top-right-radius: 0.625rem; 
    }
    
    /* Badge giảm giá */
    .badge.bg-danger {
        background-color: var(--color-sale) !important;
        padding: 0.35em 0.65em;
        font-size: 0.75rem;
        border-radius: 0.25rem;
    }

</style>
<?php foreach($danhmuc as $dm): ?>
    <?php
    $products_in_category = array_filter($mathang, function($mh_item) use ($dm) {
        return $mh_item['MaDM'] == $dm['MaDM'];
    });

    $total_products = count($products_in_category);
    $products_slice = array_slice($products_in_category, 0, 4);
    $more_products_slice = array_slice($products_in_category, 4);
    ?>

    <h3 class="mt-4 mb-3">
        <a class="text-decoration-none" href="?action=group&id=<?= $dm['MaDM']; ?>"><?= $dm['TenDanhMuc']; ?></a>
    </h3>
    
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        <?php foreach($products_slice as $mh_item): ?>
            <div class="col mb-5">
                <div class="card h-100 shadow-sm d-flex flex-column">
                    <?php 
                        if($mh_item['GiaBan'] != $mh_item['GiaGoc']) {?> 
                        <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Giảm giá</div>
                    <?php } ?>
                    
                    <a href="?action=detail&id=<?php echo $mh_item['MaSP'] ?>">
                        <img class="card-img-top" src="../images/products/<?php echo $mh_item['HinhAnh'];?>" alt="<?php echo $mh_item['TenSP'];?>" />
                    </a>
                    
                    <div class="card-body p-4 flex-grow-1">
                        <div class="text-center">
                            <a class="text-decoration-none" href="?action=detail&id=<?= $mh_item['MaSP']; ?>">
                                <h5 class="fw-bolder card-title"><?= $mh_item['TenSP']; ?></h5>
                            </a> 
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent text-center">
                        <div class="mb-2">
                            <?php if($mh_item['GiaBan'] != $mh_item['GiaGoc']) {?>
                                <span class="text-muted text-decoration-line-through me-2"><?= number_format($mh_item['GiaGoc']) ; ?> đ</span>
                            <?php } ?>
                            <span class="text-danger fw-bolder card-text"><?= number_format($mh_item['GiaBan'])?> đ</span>
                        </div>
                        <a class="btn btn-outline-dark-custom mt-auto" href="index.php?action=chovaogio&id=<?= $mh_item['MaSP']; ?>">Chọn mua</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if ($total_products > 4): ?>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center more-products-container" id="more-products-<?= $dm['MaDM']; ?>" style="display: none;">
            <?php foreach($more_products_slice as $mh_item): ?>
                <div class="col mb-5">
                    <div class="card h-100 shadow-sm d-flex flex-column">
                        <?php if($mh_item['GiaBan'] != $mh_item['GiaGoc']) {?>
                            <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Giảm giá</div>
                        <?php } ?>
                        <a href="?action=detail&id=<?php echo $mh_item['MaSP'] ?>">
                            <img class="card-img-top" src="../images/products/<?php echo $mh_item['HinhAnh'];?>" alt="<?php echo $mh_item['TenSP'];?>" />
                        </a>
                        <div class="card-body p-4 flex-grow-1">
                            <div class="text-center">
                                <a class="text-decoration-none" href="?action=detail&id=<?= $mh_item['MaSP']; ?>">
                                    <h5 class="fw-bolder card-title"><?= $mh_item['TenSP']; ?></h5>
                                </a>
                                <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill"></div><div class="bi-star-fill"></div><div class="bi-star-fill"></div><div class="bi-star-fill"></div><div class="bi-star-fill"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent text-center">
                            <div class="mb-2">
                                <?php if($mh_item['GiaBan'] != $mh_item['GiaGoc']) {?>
                                    <span class="text-muted text-decoration-line-through me-2"><?= number_format($mh_item['GiaGoc']) ; ?> đ</span>
                                <?php } ?>
                                <span class="text-danger fw-bolder card-text"><?= number_format($mh_item['GiaBan'])?> đ</span>
                            </div>
                            <a class="btn btn-outline-dark-custom" href="index.php?action=chovaogio&id=<?= $mh_item['MaSP']; ?>">Chọn mua</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mb-5">
            <button class="btn btn-outline-primary btn-xem-them" data-target="#more-products-<?= $dm['MaDM']; ?>" data-ma-dm="<?= $dm['MaDM']; ?>">
                Xem thêm <i class="bi bi-chevron-down"></i>
            </button>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<ul class="pagination justify-content-center" style="margin:20px 0">
    <li class="page-item"><a class="page-link" href="#"><i class="bi bi-caret-left-fill"></i></a></li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item"><a class="page-link" href="#"><i class="bi bi-caret-right-fill"></i></a></li>
</ul>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const seeMoreButtons = document.querySelectorAll('.btn-xem-them');
    
    seeMoreButtons.forEach(button => {
        // Khởi tạo trạng thái ban đầu
        button.dataset.expanded = 'false';

        button.addEventListener('click', function() {
            const targetSelector = this.getAttribute('data-target');
            const moreProductsContainer = document.querySelector(targetSelector);
            const isExpanded = this.dataset.expanded === 'true';

            if (moreProductsContainer) {
                if (isExpanded) {
                    // Thu gọn
                    moreProductsContainer.style.display = 'none';
                    this.dataset.expanded = 'false';
                    this.innerHTML = 'Xem thêm <i class="bi bi-chevron-down"></i>';
                } else {
                    // Xem thêm
                    // Hiển thị dưới dạng flex để giữ bố cục Bootstrap row/col
                    moreProductsContainer.style.display = 'flex'; 
                    this.dataset.expanded = 'true';
                    this.innerHTML = 'Thu gọn <i class="bi bi-chevron-up"></i>';
                }
            }
        });
    });
});
</script>
</div>
</section>

<?php
    include("inc/bottom.php");
?>