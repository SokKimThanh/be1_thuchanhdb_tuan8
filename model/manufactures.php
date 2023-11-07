<?php
class Manufactures
{
    private $manu_id;
    private $manu_name;

    public function __construct($manu_id = 0, $manu_name = "")
    {
        // if ($manu_id == null) {
        //     throw new Exception("ma nha san xuat khong hop le");
        // }

        // if ($manu_name == null) {
        //     throw new Exception("ten nha san xuat khong hop le");
        // }
        $this->manu_id = $manu_id;
        $this->manu_name = $manu_name;
    }

    public function getManuId(){
        return $this->manu_id;
    }
    public function getManuName(){
        return $this->manu_name;
    }
    public function setManuName($manu_name){
        return $this->manu_name = $manu_name;
    }

    public function __toString()
    {
        return $this->manu_id . " " . $this->manu_name;
    }
}

