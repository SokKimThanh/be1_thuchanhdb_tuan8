<?php
   require_once '../model/sinhvien_db.php';
 
   $sinhviendb = new SinhVien_Db();

   // Delete record from table
   //..


      
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
    if (isset($_GET['msg1']) == "insert") {
      echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              Record ADDED successfully
            </div>";
      } 
    if (isset($_GET['msg2']) == "update") {
      echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              Record UPDATED successfully
            </div>";
    }
    if (isset($_GET['msg3']) == "delete") {
      echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              Record DELETED successfully
            </div>";
    }
  ?>
  <div class="container">
  <form action="../controller/addSinhVien.php" method="POST">
    <div class="form-group">
      <label for="ma">Mã:</label>
      <input type="text" class="form-control" name="ma" placeholder="nhap ma sinh vien" required="">
    </div>
    <div class="form-group">
      <label for="ten">Tên:</label>
      <input type="text" class="form-control" name="ten" placeholder="nhap ten" required="">
    </div>
    <div class="form-group">
      <label for="sdt">Số điện thoại:</label>
      <input type="text" class="form-control" name="sdt" placeholder="nhap so dien thoai" required="">
    </div>
    <div class="form-group">
      <label for="namsinh">Năm sinh:</label>
      <input type="text" class="form-control" name="namsinh" placeholder="nhap nam sinh" required="">
    </div>
    <input type="submit" name="submit" class="btn btn-primary" style="float:left;" value="Add">
  </form>
</div>
<br><br><br><br>

  <table class="table table-hover">
    <thead>
      <tr>
        <th>Mã</th>
        <th>Họ tên</th>
        <th>Số điện thoại</th>
        <th>Năm sinh</th>
        <th>Tuổi</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        <?php 
          $dssv = $sinhviendb->getAllSinhVien(); 
          foreach ($dssv as $sv) {    
            ?>    
        <tr>
          <td><?php echo $sv->ma ?></td>
          <td><?php echo $sv->ten ?></td>
          <td><?php echo $sv->sodienthoai ?></td>
          <td><?php echo $sv->namsinh ?></td>
          <td><?php echo $sv->tinhTuoi() ?></td>
          <td>
            <a href="updateSinhVien.php?editId=<?php echo $sv->ma ?>" style="color:green">
              <i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp
            <a href="../controller/deleteSinhVien.php?deleteId=<?php echo $sv->ma ?>" style="color:red" onclick="confirm('Are you sure want to delete this record')">
              <i class="fa fa-trash" aria-hidden="true"></i>
            </a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>