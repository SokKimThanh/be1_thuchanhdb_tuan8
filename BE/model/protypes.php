<?php
class Protypes
{
    private $type_id;
    private $type_name;

    public function __construct($type_id = 0, $type_name = "")
    {
        if ($type_id == null) {
            throw new Exception("type_id khong hop le");
        }

        if (strlen($type_name) > 100) {
            throw new Exception("type_name khong hop le");
        }
        $this->type_id = $type_id;
        $this->type_name = $type_name;
    }


    public function __toString()
    {
        return $this->type_id . " " . $this->type_name;
    }

    /**
     * Get the value of type_id
     */
    public function getType_id()
    {
        return $this->type_id;
    }

    /**
     * Get the value of type_name
     */
    public function getType_name()
    {
        return $this->type_name;
    }

    /**
     * Set the value of type_name
     *
     * @return  self
     */
    public function setType_name($type_name)
    {
        $this->type_name = $type_name;

        return $this;
    }
}
