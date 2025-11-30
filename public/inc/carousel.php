        <!-- Carousel -->
        <style>
            #heroCarousel {
                height: 500px; /* Chiều cao mong muốn cho carousel */
                overflow: hidden; /* Ẩn phần thừa của ảnh */
            }
            #heroCarousel .carousel-inner,
            #heroCarousel .carousel-item {
                height: 100%;
            }
            #heroCarousel .carousel-item img {
                width: 100%;
                height: 100%;
                object-fit: cover; /* Đảm bảo ảnh lấp đầy khung mà không bị méo */
                object-position: center;
            }
            .carousel-caption-custom {
                background-color: rgba(0, 0, 0, 0.5); /* Thêm lớp nền mờ cho chữ dễ đọc */
                border-radius: 0.5rem;
                padding: 1rem;
            }
        </style>
        <div id="heroCarousel" class="carousel slide shadow" data-bs-ride="carousel">

            <!-- Indicators/dots -->
            <div class="carousel-indicators">
                <?php if (!empty($sukien_carousel)): ?>
                    <?php foreach ($sukien_carousel as $index => $sk): ?>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?php echo $index; ?>" class="<?php if($index == 0) echo 'active'; ?>"></button>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        
            <!-- The slideshow/carousel -->
            <div class="carousel-inner">
                <?php if (empty($sukien_carousel)): ?>
                    <div class="carousel-item active">
                        <img src="../images/carousel/default.jpg" alt="Chào mừng đến với shop" class="d-block w-100">
                    </div>
                <?php else: ?>
                    <?php foreach ($sukien_carousel as $index => $sk): ?>
                        <div class="carousel-item <?php if($index == 0) echo 'active'; ?>">
                            <img src="../<?php echo htmlspecialchars($sk['HinhAnh']); ?>" alt="<?php echo htmlspecialchars($sk['TenSuKien']); ?>" class="d-block w-100">
                            <div class="carousel-caption d-none d-md-block carousel-caption-custom">
                                <h5><?php echo htmlspecialchars($sk['TenSuKien']); ?></h5>
                                <p>Ưu đãi đặc biệt chỉ có tại UNI Shop.</p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        
            <!-- Left and right controls/icons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            </button>
        </div>