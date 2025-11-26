<?php
class DOANHTHU
{
    // Lấy tổng doanh thu
    public function layTongDoanhThu($tuNgay = null, $denNgay = null)
    {
        try {
            $conn = DATABASE::connect();
            $sql = "SELECT 
                        COUNT(DISTINCT d.MaDonHang) as TongDonHang,
                        SUM(ct.ThanhTien) as TongDoanhThu,
                        SUM(ct.SoLuong) as TongSanPhamBan
                    FROM DonHang d
                    INNER JOIN CTDonHang ct ON d.MaDonHang = ct.MaDonHang
                    WHERE (d.TrangThai IS NULL OR d.TrangThai != 'Hủy')";
            
            if ($tuNgay && $denNgay) {
                $sql .= " AND DATE(d.NgayDat) BETWEEN :tungay AND :denngay";
            }
            
            $stmt = $conn->prepare($sql);
            
            if ($tuNgay && $denNgay) {
                $stmt->bindParam(':tungay', $tuNgay);
                $stmt->bindParam(':denngay', $denNgay);
            }
            
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [
                'TongDonHang' => 0,
                'TongDoanhThu' => 0,
                'TongSanPhamBan' => 0
            ];
        }
    }

    // Lấy doanh thu theo ngày
    public function layDoanhThuTheoNgay($tuNgay = null, $denNgay = null)
    {
        try {
            $conn = DATABASE::connect();
            $sql = "SELECT 
                        DATE(d.NgayDat) as Ngay,
                        COUNT(DISTINCT d.MaDonHang) as SoDonHang,
                        SUM(ct.SoLuong) as SoLuongBan,
                        SUM(ct.ThanhTien) as DoanhThu
                    FROM DonHang d
                    INNER JOIN CTDonHang ct ON d.MaDonHang = ct.MaDonHang
                    WHERE (d.TrangThai IS NULL OR d.TrangThai != 'Hủy')";
            
            if ($tuNgay && $denNgay) {
                $sql .= " AND DATE(d.NgayDat) BETWEEN :tungay AND :denngay";
            }
            
            $sql .= " GROUP BY DATE(d.NgayDat)
                     ORDER BY DATE(d.NgayDat) DESC";
            
            $stmt = $conn->prepare($sql);
            
            if ($tuNgay && $denNgay) {
                $stmt->bindParam(':tungay', $tuNgay);
                $stmt->bindParam(':denngay', $denNgay);
            }
            
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    // Lấy doanh thu theo tháng
    public function layDoanhThuTheoThang($nam = null, $tuNgay = null, $denNgay = null)
    {
        try {
            $conn = DATABASE::connect();
            if (!$nam) $nam = date('Y');
            
            $sql = "SELECT 
                        MONTH(d.NgayDat) as Thang,
                        YEAR(d.NgayDat) as Nam,
                        COUNT(DISTINCT d.MaDonHang) as SoDonHang,
                        SUM(ct.SoLuong) as SoLuongBan,
                        SUM(ct.ThanhTien) as DoanhThu
                    FROM DonHang d
                    INNER JOIN CTDonHang ct ON d.MaDonHang = ct.MaDonHang
                    WHERE (d.TrangThai IS NULL OR d.TrangThai != 'Hủy') AND YEAR(d.NgayDat) = :nam";
            
            if ($tuNgay && $denNgay) {
                $sql .= " AND DATE(d.NgayDat) BETWEEN :tungay AND :denngay";
            }
            
            $sql .= " GROUP BY MONTH(d.NgayDat), YEAR(d.NgayDat)
                     ORDER BY MONTH(d.NgayDat) DESC";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':nam', $nam);
            
            if ($tuNgay && $denNgay) {
                $stmt->bindParam(':tungay', $tuNgay);
                $stmt->bindParam(':denngay', $denNgay);
            }
            
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    // Lấy top sản phẩm bán chạy
    public function layTopSanPhamBanChay($limit = 10, $tuNgay = null, $denNgay = null)
    {
        try {
            $conn = DATABASE::connect();
            $sql = "SELECT 
                        sp.MaSP,
                        sp.TenSP,
                        sp.HinhAnh,
                        dm.TenDanhMuc,
                        COUNT(DISTINCT d.MaDonHang) as SoDonHang,
                        SUM(ct.SoLuong) as TongSoLuong,
                        SUM(ct.ThanhTien) as TongDoanhThu
                    FROM SanPham sp
                    INNER JOIN CTDonHang ct ON sp.MaSP = ct.MaSP
                    INNER JOIN DonHang d ON ct.MaDonHang = d.MaDonHang
                    INNER JOIN DanhMuc dm ON sp.MaDM = dm.MaDM
                    WHERE (d.TrangThai IS NULL OR d.TrangThai != 'Hủy')";
            
            if ($tuNgay && $denNgay) {
                $sql .= " AND DATE(d.NgayDat) BETWEEN :tungay AND :denngay";
            }
            
            $sql .= " GROUP BY sp.MaSP, sp.TenSP, sp.HinhAnh, dm.TenDanhMuc
                     ORDER BY TongDoanhThu DESC
                     LIMIT :limit";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            
            if ($tuNgay && $denNgay) {
                $stmt->bindParam(':tungay', $tuNgay);
                $stmt->bindParam(':denngay', $denNgay);
            }
            
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    // Lấy doanh thu theo danh mục
    public function layDoanhThuTheoDanhMuc($tuNgay = null, $denNgay = null)
    {
        try {
            $conn = DATABASE::connect();
            $sql = "SELECT 
                        dm.MaDM,
                        dm.TenDanhMuc,
                        COUNT(DISTINCT d.MaDonHang) as SoDonHang,
                        SUM(ct.SoLuong) as SoLuongBan,
                        SUM(ct.ThanhTien) as DoanhThu
                    FROM DanhMuc dm
                    INNER JOIN SanPham sp ON dm.MaDM = sp.MaDM
                    INNER JOIN CTDonHang ct ON sp.MaSP = ct.MaSP
                    INNER JOIN DonHang d ON ct.MaDonHang = d.MaDonHang
                    WHERE (d.TrangThai IS NULL OR d.TrangThai != 'Hủy')";
            
            if ($tuNgay && $denNgay) {
                $sql .= " AND DATE(d.NgayDat) BETWEEN :tungay AND :denngay";
            }
            
            $sql .= " GROUP BY dm.MaDM, dm.TenDanhMuc
                     ORDER BY DoanhThu DESC";
            
            $stmt = $conn->prepare($sql);
            
            if ($tuNgay && $denNgay) {
                $stmt->bindParam(':tungay', $tuNgay);
                $stmt->bindParam(':denngay', $denNgay);
            }
            
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    // Lấy top khách hàng
    public function layTopKhachHang($limit = 10, $tuNgay = null, $denNgay = null)
    {
        try {
            $conn = DATABASE::connect();
            $sql = "SELECT 
                        kh.MaKhachHang,
                        kh.HoTen,
                        kh.Email,
                        kh.SoDT,
                        COUNT(DISTINCT d.MaDonHang) as SoDonHang,
                        SUM(ct.ThanhTien) as TongChiTieu
                    FROM KhachHang kh
                    INNER JOIN DonHang d ON kh.MaKhachHang = d.MaKhachHang
                    INNER JOIN CTDonHang ct ON d.MaDonHang = ct.MaDonHang
                    WHERE (d.TrangThai IS NULL OR d.TrangThai != 'Hủy')";
            
            if ($tuNgay && $denNgay) {
                $sql .= " AND DATE(d.NgayDat) BETWEEN :tungay AND :denngay";
            }
            
            $sql .= " GROUP BY kh.MaKhachHang, kh.HoTen, kh.Email, kh.SoDT
                     ORDER BY TongChiTieu DESC
                     LIMIT :limit";
            
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            
            if ($tuNgay && $denNgay) {
                $stmt->bindParam(':tungay', $tuNgay);
                $stmt->bindParam(':denngay', $denNgay);
            }
            
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    // Lấy doanh thu theo trạng thái đơn hàng
    public function layDoanhThuTheoTrangThai($tuNgay = null, $denNgay = null)
    {
        try {
            $conn = DATABASE::connect();
            $sql = "SELECT 
                        d.TrangThai,
                        COUNT(DISTINCT d.MaDonHang) as SoDonHang,
                        SUM(ct.ThanhTien) as DoanhThu
                    FROM DonHang d
                    INNER JOIN CTDonHang ct ON d.MaDonHang = ct.MaDonHang
                    WHERE (d.TrangThai IS NULL OR d.TrangThai != 'Hủy')";
            
            if ($tuNgay && $denNgay) {
                $sql .= " AND DATE(d.NgayDat) BETWEEN :tungay AND :denngay";
            }
            
            $sql .= " GROUP BY d.TrangThai
                     ORDER BY DoanhThu DESC";
            
            $stmt = $conn->prepare($sql);
            
            if ($tuNgay && $denNgay) {
                $stmt->bindParam(':tungay', $tuNgay);
                $stmt->bindParam(':denngay', $denNgay);
            }
            
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }
}
?>
