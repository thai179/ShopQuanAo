CREATE DATABASE IF NOT EXISTS shopquanao;
USE shopquanao;


CREATE TABLE TaiKhoan (
    Username VARCHAR(50) PRIMARY KEY,
    Password VARCHAR(255),
    Quyen ENUM('Admin','KhachHang'),
    TinhTrang ENUM('Hoạt động','Khóa')
);


CREATE TABLE DanhMuc (
    MaDM INT PRIMARY KEY AUTO_INCREMENT,
    TenDanhMuc VARCHAR(100)
);

CREATE TABLE SanPham (
    MaSP INT PRIMARY KEY AUTO_INCREMENT,
    TenSP VARCHAR(100),
    GiaGoc DECIMAL(10,2),
    GiaBan DECIMAL(10,2),
    SoLuongTon INT,
    HinhAnh VARCHAR(255),
    MoTa VARCHAR(255),
    MaDM INT,
    FOREIGN KEY (MaDM) REFERENCES DanhMuc(MaDM) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE BienTheSanPham (
    MaBienThe INT PRIMARY KEY AUTO_INCREMENT,
    MaSP INT NOT NULL,
    TenKichCo VARCHAR(10) NOT NULL, 
    SoLuongTon INT DEFAULT 0,
    
    FOREIGN KEY (MaSP) REFERENCES SanPham(MaSP) ON DELETE CASCADE,
    
    UNIQUE (MaSP, TenKichCo) 
);

CREATE TABLE HinhAnhSanPham (
    IdHinhAnh INT PRIMARY KEY AUTO_INCREMENT,
    MaSP INT NOT NULL,
    DuongDan VARCHAR(255) NOT NULL, 
    FOREIGN KEY (MaSP) REFERENCES SanPham(MaSP) ON DELETE CASCADE
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



-- 6. Các dữ liệu khác
INSERT INTO DanhMuc (TenDanhMuc) VALUES
('Áo'), ('Quần'), ('Phụ kiện');

INSERT INTO SanPham (TenSP, GiaGoc, GiaBan, HinhAnh, MaDM)
VALUES
('Áo thun trắng', 100000, 150000, 'ao_trang.jpg', 1),
('Quần jean nam', 250000, 350000, 'quan_jean.jpg', 2),
('Mũ lưỡi trai', 50000, 80000, 'mu_luoi_trai.jpg', 3);



-- Khách hàng và đơn hàng
INSERT INTO KhachHang (HoTen, Email, NgaySinh, DiaChi, SoDT, DiemThuong, GioiTinh)
VALUES
('Phạm Minh C', 'c@gmail.com', '2002-01-01', 'Đà Nẵng', '0905556666', 10, 'Nam');

INSERT INTO DonHang (MaKhachHang, TrangThai)
VALUES (1, 1); -- Giả sử 1 là trạng thái 'Chờ xác nhận' (INT)

INSERT INTO CTDonHang (MaDonHang, MaSP, SoLuong, ThanhTien)
VALUES (1, 1, 2, 300000);


INSERT INTO SuKien (TenSuKien, NgayBatDau, NgayKetThuc, GiamGia, DoanhThu, HinhAnh)
VALUES
('Sale Black Friday', '2025-11-20', '2025-11-30', 30, 5000000, 'sale_bf.jpg');

INSERT INTO TaiKhoan (Username, Password, Quyen, TinhTrang)
VALUES
('admin', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 'Hoạt động'),
('nv_a', '123456', 'NhanVien', 'Hoạt động'),
('khach1', '123456', 'KhachHang', 'Hoạt động');