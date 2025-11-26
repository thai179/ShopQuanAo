<?php include("../inc/top.php"); ?>

<h3>Thêm sự kiện mới</h3> 
<br>
<form method="post" enctype="multipart/form-data" action="index.php">
<input type="hidden" name="action" value="xulythem">

<div class="mb-3 mt-3">
	<label for="txttensukien" class="form-label">Tên sự kiện</label>
	<input class="form-control" type="text" name="txttensukien" placeholder="Nhập tên sự kiện" required>
</div>
<div class="mb-3 mt-3">
	<label for="txtngaybatdau" class="form-label">Ngày bắt đầu</label>
	<input class="form-control" type="date" name="txtngaybatdau" required>
</div>
<div class="mb-3 mt-3">
	<label for="txtngayketthuc" class="form-label">Ngày kết thúc</label>
	<input class="form-control" type="date" name="txtngayketthuc" required>
</div>
<div class="mb-3 mt-3">
	<label for="txtgiamgia" class="form-label">Giảm giá (%)</label>
	<input class="form-control" type="number" name="txtgiamgia" value="0" min="0" max="100">
</div>
<div class="mb-3 mt-3">
	<label>Hình ảnh</label>
	<input class="form-control" type="file" name="filehinhanh">
</div>
<div class="mb-3 mt-3">
	<input type="submit" value="Lưu" class="btn btn-success">
	<input type="reset" value="Hủy" class="btn btn-warning">
</div>
</form>

<?php include("../inc/bottom.php"); ?>