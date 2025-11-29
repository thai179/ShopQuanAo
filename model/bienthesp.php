<?php
class BIENTHESP
{

    public function laybienthetheosanpham($sanpham_id)
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT *
                    FROM BienTheSanPham
                    WHERE MaSP = :sanpham_id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':sanpham_id', $sanpham_id);
            $cmd->execute();
            $result = $cmd->fetchAll();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    public function laymotbienthe($sanpham_id, $tenkichco)
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM BienTheSanPham 
                    WHERE MaSP = :sanpham_id AND TenKichCo = :tenkichco";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':sanpham_id', $sanpham_id);
            $cmd->bindValue(':tenkichco', $tenkichco);
            $cmd->execute();
            $result = $cmd->fetch();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            return null;
        }
    }

    public function laybienthetheoma($mabienthe)
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM BienTheSanPham WHERE MaBienThe = :mabienthe";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':mabienthe', $mabienthe);
            $cmd->execute();
            $result = $cmd->fetch();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            return null;
        }
    }

    public function thembienthe($sanpham_id, $tenkichco, $soluong)
    {
        $db = DATABASE::connect();
        try {
            $sql = "INSERT INTO BienTheSanPham(MaSP, TenKichCo, SoLuongTon) 
                    VALUES(:sanpham_id, :tenkichco, :soluong)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':sanpham_id', $sanpham_id);
            $cmd->bindValue(':tenkichco', $tenkichco);
            $cmd->bindValue(':soluong', $soluong);
            $cmd->execute();
            return $db->lastInsertId();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            return 0;
        }
    }

    // Cập nhật số lượng tồn của một biến thể
    public function capnhatbienthe($mabienthe, $tenkichco, $soluong)
    {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE BienTheSanPham 
                    SET TenKichCo = :tenkichco, 
                        SoLuongTon = :soluong
                    WHERE MaBienThe = :mabienthe";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':mabienthe', $mabienthe);
            $cmd->bindValue(':tenkichco', $tenkichco);
            $cmd->bindValue(':soluong', $soluong);
            $cmd->execute();
            return true;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            return false;
        }
    }
    
    // Xóa một biến thể sản phẩm
    public function xoabienthe($mabienthe)
    {
        $db = DATABASE::connect();
        try {
            $sql = "DELETE FROM BienTheSanPham WHERE MaBienThe = :mabienthe";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':mabienthe', $mabienthe);
            $cmd->execute();
            return true;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            return false;
        }
    }
}
?>