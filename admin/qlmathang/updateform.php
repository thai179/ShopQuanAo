<?php include("../inc/top.php"); ?>
<div>
	<h3>Cập nhật mặt hàng</h3>
	<form method="post" action="index.php" enctype="multipart/form-data">
		<input type="hidden" name="action" value="xulysua">
		<input type="hidden" name="txtid" value="<?php echo $m["MaSP"]; ?>">
		<div class="my-3">
			<label>Hãng sản xuất</label>
			<select class="form-control" name="optdanhmuc">
				<?php foreach ($danhmuc as $dm) { ?>
					<option value="<?php echo $dm["MaDM"]; ?>" <?php if ($dm["MaDM"] == $m["MaDM"]) echo "selected"; ?>><?php echo $dm["TenDanhMuc"]; ?></option>
				<?php } ?>
			</select>
		</div>
		<div class="my-3">
			<label>Tên hàng</label>
			<input class="form-control" type="text" name="txttenhang" required value="<?php echo $m["TenSP"]; ?>">
		</div>
		<div class="my-3">
			<label>Mô tả</label>
			<textarea class="form-control" name="txtmota" required><?php echo $m["MoTa"]; ?></textarea>
		</div>
		<!-- Các trường mota, soluongton, luotxem, luotmua không có trong bảng SanPham -->
		<div class="my-3">
			<label>Giá gốc</label>
			<input class="form-control" type="number" name="txtgiagoc" value="<?php echo $m["GiaGoc"]; ?>" required>
		</div>
		<div class="my-3">
			<label>Giá bán</label>
			<input class="form-control" type="number" name="txtgiaban" value="<?php echo $m["GiaBan"]; ?>" required>
		</div>
	<div class="my-3">
		<label>Hình ảnh</label><br>
		<input type="hidden" name="txthinhcu" value="<?php echo $m["HinhAnh"]; ?>">
		<img src="../../images/products/<?php echo $m["HinhAnh"]; ?>" width="50" class="img-thumbnail">
		<a data-bs-toggle="collapse" data-bs-target="#demo">Đổi hình ảnh</a>
			<div id="demo" class="collapse m-3">
				<input type="file" class="form-control" name="hinhanh">
			</div>
		</div>

		<!-- Cập nhật các hình ảnh sản phẩm -->
		<div class="my-3">
			<label>Các hình ảnh</label><br>
			<?php
		$ha = new HINHANHSANPHAM();
		$ha_theo_sp = $ha->layTatCaHinhAnhTheoMaSP($m["MaSP"]);
		foreach ($ha_theo_sp as $ha):
			echo '<img src="../../' . $ha["DuongDan"] . '" class="img-thumbnail" style="width: 100px; height: 100px; margin-right: 5px;"> ';
		endforeach;
			?>
		</div>
		<div class="mb-3 mt-3">
			<label>Hình ảnh</label>
			<input id="upload" class="form-control" type="file" name="filehinhanh[]" multiple accept="image/*">
			<script>
				document.getElementById('upload').addEventListener('change', function(e) {
					if (this.files.length > 4) {
						alert('Chỉ được chọn tối đa 4 ảnh!');
						this.value = '';
					}
				});
			</script>
		</div>

		<div class="my-3">
			<input class="btn btn-primary" type="submit" value="Lưu">
			<input class="btn btn-warning" type="reset" value="Hủy">
		</div>
	</form>
</div>

<?php include("../inc/bottom.php"); ?>