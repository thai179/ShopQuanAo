<?php
class CUAHANG {
    public function layCuaHang() {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM CuaHang ORDER BY MaCuaHang ASC";
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

    public function layCuaHangTheoId($id) {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM CuaHang WHERE MaCuaHang = :id";
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

    public function themCuaHang($data) {
        $db = DATABASE::connect();
        try {
            $sql = "INSERT INTO CuaHang (TenCuaHang, SoChiNhanh, SoDT, DiaChi, MaNVQuanLy)
                    VALUES (:ten, :sochinhanh, :sodt, :diachi, :manvql)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":ten", $data["TenCuaHang"]);
            $cmd->bindValue(":sochinhanh", $data["SoChiNhanh"]);
            $cmd->bindValue(":sodt", $data["SoDT"]);
            $cmd->bindValue(":diachi", $data["DiaChi"]);
            $cmd->bindValue(":manvql", $data["MaNVQuanLy"] ?: null);
            $cmd->execute();
            $cmd->closeCursor();
        } catch (PDOException $e) {
            echo "<p>Lỗi thêm cửa hàng: " . $e->getMessage() . "</p>";
            exit();
        }
    }

    public function capNhatCuaHang($id, $data) {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE CuaHang SET TenCuaHang=:ten, SoChiNhanh=:sochinhanh, SoDT=:sodt, DiaChi=:diachi, MaNVQuanLy=:manvql
                    WHERE MaCuaHang=:id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":ten", $data["TenCuaHang"]);
            $cmd->bindValue(":sochinhanh", $data["SoChiNhanh"]);
            $cmd->bindValue(":sodt", $data["SoDT"]);
            $cmd->bindValue(":diachi", $data["DiaChi"]);
            $cmd->bindValue(":manvql", $data["MaNVQuanLy"] ?: null);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            $cmd->closeCursor();
        } catch (PDOException $e) {
            echo "<p>Lỗi cập nhật cửa hàng: " . $e->getMessage() . "</p>";
            exit();
        }
    }

    public function xoaCuaHang($id) {
        $db = DATABASE::connect();
        try {
            $sql = "DELETE FROM CuaHang WHERE MaCuaHang=:id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            $cmd->closeCursor();
        } catch (PDOException $e) {
            echo "<p>Lỗi xóa cửa hàng: " . $e->getMessage() . "</p>";
            exit();
        }
    }
}
