<?php

class PHANHOI{
    // Lấy danh sách phản hồi theo id sản phẩm
    public function layphanhoitheoidsp($id){
        $db = DATABASE::connect();
        try{
            // Kết hợp bảng phanhoi và KhachHang để lấy tên khách hàng
            $sql = "SELECT ph.*, kh.HoTen FROM PhanHoi ph, KhachHang kh WHERE ph.MaKhachHang = kh.MaKhachHang AND ph.MaSP = :masp";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":masp", $id);
            $cmd->execute();
            $result = $cmd->fetchAll();
            DATABASE::close();
            return $result;
        }catch (PDOException $e) {
            echo "<p>Lỗi truy vấn: " . $e->getMessage() . "</p>";
            exit();
        }
    }
    public function themphanhoi($maND, $maSP, $chiTiet, $danhGia){
        $db = DATABASE::connect();
        try {
            $sql = "INSERT INTO PhanHoi (MaSP, MaKhachHang, DanhGia, ChiTietPH)
                    VALUES (:masp, :makh, :danhgia, :chitiet)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":masp", $maSP);
            $cmd->bindValue(":makh", $maND);
            $cmd->bindValue(":danhgia", $danhGia);
            $cmd->bindValue(":chitiet", $chiTiet);
            $cmd->execute();
            $cmd->closeCursor();
        } catch (PDOException $e) {
            echo "<p>Lỗi thêm phản hồi: " . $e->getMessage() . "</p>";
            exit();
        }
    }

    // Sửa một phản hồi
    public function suaphanhoi($maKH, $maSP, $chiTiet, $danhGia){
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE PhanHoi 
                    SET DanhGia = :danhgia, ChiTietPH = :chitiet 
                    WHERE MaKhachHang = :makh AND MaSP = :masp";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":makh", $maKH);
            $cmd->bindValue(":masp", $maSP);
            $cmd->bindValue(":danhgia", $danhGia);
            $cmd->bindValue(":chitiet", $chiTiet);
            $result = $cmd->execute();
            $cmd->closeCursor();
            return $result;
        } catch (PDOException $e) {
            echo "<p>Lỗi sửa phản hồi: " . $e->getMessage() . "</p>";
            exit();
        }
    }

    // Xóa một phản hồi
    public function xoaphanhoi($maKH, $maSP){
        $db = DATABASE::connect();
        try {
            $sql = "DELETE FROM PhanHoi WHERE MaKhachHang = :makh AND MaSP = :masp";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":makh", $maKH);
            $cmd->bindValue(":masp", $maSP);
            $result = $cmd->execute();
            $cmd->closeCursor();
            return $result;
        } catch (PDOException $e) {
            echo "<p>Lỗi xóa phản hồi: " . $e->getMessage() . "</p>";
            exit();
        }
    }
}

?>