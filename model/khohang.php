<?php
class KHOHANG {
    private $maKhoHang;
    private $tenKhoHang;
    private $diaChi;
    private $maCuaHang;

    // Getter và Setter
    public function getMaKhoHang() {
        return $this->maKhoHang;
    }

    public function setMaKhoHang($value) {
        $this->maKhoHang = $value;
    }

    public function getTenKhoHang() {
        return $this->tenKhoHang;
    }

    public function setTenKhoHang($value) {
        $this->tenKhoHang = $value;
    }

    public function getDiaChi() {
        return $this->diaChi;
    }

    public function setDiaChi($value) {
        $this->diaChi = $value;
    }

    public function getMaCuaHang() {
        return $this->maCuaHang;
    }

    public function setMaCuaHang($value) {
        $this->maCuaHang = $value;
    }

    // Lấy tất cả kho hàng
    public function layTatCaKhoHang() {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT k.*, c.TenCuaHang 
                    FROM KhoHang k 
                    LEFT JOIN CuaHang c ON k.MaCuaHang = c.MaCuaHang 
                    ORDER BY k.MaKhoHang DESC";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $result = $cmd->fetchAll();
            return $result;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Lấy kho hàng theo ID
    public function layKhoHangTheoID($id) {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT k.*, c.TenCuaHang 
                    FROM KhoHang k 
                    LEFT JOIN CuaHang c ON k.MaCuaHang = c.MaCuaHang 
                    WHERE k.MaKhoHang = :id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            $result = $cmd->fetch();
            return $result;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Thêm kho hàng mới
    public function themKhoHang($tenKho, $diaChi, $maCuaHang) {
        $dbcon = DATABASE::connect();
        try {
            $sql = "INSERT INTO KhoHang (TenKhoHang, DiaChi, MaCuaHang) 
                    VALUES (:ten, :diachi, :macuahang)";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":ten", $tenKho);
            $cmd->bindValue(":diachi", $diaChi);
            $cmd->bindValue(":macuahang", $maCuaHang);
            $result = $cmd->execute();
            return $result;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            return false;
        }
    }

    // Cập nhật kho hàng
    public function capNhatKhoHang($maKho, $tenKho, $diaChi, $maCuaHang) {
        $dbcon = DATABASE::connect();
        try {
            $sql = "UPDATE KhoHang 
                    SET TenKhoHang = :ten, DiaChi = :diachi, MaCuaHang = :macuahang 
                    WHERE MaKhoHang = :id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $maKho);
            $cmd->bindValue(":ten", $tenKho);
            $cmd->bindValue(":diachi", $diaChi);
            $cmd->bindValue(":macuahang", $maCuaHang);
            $result = $cmd->execute();
            return $result;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            return false;
        }
    }

    // Xóa kho hàng
    public function xoaKhoHang($id) {
        $dbcon = DATABASE::connect();
        try {
            $sql = "DELETE FROM KhoHang WHERE MaKhoHang = :id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $id);
            $result = $cmd->execute();
            return $result;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            return false;
        }
    }

    // Lấy danh sách sản phẩm trong kho
    public function layDanhSachSanPhamTrongKho($maKho) {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT sp.*, ct.SoLuongTon, dm.TenDanhMuc,
                    (ct.SoLuongTon * sp.GiaGoc) as GiaTriTon
                    FROM ChiTietKho ct
                    INNER JOIN SanPham sp ON ct.MaSP = sp.MaSP
                    LEFT JOIN DanhMuc dm ON sp.MaDM = dm.MaDM
                    WHERE ct.MaKho = :makho
                    ORDER BY ct.SoLuongTon DESC";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":makho", $maKho);
            $cmd->execute();
            $result = $cmd->fetchAll();
            return $result;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Cập nhật số lượng tồn kho
    public function capNhatSoLuongTon($maKho, $maSP, $soLuong) {
        $dbcon = DATABASE::connect();
        try {
            // Kiểm tra xem sản phẩm đã có trong kho chưa
            $sql = "SELECT * FROM ChiTietKho WHERE MaKho = :makho AND MaSP = :masp";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":makho", $maKho);
            $cmd->bindValue(":masp", $maSP);
            $cmd->execute();
            
            if ($cmd->rowCount() > 0) {
                // Cập nhật số lượng
                $sql = "UPDATE ChiTietKho 
                        SET SoLuongTon = :soluong 
                        WHERE MaKho = :makho AND MaSP = :masp";
            } else {
                // Thêm mới
                $sql = "INSERT INTO ChiTietKho (MaKho, MaSP, SoLuongTon) 
                        VALUES (:makho, :masp, :soluong)";
            }
            
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":makho", $maKho);
            $cmd->bindValue(":masp", $maSP);
            $cmd->bindValue(":soluong", $soLuong);
            $result = $cmd->execute();
            return $result;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            return false;
        }
    }

