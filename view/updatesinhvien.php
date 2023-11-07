<?php
     require_once '../model/sinhvien_db.php';
     
     $sinhviendb = new SinhVien_Db();

   // Delete record from table
   if(isset($_GET['editId']) && !empty($_GET['editId'])) {
    $editId = $_GET['editId'];
    $sinhvien = $sinhviendb->getSinhVien($editId);

;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>PHP: CRUD OOP(Add, Edit, Delete, View) (Object Oriented Programming)</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
</head>
<body>
 
<div class="card text-center" style="padding:15px;">
  <h4 class="text-primary">QUẢN LÝ SINH VIÊN - CRUD</h4>
</div><br><br> 
 
<div class="container">
  <?php

  ?>
  <div class="container">
  <form action="../controller/updateSinhVien.php" method="POST">
    <div class="form-group">
      <label for="ma">Mã:</label>
      <input type="text" class="form-control" name="ma" placeholder="nhap ma sinh vien" required="" value="<?php echo $sinhvien->ma; ?>" >
    </div>
    <div class="form-group">
      <label for="ten">Tên:</label>
      <input type="text" class="form-control" name="ten" placeholder="nhap ten" required="" value="<?php echo $sinhvien->ten ?>">
    </div>
    <div class="form-group">
      <label for="sdt">Số điện thoại:</label>
      <input type="text" class="form-control" name="sdt" placeholder="nhap so dien thoai" required="" value="<?php echo $sinhvien->sodienthoai; ?>">
    </div>
    <div class="form-group">
      <label for="namsinh">Năm sinh:</label>
      <input type="text" class="form-control" name="namsinh" placeholder="nhap nam sinh" required="" value="<?php echo $sinhvien->namsinh; ?>">
    </div>
    <input type="submit" name="submit" class="btn btn-primary" style="float:left;" value="Edit">
  </form>
</div>
<br><br><br><br>