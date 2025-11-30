<?php
class DONHANG{
	
	/**
	 * Lấy danh sách tất cả đơn hàng
	 */
	public function xemdsdonhang($tuNgay = null, $denNgay = null){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT 
						dh.MaDonHang as id,
						dh.NgayDat as ngay, 
						kh.HoTen as hoten, 
						kh.DiaChi as diachi,
						SUM(ct.ThanhTien) as tongtien,
						dh.TrangThai as trangthai
					FROM DonHang dh
					JOIN KhachHang kh ON dh.MaKhachHang = kh.MaKhachHang
					LEFT JOIN CTDonHang ct ON dh.MaDonHang = ct.MaDonHang";
			
			if ($tuNgay && $denNgay) {
                $sql .= " WHERE DATE(dh.NgayDat) BETWEEN :tungay AND :denngay";
            }
            $sql .= " GROUP BY dh.MaDonHang, dh.NgayDat, kh.HoTen, kh.DiaChi, dh.TrangThai
					  ORDER BY dh.NgayDat DESC";
			$cmd = $db->prepare($sql);
			if ($tuNgay && $denNgay) {
                $cmd->bindValue(':tungay', $tuNgay);
                $cmd->bindValue(':denngay', $denNgay);
            }
			$cmd->execute();
			$result = $cmd->fetchAll();
			return $result;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}
	
	/**
	 * Lấy chi tiết một đơn hàng theo ID as ngay,
	 */
	public function laydonhangtheoid($id){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT 
						dh.MaDonHang as id, 
						kh.HoTen as hoten, 
						kh.Email as email,
						kh.SoDT as sodienthoai,
						kh.DiaChi as diachi,
						dh.NgayDat as ngay,
						(SELECT SUM(ThanhTien) FROM CTDonHang WHERE MaDonHang = dh.MaDonHang) as tongtien,
						dh.TrangThai as trangthai
					FROM DonHang dh
					JOIN KhachHang kh ON dh.MaKhachHang = kh.MaKhachHang
					WHERE dh.MaDonHang=:id";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":id", $id);
			$cmd->execute();
			$result = $cmd->fetch();
			return $result;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	public function layDonHangTheoMaKH($MaKhachHang){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT * FROM DonHang WHERE MaKhachHang=:MaKhachHang ORDER BY NgayDat DESC";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":MaKhachHang", $MaKhachHang);
			$cmd->execute();
			$result = $cmd->fetchAll();
			return $result;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	/**
	 * Cập nhật trạng thái đơn hàng
	 */
	public function capnhattrangthai($id,$trangthai){
		$db = DATABASE::connect();
		try{
			$sql = "UPDATE DonHang SET TrangThai=:trangthai WHERE MaDonHang=:id";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":id", $id);
			$cmd->bindValue(":trangthai", (int)$trangthai, PDO::PARAM_INT);  
			$result = $cmd->execute();
			return $result;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	/**
	 * Thêm một đơn hàng mới và chi tiết của nó
	 */
	public function themdonhang($MaKhachHang, $TrangThai, $chi_tiet_don_hang, $size){
		$db = DATABASE::connect();
		$db->beginTransaction();

		// Kiểm tra xem MaKhachHang có hợp lệ không
		if(empty($MaKhachHang)){
			return false; // Hoặc ném ra một ngoại lệ để xử lý ở nơi gọi hàm
		}

		try{
			// Thêm vào bảng DonHang
			$sql = "INSERT INTO DonHang(MaKhachHang, TrangThai) VALUES(:MaKhachHang, :TrangThai)";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':MaKhachHang', $MaKhachHang);
			// Ensure TrangThai inserted as integer (some DB schemas use INT for status)
			$cmd->bindValue(':TrangThai', (int)$TrangThai, PDO::PARAM_INT);
			$cmd->execute();
			$donhang_id = $db->lastInsertId();

			// Thêm vào bảng CTDonHang
			$sql_ct = "INSERT INTO CTDonHang(MaDonHang, MaSP, SoLuong, ThanhTien) 
					   VALUES(:MaDonHang, :MaSP, :SoLuong, :ThanhTien)";
			$cmd_ct = $db->prepare($sql_ct);
			foreach($chi_tiet_don_hang as $ct){
				$cmd_ct->bindValue(':MaDonHang', $donhang_id);
				$cmd_ct->bindValue(':MaSP', $ct['MaSP']);
				$cmd_ct->bindValue(':SoLuong', $ct['SoLuong']);
				$cmd_ct->bindValue(':ThanhTien', $ct['ThanhTien']);
				$cmd_ct->execute();
			}
			// Cập nhật số lượng tồn của sản phẩm
			$sql_sp = "UPDATE sanpham SET SoLuongTon = SoLuongTon - :SoLuongMua WHERE MaSP = :MaSP";
			$cmd_sp = $db->prepare($sql_sp);
			foreach($chi_tiet_don_hang as $ct){
				$cmd_sp->bindValue(':SoLuongMua', $ct['SoLuong']);
				$cmd_sp->bindValue(':MaSP', $ct['MaSP']);
				$cmd_sp->execute();
			}
			$sql_sp = "UPDATE BienTheSanPham 
					   SET SoLuongTon = SoLuongTon - :SoLuongMua 
					   WHERE MaSP = :MaSP AND TenKichCo = :TenKichCo";
			$cmd_sp = $db->prepare($sql_sp);
			foreach($chi_tiet_don_hang as $ct){
				$cmd_sp->bindValue(':SoLuongMua', $ct['SoLuong']);
				$cmd_sp->bindValue(':MaSP', $ct['MaSP']);
				$cmd_sp->bindValue(':TenKichCo', $size);
				$cmd_sp->execute();
			}
			
			$db->commit();
			return $donhang_id;
		}
		catch(PDOException $e){
			$db->rollBack();
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

    public function xoadonhang($id){
		$db = DATABASE::connect();
		try{
			$sql = "DELETE FROM DonHang WHERE MaDonHang=:id";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":id", $id);
			$cmd->execute();
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}
	public static function kiemtrakhachhangdamuasanpham($maKH, $maSP){
        $db = DATABASE::connect();
        try {
            $sql = "SELECT COUNT(DISTINCT ct.MaSP) 
                    FROM DonHang dh 
                    JOIN CTDonHang ct ON dh.MaDonHang = ct.MaDonHang 
                    WHERE dh.MaKhachHang = :makh AND ct.MaSP = :masp AND dh.TrangThai = 'Hoàn thành'";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":makh", $maKH);
            $cmd->bindValue(":masp", $maSP);
            $cmd->execute();
            $count = $cmd->fetchColumn();
            DATABASE::close();
            return $count > 0;
        } catch (PDOException $e) {
            echo "<p>Lỗi truy vấn: " . $e->getMessage() . "</p>";
            exit();
        }
    }
}
?>
