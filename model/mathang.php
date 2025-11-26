<?php
class MATHANG
{
    private $id, $tenMatHang, $moTa, $giaGoc, $giaBan, $soLuongTon, $hinhAnh, $danhMuc_id, $luotXem, $luotMua;
    // getter and setter
    public function getId()
    {
        return $this->id;
    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getTenMatHang()
    {
        return $this->tenMatHang;
    }

    public function setTenMatHang($value)
    {
        $this->tenMatHang = $value;
    }

    public function getMoTa()
    {
        return $this->moTa;
    }

    public function setMoTa($value)
    {
        $this->moTa = $value;
    }

    public function getGiaGoc()
    {
        return $this->giaGoc;
    }

    public function setGiaGoc($value)
    {
        $this->giaGoc = $value;
    }

    public function getGiaBan()
    {
        return $this->giaBan;
    }

    public function setGiaBan($value)
    {
        $this->giaBan = $value;
    }

    public function getSoLuongTon()
    {
        return $this->soLuongTon;
    }

    public function setSoLuongTon($value)
    {
        $this->soLuongTon = $value;
    }

    public function getHinhAnh()
    {
        return $this->hinhAnh;
    }

    public function setHinhAnh($value)
    {
        $this->hinhAnh = $value;
    }

    public function getDanhMuc_id()
    {
        return $this->danhMuc_id;
    }

    public function setDanhMuc_id($value)
    {
        $this->danhMuc_id = $value;
    }

    public function getLuotXem()
    {
        return $this->luotXem;
    }

    public function setLuotXem($value)
    {
        $this->luotXem = $value;
    }

    public function getLuotMua()
    {
        return $this->luotMua;
    }

    public function setLuotMua($value)
    {
        $this->luotMua = $value;
    }

    public function laymathang()
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM SanPham";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $mathang = $cmd->fetchAll();
            $cmd->closeCursor();
            return $mathang;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    public function laymathangtheoid($id)
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM SanPham WHERE MaSP = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id);
            $cmd->execute();
            $mathang = $cmd->fetch();
            $cmd->closeCursor();
            return $mathang;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    public function laymathangvuathem()
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT MaSP FROM SanPham ORDER BY MaSP DESC LIMIT 1";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $maSP = $cmd->fetchColumn();
            $cmd->closeCursor();
            return $maSP;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    public function laymathangtheodanhmuc($danhMuc_id)
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM SanPham WHERE MaDM = :danhMuc_id LIMIT 4";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':danhMuc_id', $danhMuc_id);
            $cmd->execute();
            $mathang = $cmd->fetchAll();
            $cmd->closeCursor();
            return $mathang;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Tìm kiếm
    public function timkiemmathang($tukhoa)
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM SanPham WHERE TenSP LIKE :tukhoa";
            $cmd = $db->prepare($sql);
            // tìm kiếm gần đúng
            $cmd->bindValue(':tukhoa', '%' . $tukhoa . '%');
            $cmd->execute();
            $mathang = $cmd->fetchAll();
            return $mathang;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Thêm mới
    public function themmathang($mathang)
    {
        $dbcon = DATABASE::connect();
        try {
            // Bảng SanPham không có mota, soluongton, luotxem, luotmua
            $sql = "INSERT INTO SanPham(TenSP, GiaGoc, GiaBan, MoTa, MaDM)
                    VALUES(:tensp, :giagoc, :giaban, :mota, :madm)";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tensp", $mathang->getTenMatHang());
            $cmd->bindValue(":giagoc", $mathang->getGiaGoc());
            $cmd->bindValue(":giaban", $mathang->getGiaBan());
            $cmd->bindValue(":madm", $mathang->getDanhMuc_Id());
            $cmd->bindValue(":mota", $mathang->getMoTa());
            
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Xóa
    public function xoamathang($mathang)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "DELETE FROM SanPham WHERE MaSP=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $mathang->getId());
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Cập nhật
    public function suamathang($mathang)
    {
        $dbcon = DATABASE::connect();
        try {
            // Bảng SanPham không có mota, soluongton, luotxem, luotmua
            $sql = "UPDATE SanPham SET TenSP=:tensp,
                                        GiaGoc=:giagoc,
                                        GiaBan=:giaban,
                                        MaDM=:madm,
                                        MoTa=:mota,
                                        HinhAnh=:hinhanh
                                    WHERE MaSP=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tensp", $mathang->getTenMatHang());
            $cmd->bindValue(":giagoc", $mathang->getGiaGoc());
            $cmd->bindValue(":giaban", $mathang->getGiaBan());
            $cmd->bindValue(":madm", $mathang->getDanhMuc_Id());
            $cmd->bindValue(":hinhanh", $mathang->getHinhAnh());
            $cmd->bindValue(":mota", $mathang->getMoTa());
            $cmd->bindValue(":id", $mathang->getId());
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    public function capNhatHinhAnh($id, $hinhanh)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "UPDATE SanPham SET HinhAnh=:hinhanh WHERE MaSP=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":hinhanh", $hinhanh);
            $cmd->bindValue(":id", $id);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}
