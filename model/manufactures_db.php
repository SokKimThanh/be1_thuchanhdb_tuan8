<?php
include_once "db.php";
include_once "manufactures.php";
class Manufactures_db extends Db
{
    public function select()
    {
        $sql = self::$connection->prepare("SELECT * FROM manufactures");
        $sql->execute(); // return an object

        $item = array();
        $item = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

        $arr = array();
        foreach ($item as $key => $value) {
            $arr[] = new Manufactures($value['manu_id'], $value['manu_name']);
        }
       
        return $arr;
    }
    public function selectOne($id){
        $sql = self::$connection->prepare("SELECT * FROM manufactures WHERE manu_id = ?");
        
        $sql->bind_param("i",$id);
        
        $sql->execute();
        
        
        
        $item = array();
        $item = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

        $manu = new Manufactures();
        foreach ($item as $key => $value) {
            $manu = new Manufactures($value['manu_id'], $value['manu_name']);
            break;
        }
       
        return $manu;
    }
}
// $manuDb = new Manufactures_db();
// $list = $manuDb->getAllManufactures();
// print_r($list);

// $manuDb = new Manufactures_db();
// $manu = $manuDb->selectOne(123123123);
// echo $manu->__toString();
