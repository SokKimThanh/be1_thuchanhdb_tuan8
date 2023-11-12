<?php
include_once('../BE/model/protypes_db.php');
$protypeDB = new Protypes_DB();
$protypeList = $protypeDB->getList();
?>
<div class="col-md-12">
    <div class="section-title">
        <h3 class="title"><?php
            if(isset($_GET['search'])) {
                echo "Search Item";
            }else{
                echo "New Products";
            }
        ?></h3>
        <div class="section-nav">
            <ul class="section-tab-nav tab-nav">
                <?php
                foreach ($protypeList as $key => $value) {
                    if ($key == 0) {
                        echo "<li class='active'><a data-toggle='tab' href='#tab1'>{$value['type_name']}</a></li>";
                    } else {
                        echo "<li><a data-toggle='tab' href='#tab1'>{$value['type_name']}</a></li>";
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</div>