    // Nhập kho (tăng số lượng)
    public function nhapKho($maKho, $maSP, $soLuongNhap) {
        $dbcon = DATABASE::connect();
        try {
            $sql = "INSERT INTO ChiTietKho (MaKho, MaSP, SoLuongTon) 
                    VALUES (:makho, :masp, :soluong)
                    ON DUPLICATE KEY UPDATE SoLuongTon = SoLuongTon + :soluong";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":makho", $maKho);
            $cmd->bindValue(":masp", $maSP);
            $cmd->bindValue(":soluong", $soLuongNhap);
            $result = $cmd->execute();
            return $result;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            return false;
        }
    }

    // Xuất kho (giảm số lượng)
    public function xuatKho($maKho, $maSP, $soLuongXuat) {
        $dbcon = DATABASE::connect();
        try {
            // Kiểm tra số lượng tồn
            $sql = "SELECT SoLuongTon FROM ChiTietKho 
                    WHERE MaKho = :makho AND MaSP = :masp";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":makho", $maKho);
            $cmd->bindValue(":masp", $maSP);
            $cmd->execute();
            $row = $cmd->fetch();
            
            if (!$row || $row['SoLuongTon'] < $soLuongXuat) {
                return false; // Không đủ hàng
            }
            
            // Giảm số lượng
            $sql = "UPDATE ChiTietKho 
                    SET SoLuongTon = SoLuongTon - :soluong 
                    WHERE MaKho = :makho AND MaSP = :masp";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":makho", $maKho);
            $cmd->bindValue(":masp", $maSP);
            $cmd->bindValue(":soluong", $soLuongXuat);
            $result = $cmd->execute();
            return $result;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            return false;
        }
    }

    // Thống kê tồn kho
    public function thongKeTonKho($maKho) {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT 
                    COUNT(DISTINCT ct.MaSP) as TongSanPham,
                    SUM(ct.SoLuongTon) as TongSoLuong,
                    SUM(ct.SoLuongTon * sp.GiaGoc) as TongGiaTri
                    FROM ChiTietKho ct
                    INNER JOIN SanPham sp ON ct.MaSP = sp.MaSP
                    WHERE ct.MaKho = :makho";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":makho", $maKho);
            $cmd->execute();
            $result = $cmd->fetch();
            return $result;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Lấy sản phẩm sắp hết hàng
    public function laySanPhamSapHetHang($maKho, $nguongToiThieu = 10) {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT sp.*, ct.SoLuongTon, dm.TenDanhMuc
                    FROM ChiTietKho ct
                    INNER JOIN SanPham sp ON ct.MaSP = sp.MaSP
                    LEFT JOIN DanhMuc dm ON sp.MaDM = dm.MaDM
                    WHERE ct.MaKho = :makho AND ct.SoLuongTon <= :nguong
                    ORDER BY ct.SoLuongTon ASC";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":makho", $maKho);
            $cmd->bindValue(":nguong", $nguongToiThieu);
            $cmd->execute();
            $result = $cmd->fetchAll();
            return $result;
        } catch(PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}
?>
