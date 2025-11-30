<?php
class DONHANGCT{
	
	// Thêm chi tiết đơn hàng mới, trả về khóa của dòng mới thêm
	public function themchitietdonhang($donhang_id,$mathang_id,$dongia,$soluong,$thanhtien){
		$db = DATABASE::connect();
		try{
			$sql = "INSERT INTO CTDonHang(MaDonHang, MaSP, SoLuong, ThanhTien) 
					VALUES(:donhang_id, :mathang_id, :soluong, :thanhtien)";
			$cmd = $db->prepare($sql);
			$cmd->bindValue(':donhang_id',$donhang_id);			
			$cmd->bindValue(':mathang_id',$mathang_id);
			$cmd->bindValue(':soluong',$soluong);
			$cmd->bindValue(':thanhtien',$thanhtien);
			$cmd->execute();
			$id = $db->lastInsertId();
			return $id;
		}
		catch(PDOException $e){
			$error_message=$e->getMessage();
			echo "<p>Lỗi truy vấn: $error_message</p>";
			exit();
		}
	}

	// Lấy chi tiết đơn hàng theo id đơn hàng
    public function laychitiettheodonhang($donhang_id){
        $db = DATABASE::connect();
        try{
            $sql = "SELECT ct.*, sp.TenSP, sp.HinhAnh, sp.GiaBan
                    FROM CTDonHang ct 
                    JOIN SanPham sp ON ct.MaSP = sp.MaSP
                    WHERE ct.MaDonHang=:donhang_id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":donhang_id", $donhang_id);
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
}
?>
