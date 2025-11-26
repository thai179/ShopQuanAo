        </section>
        
        <!-- Top products -->
        <section>            
            <div class="container-fluid">
                <div class="row">                    
                    <div class="">
                        <?php include("inc/carousel.php"); ?>    
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer-->
        <footer class="py-5 bg-dark text-light">
            <div class="text-center mb-4"><a href="#top" class="text-warning"><i class="bi bi-chevron-up" style="font-size: 3rem;"></i></a></div>
            
            <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <a href="index.php" class="text-decoration-none text-white">
                            <h4>
                                <i class="bi bi-shop"></i>
                                <span class="badge bg-secondary">U</span><span class="badge bg-light text-dark">N</span><span class="badge bg-secondary">I</span> Shop
                            </h4>
                        </a>
                        <p>Cửa hàng thời trang hiện đại.</p>
                        <p><i class="bi bi-geo-alt-fill"></i> <b>Địa chỉ:</b>Phường Long Xuyên, An Giang</p>
                        <p><i class="bi bi-telephone-fill"></i> <b>Điện thoại:</b> 012 3698547</p>
                        <p><i class="bi bi-envelope-fill"></i> <b>Email:</b> unilx@gmail.com</p>
                    </div>
                    <div class="col-md-4">
                        <h5><i class="bi bi-list-ul"></i> DANH MỤC SẢN PHẨM</h5>
                        <div class="list-group list-group-flush">
                            <?php foreach ($danhmuc as $d): ?>
                                <a class="list-group-item list-group-item-action bg-dark text-light" href="?action=group&id=<?php echo $d["MaDM"]; ?>">
                                    <?php echo $d["TenDanhMuc"]; ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <h5><i class="bi bi-headset"></i> DỊCH VỤ KHÁCH HÀNG</h5>
                        <div class="list-group list-group-flush">
                            <a href="#" class="list-group-item list-group-item-action bg-dark text-light footer-link">Hướng dẫn mua hàng</a>
                            <a href="#" class="list-group-item list-group-item-action bg-dark text-light footer-link">Câu hỏi thường gặp</a>
                            <a href="#" class="list-group-item list-group-item-action bg-dark text-light footer-link">Liên hệ</a>
							<a href="#" class="list-group-item list-group-item-action bg-dark text-light footer-link">Chính sách bảo hành</a>
                        </div>
                    </div>
                </div>
                <hr class="text-light">
                <p class="m-0 text-center text-white-50">Copyright &copy; UNI Shop 2025</p>
            </div>
        </footer>

    </body>
</html>
