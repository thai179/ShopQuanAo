<?php
class SAOLUU
{
    private $id;
    private $tenfile;
    private $ngaysaoluu;

    // Getter và Setter
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getTenFile()
    {
        return $this->tenfile;
    }
    public function setTenFile($tenfile)
    {
        $this->tenfile = $tenfile;
    }
    public function getNgaySaoLuu()
    {
        return $this->ngaysaoluu;
    }
    public function setNgaySaoLuu($ngaysaoluu)
    {
        $this->ngaysaoluu = $ngaysaoluu;
    }

    // lấy tất cả bản ghi
    public function layLichSu()
    {
        $logFile = __DIR__ . '/../public/backups/history.json';

        if (file_exists($logFile)) {
            $content = file_get_contents($logFile);
            $data = json_decode($content, true);
            if (is_array($data)) {
                // Sắp xếp mới nhất lên đầu
                usort($data, function ($a, $b) {
                    return strtotime($b['NgaySaoLuu']) - strtotime($a['NgaySaoLuu']);
                });
                return $data;
            }
        }
        return [];
    }


    // Tạo sao lưu
    public function taoSaoLuu()
    {
        // Thay đổi quan trọng: Đường dẫn đến thư mục bin của MySQL trong Vertrigo
        // Vui lòng kiểm tra lại đường dẫn này trên máy của bạn nếu nó khác.
        $mysqlBinPath = 'D:/Vertrigo/mysql/bin/';
        $mysqldumpExecutable = $mysqlBinPath . 'mysqldump.exe';

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $tenfile = 'saoluu_' . date('Ymd_His') . '.sql';
        $ngaysaoluu = date('Y-m-d H:i:s');

        $backupDir = __DIR__ . '/../public/backups';

        if (!is_dir($backupDir)) {
            mkdir($backupDir, 0777, true);
        }

        $backupPath = $backupDir . '/' . $tenfile;

        // Lấy thông tin kết nối từ lớp DATABASE để đảm bảo tính nhất quán
        $user = DATABASE::$username;
        $pass = DATABASE::$password;
        $host = 'localhost'; // Giả định host là localhost từ file database.php
        $dbName = 'shopquanao'; // Tên database

        // Sử dụng exec để bắt cả output và return status, chuyển hướng stderr sang stdout (2>&1) để bắt lỗi
        $command = sprintf('"%s" --user="%s" --password="%s" --host="%s" %s > "%s" 2>&1', $mysqldumpExecutable, $user, $pass, $host, $dbName, $backupPath);
        exec($command, $output, $return_var);

        // Kiểm tra nếu lệnh không thực thi thành công
        if ($return_var !== 0) {
            // Nếu có lỗi, đọc nội dung lỗi từ file output (nếu có) hoặc từ mảng $output
            $error_message = file_get_contents($backupPath); // Lỗi thường được ghi vào file
            throw new Exception("Tạo sao lưu thất bại. Lỗi từ mysqldump: " . $error_message . implode("\n", $output));
        }

        // Lưu thông tin
        $logFile = $backupDir . '/history.json';
        $data = [
            'TenFile' => $tenfile,
            'NgaySaoLuu' => $ngaysaoluu,
            'DuongDan' => realpath($backupPath),
            'NguoiThucHien' => $_SESSION['nguoidung']['HoTen'] ?? 'Unknown',
        ];

        $existingLogs = [];
        if (file_exists($logFile)) {
            $existingLogs = json_decode(file_get_contents($logFile), true);
            if (!is_array($existingLogs)) $existingLogs = [];
        }

        $existingLogs[] = $data;

        // Ghi đè lại file log
        file_put_contents($logFile, json_encode($existingLogs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    public function phucHoi($tenfile)
    {
        // Tương tự, chỉ định đường dẫn đầy đủ cho mysql.exe
        $mysqlBinPath = 'D:/Vertrigo/mysql/bin/';
        $mysqlExecutable = $mysqlBinPath . 'mysql.exe';

        $backupPath = __DIR__ . '/../public/backups/' . $tenfile;

        if (!file_exists($backupPath)) {
            throw new Exception("File sao lưu không tồn tại: " . $tenfile);
        }

        // Lấy thông tin kết nối từ lớp DATABASE
        $user = DATABASE::$username;
        $pass = DATABASE::$password;
        $host = 'localhost';
        $dbName = 'shopquanao';

        // Đặt mật khẩu trong dấu nháy kép và sử dụng escapeshellarg cho đường dẫn file
        $command = sprintf('"%s" --user="%s" --password="%s" --host="%s" %s < %s 2>&1',
            $mysqlExecutable, $user, $pass, $host, $dbName, escapeshellarg($backupPath)
        );

        exec($command, $output, $returnVar);
        
        if ($returnVar !== 0) {
            throw new Exception("Phục hồi thất bại: " . implode("\n", $output));
        }

        return true;
    }
}
?>