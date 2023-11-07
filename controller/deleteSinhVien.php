<?php
     require_once '../model/sinhvien_db.php';
     
     $sinhviendb = new SinhVien_Db();

   // Delete record from table
   if(isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
    $deleteId = $_GET['deleteId'];
    $sinhviendb->xoaSinhVien($deleteId);
    header("Location: ../view/quanlysinhvien.php?msg3='delete'");
  }
?>