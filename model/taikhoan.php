<?php
class TAIKHOAN {
    // Simple model for TaiKhoan table (Username, Password, Quyen, TinhTrang)
    public function kiemtrataikhoanhople($username, $password) {
        $db = DATABASE::connect();
        try {
            // accept either plain or md5-stored passwords (compat)
            $sql = "SELECT * FROM TaiKhoan WHERE Username=:u AND (Password=:p OR Password=:p_md) AND TinhTrang='Hoạt động'";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":u", $username);
            $cmd->bindValue(":p", $password);
            $cmd->bindValue(":p_md", md5($password));
            $cmd->execute();
            $valid = ($cmd->rowCount() == 1);
            $cmd->closeCursor();
            return $valid;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    public function laythongtin($username) {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM TaiKhoan WHERE Username=:u";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":u", $username);
            $cmd->execute();
            $row = $cmd->fetch(PDO::FETCH_ASSOC);
            $cmd->closeCursor();
            if ($row) {
                // Map TaiKhoan fields to keys used by the admin UI (minimal compatibility)
                $mapped = [
                    // keep an 'id' key so some code referencing id won't break (use username)
                    'id' => $row['Username'],
                    'email' => $row['Username'],
                    'hoten' => $row['Username'],
                    'hinhanh' => null,
                    // numeric role mapping to match previous logic: Admin=1, NhanVien=2, KhachHang=3
                    'loai' => ($row['Quyen'] === 'Admin') ? 1 : (($row['Quyen'] === 'NhanVien') ? 2 : 3),
                    // trangthai: 1 active, 0 locked
                    'trangthai' => ($row['TinhTrang'] === 'Hoạt động') ? 1 : 0,
                    // keep original columns too
                    'Username' => $row['Username'],
                    'Quyen' => $row['Quyen'],
                    'TinhTrang' => $row['TinhTrang']
                ];
                return $mapped;
            }
            return null;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    public function doimatkhau($username, $matkhauMoi) {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE TaiKhoan SET Password=:pwd WHERE Username=:u";
            $cmd = $db->prepare($sql);
            // store plain password (to be compatible with provided seed). 
            // In production, use password_hash().
            $cmd->bindValue(":pwd", $matkhauMoi);
            $cmd->bindValue(":u", $username);
            $cmd->execute();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    public function kiemtrataikhoandatontai($username) {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM TaiKhoan WHERE Username=:u";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":u", $username);
            $cmd->execute();
            $exists = ($cmd->rowCount() == 1);
            $cmd->closeCursor();
            return $exists;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    public function dangkytaikhoanKH($username, $password) {
        $db = DATABASE::connect();
        try {
            $sql = "INSERT INTO TaiKhoan (Username, Password, Quyen, TinhTrang) VALUES (:u, :p, 'KhachHang', 'Hoạt động')";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":u", $username);
            $cmd->bindValue(":p", $password);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            return false;
        }
    }
}
?>