-- MySQL dump 10.13  Distrib 5.7.25, for Win64 (x86_64)
--
-- Host: localhost    Database: shopquanao
-- ------------------------------------------------------
-- Server version	5.7.25

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bienthesanpham`
--

DROP TABLE IF EXISTS `bienthesanpham`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bienthesanpham` (
  `MaBienThe` int(11) NOT NULL AUTO_INCREMENT,
  `MaSP` int(11) NOT NULL,
  `TenKichCo` varchar(10) NOT NULL,
  `SoLuongTon` int(11) unsigned DEFAULT '0',
  `GiaBanBienThe` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`MaBienThe`),
  UNIQUE KEY `MaSP` (`MaSP`,`TenKichCo`),
  CONSTRAINT `bienthesanpham_ibfk_1` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bienthesanpham`
--

LOCK TABLES `bienthesanpham` WRITE;
/*!40000 ALTER TABLE `bienthesanpham` DISABLE KEYS */;
INSERT INTO `bienthesanpham` VALUES (1,1,'S',5,NULL),(2,1,'M',4,NULL),(3,1,'L',6,NULL),(4,1,'XL',5,NULL),(5,1,'FREE',0,NULL);
/*!40000 ALTER TABLE `bienthesanpham` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ctdonhang`
--

DROP TABLE IF EXISTS `ctdonhang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ctdonhang` (
  `MaDonHang` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `SoLuong` int(11) DEFAULT NULL,
  `ThanhTien` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`MaDonHang`,`MaSP`),
  KEY `MaSP` (`MaSP`),
  CONSTRAINT `ctdonhang_ibfk_1` FOREIGN KEY (`MaDonHang`) REFERENCES `donhang` (`MaDonHang`) ON DELETE CASCADE,
  CONSTRAINT `ctdonhang_ibfk_2` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ctdonhang`
--

LOCK TABLES `ctdonhang` WRITE;
/*!40000 ALTER TABLE `ctdonhang` DISABLE KEYS */;
INSERT INTO `ctdonhang` VALUES (2,20,6,1050000.00),(3,20,1,175000.00),(4,20,1,175000.00),(5,20,1,175000.00),(6,20,2,350000.00),(7,20,2,350000.00),(8,20,1,175000.00),(9,20,1,175000.00),(10,20,1,175000.00),(11,20,1,175000.00),(12,20,1,175000.00),(13,20,5,875000.00),(14,20,3,525000.00),(15,20,1,175000.00),(16,1,1,0.00),(17,1,1,150000.00),(18,1,1,150000.00),(19,12,1,200000.00),(29,1,1,150000.00),(30,1,1,150000.00),(31,1,1,150000.00),(32,1,1,150000.00),(36,1,1,150000.00),(45,1,1,150000.00),(47,1,1,150000.00),(48,1,1,150000.00);
/*!40000 ALTER TABLE `ctdonhang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `danhmuc`
--

DROP TABLE IF EXISTS `danhmuc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `danhmuc` (
  `MaDM` int(11) NOT NULL AUTO_INCREMENT,
  `TenDanhMuc` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`MaDM`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `danhmuc`
--

LOCK TABLES `danhmuc` WRITE;
/*!40000 ALTER TABLE `danhmuc` DISABLE KEYS */;
INSERT INTO `danhmuc` VALUES (1,'Áo'),(2,'Quần'),(3,'Phụ kiện'),(4,'Áo khoác');
/*!40000 ALTER TABLE `danhmuc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `donhang`
--

