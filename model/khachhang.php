<?php
class KhachHang
{
    private $maKH;
    private $hoTen;
    private $diaChi;
    private $soDienThoai;
    private $email;
    private $gioiTinh;
    private $namSinh;
    private $username;
    private $diemThuong;

    // Getter and Setter
    public function getMaKhachHang()
    {
        return $this->maKH;
    }
    public function setMaKhachHang($maKH)
    {
        return $this->maKH = $maKH;
    }
    public function getHoTen()
    {
        return $this->hoTen;
    }
    public function setHoTen($hoTen)
    {
        return $this->hoTen = $hoTen;
    }
    public function getDiaChi()
    {
        return $this->diaChi;
    }
    public function setDiaChi($diaChi)
    {
        return $this->diaChi = $diaChi;
    }
    public function getSoDienThoai()
    {
        return $this->soDienThoai;
    }
    public function setSoDienThoai($soDienThoai)
    {
        return $this->soDienThoai = $soDienThoai;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        return $this->email = $email;
    }
    public function getGioiTinh()
    {
        return $this->gioiTinh;
    }
    public function setGioiTinh($gioiTinh)
    {
        return $this->gioiTinh = $gioiTinh;
    }
    public function getNamSinh()
    {
        return $this->namSinh;
    }
    public function setNamSinh($namSinh)
    {
        return $this->namSinh = $namSinh;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
    {
        return $this->username = $username;
    }
    public function getDiemThuong()
    {
        return $this->diemThuong;
    }
    public function setDiemThuong($diemThuong)
    {
        return $this->diemThuong = $diemThuong;
    }

    // Lấy tất cả khách hàng
    public static function layTatCaKhachHang()
    {
        try {
            $db = DATABASE::connect();
            $sql = "SELECT * FROM KhachHang";
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return [];
        }
    }

    // Thêm khách hàng
    public static function themKhachHang($khachhang)
    {
        try {
            $db = DATABASE::connect();
            $sql = "INSERT INTO KhachHang (HoTen, DiaChi, SoDT, Email, GioiTinh, NgaySinh, DiemThuong, Username) 
                    VALUES (:hoTen, :diaChi, :soDienThoai, :email, :gioiTinh, :namSinh, :diemThuong, :username)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':hoTen', $khachhang->hoTen);
            $stmt->bindParam(':diaChi', $khachhang->diaChi);
            $stmt->bindParam(':soDienThoai', $khachhang->soDienThoai);
            $stmt->bindParam(':email', $khachhang->email);
            $stmt->bindParam(':gioiTinh', $khachhang->gioiTinh);
            $stmt->bindParam(':namSinh', $khachhang->namSinh);
            $stmt->bindParam(':diemThuong', $khachhang->diemThuong);
            $stmt->bindParam(':username', $khachhang->username);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return false;
        }
    }
    // Lấy khách hàng theo username
    public static function layKhachHangTheoUsername($username)
    {
        try {
            $db = DATABASE::connect();
            $sql = "SELECT * FROM KhachHang WHERE Username = :username";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }

    // Lấy khách hàng theo ID
    public static function layKhachHangTheoId($maKH)
    {
        try {
            $db = DATABASE::connect();
            $sql = "SELECT * FROM KhachHang WHERE MaKhachHang = :maKH";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':maKH', $maKH);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }

    // Cập nhật khách hàng
    public static function capNhatKhachHang($khachhang)
    {
        try {
            $db = DATABASE::connect();
            $sql = "UPDATE KhachHang 
                    SET HoTen = :hoTen, DiaChi = :diaChi, SoDT = :soDienThoai, 
                        Email = :email, GioiTinh = :gioiTinh, NgaySinh = :namSinh 
                    WHERE MaKhachHang = :maKH";
            $stmt = $db->prepare($sql);
            $stmt->bindValue(':hoTen', $khachhang->getHoTen());
            $stmt->bindValue(':diaChi', $khachhang->getDiaChi());
            $stmt->bindValue(':soDienThoai', $khachhang->getSoDienThoai());
            $stmt->bindValue(':email', $khachhang->getEmail());
            $stmt->bindValue(':gioiTinh', $khachhang->getGioiTinh());
            $stmt->bindValue(':namSinh', $khachhang->getNamSinh());
            $stmt->bindValue(':maKH', $khachhang->getMaKhachHang());
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return false;
        }
    }

    // Xóa khách hàng
    public static function xoaKhachHang($maKH)
    {
        try {
            $db = DATABASE::connect();
            $sql = "DELETE FROM KhachHang WHERE MaKhachHang = :maKH";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':maKH', $maKH);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return false;
        }
    }
}
