<?php include '../inc/top.php'; ?>

<h2>Sao lưu Phục hồi</h2>
<h4 class="text-info">Danh sách sao lưu</h4>
<table class="table table-hover">
    <tr>
        <th>STT</th>
        <th>Tên file</th>
        <th>Ngày sao lưu</th>
        <th>Người thực hiện</th>
        <th>Hành động</th>
    </tr>
    <!-- <?php
            if (!empty($dsSaoLuu)):
                foreach ($dsSaoLuu as $ds):
            ?>
            <tr>
                <td><?php echo $ds['TenFile']; ?></td>
                <td><?php echo $ds['NgaySaoLuu']; ?></td>
                <td>
                    <a href="index.php?action=phuchoi&name=<?php echo $ds['TenFile']; ?>" class="btn btn-warning">Phục hồi</a>
                </td>
                <td><?php echo $ds['NguoiThucHien']; ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="4">Chưa có bản sao lưu nào.</td>
        </tr>
    <?php endif; ?> -->
    <?php if (!empty($dsSaoLuu)) : ?>
        <?php foreach ($dsSaoLuu as $index => $item) : ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= htmlspecialchars($item['TenFile']) ?></td>
                <td><?= htmlspecialchars($item['NgaySaoLuu']) ?></td>
                <td><?= htmlspecialchars($item['NguoiThucHien']) ?></td>
                <td>
                    <form method="post" action="index.php?action=phuchoi" onsubmit="return valid_restore()" style="display:inline;">
                        <input type="hidden" name="TenFile" value="<?= htmlspecialchars($item['TenFile']) ?>">
                        <button type="submit" class="btn btn-warning">Phục hồi</button>
                    </form>
                    <script>
                        function valid_restore() {
                            return confirm('Bạn có chắc chắn muốn phục hồi bản sao lưu này? Hành động này sẽ ghi đè dữ liệu hiện tại.');
                        }
                    </script>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="6" style="text-align:center;">Chưa có bản sao lưu nào</td>
        </tr>
    <?php endif; ?>
</table>

<!-- Thêm mới bản sao lưu -->
<form method="post" action="index.php?action=taosaoluu">
    <button type="submit" class="btn btn-primary mt-3">Thêm bản sao lưu</button>
</form>

<?php include("../inc/bottom.php"); ?>