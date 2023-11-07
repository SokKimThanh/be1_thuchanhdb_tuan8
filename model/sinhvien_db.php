<?php
require_once 'db.php';
require_once 'sinhvien.php';
class SinhVien_Db extends Db{
    public function getAllSinhVien()
    {
        $sql = self::$connection->prepare("SELECT * FROM tbl_sinhvien");
        $sql->execute(); //return an object

        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
       
        $arrSinhVien = array();
        foreach($items as $key => $value){
            $arrSinhVien[] = new SinhVien($value['ma'], $value['ten'], $value['sodienthoai'], $value['namsinh']);
        }

        return $arrSinhVien; //return an array
    }

    public function themSinhVien($sinhvien){
        $stmt = self::$connection->prepare("INSERT INTO tbl_sinhvien VALUES (?,?,?,?)");
        $stmt->bind_param("sssd", $sinhvien->ma, $sinhvien->ten, $sinhvien->sodienthoai,$sinhvien->namsinh);
        
        $stmt->execute();
        
    }

    public function xoaSinhVien($masinhvien){
        $stmt = self::$connection->prepare("DELETE FROM tbl_sinhvien WHERE ma = ?");
        $stmt->bind_param("s", $masinhvien);
        
        $stmt->execute();
        
    }
    
    public function getSinhVien($masinhvien)
    {
        $sql = self::$connection->prepare("SELECT * FROM tbl_sinhvien WHERE MA = ?");
        $sql->bind_param("s", $masinhvien);
        $sql->execute(); //return an object

        $items = array();
        $items = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
       
        $sinhVien = "";
        foreach($items as $key => $value){
            $sinhVien = new SinhVien($value['ma'], $value['ten'], $value['sodienthoai'], $value['namsinh']);
        }

        return $sinhVien; 
    }

    public function suaSinhVien($sinhvien){
        $stmt = self::$connection->prepare("UPDATE tbl_sinhvien SET ten = ?, sodienthoai = ?, namsinh = ? WHERE ma = ?");
        $stmt->bind_param("ssis", $sinhvien->ten, $sinhvien->sodienthoai, $sinhvien->namsinh, $sinhvien->ma);
        
        $stmt->execute();
        
    }

}

//test
//  $sinhvien_db = new SinhVien_Db();
//  print_r($sinhvien_db->getAllSinhVien());

?>