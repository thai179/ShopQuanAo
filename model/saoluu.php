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
        $db = DATABASE::connect();
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $tenfile = 'saoluu_' . date('Ymd_His') . '.sql';
        $ngaysaoluu = date('Y-m-d H:i:s');

        $backupDir = __DIR__ . '/../public/backups';

        if (!is_dir($backupDir)) {
            mkdir($backupDir, 0777, true);
        }

        $backupPath = $backupDir . '/' . $tenfile;

        $command = "mysqldump --user=root --password= --host=localhost quan_ly_ban_quan_ao > \"$backupPath\"";
        system($command);

        // Lưu thông tinu
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
        $backupPath = __DIR__ . '/../public/backups/' . $tenfile;
        $dbName = 'quan_ly_ban_quan_ao';

        if (!file_exists($backupPath)) {
            throw new Exception("File sao lưu không tồn tại: " . $tenfile);
        }

        // Sử dụng mysql command trực tiếp trên Linux
        $command = "mysql --user=root --password= --host=localhost $dbName < " . escapeshellarg($backupPath) . " 2>&1";
        exec($command, $output, $returnVar);

        if ($returnVar !== 0) {
            throw new Exception("Phục hồi thất bại: " . implode("\n", $output));
        }

        return true;
    }
}
