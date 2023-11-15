<?php

/**
 * Sok Kim Thanh
 * 06/11/2023
 * viet query
 */
include_once 'db.php';
include_once 'protype.php';
include_once 'protypes.php';
class Protypes_DB extends Db
{
    private $list;
    public function __construct()
    {
        $this->list = new ArrayListProtype();
        $this->selectAll();
    }

    public function getList()
    {
        return $this->list->getList();
    }

    public function Xuat()
    {
        foreach ($this->list->getList() as $key => $value) {
            var_dump($value);
        }
    }
    public function selectAll()
    {
        $sql = self::$connection->prepare("SELECT * from protypes");
        $sql->execute();
        if (!$sql->execute()) {
            throw new Exception("Thực thi sql không thành công!" . $sql->error);
            return;
        }
        $list = array();
        // proceed only if a query is executed
        if ($result = $sql->get_result()) {
            while ($row = $result->fetch_assoc()) {
                $list[] = $row;
            }
        }
        $sql->close();
        return $list;
    }
    public function InDanhSachLoaiSanPham($url, $type_id)
    {
        $protypeList = $this->selectAll();
        $result = "";
        foreach ($protypeList as $key => $value) {
            if ($value['type_id'] != $type_id) {
                echo "<li><a href='{$_SERVER['PHP_SELF']}?type_id={$value['type_id']}'>{$value['type_name']}</a></li>";
            } else {
                echo "<li class='active'><a href='{$_SERVER['PHP_SELF']}?type_id={$value['type_id']}'>{$value['type_name']}</a></li>";
            }
        }
        return $result;
    }
    public function InDanhSachLoaiSanPhamTimKiem($type_id)
    {
        $protypeList = $this->selectAll();
        $result = "";

        foreach ($protypeList as $key => $value) {
            if ($value['type_id'] == $type_id && $type_id == -1) {
                $result .= "<option selected value='{$value['type_id']}'>{$value['type_name']}</option>";
            } else if ($value['type_id'] == $type_id) {
                $result .= "<option selected value='{$value['type_id']}'>{$value['type_name']}</option>";
            } else {
                $result .= "<option value='{$value['type_id']}'>{$value['type_name']}</option>";
            }
        }
        return $result;
    }
}
// $protype_db = new Protypes_DB();

// cau 1:  
// print_r($protype_db->getList());
