<?php include("../inc/top.php"); ?>

<a href="index.php">Trở về danh sách</a>
<h3><?php echo $m["TenSP"]; ?></h3> 
<img src="../../images/products/<?php echo $m["HinhAnh"]; ?>" width="400" class="img-thumbnail"></a>
<p><strong>Giá gốc: </strong><?php echo number_format($m["GiaGoc"]); ?>đ</p>
<p><strong>Giá bán: </strong><?php echo number_format($m["GiaBan"]); ?>đ</p>
<p><a class="btn btn-warning" href="index.php?action=sua&MaSP=<?php echo $m["MaSP"]; ?>"><i class="align-middle" data-feather="edit"></i> Sửa</a> 
<a class="btn btn-danger" href="index.php?action=xoa&MaSP=<?php echo $m["MaSP"]; ?>"><i class="align-middle" data-feather="trash-2"></i> Xóa</a></p>	

<a href="index.php">Trở về danh sách</a>
<?php include("../inc/bottom.php"); ?>
