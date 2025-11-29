<?php include("../inc/top.php"); ?>

<h3>Quản lý mặt hàng</h3> 
<br>
<a href="index.php?action=them" class="btn btn-info">
	<i class="align-middle" data-feather="plus-circle"></i> 
	Thêm mặt hàng
</a>
<br> <br> 
<table class="table table-hover">
	<tr>
		<th>Tên mặt hàng</th>
		<th>Số lượng tồn</th>
		<th>Giá bán</th>		
		<th>Hình ảnh</th>		
		<th>Sửa</th>
		<th>Xóa</th>
	</tr>
	<?php
	foreach($mathang as $m):
	?>
	<tr>
		<td>
			<a href="index.php?action=chitiet&MaSP=<?php echo $m["MaSP"]; ?>">
			<?php echo $m["TenSP"]; ?>
			</a>	
		</td>
		<td>
			<?php echo number_format($m["SoLuongTon"])?>
		</td>
		<td><?php echo number_format($m["GiaBan"]); ?>đ</td>
		<td>
			<a href="index.php?action=chitiet&MaSP=<?php echo $m["MaSP"]; ?>">
			<img src="../../images/products/<?php echo $m["HinhAnh"]; ?>" width="80" class="img-thumbnail"></a>
		</td>
		<td><a class="btn btn-warning" href="index.php?action=sua&MaSP=<?php echo $m["MaSP"]; ?>"><i class="align-middle" data-feather="edit"></a></td>
		<td><a class="btn btn-danger" href="index.php?action=xoa&MaSP=<?php echo $m["MaSP"]; ?>"><i class="align-middle" data-feather="trash-2"></a></td>
	</tr>
	<?php
	endforeach;
	?>
</table>

<?php include("../inc/bottom.php"); ?>
