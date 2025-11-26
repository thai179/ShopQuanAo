<?php
class DONHANG{
	
	/**
	 * Lấy danh sách tất cả đơn hàng
	 */
	public function xemdsdonhang(){
		$db = DATABASE::connect();
		try{
			$sql = "SELECT 
						dh.MaDonHang as id, 
						kh.HoTen as hoten, 
						kh.DiaChi as diachi,
						(SELECT NgayLap FROM HoaDon WHERE MaHoaDon = dh.MaDonHang) as ngay,
						(SELECT SUM(ThanhTien) FROM CTDonHang WHERE MaDonHang = dh.MaDonHang) as tongtien,
						dh.TrangThai as trangthai
					FROM DonHang dh
					JOIN KhachHang kh ON dh.MaKhachHang = kh.MaKhachHang
					ORDER BY (SELECT NgayLap FROM HoaDon WHERE MaHoaDon = dh.MaDonHang) DESC";
			$cmd = $db->prepare($sql);
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
	 * Lấy chi tiết một đơn hàng theo ID
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
						(SELECT NgayLap FROM HoaDon WHERE MaHoaDon = dh.MaDonHang) as ngay,
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
			// Chuyển đổi giá trị số sang chuỗi ENUM tương ứng
			$sql = "UPDATE DonHang SET TrangThai=:trangthai WHERE MaDonHang=:id";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(":id", $id);
			// Ensure integer is used to match DB schema
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
	public function themdonhang($MaKhachHang, $TrangThai, $chi_tiet_don_hang){
		$db = DATABASE::connect();
		$db->beginTransaction();
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
}
?>
