CREATE DATABASE IF NOT EXISTS quan_ly_ban_quan_ao;
USE quan_ly_ban_quan_ao;

-- =========================================================
-- BẢNG DANH MỤC, CHỨC VỤ, TÀI KHOẢN
-- =========================================================

CREATE TABLE ChucVu (
    MaCV INT PRIMARY KEY AUTO_INCREMENT,
    TenCV VARCHAR(50),
    HSLuong FLOAT
);

CREATE TABLE TaiKhoan (
    Username VARCHAR(50) PRIMARY KEY,
    Password VARCHAR(255),
    Quyen ENUM('Admin','NhanVien','KhachHang'),
    TinhTrang ENUM('Hoạt động','Khóa')
);

-- =========================================================
-- NHÂN VIÊN, CỬA HÀNG, KHO
-- =========================================================

CREATE TABLE CuaHang (
    MaCuaHang INT PRIMARY KEY AUTO_INCREMENT,
    TenCuaHang VARCHAR(100),
    SoChiNhanh INT,
    SoDT VARCHAR(15),
    DiaChi VARCHAR(255),
    MaNVQuanLy INT
);

CREATE TABLE NhanVien (
    MaNV INT PRIMARY KEY AUTO_INCREMENT,
    HoTen VARCHAR(100),
    GioiTinh ENUM('Nam', 'Nữ'), -- 0: Nam, 1: Nữ
    SoDT VARCHAR(15),
    DiaChi VARCHAR(255),
    NgaySinh DATE,
    Email VARCHAR(100),
    MaCuaHang INT,
    MaCV INT,
    FOREIGN KEY (MaCuaHang) REFERENCES CuaHang(MaCuaHang) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (MaCV) REFERENCES ChucVu(MaCV) ON DELETE SET NULL ON UPDATE CASCADE
);

ALTER TABLE CuaHang 
ADD CONSTRAINT FK_CuaHang_QuanLy FOREIGN KEY (MaNVQuanLy) REFERENCES NhanVien(MaNV) 
ON DELETE SET NULL ON UPDATE CASCADE;

CREATE TABLE KhoHang (
    MaKhoHang INT PRIMARY KEY AUTO_INCREMENT,
    TenKhoHang VARCHAR(100),
    DiaChi VARCHAR(255),
    MaCuaHang INT,
    FOREIGN KEY (MaCuaHang) REFERENCES CuaHang(MaCuaHang) ON DELETE CASCADE ON UPDATE CASCADE
);

-- =========================================================
-- KHÁCH HÀNG, DANH MỤC, SẢN PHẨM, KHO
-- =========================================================

CREATE TABLE DanhMuc (
    MaDM INT PRIMARY KEY AUTO_INCREMENT,
    TenDanhMuc VARCHAR(100)
);

