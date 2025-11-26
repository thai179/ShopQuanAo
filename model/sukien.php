<?php
class SUKIEN
{
    private $MaSuKien, $TenSuKien, $NgayBatDau, $NgayKetThuc, $GiamGia, $HinhAnh;

    public function getMaSuKien(){ return $this->MaSuKien; }
    public function setMaSuKien($value){ $this->MaSuKien = $value; }
    public function getTenSuKien(){ return $this->TenSuKien; }
    public function setTenSuKien($value){ $this->TenSuKien = $value; }
    public function getNgayBatDau(){ return $this->NgayBatDau; }
    public function setNgayBatDau($value){ $this->NgayBatDau = $value; }
    public function getNgayKetThuc(){ return $this->NgayKetThuc; }
    public function setNgayKetThuc($value){ $this->NgayKetThuc = $value; }
    public function getGiamGia(){ return $this->GiamGia; }
    public function setGiamGia($value){ $this->GiamGia = $value; }
    public function getHinhAnh(){ return $this->HinhAnh; }
    public function setHinhAnh($value){ $this->HinhAnh = $value; }

    public function laysukien()
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM SuKien";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $sukien = $cmd->fetchAll();
            $cmd->closeCursor();
            return $sukien;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    public function laysukientheoid($id)
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM SuKien WHERE MaSuKien = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id);
            $cmd->execute();
            $sukien = $cmd->fetch();
            $cmd->closeCursor();
            return $sukien;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    public function themsukien($sukien)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "INSERT INTO SuKien(TenSuKien, NgayBatDau, NgayKetThuc, GiamGia, HinhAnh)
                    VALUES(:tensukien, :ngaybatdau, :ngayketthuc, :giamgia, :hinhanh)";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tensukien", $sukien->getTenSuKien());
            $cmd->bindValue(":ngaybatdau", $sukien->getNgayBatDau());
            $cmd->bindValue(":ngayketthuc", $sukien->getNgayKetThuc());
            $cmd->bindValue(":giamgia", $sukien->getGiamGia());
            $cmd->bindValue(":hinhanh", $sukien->getHinhAnh());
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    public function xoasukien($sukien)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "DELETE FROM SuKien WHERE MaSuKien=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $sukien->getMaSuKien());
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    public function suasukien($sukien)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "UPDATE SuKien SET TenSuKien=:tensukien,
                                        NgayBatDau=:ngaybatdau,
                                        NgayKetThuc=:ngayketthuc,
                                        GiamGia=:giamgia,
                                        HinhAnh=:hinhanh
                                    WHERE MaSuKien=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tensukien", $sukien->getTenSuKien());
            $cmd->bindValue(":ngaybatdau", $sukien->getNgayBatDau());
            $cmd->bindValue(":ngayketthuc", $sukien->getNgayKetThuc());
            $cmd->bindValue(":giamgia", $sukien->getGiamGia());
            $cmd->bindValue(":hinhanh", $sukien->getHinhAnh());
            $cmd->bindValue(":id", $sukien->getMaSuKien());
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    public function laysukiendangdienra()
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM SuKien 
                    WHERE CURDATE() BETWEEN NgayBatDau AND NgayKetThuc 
                    ORDER BY MaSuKien DESC 
                    LIMIT 1";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $sukien = $cmd->fetch();
            $cmd->closeCursor();
            return $sukien;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}
?>