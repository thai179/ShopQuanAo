<?php include("../inc/top.php"); ?>
<h3>Quản lý chấm công</h3>
<a href="index.php?action=add" class="btn btn-info">Thêm chấm công</a>
<br><br>
<table class="table table-hover">
    <tr>
        <th>Mã</th>
        <th>Nhân viên</th>
        <th>Thời gian làm (giờ)</th>
        <th>Đánh giá</th>
        <th>Sửa</th>
        <th>Xóa</th>
    </tr>
    <?php if(!empty($dschamcong)): ?>
        <?php foreach($dschamcong as $item): ?>
        <tr>
            <td><?php echo $item['MaChamCong']; ?></td>
            <td><?php echo $item['HoTen']; ?></td>
            <td><?php echo $item['ThoiGianLam']; ?></td>
            <td><?php echo $item['DanhGia']; ?></td>
            <td><a class="btn btn-warning" href="index.php?action=edit&id=<?php echo $item['MaChamCong']; ?>">Sửa</a></td>
            <td><a class="btn btn-danger" href="index.php?action=delete&id=<?php echo $item['MaChamCong']; ?>" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a></td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6" class="text-center">Chưa có dữ liệu chấm công</td>
        </tr>
    <?php endif; ?>
</table>
<?php include("../inc/bottom.php"); ?>
