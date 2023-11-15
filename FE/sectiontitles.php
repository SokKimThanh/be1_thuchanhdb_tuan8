 <?php
include_once('../BE/model/protypes_db.php');
$protypeDB = new Protypes_DB();
    ?>
 <div class="col-md-12">
     <div class="section-title">
         <h3 class="title"><?php
                            if (isset($_GET['search'])) {
                                echo "Search Item";
                            } else {
                                echo "New Products";
                            }
                            ?></h3>
         <div class="section-nav">
             <ul class="section-tab-nav tab-nav">
                 <?php
                      $protypeDB->InDanhSachLoaiSanPham($url, $type_id);
                    ?>
             </ul>
         </div>
     </div>
 </div>