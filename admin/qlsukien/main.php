<?php include("../inc/top.php"); ?>

<h3>Quản lý Sự kiện</h3> 
<br>
<a href="index.php?action=them" class="btn btn-info">
	<i class="align-middle" data-feather="plus-circle"></i> 
	Thêm sự kiện
</a>
<br> <br> 
<table class="table table-hover">
	<tr class="table-primary">
		<th>Tên sự kiện</th>
		<th>Ngày bắt đầu</th>		
		<th>Ngày kết thúc</th>		
		<th>Giảm giá (%)</th>		
		<th>Hình ảnh</th>		
		<th>Sửa</th>
		<th>Xóa</th>
	</tr>
	<?php
	foreach($sukien as $s):
	?>
	<tr>
		<td><?php echo $s["TenSuKien"]; ?></td>
		<td><?php echo date("d/m/Y", strtotime($s["NgayBatDau"])); ?></td>
		<td><?php echo date("d/m/Y", strtotime($s["NgayKetThuc"])); ?></td>
		<td><?php echo $s["GiamGia"]; ?>%</td>
		<td>
			<img src="../../<?php echo $s["HinhAnh"]; ?>" width="80" class="img-thumbnail">
		</td>
		<td><a class="btn btn-warning" href="index.php?action=sua&MaSuKien=<?php echo $s["MaSuKien"]; ?>"><i class="align-middle" data-feather="edit"></i></a></td>
		<td><a class="btn btn-danger" href="index.php?action=xoa&MaSuKien=<?php echo $s["MaSuKien"]; ?>" onclick="return confirm('Bạn chắc chắn muốn xóa sự kiện này?')"><i class="align-middle" data-feather="trash-2"></i></a></td>
	</tr>
	<?php
	endforeach;
	?>
</table>

<?php include("../inc/bottom.php"); ?>