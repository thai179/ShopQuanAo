<?php
class NHANVIEN {
    public function layNhanVien() {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT n.*, c.TenCuaHang, cv.TenCV
                    FROM NhanVien n
                    LEFT JOIN CuaHang c ON n.MaCuaHang = c.MaCuaHang
                    LEFT JOIN ChucVu cv ON n.MaCV = cv.MaCV
                    ORDER BY n.MaNV ASC";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $rs = $cmd->fetchAll(PDO::FETCH_ASSOC);
            $cmd->closeCursor();
            return $rs;
        } catch (PDOException $e) {
            echo "<p>Lỗi truy vấn: " . $e->getMessage() . "</p>";
            exit();
        }
    }

    public function layNhanVienTheoId($id) {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM NhanVien WHERE MaNV = :id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            $r = $cmd->fetch(PDO::FETCH_ASSOC);
            $cmd->closeCursor();
            return $r;
        } catch (PDOException $e) {
            echo "<p>Lỗi truy vấn: " . $e->getMessage() . "</p>";
            exit();
        }
    }

    public function themNhanVien($data) {
        $db = DATABASE::connect();
        try {
            $sql = "INSERT INTO NhanVien (HoTen, GioiTinh, SoDT, DiaChi, NamSinh, Email, MaCuaHang, MaCV)
                    VALUES (:hoten, :gioitinh, :sodt, :diachi, :namsinh, :email, :macuahang, :macv)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":hoten", $data["HoTen"]);
            $cmd->bindValue(":gioitinh", $data["GioiTinh"]);
            $cmd->bindValue(":sodt", $data["SoDT"]);
            $cmd->bindValue(":diachi", $data["DiaChi"]);
            $cmd->bindValue(":namsinh", $data["NamSinh"] ?: null);
            $cmd->bindValue(":email", $data["Email"]);
            $cmd->bindValue(":macuahang", $data["MaCuaHang"] ?: null);
            $cmd->bindValue(":macv", $data["MaCV"] ?: null);
            $cmd->execute();
            $cmd->closeCursor();
        } catch (PDOException $e) {
            echo "<p>Lỗi thêm nhân viên: " . $e->getMessage() . "</p>";
            exit();
        }
    }

    public function capNhatNhanVien($id, $data) {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE NhanVien SET HoTen=:hoten, GioiTinh=:gioitinh, SoDT=:sodt, DiaChi=:diachi, NamSinh=:namsinh, Email=:email, MaCuaHang=:macuahang, MaCV=:macv
                    WHERE MaNV=:id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":hoten", $data["HoTen"]);
            $cmd->bindValue(":gioitinh", $data["GioiTinh"]);
            $cmd->bindValue(":sodt", $data["SoDT"]);
            $cmd->bindValue(":diachi", $data["DiaChi"]);
            $cmd->bindValue(":namsinh", $data["NamSinh"] ?: null);
            $cmd->bindValue(":email", $data["Email"]);
            $cmd->bindValue(":macuahang", $data["MaCuaHang"] ?: null);
            $cmd->bindValue(":macv", $data["MaCV"] ?: null);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            $cmd->closeCursor();
        } catch (PDOException $e) {
            echo "<p>Lỗi cập nhật nhân viên: " . $e->getMessage() . "</p>";
            exit();
        }
    }

    public function xoaNhanVien($id) {
        $db = DATABASE::connect();
        try {
            $sql = "DELETE FROM NhanVien WHERE MaNV=:id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            $cmd->closeCursor();
        } catch (PDOException $e) {
            echo "<p>Lỗi xóa nhân viên: " . $e->getMessage() . "</p>";
            exit();
        }
    }
}
