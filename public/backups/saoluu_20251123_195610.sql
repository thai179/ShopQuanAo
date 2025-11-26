/*M!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19-12.0.2-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: quan_ly_ban_quan_ao
-- ------------------------------------------------------
-- Server version	12.0.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*M!100616 SET @OLD_NOTE_VERBOSITY=@@NOTE_VERBOSITY, NOTE_VERBOSITY=0 */;

--
-- Table structure for table `CTDonHang`
--

DROP TABLE IF EXISTS `CTDonHang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `CTDonHang` (
  `MaDonHang` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `SoLuong` int(11) DEFAULT NULL,
  `ThanhTien` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`MaDonHang`,`MaSP`),
  KEY `MaSP` (`MaSP`),
  CONSTRAINT `CTDonHang_ibfk_1` FOREIGN KEY (`MaDonHang`) REFERENCES `DonHang` (`MaDonHang`) ON DELETE CASCADE,
  CONSTRAINT `CTDonHang_ibfk_2` FOREIGN KEY (`MaSP`) REFERENCES `SanPham` (`MaSP`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CTDonHang`
--

LOCK TABLES `CTDonHang` WRITE;
/*!40000 ALTER TABLE `CTDonHang` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `CTDonHang` VALUES
(1,1,2,300000.00);
/*!40000 ALTER TABLE `CTDonHang` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `CTPhieuNhap`
--

DROP TABLE IF EXISTS `CTPhieuNhap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `CTPhieuNhap` (
  `MaPhieuNhap` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `SoLuong` int(11) DEFAULT NULL,
  `DonGia` decimal(10,2) DEFAULT NULL,
  `ThanhTien` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`MaPhieuNhap`,`MaSP`),
  KEY `MaSP` (`MaSP`),
  CONSTRAINT `CTPhieuNhap_ibfk_1` FOREIGN KEY (`MaPhieuNhap`) REFERENCES `PhieuNhap` (`MaPhieuNhap`) ON DELETE CASCADE,
  CONSTRAINT `CTPhieuNhap_ibfk_2` FOREIGN KEY (`MaSP`) REFERENCES `SanPham` (`MaSP`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CTPhieuNhap`
--

LOCK TABLES `CTPhieuNhap` WRITE;
/*!40000 ALTER TABLE `CTPhieuNhap` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `CTPhieuNhap` VALUES
(1,1,100,95000.00,9500000.00),
(2,2,50,230000.00,11500000.00);
/*!40000 ALTER TABLE `CTPhieuNhap` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `CTPhieuXuat`
--

DROP TABLE IF EXISTS `CTPhieuXuat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `CTPhieuXuat` (
  `MaPhieuXuat` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `SoLuong` int(11) DEFAULT NULL,
  `DonGia` decimal(10,2) DEFAULT NULL,
  `ThanhTien` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`MaPhieuXuat`,`MaSP`),
  KEY `MaSP` (`MaSP`),
  CONSTRAINT `CTPhieuXuat_ibfk_1` FOREIGN KEY (`MaPhieuXuat`) REFERENCES `PhieuXuat` (`MaPhieuXuat`) ON DELETE CASCADE,
  CONSTRAINT `CTPhieuXuat_ibfk_2` FOREIGN KEY (`MaSP`) REFERENCES `SanPham` (`MaSP`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CTPhieuXuat`
--

LOCK TABLES `CTPhieuXuat` WRITE;
/*!40000 ALTER TABLE `CTPhieuXuat` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `CTPhieuXuat` VALUES
(1,1,5,150000.00,750000.00),
(1,2,3,350000.00,1050000.00),
(2,3,10,80000.00,800000.00);
/*!40000 ALTER TABLE `CTPhieuXuat` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `ChamCong`
--

DROP TABLE IF EXISTS `ChamCong`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ChamCong` (
  `MaChamCong` int(11) NOT NULL AUTO_INCREMENT,
  `MaNhanVien` int(11) DEFAULT NULL,
  `NgayCham` date DEFAULT curdate(),
  `GioVao` time DEFAULT NULL,
  `GioRa` time DEFAULT NULL,
  `ThoiGianLam` float DEFAULT NULL,
  `DanhGia` varchar(100) DEFAULT NULL,
  `GhiChu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`MaChamCong`),
  KEY `MaNhanVien` (`MaNhanVien`),
  CONSTRAINT `ChamCong_ibfk_1` FOREIGN KEY (`MaNhanVien`) REFERENCES `NhanVien` (`MaNV`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ChamCong`
--

LOCK TABLES `ChamCong` WRITE;
/*!40000 ALTER TABLE `ChamCong` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `ChamCong` VALUES
(1,1,'2025-11-20','08:00:00','17:00:00',8,'Tốt','Đúng giờ, làm đủ ca'),
(2,2,'2025-11-20','08:15:00','17:00:00',7.75,'Khá','Đến muộn 15 phút'),
(3,1,'2025-11-21','08:00:00','16:30:00',7.5,'Xuất sắc','Về sớm do hoàn thành công việc'),
(4,2,'2025-11-21','09:00:00','17:00:00',7,'Trung bình','Đi muộn, cần nhắc nhở');
/*!40000 ALTER TABLE `ChamCong` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `ChiTietKho`
--

DROP TABLE IF EXISTS `ChiTietKho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ChiTietKho` (
  `MaKho` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `SoLuongTon` int(11) DEFAULT 0,
  PRIMARY KEY (`MaKho`,`MaSP`),
  KEY `MaSP` (`MaSP`),
  CONSTRAINT `ChiTietKho_ibfk_1` FOREIGN KEY (`MaKho`) REFERENCES `KhoHang` (`MaKhoHang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ChiTietKho_ibfk_2` FOREIGN KEY (`MaSP`) REFERENCES `SanPham` (`MaSP`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ChiTietKho`
--

LOCK TABLES `ChiTietKho` WRITE;
/*!40000 ALTER TABLE `ChiTietKho` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `ChiTietKho` VALUES
(1,1,50),
(1,2,20),
(2,3,100);
/*!40000 ALTER TABLE `ChiTietKho` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `ChucVu`
--

DROP TABLE IF EXISTS `ChucVu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `ChucVu` (
  `MaCV` int(11) NOT NULL AUTO_INCREMENT,
  `TenCV` varchar(50) DEFAULT NULL,
  `HSLuong` float DEFAULT NULL,
  PRIMARY KEY (`MaCV`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ChucVu`
--

LOCK TABLES `ChucVu` WRITE;
/*!40000 ALTER TABLE `ChucVu` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `ChucVu` VALUES
(1,'Quản lý',3),
(2,'Bán hàng',1.5),
(3,'Kho',1.2);
/*!40000 ALTER TABLE `ChucVu` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `CuaHang`
--

DROP TABLE IF EXISTS `CuaHang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `CuaHang` (
  `MaCuaHang` int(11) NOT NULL AUTO_INCREMENT,
  `TenCuaHang` varchar(100) DEFAULT NULL,
  `SoChiNhanh` int(11) DEFAULT NULL,
  `SoDT` varchar(15) DEFAULT NULL,
  `DiaChi` varchar(255) DEFAULT NULL,
  `MaNVQuanLy` int(11) DEFAULT NULL,
  PRIMARY KEY (`MaCuaHang`),
  KEY `FK_CuaHang_QuanLy` (`MaNVQuanLy`),
  CONSTRAINT `FK_CuaHang_QuanLy` FOREIGN KEY (`MaNVQuanLy`) REFERENCES `NhanVien` (`MaNV`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CuaHang`
--

LOCK TABLES `CuaHang` WRITE;
/*!40000 ALTER TABLE `CuaHang` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `CuaHang` VALUES
(1,'Chi nhánh Hà Nội',1,'0123456789','123 Đường A, Hà Nội',1),
(2,'Chi nhánh TP.HCM',2,'0987654321','456 Đường B, TP.HCM',NULL);
/*!40000 ALTER TABLE `CuaHang` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `DanhMuc`
--

DROP TABLE IF EXISTS `DanhMuc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `DanhMuc` (
  `MaDM` int(11) NOT NULL AUTO_INCREMENT,
  `TenDanhMuc` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`MaDM`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DanhMuc`
--

LOCK TABLES `DanhMuc` WRITE;
/*!40000 ALTER TABLE `DanhMuc` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `DanhMuc` VALUES
(1,'Áo'),
(2,'Quần'),
(3,'Phụ kiện');
/*!40000 ALTER TABLE `DanhMuc` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `DonHang`
--

DROP TABLE IF EXISTS `DonHang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `DonHang` (
  `MaDonHang` int(11) NOT NULL AUTO_INCREMENT,
  `MaKhachHang` int(11) DEFAULT NULL,
  `NgayDat` datetime DEFAULT current_timestamp(),
  `TrangThai` int(11) DEFAULT NULL,
  PRIMARY KEY (`MaDonHang`),
  KEY `MaKhachHang` (`MaKhachHang`),
  CONSTRAINT `DonHang_ibfk_1` FOREIGN KEY (`MaKhachHang`) REFERENCES `KhachHang` (`MaKhachHang`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DonHang`
--

LOCK TABLES `DonHang` WRITE;
/*!40000 ALTER TABLE `DonHang` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `DonHang` VALUES
(1,1,'2025-11-21 22:13:06',1);
/*!40000 ALTER TABLE `DonHang` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `HinhAnhSanPham`
--

DROP TABLE IF EXISTS `HinhAnhSanPham`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `HinhAnhSanPham` (
  `IdHinhAnh` int(11) NOT NULL AUTO_INCREMENT,
  `MaSP` int(11) NOT NULL,
  `DuongDan` varchar(255) NOT NULL,
  PRIMARY KEY (`IdHinhAnh`),
  KEY `MaSP` (`MaSP`),
  CONSTRAINT `HinhAnhSanPham_ibfk_1` FOREIGN KEY (`MaSP`) REFERENCES `SanPham` (`MaSP`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HinhAnhSanPham`
--

LOCK TABLES `HinhAnhSanPham` WRITE;
/*!40000 ALTER TABLE `HinhAnhSanPham` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `HinhAnhSanPham` VALUES
(1,1,'images/products/gen-h-z7211337600005_b3254cc88c10a7be1524f189d0302ecf_1763738058_0.jpg'),
(2,1,'images/products/gen-h-z7211337603243_63e703098eaec6eb59fe6162c3b1aa22_1763738058_1.jpg'),
(3,1,'images/products/gen-h-z7211337605508_4e661557ace7ff8150788235fb89b11a_1763738058_2.jpg'),
(4,1,'images/products/gen-h-z7211337667805_afc65fca87373ab80ffaa24744e26688_1763738058_3.jpg');
/*!40000 ALTER TABLE `HinhAnhSanPham` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `HoaDon`
--

DROP TABLE IF EXISTS `HoaDon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `HoaDon` (
  `MaHoaDon` int(11) NOT NULL AUTO_INCREMENT,
  `NgayLap` date DEFAULT NULL,
  `NguoiLap` int(11) DEFAULT NULL,
  `TongTien` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`MaHoaDon`),
  KEY `NguoiLap` (`NguoiLap`),
  CONSTRAINT `HoaDon_ibfk_1` FOREIGN KEY (`NguoiLap`) REFERENCES `NhanVien` (`MaNV`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HoaDon`
--

LOCK TABLES `HoaDon` WRITE;
/*!40000 ALTER TABLE `HoaDon` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `HoaDon` VALUES
(1,'2025-11-06',1,300000.00);
/*!40000 ALTER TABLE `HoaDon` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `KhachHang`
--

DROP TABLE IF EXISTS `KhachHang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `KhachHang` (
  `MaKhachHang` int(11) NOT NULL AUTO_INCREMENT,
  `HoTen` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL,
  `DiaChi` varchar(255) DEFAULT NULL,
  `SoDT` varchar(15) DEFAULT NULL,
  `DiemThuong` int(11) DEFAULT 0,
  `Username` varchar(50) DEFAULT NULL,
  `GioiTinh` enum('Nam','Nữ') DEFAULT NULL,
  PRIMARY KEY (`MaKhachHang`),
  KEY `Username` (`Username`),
  CONSTRAINT `KhachHang_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `TaiKhoan` (`Username`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `KhachHang`
--

LOCK TABLES `KhachHang` WRITE;
/*!40000 ALTER TABLE `KhachHang` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `KhachHang` VALUES
(1,'Phạm Minh C','c@gmail.com','2002-01-01','Đà Nẵng','0905556666',10,NULL,'Nam');
/*!40000 ALTER TABLE `KhachHang` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `KhoHang`
--

DROP TABLE IF EXISTS `KhoHang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `KhoHang` (
  `MaKhoHang` int(11) NOT NULL AUTO_INCREMENT,
  `TenKhoHang` varchar(100) DEFAULT NULL,
  `DiaChi` varchar(255) DEFAULT NULL,
  `MaCuaHang` int(11) DEFAULT NULL,
  PRIMARY KEY (`MaKhoHang`),
  KEY `MaCuaHang` (`MaCuaHang`),
  CONSTRAINT `KhoHang_ibfk_1` FOREIGN KEY (`MaCuaHang`) REFERENCES `CuaHang` (`MaCuaHang`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `KhoHang`
--

LOCK TABLES `KhoHang` WRITE;
/*!40000 ALTER TABLE `KhoHang` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `KhoHang` VALUES
(1,'Kho Hà Nội','123 Đường A',1),
(2,'Kho Sài Gòn','456 Đường B',2);
/*!40000 ALTER TABLE `KhoHang` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `NhanVien`
--

DROP TABLE IF EXISTS `NhanVien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `NhanVien` (
  `MaNV` int(11) NOT NULL AUTO_INCREMENT,
  `HoTen` varchar(100) DEFAULT NULL,
  `GioiTinh` enum('Nam','Nữ') DEFAULT NULL,
  `SoDT` varchar(15) DEFAULT NULL,
  `DiaChi` varchar(255) DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `MaCuaHang` int(11) DEFAULT NULL,
  `MaCV` int(11) DEFAULT NULL,
  PRIMARY KEY (`MaNV`),
  KEY `MaCuaHang` (`MaCuaHang`),
  KEY `MaCV` (`MaCV`),
  CONSTRAINT `NhanVien_ibfk_1` FOREIGN KEY (`MaCuaHang`) REFERENCES `CuaHang` (`MaCuaHang`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `NhanVien_ibfk_2` FOREIGN KEY (`MaCV`) REFERENCES `ChucVu` (`MaCV`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `NhanVien`
--

LOCK TABLES `NhanVien` WRITE;
/*!40000 ALTER TABLE `NhanVien` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `NhanVien` VALUES
(1,'Nguyễn Văn A','Nam','0901112222','Hà Nội','1998-01-01','a@shop.com',1,1),
(2,'Trần Thị B','Nữ','0913334444','TP.HCM','2000-02-02','b@shop.com',2,2);
/*!40000 ALTER TABLE `NhanVien` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `PhanHoi`
--

DROP TABLE IF EXISTS `PhanHoi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `PhanHoi` (
  `MaSP` int(11) NOT NULL,
  `MaKhachHang` int(11) NOT NULL,
  `DanhGia` tinyint(4) DEFAULT NULL CHECK (`DanhGia` between 1 and 5),
  `ChiTietPH` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`MaSP`,`MaKhachHang`),
  KEY `MaKhachHang` (`MaKhachHang`),
  CONSTRAINT `PhanHoi_ibfk_1` FOREIGN KEY (`MaSP`) REFERENCES `SanPham` (`MaSP`) ON DELETE CASCADE,
  CONSTRAINT `PhanHoi_ibfk_2` FOREIGN KEY (`MaKhachHang`) REFERENCES `KhachHang` (`MaKhachHang`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PhanHoi`
--

LOCK TABLES `PhanHoi` WRITE;
/*!40000 ALTER TABLE `PhanHoi` DISABLE KEYS */;
set autocommit=0;
/*!40000 ALTER TABLE `PhanHoi` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `PhieuNhap`
--

DROP TABLE IF EXISTS `PhieuNhap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `PhieuNhap` (
  `MaPhieuNhap` int(11) NOT NULL AUTO_INCREMENT,
  `NgayNhap` date DEFAULT NULL,
  `MaKho` int(11) DEFAULT NULL,
  `MaNV` int(11) DEFAULT NULL,
  `GhiChu` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`MaPhieuNhap`),
  KEY `MaKho` (`MaKho`),
  KEY `MaNV` (`MaNV`),
  CONSTRAINT `PhieuNhap_ibfk_1` FOREIGN KEY (`MaKho`) REFERENCES `KhoHang` (`MaKhoHang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `PhieuNhap_ibfk_2` FOREIGN KEY (`MaNV`) REFERENCES `NhanVien` (`MaNV`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PhieuNhap`
--

LOCK TABLES `PhieuNhap` WRITE;
/*!40000 ALTER TABLE `PhieuNhap` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `PhieuNhap` VALUES
(1,'2025-11-01',1,1,'Nhập hàng từ nhà cung cấp A'),
(2,'2025-11-02',2,2,'Nhập thêm quần jean');
/*!40000 ALTER TABLE `PhieuNhap` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `PhieuXuat`
--

DROP TABLE IF EXISTS `PhieuXuat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `PhieuXuat` (
  `MaPhieuXuat` int(11) NOT NULL AUTO_INCREMENT,
  `NgayXuat` date DEFAULT NULL,
  `MaKho` int(11) DEFAULT NULL,
  `MaNV` int(11) DEFAULT NULL,
  `LyDo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`MaPhieuXuat`),
  KEY `MaKho` (`MaKho`),
  KEY `MaNV` (`MaNV`),
  CONSTRAINT `PhieuXuat_ibfk_1` FOREIGN KEY (`MaKho`) REFERENCES `KhoHang` (`MaKhoHang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `PhieuXuat_ibfk_2` FOREIGN KEY (`MaNV`) REFERENCES `NhanVien` (`MaNV`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PhieuXuat`
--

LOCK TABLES `PhieuXuat` WRITE;
/*!40000 ALTER TABLE `PhieuXuat` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `PhieuXuat` VALUES
(1,'2025-11-05',1,1,'Xuất bán hàng cho khách'),
(2,'2025-11-06',2,2,'Chuyển hàng giữa chi nhánh');
/*!40000 ALTER TABLE `PhieuXuat` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `SanPham`
--

DROP TABLE IF EXISTS `SanPham`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `SanPham` (
  `MaSP` int(11) NOT NULL AUTO_INCREMENT,
  `TenSP` varchar(100) DEFAULT NULL,
  `GiaGoc` decimal(10,2) DEFAULT NULL,
  `GiaBan` decimal(10,2) DEFAULT NULL,
  `HinhAnh` varchar(255) DEFAULT NULL,
  `MoTa` varchar(255) DEFAULT NULL,
  `MaDM` int(11) DEFAULT NULL,
  PRIMARY KEY (`MaSP`),
  KEY `MaDM` (`MaDM`),
  CONSTRAINT `SanPham_ibfk_1` FOREIGN KEY (`MaDM`) REFERENCES `DanhMuc` (`MaDM`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SanPham`
--

LOCK TABLES `SanPham` WRITE;
/*!40000 ALTER TABLE `SanPham` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `SanPham` VALUES
(1,'Áo thun trắng',100000.00,150000.00,'ao_trang.jpg','asdasd',1),
(2,'Quần jean nam',250000.00,350000.00,'quan_jean.jpg',NULL,2),
(3,'Mũ lưỡi trai',50000.00,80000.00,'mu_luoi_trai.jpg',NULL,3);
/*!40000 ALTER TABLE `SanPham` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `SuKien`
--

DROP TABLE IF EXISTS `SuKien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `SuKien` (
  `MaSuKien` int(11) NOT NULL AUTO_INCREMENT,
  `TenSuKien` varchar(100) DEFAULT NULL,
  `NgayBatDau` date DEFAULT NULL,
  `NgayKetThuc` date DEFAULT NULL,
  `GiamGia` int(11) DEFAULT NULL,
  `DoanhThu` decimal(12,2) DEFAULT NULL,
  `HinhAnh` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`MaSuKien`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SuKien`
--

LOCK TABLES `SuKien` WRITE;
/*!40000 ALTER TABLE `SuKien` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `SuKien` VALUES
(1,'Sale Black Friday','2025-11-20','2025-11-30',30,5000000.00,'sale_bf.jpg');
/*!40000 ALTER TABLE `SuKien` ENABLE KEYS */;
UNLOCK TABLES;
commit;

--
-- Table structure for table `TaiKhoan`
--

DROP TABLE IF EXISTS `TaiKhoan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8mb4 */;
CREATE TABLE `TaiKhoan` (
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Quyen` enum('Admin','NhanVien','KhachHang') DEFAULT NULL,
  `TinhTrang` enum('Hoạt động','Khóa') DEFAULT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TaiKhoan`
--

LOCK TABLES `TaiKhoan` WRITE;
/*!40000 ALTER TABLE `TaiKhoan` DISABLE KEYS */;
set autocommit=0;
INSERT INTO `TaiKhoan` VALUES
('admin','e10adc3949ba59abbe56e057f20f883e','Admin','Hoạt động'),
('khach1','123456','KhachHang','Hoạt động'),
('nv_a','123456','NhanVien','Hoạt động');
/*!40000 ALTER TABLE `TaiKhoan` ENABLE KEYS */;
UNLOCK TABLES;
commit;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*M!100616 SET NOTE_VERBOSITY=@OLD_NOTE_VERBOSITY */;

-- Dump completed on 2025-11-23 19:56:10
