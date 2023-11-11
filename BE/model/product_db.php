<?php

/**
 * Sok Kim Thanh
 * 06/11/2023
 * viet query
 */
include_once 'db.php';
include_once 'product.php';
include_once 'products.php';
class Product_DB extends Db
{

    /**
     * 1  danh sách sản phẩm
     */
    public function select()
    {
        $sql = self::$connection->prepare("SELECT id, name, price, pro_image, description FROM products");
        $sql->execute();

        $products = new ArrayListSanPham();
        // proceed only if a query is executed
        if ($result = $sql->get_result()) {
            while ($row = $result->fetch_assoc()) {
                $products->add($row);
            }
        }
        $sql->close();
        return $products;
    }
    /**
     * 2 Tìm product theo id
     */
    public function selectOne($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();

        $products = new ArrayListSanPham();
        // proceed only if a query is executed
        if ($result = $sql->get_result()) {
            while ($row = $result->fetch_assoc()) {
                $products->add($row);
            }
        }
        $sql->close();
        return $products->findById($id);
    }

    /**
     * 3 Lọc product theo type id
     */
    public function selectByTypeID($type_id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE type_id = ?");
        $sql->bind_param("i", $type_id);
        $sql->execute();

        $products = new ArrayListSanPham();
        // proceed only if a query is executed
        if ($result = $sql->get_result()) {
            while ($row = $result->fetch_assoc()) {
                $products->add($row);
            }
        }
        $sql->close();
        return $products->getList()[0];
    }
    /**
     * 4 Lọc product theo manu name
     */
    public function selectByManuName($manu_name)
    {
        $sql = self::$connection->prepare("SELECT * FROM products as p, manufactures as m WHERE p.manu_id = m.manu_id and m.manu_name =?");
        $sql->bind_param("s", $manu_name);
        $sql->execute();

        $products = new ArrayListSanPham();
        // proceed only if a query is executed
        if ($result = $sql->get_result()) {
            while ($row = $result->fetch_assoc()) {
                $products->add($row);
            }
        }
        $sql->close();
        return $products->getList()[0];
    }
    /**
     * 5 Phân trang
     */
    public function selectLimit($limit)
    {
        $sql = self::$connection->prepare("SELECT * FROM products order by created_at desc limit ?");
        $sql->bind_param("i", $limit);
        $sql->execute();

        $products = new ArrayListSanPham();
        // proceed only if a query is executed
        if ($result = $sql->get_result()) {
            while ($row = $result->fetch_assoc()) {
                $products->add($row);
            }
        }
        $sql->close();
        return $products->getList()[0];
    }
    /**
     * 6 Phân trang
     */
    public function selectLimitByOffset($limit, $offset)
    {
        $sql = self::$connection->prepare("SELECT * FROM products order by created_at desc limit ? offset ?");
        $sql->bind_param("ii", $limit, $offset);
        $sql->execute();

        $products = new ArrayListSanPham();
        // proceed only if a query is executed
        if ($result = $sql->get_result()) {
            while ($row = $result->fetch_assoc()) {
                $products->add($row);
            }
        }
        $sql->close();
        return $products->getList()[0];
    }

    /**
     * 7 Chức năng tìm kiếm
     */
    public function searchByName($name)
    {
        $sql = self::$connection->prepare("SELECT * FROM products where name like '%?%' ");
        $sql->bind_param("s", $name);
        $sql->execute();

        $products = new ArrayListSanPham();
        // proceed only if a query is executed
        if ($result = $sql->get_result()) {
            while ($row = $result->fetch_assoc()) {
                $products->add($row);
            }
        }
        $sql->close();
        return $products->getList()[0];
    }

    /**
     * 8 Chức năng Xoa
     */
    public function deleteByID($id)
    {
        $sql = self::$connection->prepare("DELETE from products where id = ?");
        $sql->bind_param("i", $id);
        $sql->execute();

        $products = new ArrayListSanPham();
        // proceed only if a query is executed
        if ($result = $sql->get_result()) {
            while ($row = $result->fetch_assoc()) {
                $products->add($row);
            }
        }
        $sql->close();
        return $products->getList()[0];
    }
    /**
     * 9 Chức năng cap nhat
     */
    public function update($sanpham)
    {
        $string = "UPDATE `products` SET `name` = ?, `manu_id` = ?, `type_id` = ?, `price` = ?, `pro_image` = ?, `description` = ?, `feature` = ?, `created_at` = ? WHERE `id` = ?";
        $sql = self::$connection->prepare($string);

        $id = $sanpham->getId();
        $ten = $sanpham->getName();
        $manu_id = $sanpham->getManu_id();
        $type_id = $sanpham->getType_id();
        $price = $sanpham->getPrice();
        $pro_image = $sanpham->getPro_image();
        $description = $sanpham->getDescription();
        $feature = $sanpham->getFeature();
        $created_at = $sanpham->getCreated_at();

        $sql->bind_param("siiissisi",  $ten, $manu_id, $type_id, $price, $pro_image, $description, $feature, $created_at, $id);

        if (!$sql->execute()) {
            throw new Exception("Thực thi sql không thành công!" . $sql->error);
            return;
        }

        $products = new ArrayListSanPham();
        // proceed only if a query is executed
        if ($result = $sql->get_result()) {
            while ($row = $result->fetch_assoc()) {
                $products->add($row);
            }
        }
        $sql->close();
        return $products;
    }
    /**
     * 10 Chức năng Them
     */
    public function add($sanpham)
    {
        $string = "INSERT INTO `products` (`id`, `name`, `manu_id`, `type_id`, `price`, `pro_image`, `description`, `feature`, `created_at`) values(?,?,?,?,?,?,?,?,?)";
        $sql = self::$connection->prepare($string);

        $id = $sanpham->getId();
        $ten = $sanpham->getName();
        $manu_id = $sanpham->getManu_id();
        $type_id = $sanpham->getType_id();
        $price = $sanpham->getPrice();
        $pro_image = $sanpham->getPro_image();
        $description = $sanpham->getDescription();
        $feature = $sanpham->getFeature();
        $created_at = $sanpham->getCreated_at();

        $sql->bind_param("isiiissis", $id, $ten, $manu_id, $type_id, $price, $pro_image, $description, $feature, $created_at);

        if (!$sql->execute()) {
            throw new Exception("Thực thi sql không thành công!" . $sql->error);
            return;
        }

        $products = new ArrayListSanPham();
        // proceed only if a query is executed
        if ($result = $sql->get_result()) {
            while ($row = $result->fetch_assoc()) {
                $products->add($row);
            }
        }
        $sql->close();
        return $products;
    }
}
$product_db = new Product_DB();

// cau 1: 
// $products = $product_db->select();
// print_r($products->getList());

// cau 2:
// $product = $product_db->selectOne(1);
// if (isset($product)) {
//     echo $product;
// } else {
//     echo "Khong tim thay";
// }

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

// cau 8: deletebyid


// cau 9: update

// $product = new Product(10002512, "phone_mac", 1000001, 100001, 204.22, "phone_mac.jpg", "điện thoại iphone 18 xịn", 1,  "2023/11/10");
// $products = $product_db->update($product);
// print_r($product_db->selectOne(10002512));


// cau 10:
// $product = new Product(10002512, "san pham 1", 1000001, 100001, 204.22, "phone_mac.jpg", "điện thoại iphone 18 xịn", 1,  "2023/11/10");
// $products = $product_db->add($product);
// print_r($product_db->select()->getList());
