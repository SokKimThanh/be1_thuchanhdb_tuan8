<?php
class ArrayListProtype
{
    private $list;/* list san pham */
    private $size;/* so luong san pham */

    public function __construct()
    {
        $this->list = array();
        $size = 0;
    }

    /**
     * Get the value of list
     */
    public function getList()
    {
        return $this->list;
    }

    /**
     * Set the value of list
     *
     * @return  self
     */
    public function setList($list)
    {
        $this->list = $list;

        return $this;
    }

    /**
     * Get the value of size
     */
    public function getSize()
    {
        return $this->size;
    }

    public function add($sanpham)
    {
        $this->list[] = $sanpham;
        $this->size++;
    }
    /**
     * hàm xóa theo id
     */
    public function removeById($id)
    {
        foreach ($this->list as $key => $sanpham) {
            if ($sanpham->getId() == $id) {
                // 1_tao 2_le 3_dao
                // unset (1xtao) 2_le 3_dao
                // 1_??? 2_le 3_dao
                unset($this->list[$key]);
                $this->list = array_values($this->list);  // Re-index the array
                // 1_le 2_dao 
                $this->size--;
                break;
            }
        }
    }

    public function edit($sanpham)
    {
        foreach ($this->list as $key => $sp) {
            if ($sp->getId() == $sanpham->getId()) {
                $sp->setName($sanpham->getName());
                $sp->setManu_id($sanpham->getManu_id());
                $sp->setType_id($sanpham->getType_id());
                $sp->setPrice($sanpham->getPrice());
                $sp->setPro_image($sanpham->getPro_image());
                $sp->setDescription($sanpham->getDescription());
                $sp->setFeature($sanpham->getFeature());
                $sp->setCreated_at($sanpham->getCreated_at());
            }
        }
    }

    /**
     * hàm xóa theo id
     */
    public function findById($id)
    {
        foreach ($this->list as $key => $value) {
            if ($value['type_id'] == $id) {
                return new Product($value['type_id'], $value['type_name']);
            }
        }
        return null;
    }
}


// include_once 'product.php';
//test
// $product1 = new Product(100002, "san pham 1", 1000001, 100001, 204.22, "phone_mac.jpg", "điện thoại iphone 18 xịn", 1, DateTime::createFromFormat("Y-m-d", "2023-4-5"));
// $product2 = new Product(100003, "san pham 21", 1000001, 100001, 204.22, "phone_mac.jpg", "điện thoại iphone 18 xịn", 1, DateTime::createFromFormat("Y-m-d", "2023-4-5"));
// $product3 = new Product(100004, "san pham 31", 1000001, 100001, 204.22, "phone_mac.jpg", "điện thoại iphone 18 xịn", 1, DateTime::createFromFormat("Y-m-d", "2023-4-5"));
// $product4 = new Product(100005, "san pham 41", 1000001, 100001, 204.22, "phone_mac.jpg", "điện thoại iphone 18 xịn", 1, DateTime::createFromFormat("Y-m-d", "2023-4-5"));
// $product5 = new Product(100001, "san pham 51", 1000001, 100001, 204.22, "phone_mac.jpg", "điện thoại iphone 18 xịn", 1, DateTime::createFromFormat("Y-m-d", "2023-4-5"));

// $list = new ArrayListSanPham();
// $list->add($product1);
// $list->add($product2);
// $list->add($product3);
// $list->add($product4);
// $list->add($product5);

// print_r($list->getList());

// $sanpham = $list->findById(100001);

// echo $sanpham->__toString() . "<br>";;

// echo $list->getSize() . "<br>";
// $list->removeById($sanpham->getId());
// echo $list->getSize() . "<br>";;