DROP TABLE IF EXISTS `donhang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `donhang` (
  `MaDonHang` int(11) NOT NULL AUTO_INCREMENT,
  `MaKhachHang` int(11) DEFAULT NULL,
  `NgayDat` datetime DEFAULT CURRENT_TIMESTAMP,
  `TrangThai` int(11) DEFAULT NULL,
  PRIMARY KEY (`MaDonHang`),
  KEY `MaKhachHang` (`MaKhachHang`),
  CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`MaKhachHang`) REFERENCES `khachhang` (`MaKhachHang`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `donhang`
--

LOCK TABLES `donhang` WRITE;
/*!40000 ALTER TABLE `donhang` DISABLE KEYS */;
INSERT INTO `donhang` VALUES (1,1,'2025-11-26 19:03:45',1),(2,NULL,'2025-11-27 20:52:56',0),(3,NULL,'2025-11-27 21:20:02',0),(4,NULL,'2025-11-28 09:12:06',0),(5,NULL,'2025-11-28 09:36:36',0),(6,NULL,'2025-11-28 09:54:05',0),(7,NULL,'2025-11-28 10:01:55',0),(8,NULL,'2025-11-28 10:02:39',0),(9,NULL,'2025-11-28 10:16:48',0),(10,NULL,'2025-11-28 10:20:18',0),(11,NULL,'2025-11-28 10:30:07',3),(12,NULL,'2025-11-28 10:44:15',0),(13,1,'2025-11-28 12:10:35',0),(14,1,'2025-11-28 12:12:59',3),(15,1,'2025-11-28 12:20:32',3),(16,1,'2025-11-28 21:28:56',0),(17,1,'2025-11-28 21:39:09',0),(18,1,'2025-11-28 21:40:06',0),(19,1,'2025-11-28 21:51:12',0),(20,1,'2025-11-29 10:11:10',0),(21,1,'2025-11-29 10:11:21',0),(22,1,'2025-11-29 10:11:23',0),(23,1,'2025-11-29 10:11:32',0),(24,1,'2025-11-29 10:11:56',0),(25,1,'2025-11-29 10:12:09',0),(26,1,'2025-11-29 10:12:38',0),(27,1,'2025-11-29 10:12:54',0),(28,1,'2025-11-29 10:13:07',0),(29,1,'2025-11-29 10:15:42',0),(30,1,'2025-11-29 10:15:42',0),(31,1,'2025-11-29 10:17:20',0),(32,1,'2025-11-29 10:17:20',2),(36,1,'2025-11-29 15:21:33',0),(45,1,'2025-11-29 15:45:23',0),(46,1,'2025-11-29 15:58:03',2),(47,1,'2025-11-29 16:17:05',1),(48,1,'2025-11-29 16:19:26',3);
/*!40000 ALTER TABLE `donhang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hinhanhsanpham`
--

DROP TABLE IF EXISTS `hinhanhsanpham`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hinhanhsanpham` (
  `IdHinhAnh` int(11) NOT NULL AUTO_INCREMENT,
  `MaSP` int(11) NOT NULL,
  `DuongDan` varchar(255) NOT NULL,
  PRIMARY KEY (`IdHinhAnh`),
  KEY `MaSP` (`MaSP`),
  CONSTRAINT `hinhanhsanpham_ibfk_1` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hinhanhsanpham`
--

LOCK TABLES `hinhanhsanpham` WRITE;
/*!40000 ALTER TABLE `hinhanhsanpham` DISABLE KEYS */;
INSERT INTO `hinhanhsanpham` VALUES (3,4,'images/products/vo2_1763904654_0.jpg'),(4,4,'images/products/vo1_1763904669_0.jpg'),(5,4,'images/products/vo3_1763904669_1.jpg'),(6,4,'images/products/vo4_1763904669_2.jpg'),(8,5,'images/products/dn_1763904886_0.png'),(9,5,'images/products/dn2_1763904894_0.png'),(11,6,'images/products/tui_1763905078_0.png'),(12,6,'images/products/tui1_1763905090_0.png'),(13,6,'images/products/tui2_1763905090_1.png'),(15,7,'images/products/vi_1763905258_0.png'),(16,7,'images/products/vi1_1763905274_0.png'),(17,7,'images/products/vi2_1763905274_1.png'),(18,7,'images/products/vi3_1763905274_2.png'),(19,3,'images/products/non_1763905441_0.png'),(20,3,'images/products/non1_1763905441_1.png'),(21,3,'images/products/non2_1763905441_2.png'),(22,3,'images/products/non3_1763905441_3.png'),(24,8,'images/products/-19068-slide-products-6782226d28750_1763905630_0.jpg'),(25,8,'images/products/-19068-slide-products-6782226d41cd3_1763905642_0.jpg'),(26,8,'images/products/-19068-slide-products-6782226d18403_1763905642_1.jpg'),(28,9,'images/products/no-nam-soc-gan-no-019-17278-slide-products-632c34917a7aa_1763905677_0.jpg'),(29,9,'images/products/no-nam-soc-gan-no-019-17278-slide-products-632c34923ec02_1763905686_0.jpg'),(30,9,'images/products/no-nam-soc-gan-no-019-17278-slide-products-632c349201239_1763905686_1.jpg'),(32,10,'images/products/tui-canvas-den-phoi-trang-tx017-19266-slide-products-6842af156d126_1763905834_0.jpg'),(33,10,'images/products/tui-canvas-den-phoi-trang-tx017-19266-slide-products-6842af15b4f42_1763905859_0.jpg'),(34,10,'images/products/tui-canvas-den-phoi-trang-tx017-19266-slide-products-6842af15d0d97_1763905859_1.jpg'),(35,10,'images/products/tui-canvas-den-phoi-trang-tx017-19266-slide-products-6842af159e1f7_1763905859_2.jpg'),(36,10,'images/products/tui-canvas-den-phoi-trang-tx017-19266-slide-products-6842af1584d27_1763905859_3.jpg'),(38,11,'images/products/giay-tay-leather-g017-17174-slide-products-630c83ea0cf78_1763905950_0.jpg'),(39,11,'images/products/giay-tay-leather-g017-17174-slide-products-630c83ea4f58b_1763905961_0.jpg'),(40,11,'images/products/giay-tay-leather-g017-17174-slide-products-630c83eae6150_1763905961_1.jpg'),(41,11,'images/products/giay-tay-leather-g017-17174-slide-products-630c83eb1b5db_1763905961_2.jpg'),(43,12,'images/products/1bceae2dd218dbab6752f4167b7030a5_1763906462_0.jpg'),(44,12,'images/products/35bf93f623648daf82dfe7243007657f_1763906486_0.jpg'),(45,12,'images/products/077664cbcfa2a661daf2bd2bba1f15a9_1763906486_1.jpg'),(48,13,'images/products/16a260176b7eef34b78cb6ddd6de8e2a_1763906563_1.jpg'),(49,13,'images/products/16a260176b7eef34b78cb6ddd6de8e2a_1763906572_0.jpg'),(50,1,'images/products/10f25tssw007-snow-white-1-jpg-tdgd_1763906600_0.jpg'),(51,2,'images/products/2_1763906624_0.jpg'),(53,14,'images/products/ao-khoac-phao-nam-icon-airlite-puffer-jacket-form-regular43_94e0b19c1d6444fd80e37c473a15aeed_1024x1024_1763906690_0.jpg'),(54,14,'images/products/ao-khoac-phao-nam-icon-airlite-puffer-jacket-form-regular46_ae8916573886452e94d58a32dadd4936_1024x1024_1763906700_0.jpg'),(55,14,'images/products/ao-khoac-phao-nam-icon-airlite-puffer-jacket-form-regular49_878bc8413ccc4c74b3aa226422e32541_1024x1024_1763906700_1.jpg'),(57,15,'images/products/ao-khoac-jean-nam-drafting-all-black-basic-form-regular37_0e4d7392f08f4d3c92f79c6084fbff6c_1024x1024_1763906731_0.jpg'),(58,15,'images/products/ao-khoac-jean-nam-drafting-all-black-basic-form-regular43_49a0846f6e934647abb71300e40c2e3f_1024x1024_1763906743_0.jpg'),(59,15,'images/products/ao-khoac-jean-nam-drafting-all-black-basic-form-regular45_ef516e98a16f4b46ab107cd8743b2328_1024x1024_1763906743_1.jpg'),(61,16,'images/products/605c678da8ef68367b888c09e9949d10_1763906777_0.jpg'),(62,16,'images/products/605c678da8ef68367b888c09e9949d10_1763906804_0.jpg'),(63,16,'images/products/2356ef52d1355b69fe500534338a618e_1763906804_1.jpg'),(64,16,'images/products/b087ccd9611f585b495041a7c44bbdbd_1763906804_2.jpg'),(65,16,'images/products/e70fca8f422a007dde1aad77339a8248_1763906804_3.jpg'),(67,17,'images/products/img_8575_650e4503c2c04e27ad0e6fbc400f5a01_1024x1024_1763906855_0.jpg'),(68,17,'images/products/quan-jean-nam-sieu-nhe-ong-suong-dark-grey-icon105-form-straight_baf5255966974db7a5fa08cba4aeaf5b_1024x1024_1763906865_0.jpg'),(69,17,'images/products/quan-jean-nam-sieu-nhe-ong-suong-dark-grey-icon105-form-straight11_ce9dd1cb195444b3b505f9908782c3ab_1024x1024_1763906865_1.jpg'),(71,18,'images/products/quan-jean-nam-sieu-nhe-ong-suong-dark-grey-icon105-form-straight20_3bb52bd3f9e6462391811f4a713fd0f0_1024x1024_1763906894_0.jpg'),(72,18,'images/products/quan-jean-nam-sieu-nhe-ong-suong-dark-grey-icon105-form-straight22_48351fc2901e460f8a4657ab6d0ef62c_1024x1024_1763906904_0.jpg'),(74,19,'images/products/632fcd37d226b67f67dd20fb3e569d87_1763906932_0.jpg'),(75,19,'images/products/b288ce17ff7ea2ca59c9e0cbd05f30d1_1763906949_0.jpg'),(76,19,'images/products/c79c7a9c9578d3f43ddd4bd528f28e74_1763906949_1.jpg'),(78,20,'images/products/10f25tslw002-off-white-4-jpg-ws3b_1763906992_0.jpg'),(79,20,'images/products/10f25tslw002-off-white-2-jpg-m7j8_1763907009_0.jpg'),(81,21,'images/products/img_6886_1750dcd3cbf5466ba2d22b695e6ad20b_1024x1024_1763907058_0.jpg'),(82,21,'images/products/img_6889_172cfb2987ce4f25a762e4ec45433ef9_1024x1024_1763907068_0.jpg'),(83,21,'images/products/img_6891_3540eeade8d241808d585e12fd2b424f_1024x1024_1763907068_1.jpg'),(85,22,'images/products/5-xam-vf10047_1763907126_0.jpg'),(86,22,'images/products/2-den-vf07034_1763907135_0.jpg'),(87,22,'images/products/5-den-vf07034_1763907135_1.jpg'),(88,22,'images/products/6-xam-vf10047_1763907135_2.jpg'),(90,23,'images/products/2.1_e2db3768d929465b864262247b086d30_master_1763907175_0.jpg'),(91,23,'images/products/2.5_9bf7920879f04ed5bb9d58ad127cea16_master_1763907195_0.jpg');
/*!40000 ALTER TABLE `hinhanhsanpham` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `khachhang`
--

DROP TABLE IF EXISTS `khachhang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `khachhang` (
  `MaKhachHang` int(11) NOT NULL AUTO_INCREMENT,
  `HoTen` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `NgaySinh` date DEFAULT NULL,
  `DiaChi` varchar(255) DEFAULT NULL,
  `SoDT` varchar(15) DEFAULT NULL,
  `DiemThuong` int(11) DEFAULT '0',
  `Username` varchar(50) DEFAULT NULL,
  `GioiTinh` enum('Nam','Nữ') DEFAULT NULL,
  PRIMARY KEY (`MaKhachHang`),
  KEY `Username` (`Username`),
  CONSTRAINT `khachhang_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `taikhoan` (`Username`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `khachhang`
--

LOCK TABLES `khachhang` WRITE;
/*!40000 ALTER TABLE `khachhang` DISABLE KEYS */;
INSERT INTO `khachhang` VALUES (1,'Phạm Minh C','thaimoblxag1122@gmail.com',NULL,'Đà Nẵng','0905556666',10,'khach1',NULL);
/*!40000 ALTER TABLE `khachhang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phanhoi`
--

DROP TABLE IF EXISTS `phanhoi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phanhoi` (
  `MaSP` int(11) NOT NULL,
  `MaKhachHang` int(11) NOT NULL,
  `DanhGia` tinyint(4) DEFAULT NULL,
  `ChiTietPH` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`MaSP`,`MaKhachHang`),
  KEY `MaKhachHang` (`MaKhachHang`),
  CONSTRAINT `phanhoi_ibfk_1` FOREIGN KEY (`MaSP`) REFERENCES `sanpham` (`MaSP`) ON DELETE CASCADE,
  CONSTRAINT `phanhoi_ibfk_2` FOREIGN KEY (`MaKhachHang`) REFERENCES `khachhang` (`MaKhachHang`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phanhoi`
--

LOCK TABLES `phanhoi` WRITE;
/*!40000 ALTER TABLE `phanhoi` DISABLE KEYS */;
/*!40000 ALTER TABLE `phanhoi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sanpham`
--

DROP TABLE IF EXISTS `sanpham`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sanpham` (
  `MaSP` int(11) NOT NULL AUTO_INCREMENT,
  `TenSP` varchar(100) DEFAULT NULL,
  `GiaGoc` decimal(10,2) DEFAULT NULL,
  `GiaBan` decimal(10,2) DEFAULT NULL,
  `SoLuongTon` int(11) unsigned NOT NULL,
  `HinhAnh` varchar(255) DEFAULT NULL,
  `MoTa` varchar(255) DEFAULT NULL,
  `MaDM` int(11) DEFAULT NULL,
  PRIMARY KEY (`MaSP`),
  KEY `MaDM` (`MaDM`),
  CONSTRAINT `sanpham_ibfk_1` FOREIGN KEY (`MaDM`) REFERENCES `danhmuc` (`MaDM`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sanpham`
--

LOCK TABLES `sanpham` WRITE;
/*!40000 ALTER TABLE `sanpham` DISABLE KEYS */;
INSERT INTO `sanpham` VALUES (1,'Áo thun trắng',100000.00,150000.00,20,'10f25tssw007-snow-white-1-jpg-tdgd_1763906600.jpg','không có',1),(2,'Quần jean nam',250000.00,350000.00,0,'ad362c883290776b7a6ef298d451a4af_1763906624.jpg','quần jean',2),(3,'Mũ lưỡi trai',50000.00,80000.00,0,'non_1763905454.png','Nón chống nắng',3),(4,'Vớ',15000.00,25000.00,0,'vo2_1763904654_0.jpg','Đa dạng mẫu mã',3),(5,'Dây nịt da bò',150000.00,200000.00,0,'dn_1763904886_0.png','Làm từ da bò thật',3),(6,'Túi',200000.00,250000.00,0,'tui_1763905078_0.png','Túi cotton',3),(7,'Ví đứng',200000.00,236000.00,0,'vi_1763905258_0.png','Ví dáng đứng trẻ trung',3),(8,'Cà vạt',25000.00,50000.00,0,'-19068-slide-products-6782226d28750_1763905630_0.jpg','Cà vạt sọc thanh lịch',3),(9,'Nơ',15000.00,35000.00,0,'no-nam-soc-gan-no-019-17278-slide-products-632c34917a7aa_1763905677_0.jpg','Nơ nam',3),(10,'Túi xách',200000.00,300000.00,0,'tui-canvas-den-phoi-trang-tx017-19266-slide-products-6842af156d126_1763905834_0.jpg','Túi xách jean',3),(11,'Giày',335000.00,500000.00,0,'giay-tay-leather-g017-17174-slide-products-630c83ea0cf78_1763905950_0.jpg','Giày da cao cấp',3),(12,'Áo Ai Cập',150000.00,200000.00,0,'1bceae2dd218dbab6752f4167b7030a5_1763906462_0.jpg','Áo Ai Cập',1),(13,'Quần Ai Cập',100000.00,150000.00,0,'16a260176b7eef34b78cb6ddd6de8e2a_1763906563_1.jpg','Quần Ai Cập',2),(14,'Áo khoác bông',150000.00,200000.00,0,'ao-khoac-phao-nam-icon-airlite-puffer-jacket-form-regular43_94e0b19c1d6444fd80e37c473a15aeed_1024x1024_1763906690_0.jpg','Áo khoác bông',4),(15,'Áo khoác jean',300000.00,450000.00,0,'ao-khoac-jean-nam-drafting-all-black-basic-form-regular37_0e4d7392f08f4d3c92f79c6084fbff6c_1024x1024_1763906731_0.jpg','Áo khoác jean',4),(16,'Áo nhật',300000.00,400000.00,0,'605c678da8ef68367b888c09e9949d10_1763906777_0.jpg','Áo nhật',1),(17,'Quần short',50000.00,100000.00,0,'img_8575_650e4503c2c04e27ad0e6fbc400f5a01_1024x1024_1763906855_0.jpg','Quần short',2),(18,'Quần jean đen',250000.00,325000.00,0,'quan-jean-nam-sieu-nhe-ong-suong-dark-grey-icon105-form-straight20_3bb52bd3f9e6462391811f4a713fd0f0_1024x1024_1763906894_0.jpg','Quần jean đen',2),(19,'Quần rằn gi',200000.00,300000.00,0,'632fcd37d226b67f67dd20fb3e569d87_1763906932_0.jpg','Quần rằn gi',2),(20,'Áo crop top',150000.00,175000.00,0,'10f25tslw002-off-white-4-jpg-ws3b_1763906992_0.jpg','Áo crop top',1),(21,'Dép',200000.00,300000.00,0,'img_6886_1750dcd3cbf5466ba2d22b695e6ad20b_1024x1024_1763907058_0.jpg','Dép',3),(22,'Sơ mi nữ',200000.00,30000.00,0,'5-xam-vf10047_1763907126_0.jpg','Sơ mi nữ',1),(23,'Áo kèm chân váy xám',550000.00,700000.00,0,'2.1_e2db3768d929465b864262247b086d30_master_1763907175_0.jpg','Áo kèm chân váy xám',1);
/*!40000 ALTER TABLE `sanpham` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sukien`
--

DROP TABLE IF EXISTS `sukien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sukien` (
  `MaSuKien` int(11) NOT NULL AUTO_INCREMENT,
  `TenSuKien` varchar(100) DEFAULT NULL,
  `NgayBatDau` date DEFAULT NULL,
  `NgayKetThuc` date DEFAULT NULL,
  `GiamGia` int(11) DEFAULT NULL,
  `DoanhThu` decimal(12,2) DEFAULT NULL,
  `HinhAnh` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`MaSuKien`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sukien`
--

LOCK TABLES `sukien` WRITE;
/*!40000 ALTER TABLE `sukien` DISABLE KEYS */;
INSERT INTO `sukien` VALUES (1,'Sale Black Friday','2025-11-20','2025-11-30',30,5000000.00,'sale_bf.jpg');
/*!40000 ALTER TABLE `sukien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `taikhoan`
--

DROP TABLE IF EXISTS `taikhoan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `taikhoan` (
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Quyen` enum('Admin','KhachHang') DEFAULT NULL,
  `TinhTrang` enum('Hoạt động','Khóa') DEFAULT NULL,
  PRIMARY KEY (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `taikhoan`
--

LOCK TABLES `taikhoan` WRITE;
/*!40000 ALTER TABLE `taikhoan` DISABLE KEYS */;
INSERT INTO `taikhoan` VALUES ('admin','e10adc3949ba59abbe56e057f20f883e','Admin','Hoạt động'),('khach1','e10adc3949ba59abbe56e057f20f883e','KhachHang','Hoạt động'),('nv_a','123456','','Hoạt động');
/*!40000 ALTER TABLE `taikhoan` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-29 16:32:56
