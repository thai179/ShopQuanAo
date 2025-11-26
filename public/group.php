<?php include("inc/top.php"); ?>

<h3 class="text-info"><?= $tendanhmuc ?></h3>
<div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
    <?php 
    if(isset($mathang) && !empty($mathang))
        foreach($mathang as $mh): ?>
            <div class="col mb-5">
                <div class="card h-100">
                    <!-- Sale badge-->
                    <?php if($mh['GiaBan'] != $mh['GiaGoc']) {?>
                        <div class="badge bg-danger text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Giảm giá</div>
                    <?php } ?>

                    <!-- Product image-->
                    <a href="?action=detail&id=<?php echo $mh['MaSP'] ?>">
                        <img class="card-img-top" src="../images/products/<?php echo $mh['HinhAnh'];?>" alt="<?php echo $mh['TenSP'];?>" />
                    </a>

                    <!-- Product details-->
                    <div class="card-body p-4">
                        <div class="text-center">
                            <!-- Product name-->
                            <a class="text-decoration-none" href="?action=detail&id=<?= $mh['MaSP'];?>">
                                <h5 class="fw-bolder text-info"><?= $mh['TenSP']; ?></h5>
                            </a>                    
                            <!-- Product reviews-->
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <!-- Product price-->
                            <?php if($mh['GiaBan'] != $mh['GiaGoc']) {?>
                                <span class="text-muted text-decoration-line-through"><?= number_format($mh['GiaGoc']) ; ?> đ</span>
                            <?php } ?>
                                <span class="text-danger fw-bolder"><?= number_format($mh['GiaBan']); ?> đ</span>
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                        <div class="text-center"><a class="btn btn-outline-info mt-auto" href="index.php?action=chovaogio&id=<?= $mh['MaSP']; ?>">Chọn mua</a></div>
                    </div>
                </div>
            </div>
        <?php 
            endforeach;
            else
                echo "Danh mục này tạm thời chưa có sản phẩm. Hãy lựa chọn danh mục khác!"
        ?>
</div>

<?php
    include("inc/bottom.php");
?>
