<?php

/**
 * Sok Kim Thanh
 * 06/11/2023
 * viet query
 */
include_once 'db.php';
include_once 'product.php';
class Product_DB extends Db
{

    /**
     * danh sách sản phẩm
     */
    public function select()
    {
        $sql = self::$connection->prepare("SELECT `id`, `name`, `price`, `image`, `description` FROM `products`");
        $sql->execute();

        $item = array();
        $item = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

        $products = array();
        foreach ($item as $key => $value) {
            $products[]  = new Product($value['id'], $value['name'], 0, 0, $value['price'], $value['image'], $value['description']);
        }
        $sql->close();
        return $products;
    }
    /**
     * Tìm product theo id
     */
    public function selectOne($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();

        $item = new Product();
        $item = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

        $products = array();
        foreach ($item as $key => $value) {
            $products[]  = new Product($value['id'], $value['name'], $value['manu_id'], $value['type_id'], $value['price'], $value['image'], $value['description'], $value['feature'], $value['created_at']);
        }
        return $products[0];
    }

    /**
     * Lọc product theo type id
     */
    public function selectByTypeID($type_id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE type_id = ?");
        $sql->bind_param("i", $type_id);
        $sql->execute();

        $item = new Product();
        $item = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

        $products = array();
        foreach ($item as $key => $value) {
            $products[]  = new Product($value['id'], $value['name'], $value['manu_id'], $value['type_id'], $value['price'], $value['image'], $value['description'], $value['feature'], $value['created_at']);
        }
        return $products;
    }
    /**
     * Lọc product theo manu name
     */
    public function selectByManuName($manu_name)
    {
        $sql = self::$connection->prepare("SELECT * FROM products as p, manufactures as m WHERE p.manu_id = m.manu_id and m.manu_name =?");
        $sql->bind_param("s", $manu_name);
        $sql->execute();

        $item = new Product();
        $item = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

        $products = array();
        foreach ($item as $key => $value) {
            $products[]  = new Product($value['id'], $value['name'], $value['manu_id'], $value['type_id'], $value['price'], $value['image'], $value['description'], $value['feature'], $value['created_at']);
        }
        return $products;
    }

    /**
     * Phân trang
     */
    public function selectLimit($limit)
    {
        $sql = self::$connection->prepare("SELECT * FROM products order by created_at desc limit ?");
        $sql->bind_param("i", $limit);
        $sql->execute();

        $item = new Product();
        $item = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

        $products = array();
        foreach ($item as $key => $value) {
            $products[] = new Product($value['id'], $value['name'], $value['manu_id'], $value['type_id'], $value['price'], $value['image'], $value['description'], $value['feature'], $value['created_at']);
        }
        return $products;
    }

    /**
     * Chức năng tìm kiếm
     */
    public function searchByName($name)
    {
        $sql = self::$connection->prepare("SELECT * FROM products where name like '%?%' ");
        $sql->bind_param("s", $name);
        $sql->execute();

        $item = new Product();
        $item = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

        $products = array();
        foreach ($item as $key => $value) {
            $products[] = new Product($value['id'], $value['name'], $value['manu_id'], $value['type_id'], $value['price'], $value['image'], $value['description'], $value['feature'], $value['created_at']);
        }
        return $products;
    }

    /**
     * Chức năng Xoa
     */
    public function deleteByID($id)
    {
        $sql = self::$connection->prepare("DELETE from products where id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();

        $item = new Product();
        $item = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

        $products = array();
        foreach ($item as $key => $value) {
            $products[] = new Product($value['id'], $value['name'], $value['manu_id'], $value['type_id'], $value['price'], $value['image'], $value['description'], $value['feature'], $value['created_at']);
        }
        return $products;
    }
    /**
     * Chức năng Them
     */
    public function add($sanpham)
    {
        $sql = self::$connection->prepare("INSERT into products values(?,?,?,?,?,?,?,?,?)");
        $sql->bind_param("i", $sanpham->getId());
        $sql->bind_param("i", $sanpham->getName());

        $sql->bind_param("i", $sanpham->getManu_id());


        $sql->bind_param("i", $sanpham->getType_id());

        $sql->bind_param("i", $sanpham->getPrice());

        $sql->bind_param("i", $sanpham);

        $sql->bind_param("i", $id);

        $sql->bind_param("i", $id);

        $sql->bind_param("i", $id);

        $sql->execute();

        $item = new Product();
        $item = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

        $products = array();
        foreach ($item as $key => $value) {
            $products[] = new Product($value['id'], $value['name'], $value['manu_id'], $value['type_id'], $value['price'], $value['image'], $value['description'], $value['feature'], $value['created_at']);
        }
        return $products;
    }
}
$product_db = new Product_DB();

// cau 1: 
// $products = $product_db->select();
// print_r($products);

// cau 2:
// $product = $product_db->selectOne(234234214);
// echo $product;

// cau 3:
// $products =  $product_db->selectByTypeID(1);
// print_r($products);

// cau 4:
// $products =  $product_db->selectByManuName("samsung");
// print_r($products);

// cau 5: 
// $products =  $product_db->selectLimit(1);
// print_r($products);

// cau 6:
