<?php
include_once('../BE/model/protypes_db.php');
$protypeDB = new Protypes_DB();
$protypeList = $protypeDB->getList();
$type_id = isset($_GET["type_id"]) ? $_GET["type_id"] : '0';
$productNews = $productDB->selectNewsLimit(10, $type_id);
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
                foreach ($protypeList as $key => $value) {
                    if ($key == 0) {
                        // ../FE/index.php?type_id={$value["type_id"]}
                        // #tab{$value["type_id"]}
                        echo "<li class='active' data-toggle='tab'>
                        <a href='../FE/index.php?type_id={$value["type_id"]}' name='type_id'>
                        {$value['type_name']}</a>
                        </li>";
                    } else {
                        echo "<li data-toggle='tab'>
                        <a href='../FE/index.php?type_id={$value["type_id"]}' name='type_id'>
                        {$value['type_name']}</a>
                        </li>";
                    }
                }

                ?>
            </ul>
        </div>
    </div>
</div>