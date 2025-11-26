<?php
class CHAMCONG {
    
    // Lấy tất cả bản ghi chấm công
    public function laytatcachamcong() {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT cc.*, nv.HoTen, nv.MaCuaHang 
                    FROM ChamCong cc
                    INNER JOIN NhanVien nv ON cc.MaNhanVien = nv.MaNV
                    ORDER BY cc.MaChamCong DESC";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $result = $cmd->fetchAll();
            return $result;
        } catch (PDOException $e) {
            echo "<p>Lỗi truy vấn: " . $e->getMessage() . "</p>";
            exit();
        }
    }
    
    // Lấy chấm công theo ID
    public function laychamcongtheoid($id) {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT cc.*, nv.HoTen, nv.MaCuaHang 
                    FROM ChamCong cc
                    INNER JOIN NhanVien nv ON cc.MaNhanVien = nv.MaNV
                    WHERE cc.MaChamCong = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            $result = $cmd->fetch();
            return $result;
        } catch (PDOException $e) {
            echo "<p>Lỗi truy vấn: " . $e->getMessage() . "</p>";
            exit();
        }
    }
    
    // Lấy chấm công theo nhân viên
    public function laychamcongtheonhanvien($manv) {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT cc.*, nv.HoTen 
                    FROM ChamCong cc
                    INNER JOIN NhanVien nv ON cc.MaNhanVien = nv.MaNV
                    WHERE cc.MaNhanVien = :manv
                    ORDER BY cc.MaChamCong DESC";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":manv", $manv);
            $cmd->execute();
            $result = $cmd->fetchAll();
            return $result;
        } catch (PDOException $e) {
            echo "<p>Lỗi truy vấn: " . $e->getMessage() . "</p>";
            exit();
        }
    }
    
    // Thêm chấm công mới
    public function themchamcong($manv, $ngaycham, $giovao, $giora, $thoigianlam, $danhgia, $ghichu) {
        $db = DATABASE::connect();
        try {
            $sql = "INSERT INTO ChamCong (MaNhanVien, NgayCham, GioVao, GioRa, ThoiGianLam, DanhGia, GhiChu) 
                    VALUES (:manv, :ngaycham, :giovao, :giora, :thoigianlam, :danhgia, :ghichu)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":manv", $manv);
            $cmd->bindValue(":ngaycham", $ngaycham);
            $cmd->bindValue(":giovao", $giovao);
            $cmd->bindValue(":giora", $giora);
            $cmd->bindValue(":thoigianlam", $thoigianlam);
            $cmd->bindValue(":danhgia", $danhgia);
            $cmd->bindValue(":ghichu", $ghichu);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            echo "<p>Lỗi thêm chấm công: " . $e->getMessage() . "</p>";
            exit();
        }
    }
    
    // Cập nhật chấm công
    public function capnhatchamcong($id, $manv, $ngaycham, $giovao, $giora, $thoigianlam, $danhgia, $ghichu) {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE ChamCong 
                    SET MaNhanVien = :manv, NgayCham = :ngaycham, GioVao = :giovao, GioRa = :giora, ThoiGianLam = :thoigianlam, DanhGia = :danhgia, GhiChu = :ghichu 
                    WHERE MaChamCong = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":id", $id);
            $cmd->bindValue(":manv", $manv);
            $cmd->bindValue(":ngaycham", $ngaycham);
            $cmd->bindValue(":giovao", $giovao);
            $cmd->bindValue(":giora", $giora);
            $cmd->bindValue(":thoigianlam", $thoigianlam);
            $cmd->bindValue(":danhgia", $danhgia);
            $cmd->bindValue(":ghichu", $ghichu);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            echo "<p>Lỗi cập nhật chấm công: " . $e->getMessage() . "</p>";
            exit();
        }
    }
    
    // Xóa chấm công
    public function xoachamcong($id) {
        $db = DATABASE::connect();
        try {
            $sql = "DELETE FROM ChamCong WHERE MaChamCong = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":id", $id);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            echo "<p>Lỗi xóa chấm công: " . $e->getMessage() . "</p>";
            exit();
        }
    }
    
    // Thống kê chấm công theo tháng
    public function thongkechamcongtheothang($thang, $nam) {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT nv.MaNV, nv.HoTen, 
                    COUNT(cc.MaChamCong) as SoNgayLam,
                    SUM(cc.ThoiGianLam) as TongGioLam
                    FROM NhanVien nv
                    LEFT JOIN ChamCong cc ON nv.MaNV = cc.MaNhanVien
                    WHERE MONTH(cc.NgayCham) = :thang AND YEAR(cc.NgayCham) = :nam
                    GROUP BY nv.MaNV, nv.HoTen
                    ORDER BY nv.MaNV";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":thang", $thang);
            $cmd->bindValue(":nam", $nam);
            $cmd->execute();
            $result = $cmd->fetchAll();
            return $result;
        } catch (PDOException $e) {
            echo "<p>Lỗi thống kê: " . $e->getMessage() . "</p>";
            exit();
        }
    }
}
?>
