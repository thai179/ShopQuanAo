<?php
session_start();
if(!isset($_SESSION["nguoidung"])){
    header("location:../index.php");
    exit();
}
require("../../model/database.php");
require("../../model/sukien.php");

if(isset($_REQUEST["action"])){
    $action = $_REQUEST["action"];
}
else{
    $action="xem";
}

$sk = new SUKIEN();

switch($action){
    case "xem":
        $sukien = $sk->laysukien();
		include("main.php");
        break;
	case "them":
		include("addform.php");
        break;
	case "xulythem":	
        $sukienmoi = new SUKIEN();
		$sukienmoi->setTenSuKien($_POST["txttensukien"]);
		$sukienmoi->setNgayBatDau($_POST["txtngaybatdau"]);
		$sukienmoi->setNgayKetThuc($_POST["txtngayketthuc"]);
		$sukienmoi->setGiamGia($_POST["txtgiamgia"]);

        if($_FILES["filehinhanh"]["name"] != ""){
            $ten_file_goc = basename($_FILES["filehinhanh"]["name"]);
            $ten_file_sach = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", $ten_file_goc);
            $hinhanh = "images/events/" . $ten_file_sach; 
            $duongdan = __DIR__ . "/../../" . $hinhanh;
            $thu_muc_dich = dirname($duongdan);
            if (!is_dir($thu_muc_dich)) {
                mkdir($thu_muc_dich, 0775, true);
            }
            move_uploaded_file($_FILES["filehinhanh"]["tmp_name"], $duongdan); 
            $sukienmoi->setHinhAnh($hinhanh);
        }

		$sk->themsukien($sukienmoi);
		$sukien = $sk->laysukien();
		include("main.php");
        break;
	case "xoa":
		if(isset($_GET["MaSuKien"])){
            $sukienxoa = new SUKIEN();        
            $sukienxoa->setMaSuKien($_GET["MaSuKien"]);
			$sk->xoasukien($sukienxoa);
        }
		$sukien = $sk->laysukien();
		include("main.php");
		break;	
    case "sua":
        if(isset($_GET["MaSuKien"])){ 
            $s = $sk->laysukientheoid($_GET["MaSuKien"]);
            include("updateform.php");
        }
        else{
            $sukien = $sk->laysukien();        
            include("main.php");            
        }
        break;
    case "xulysua":
        $sukiensua = new SUKIEN();
        $sukiensua->setMaSuKien($_POST["txtid"]);
        $sukiensua->setTenSuKien($_POST["txttensukien"]);
        $sukiensua->setNgayBatDau($_POST["txtngaybatdau"]);
        $sukiensua->setNgayKetThuc($_POST["txtngayketthuc"]);
        $sukiensua->setGiamGia($_POST["txtgiamgia"]);
        $sukiensua->setHinhAnh($_POST["txthinhcu"]);

        if($_FILES["filehinhanh"]["name"]!=""){
            $ten_file_goc = basename($_FILES["filehinhanh"]["name"]);
            $ten_file_sach = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", $ten_file_goc);
            $hinhanh = "images/events/" . $ten_file_sach;
            $duongdan = __DIR__ . "/../../" . $hinhanh;
            $thu_muc_dich = dirname($duongdan);
            if (!is_dir($thu_muc_dich)) {
                mkdir($thu_muc_dich, 0775, true);
            }
            move_uploaded_file($_FILES["filehinhanh"]["tmp_name"], $duongdan);
            $sukiensua->setHinhAnh($hinhanh);
        }
        
        $sk->suasukien($sukiensua);         
    
        $sukien = $sk->laysukien();    
        include("main.php");
        break;
    default:
        break;
}
?>