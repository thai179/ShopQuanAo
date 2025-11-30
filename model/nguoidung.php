<?php
class NGUOIDUNG
{
    private $id, $email, $hoten, $matkhau, $sodienthoai, $loai, $trangthai, $hinhanh;
    // Các phương thức getter và setter
    public function getId()
    {
        return $this->id;
    }
    public function setId($value)
    {
        $this->id = $value;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($value)
    {
        $this->email = $value;
    }
    public function getHoten()
    {
        return $this->hoten;
    }
    public function setHoten($value)
    {
        $this->hoten = $value;
    }
    public function getMatkhau()
    {
        return $this->matkhau;
    }
    public function setMatkhau($value)
    {
        $this->matkhau = $value;
    }
    public function getSodienthoai()
    {
        return $this->sodienthoai;
    }
    public function setSodienthoai($value)
    {
        $this->sodienthoai = $value;
    }
    public function getLoai()
    {
        return $this->loai;
    }
    public function setLoai($value)
    {
        $this->loai = $value;
    }
    public function getTrangthai()
    {
        return $this->trangthai;
    }
    public function setTrangthai($value)
    {
        $this->trangthai = $value;
    }
    public function getHinhanh()
    {
        return $this->hinhanh;
    }
    public function setHinhanh($value)
    {
        $this->hinhanh = $value;
    }

    // Contructor
    public function __construct()
    {
        $this->id = 0;
        $this->email = "";
        $this->hoten = "";
        $this->matkhau = "";
        $this->sodienthoai = "";
        $this->loai = 2; // Mặc định là khách hàng
        $this->trangthai = 1; // Mặc định là kích hoạt
        $this->hinhanh = ""; // Hình mặc định
    }


    // lấy tất cả người dùng (chỉ từ bảng TaiKhoan)
    public function laydanhsachnguoidung()
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT Username as email, '' as hoten, '' as sodienthoai,
                           Quyen as loai, TinhTrang as trangthai, '' as hinhanh
                    FROM TaiKhoan
                    ORDER BY Quyen ASC, Username ASC";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $ketqua = $cmd->fetchAll();
            $dsnguoidung = [];
            foreach ($ketqua as $nd) {
                $nguoidung = new NGUOIDUNG();
                $nguoidung->setId(0); // Không có ID
                $nguoidung->setEmail($nd["email"]);
                $nguoidung->setHoten($nd["email"]); // Tạm dùng email làm họ tên
                $nguoidung->setSodienthoai(''); // Khởi tạo rỗng
                $nguoidung->setLoai($nd["loai"] == 'Admin' ? 1 : 2);
                $nguoidung->setTrangthai($nd["trangthai"] == 'Hoạt động' ? 1 : 0);
                $nguoidung->setHinhanh($nd["hinhanh"]);
                $dsnguoidung[] = $nguoidung;
            }
            return $dsnguoidung;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }


    public function themNguoidung($nguoidung)
    {
        $db = DATABASE::connect();
        try {
            // Chỉ thêm vào bảng TaiKhoan
            $quyen = ($nguoidung->getLoai() == 1) ? 'Admin' : 'KhachHang';
            $tinhtrang = ($nguoidung->getTrangthai() == 1) ? 'Hoạt động' : 'Khóa';
            
            $sql = "INSERT INTO TaiKhoan (Username, Password, Quyen, TinhTrang)
                    VALUES (:username, :password, :quyen, :tinhtrang)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":username", $nguoidung->getEmail());
            $cmd->bindValue(":password", md5($nguoidung->getMatkhau()));
            $cmd->bindValue(":quyen", $quyen);
            $cmd->bindValue(":tinhtrang", $tinhtrang);
            $cmd->execute();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Đổi quyền người dùng
    public function doiQuyen($username, $loaiMoi) {
        $db = DATABASE::connect();
        try {
            // Chuyển đổi số sang text
            $quyen = ($loaiMoi == 1) ? 'Admin' : 'KhachHang';
            $sql = "UPDATE TaiKhoan SET Quyen=:quyen WHERE Username=:username";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":username", $username);
            $cmd->bindValue(":quyen", $quyen);
            $cmd->execute();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Khóa / Mở khóa người dùng
    public function thayDoiTrangThai($username, $trangthaiMoi) {
        $db = DATABASE::connect();
        try {
            // Chuyển đổi số sang text
            $tinhtrang = ($trangthaiMoi == 1) ? 'Hoạt động' : 'Khóa';
            $sql = "UPDATE TaiKhoan SET TinhTrang=:tinhtrang WHERE Username=:username";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":username", $username);
            $cmd->bindValue(":tinhtrang", $tinhtrang);
            $cmd->execute();
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}
