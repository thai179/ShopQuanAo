<?php
class DANHMUC{
    // khai báo các thuộc tính của lớp
	private $id;
    private $tendanhmuc;

	// khai báo các phương thức
    public function getID(){
        return $this->id;
    }

    public function setID($value){
        $this->id = $value;
    }

    public function getTendanhmuc(){
        return $this->tendanhmuc;
    }

    public function setTendanhmuc($value){
        $this->tendanhmuc = $value;
    }

    // Lấy danh sách tất cả danh mục
    public function laydanhmuc(){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM DanhMuc";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $result = $cmd->fetchAll();
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // public function laydanhmuc(){
    //     $dbcon = DATABASE::connect();
    //     try{
    //         $sql = "SELECT * FROM danhmuc";
    //         $cmd = $dbcon->prepare($sql);
    //         $cmd->execute();
    //         // $result = $cmd->fetchAll();
    //         // return $result;

    //         $result = $cmd->fetchAll(PDO::FETCH_OBJ);
    //         foreach($result as $r){
    //             $dm = new DANHMUC();
    //             $dm->setID($r->id);
    //             $dm->setTendanhmuc($r->tendanhmuc);
    //             $danhmuc[] = $dm;
    //         }
    //         return $danhmuc;
    //     }
    //     catch(PDOException $e){
    //         $error_message = $e->getMessage();
    //         echo "<p>Lỗi truy vấn: $error_message</p>";
    //         exit();
    //     }
    // }

    // Lấy một danh mục theo id
    public function laydanhmuctheoid($id){
        $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM DanhMuc WHERE MaDM=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            $result = $cmd->fetch();             
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    public function laytendanhmuctheoMaSP($id) {
         $dbcon = DATABASE::connect();
        try{
            $sql = "SELECT * FROM DanhMuc WHERE MaDM=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            $result = $cmd->fetch();             
            return $result;
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Thêm danh mục
    public function themdanhmuc($danhmucmoi){
        $dbcon = DATABASE::connect();
        try{
            $sql = "INSERT INTO DanhMuc(TenDanhMuc) VALUES(:tendanhmuc)";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tendanhmuc", $danhmucmoi->getTendanhmuc());
            $cmd->execute();
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Cập nhật danh mục
    public function capnhatdanhmuc($danhmuccapnhat){
        $dbcon = DATABASE::connect();
        try{
            $sql = "UPDATE DanhMuc SET TenDanhMuc=:tendanhmuc WHERE MaDM=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $danhmuccapnhat->getID());
            $cmd->bindValue(":tendanhmuc", $danhmuccapnhat->getTendanhmuc());
            $cmd->execute();
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Xóa danh mục
    public function xoadanhmuc($danhmucxoa){
        $dbcon = DATABASE::connect();
        try{
            $sql = "DELETE FROM DanhMuc WHERE MaDM=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $danhmucxoa->getID());
            $cmd->execute();
        }
        catch(PDOException $e){
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}
?>