CREATE TABLE SanPham (
    MaSP INT PRIMARY KEY AUTO_INCREMENT,
    TenSP VARCHAR(100),
    GiaGoc DECIMAL(10,2),
    GiaBan DECIMAL(10,2),
    HinhAnh VARCHAR(255),
    MoTa VARCHAR(255),
    MaDM INT,
    FOREIGN KEY (MaDM) REFERENCES DanhMuc(MaDM) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE HinhAnhSanPham (
    IdHinhAnh INT PRIMARY KEY AUTO_INCREMENT,
    MaSP INT NOT NULL,
    DuongDan VARCHAR(255) NOT NULL, 
    FOREIGN KEY (MaSP) REFERENCES SanPham(MaSP) ON DELETE CASCADE
);

CREATE TABLE ChiTietKho (
    MaKho INT,
    MaSP INT,
    SoLuongTon INT DEFAULT 0,
    PRIMARY KEY (MaKho, MaSP),
    FOREIGN KEY (MaKho) REFERENCES KhoHang(MaKhoHang) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (MaSP) REFERENCES SanPham(MaSP) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE KhachHang (
    MaKhachHang INT PRIMARY KEY AUTO_INCREMENT,
    HoTen VARCHAR(100),
    Email VARCHAR(100),
    NgaySinh DATE,
    DiaChi VARCHAR(255),
    SoDT VARCHAR(15),
    DiemThuong INT DEFAULT 0,
    Username VARCHAR(50),
    GioiTinh ENUM('Nam', 'Nữ'),
    FOREIGN KEY (Username) REFERENCES TaiKhoan(Username) ON DELETE SET NULL ON UPDATE CASCADE
);

-- =========================================================
-- NHẬP XUẤT KHO
-- =========================================================

CREATE TABLE PhieuNhap (
    MaPhieuNhap INT PRIMARY KEY AUTO_INCREMENT,
    NgayNhap DATE,
    MaKho INT,
    MaNV INT,
    GhiChu VARCHAR(255),
    FOREIGN KEY (MaKho) REFERENCES KhoHang(MaKhoHang) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (MaNV) REFERENCES NhanVien(MaNV) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE CTPhieuNhap (
    MaPhieuNhap INT,
    MaSP INT,
    SoLuong INT,
    DonGia DECIMAL(10,2),
    ThanhTien DECIMAL(12,2),
    PRIMARY KEY (MaPhieuNhap, MaSP),
    FOREIGN KEY (MaPhieuNhap) REFERENCES PhieuNhap(MaPhieuNhap) ON DELETE CASCADE,
    FOREIGN KEY (MaSP) REFERENCES SanPham(MaSP) ON DELETE CASCADE
);

CREATE TABLE PhieuXuat (
    MaPhieuXuat INT PRIMARY KEY AUTO_INCREMENT,
    NgayXuat DATE,
    MaKho INT,
    MaNV INT,
    LyDo VARCHAR(255),
    FOREIGN KEY (MaKho) REFERENCES KhoHang(MaKhoHang) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (MaNV) REFERENCES NhanVien(MaNV) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE CTPhieuXuat (
    MaPhieuXuat INT,
    MaSP INT,
    SoLuong INT,
    DonGia DECIMAL(10,2),
    ThanhTien DECIMAL(12,2),
    PRIMARY KEY (MaPhieuXuat, MaSP),
    FOREIGN KEY (MaPhieuXuat) REFERENCES PhieuXuat(MaPhieuXuat) ON DELETE CASCADE,
    FOREIGN KEY (MaSP) REFERENCES SanPham(MaSP) ON DELETE CASCADE
);

-- =========================================================
-- ĐƠN HÀNG, HÓA ĐƠN, SỰ KIỆN, PHẢN HỒI, CHẤM CÔNG
-- =========================================================

CREATE TABLE DonHang (
    MaDonHang INT PRIMARY KEY AUTO_INCREMENT,
    MaKhachHang INT,
    NgayDat DATETIME DEFAULT CURRENT_TIMESTAMP,
    TrangThai INT,
    FOREIGN KEY (MaKhachHang) REFERENCES KhachHang(MaKhachHang) ON DELETE CASCADE
);

CREATE TABLE CTDonHang (
    MaDonHang INT,
    MaSP INT,
    SoLuong INT,
    ThanhTien DECIMAL(10,2),
    PRIMARY KEY (MaDonHang, MaSP),
    FOREIGN KEY (MaDonHang) REFERENCES DonHang(MaDonHang) ON DELETE CASCADE,
    FOREIGN KEY (MaSP) REFERENCES SanPham(MaSP) ON DELETE CASCADE
);

CREATE TABLE HoaDon (
    MaHoaDon INT PRIMARY KEY AUTO_INCREMENT,
    NgayLap DATE,
    NguoiLap INT,
    TongTien DECIMAL(12,2),
    FOREIGN KEY (NguoiLap) REFERENCES NhanVien(MaNV) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE SuKien (
    MaSuKien INT PRIMARY KEY AUTO_INCREMENT,
    TenSuKien VARCHAR(100),
    NgayBatDau DATE,
    NgayKetThuc DATE,
    GiamGia INT,
    DoanhThu DECIMAL(12,2),
    HinhAnh VARCHAR(255)
);

CREATE TABLE PhanHoi (
    MaSP INT,
    MaKhachHang INT,
    DanhGia TINYINT CHECK (DanhGia BETWEEN 1 AND 5),
    ChiTietPH VARCHAR(255),
    PRIMARY KEY (MaSP, MaKhachHang),
    FOREIGN KEY (MaSP) REFERENCES SanPham(MaSP) ON DELETE CASCADE,
    FOREIGN KEY (MaKhachHang) REFERENCES KhachHang(MaKhachHang) ON DELETE CASCADE
);

CREATE TABLE ChamCong (
    MaChamCong INT PRIMARY KEY AUTO_INCREMENT,
    MaNhanVien INT,
    NgayCham DATE DEFAULT CURRENT_DATE,
    GioVao TIME,
    GioRa TIME,
    ThoiGianLam FLOAT,
    DanhGia VARCHAR(100),
    GhiChu VARCHAR(255),
    FOREIGN KEY (MaNhanVien) REFERENCES NhanVien(MaNV) ON DELETE CASCADE
);

-- =========================================================
-- DỮ LIỆU MẪU
-- =========================================================

-- 1. Tạo Chức vụ trước
INSERT INTO ChucVu (TenCV, HSLuong) VALUES
('Quản lý', 3.0),
('Bán hàng', 1.5),
('Kho', 1.2);

-- 2. Tạo Cửa hàng (chưa có quản lý)
INSERT INTO CuaHang (TenCuaHang, SoChiNhanh, SoDT, DiaChi)
VALUES
('Chi nhánh Hà Nội', 1, '0123456789', '123 Đường A, Hà Nội'),
('Chi nhánh TP.HCM', 2, '0987654321', '456 Đường B, TP.HCM');

-- 3. Tạo Nhân viên (lúc này đã có Chức vụ và Cửa hàng để tham chiếu)
INSERT INTO NhanVien (HoTen, GioiTinh, SoDT, DiaChi, NgaySinh, Email, MaCuaHang, MaCV)
VALUES
('Nguyễn Văn A', 'Nam', '0901112222', 'Hà Nội', '1998-01-01', 'a@shop.com', 1, 1),
('Trần Thị B', 'Nữ', '0913334444', 'TP.HCM', '2000-02-02', 'b@shop.com', 2, 2);

-- 4. Cập nhật lại Quản lý cho Cửa hàng (sau khi đã có Nhân viên)
UPDATE CuaHang SET MaNVQuanLy = 1 WHERE MaCuaHang = 1;

-- 5. BÂY GIỜ MỚI ĐƯỢC INSERT CHẤM CÔNG (Vì giờ đã có nhân viên ID 1 và 2)
INSERT INTO ChamCong (MaNhanVien, NgayCham, GioVao, GioRa, ThoiGianLam, DanhGia, GhiChu) VALUES
    (1, '2025-11-20', '08:00', '17:00', 8.0, 'Tốt', 'Đúng giờ, làm đủ ca'),
    (2, '2025-11-20', '08:15', '17:00', 7.75, 'Khá', 'Đến muộn 15 phút'),
    (1, '2025-11-21', '08:00', '16:30', 7.5, 'Xuất sắc', 'Về sớm do hoàn thành công việc'),
    (2, '2025-11-21', '09:00', '17:00', 7.0, 'Trung bình', 'Đi muộn, cần nhắc nhở');

-- 6. Các dữ liệu khác
INSERT INTO DanhMuc (TenDanhMuc) VALUES
('Áo'), ('Quần'), ('Phụ kiện');

INSERT INTO SanPham (TenSP, GiaGoc, GiaBan, HinhAnh, MaDM)
VALUES
('Áo thun trắng', 100000, 150000, 'ao_trang.jpg', 1),
('Quần jean nam', 250000, 350000, 'quan_jean.jpg', 2),
('Mũ lưỡi trai', 50000, 80000, 'mu_luoi_trai.jpg', 3);

INSERT INTO KhoHang (TenKhoHang, DiaChi, MaCuaHang)
VALUES
('Kho Hà Nội', '123 Đường A', 1),
('Kho Sài Gòn', '456 Đường B', 2);

INSERT INTO ChiTietKho (MaKho, MaSP, SoLuongTon)
VALUES
(1, 1, 50),
(1, 2, 20),
(2, 3, 100);

-- Phiếu nhập hàng
INSERT INTO PhieuNhap (NgayNhap, MaKho, MaNV, GhiChu)
VALUES
('2025-11-01', 1, 1, 'Nhập hàng từ nhà cung cấp A'),
('2025-11-02', 2, 2, 'Nhập thêm quần jean');

INSERT INTO CTPhieuNhap (MaPhieuNhap, MaSP, SoLuong, DonGia, ThanhTien)
VALUES
(1, 1, 100, 95000, 9500000),
(2, 2, 50, 230000, 11500000);

-- Phiếu xuất hàng
INSERT INTO PhieuXuat (NgayXuat, MaKho, MaNV, LyDo)
VALUES
('2025-11-05', 1, 1, 'Xuất bán hàng cho khách'),
('2025-11-06', 2, 2, 'Chuyển hàng giữa chi nhánh');

INSERT INTO CTPhieuXuat (MaPhieuXuat, MaSP, SoLuong, DonGia, ThanhTien)
VALUES
(1, 1, 5, 150000, 750000),
(1, 2, 3, 350000, 1050000),
(2, 3, 10, 80000, 800000);

-- Khách hàng và đơn hàng
INSERT INTO KhachHang (HoTen, Email, NgaySinh, DiaChi, SoDT, DiemThuong, GioiTinh)
VALUES
('Phạm Minh C', 'c@gmail.com', '2002-01-01', 'Đà Nẵng', '0905556666', 10, 'Nam');

INSERT INTO DonHang (MaKhachHang, TrangThai)
VALUES (1, 1); -- Giả sử 1 là trạng thái 'Chờ xác nhận' (INT)

INSERT INTO CTDonHang (MaDonHang, MaSP, SoLuong, ThanhTien)
VALUES (1, 1, 2, 300000);

INSERT INTO HoaDon (NgayLap, NguoiLap, TongTien)
VALUES ('2025-11-06', 1, 300000);

INSERT INTO SuKien (TenSuKien, NgayBatDau, NgayKetThuc, GiamGia, DoanhThu, HinhAnh)
VALUES
('Sale Black Friday', '2025-11-20', '2025-11-30', 30, 5000000, 'sale_bf.jpg');

INSERT INTO TaiKhoan (Username, Password, Quyen, TinhTrang)
VALUES
('admin', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 'Hoạt động'),
('nv_a', '123456', 'NhanVien', 'Hoạt động'),
('khach1', '123456', 'KhachHang', 'Hoạt động');