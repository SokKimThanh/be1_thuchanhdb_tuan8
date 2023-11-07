<?php
    require_once '../model/sinhvien_db.php';
    
    $ma = $_POST['ma'];
    $ten = $_POST['ten'];
    $sodienthoai = $_POST['sdt'];
    $namsinh = $_POST['namsinh'];

    $svdb = new SinhVien_DB();
    $svdb->themSinhVien(new SinhVien($ma, $ten, $sodienthoai, $namsinh));

    header("Location: ../view/quanlysinhvien.php?msg1='insert'")

?>