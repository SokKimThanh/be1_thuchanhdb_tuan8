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
        $sql = self::$connection->prepare("Select * from protypes");
        $sql->execute();
        if (!$sql->execute()) {
            throw new Exception("Thực thi sql không thành công!" . $sql->error);
            return;
        }

        // proceed only if a query is executed
        if ($result = $sql->get_result()) {
            while ($row = $result->fetch_assoc()) {
                $this->list->add($row);
            }
        }
        $sql->close();
    }
}
// $protype_db = new Protypes_DB();

// cau 1:  
// print_r($protype_db->getList());
