<?php include("inc/top.php"); ?>

<div class="container my-5">
    <!-- Banner liên hệ -->
    <div class="text-center mb-5">
        <h1 class="display-4 text-primary fw-bold">Liên hệ với chúng tôi</h1>
        <p class="lead text-muted">Chúng tôi luôn sẵn sàng lắng nghe và hỗ trợ bạn</p>
    </div>

    <div class="row">
        <!-- Form liên hệ -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h4 class="card-title text-info mb-4">
                        <i class="bi bi-envelope-fill"></i> Gửi tin nhắn cho chúng tôi
                    </h4>
                    <form action="index.php?action=guilienhe" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Họ tên <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="hoten" required 
                                   placeholder="Nhập họ và tên của bạn">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" required 
                                   placeholder="example@email.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="tel" class="form-control" name="sodienthoai" 
                                   placeholder="Nhập số điện thoại của bạn">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Chủ đề <span class="text-danger">*</span></label>
                            <select class="form-select" name="chude" required>
                                <option value="">-- Chọn chủ đề --</option>
                                <option value="Tư vấn sản phẩm">Tư vấn sản phẩm</option>
                                <option value="Hỏi về đơn hàng">Hỏi về đơn hàng</option>
                                <option value="Góp ý">Góp ý, phản hồi</option>
                                <option value="Khiếu nại">Khiếu nại</option>
                                <option value="Khác">Khác</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nội dung <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="noidung" rows="5" required 
                                      placeholder="Nhập nội dung tin nhắn của bạn..."></textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-send-fill"></i> Gửi tin nhắn
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Thông tin liên hệ -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <h4 class="card-title text-info mb-4">
                        <i class="bi bi-info-circle-fill"></i> Thông tin liên hệ
                    </h4>
                    
                    <div class="mb-4">
                        <h5 class="text-dark">
                            <i class="bi bi-geo-alt-fill text-danger"></i> Địa chỉ
                        </h5>
                        <p class="ms-4 text-muted">
                            123 Đường ABC, Phường XYZ, Quận 1, TP. Hồ Chí Minh
                        </p>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-dark">
                            <i class="bi bi-telephone-fill text-success"></i> Điện thoại
                        </h5>
                        <p class="ms-4">
                            <a href="tel:0123456789" class="text-decoration-none">
                                <strong>Hotline:</strong> 0123 456 789
                            </a>
                            <br>
                            <a href="tel:0987654321" class="text-decoration-none">
                                <strong>Tư vấn:</strong> 0987 654 321
                            </a>
                        </p>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-dark">
                            <i class="bi bi-envelope-fill text-primary"></i> Email
                        </h5>
                        <p class="ms-4">
                            <a href="mailto:info@shopthoitrang.vn" class="text-decoration-none">
                                info@shopthoitrang.vn
                            </a>
                            <br>
                            <a href="mailto:support@shopthoitrang.vn" class="text-decoration-none">
                                support@shopthoitrang.vn
                            </a>
                        </p>
                    </div>

                    <div class="mb-4">
                        <h5 class="text-dark">
                            <i class="bi bi-clock-fill text-warning"></i> Giờ làm việc
                        </h5>
                        <p class="ms-4 text-muted">
                            <strong>Thứ 2 - Thứ 6:</strong> 8:00 - 20:00<br>
                            <strong>Thứ 7 - Chủ nhật:</strong> 9:00 - 18:00
                        </p>
                    </div>

                    <div>
                        <h5 class="text-dark mb-3">
                            <i class="bi bi-share-fill text-info"></i> Mạng xã hội
                        </h5>
                        <div class="ms-4">
                            <a href="#" class="btn btn-outline-primary me-2 mb-2">
                                <i class="bi bi-facebook"></i> Facebook
                            </a>
                            <a href="#" class="btn btn-outline-danger me-2 mb-2">
                                <i class="bi bi-instagram"></i> Instagram
                            </a>
                            <a href="#" class="btn btn-outline-info me-2 mb-2">
                                <i class="bi bi-twitter"></i> Twitter
                            </a>
                            <a href="#" class="btn btn-outline-success me-2 mb-2">
                                <i class="bi bi-whatsapp"></i> Zalo
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bản đồ -->
            <div class="card shadow-sm border-0">
                <div class="card-body p-0">
                    <div class="ratio ratio-16x9">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.3193500383436!2d106.69746731533397!3d10.786834192311544!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f4b3330bcc9%3A0xb2b8f5b4c8f5b4b8!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBLaG9hIGjhu41jIFThu7Egbmhpw6puIC0gxJDhuqFpIGjhu41jIFF14buRYyBnaWEgVFAuSENN!5e0!3m2!1svi!2s!4v1234567890"
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Câu hỏi thường gặp -->
    <div class="row mt-5">
        <div class="col-12">
            <h3 class="text-center text-primary fw-bold mb-4">
                <i class="bi bi-question-circle-fill"></i> Câu hỏi thường gặp
            </h3>
        </div>
        <div class="col-lg-10 mx-auto">
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            <i class="bi bi-question-circle me-2"></i> Làm sao để đặt hàng?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Bạn có thể đặt hàng trực tiếp trên website bằng cách thêm sản phẩm vào giỏ hàng 
                            và tiến hành thanh toán. Hoặc liên hệ với chúng tôi qua hotline để được hỗ trợ đặt hàng.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            <i class="bi bi-question-circle me-2"></i> Chính sách đổi trả như thế nào?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Chúng tôi hỗ trợ đổi trả trong vòng 7 ngày kể từ ngày nhận hàng nếu sản phẩm bị lỗi 
                            hoặc không đúng như mô tả. Sản phẩm phải còn nguyên tem, mác và chưa qua sử dụng.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            <i class="bi bi-question-circle me-2"></i> Thời gian giao hàng bao lâu?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Nội thành TP.HCM: 1-2 ngày làm việc. Các tỉnh thành khác: 3-5 ngày làm việc. 
                            Vùng sâu vùng xa: 5-7 ngày làm việc.
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                            <i class="bi bi-question-circle me-2"></i> Có hỗ trợ thanh toán online không?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Có, chúng tôi hỗ trợ nhiều hình thức thanh toán: COD (thanh toán khi nhận hàng), 
                            chuyển khoản ngân hàng, ví điện tử MoMo, ZaloPay.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("inc/bottom.php"); ?>
