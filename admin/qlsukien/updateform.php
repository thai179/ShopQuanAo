<?php include("../inc/top.php"); ?>
<div>
<h3>Cập nhật sự kiện</h3>
<form method="post" action="index.php" enctype="multipart/form-data">
<input type="hidden" name="action" value="xulysua">
<input type="hidden" name="txtid" value="<?php echo $s["MaSuKien"]; ?>">

<div class="my-3">    
	<label>Tên sự kiện</label>    
	<input class="form-control" type="text" name="txttensukien" required value="<?php echo $s["TenSuKien"]; ?>">
</div> 
<div class="my-3">    
	<label>Ngày bắt đầu</label>    
	<input class="form-control" type="date" name="txtngaybatdau" value="<?php echo $s["NgayBatDau"]; ?>" required>
</div> 
<div class="my-3">    
	<label>Ngày kết thúc</label>    
	<input class="form-control" type="date" name="txtngayketthuc" value="<?php echo $s["NgayKetThuc"]; ?>" required>
</div> 
<div class="my-3">    
	<label>Giảm giá (%)</label>    
	<input class="form-control" type="number" name="txtgiamgia" value="<?php echo $s["GiamGia"]; ?>" required min="0" max="100">
</div> 
<div class="my-3">
	<label>Hình ảnh</label><br>
	<input type="hidden" name="txthinhcu" value="<?php echo $s["HinhAnh"]; ?>">
	<img src="../../<?php echo $s["HinhAnh"]; ?>" width="100" class="img-thumbnail">	
	<a data-bs-toggle="collapse" data-bs-target="#demo">Đổi hình ảnh</a>
	<div id="demo" class="collapse m-3">
	  <input type="file" class="form-control" name="filehinhanh">
	</div>
</div>

<div class="my-3">
<input class="btn btn-primary"  type="submit" value="Lưu">
<input class="btn btn-warning"  type="reset" value="Hủy">
</div>
</form>
</div>

<?php include("../inc/bottom.php"); ?>