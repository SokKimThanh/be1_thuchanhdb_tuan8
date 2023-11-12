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
    private $products;
    public function __construct()
    {
        $this->products = new ArrayListSanPham();
        $this->select();
    }

    public function getProducts()
    {
        return $this->products->getList();
    }

    public function Xuat()
    {
        foreach ($this->products->getList() as $key => $value) {
            var_dump($value);
        }
    }
    /**
     * 1  danh sách sản phẩm
     */
    public function select()
    {
        $sql = self::$connection->prepare("SELECT id, name, price, pro_image, description FROM products");
        if (!$sql->execute()) {
            throw new Exception("Thực thi sql không thành công!" . $sql->error);
            return;
        }

        // proceed only if a query is executed
        if ($result = $sql->get_result()) {
            while ($row = $result->fetch_assoc()) {
                $this->products->add($row);
            }
        }
        $sql->close();
    }
    /**
     * 2 Tìm product theo id
     */
    public function selectOne($id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE id = ?");
        $sql->bind_param("i", $id);
        if (!$sql->execute()) {
            throw new Exception("Thực thi sql không thành công!" . $sql->error);
            return;
        }
        // proceed only if a query is executed
        if ($result = $sql->get_result()) {
            while ($row = $result->fetch_assoc()) {
                $this->products->add($row);
            }
        }
        if (!isset($this->products->getList()[0])) {
            throw new Exception("Phần tử không tồn tại");
        }
        $sql->close();
    }

    /**
     * 3 Lọc product theo type id
     */
    public function selectByTypeID($type_id)
    {
        $sql = self::$connection->prepare("SELECT * FROM products WHERE type_id = ?");
        $sql->bind_param("i", $type_id);
        if (!$sql->execute()) {
            throw new Exception("Thực thi sql không thành công!" . $sql->error);
            return;
        }


        // proceed only if a query is executed
        if ($result = $sql->get_result()) {
            while ($row = $result->fetch_assoc()) {
                $this->products->add($row);
            }
        }
        $sql->close();
    }
    /**
     * 4 Lọc product theo manu name
     */
    public function selectByManuName($manu_name)
    {
        $sql = self::$connection->prepare("SELECT * FROM products as p, manufactures as m WHERE p.manu_id = m.manu_id and m.manu_name =?");
        $sql->bind_param("s", $manu_name);
        if (!$sql->execute()) {
            throw new Exception("Thực thi sql không thành công!" . $sql->error);
            return;
        }

        // proceed only if a query is executed
        if ($result = $sql->get_result()) {
            while ($row = $result->fetch_assoc()) {
                $this->products->add($row);
            }
        }
        $sql->close();
    }
    /**
     * 5 select new 10 
     */
    public function selectNewsLimit($limit)
    {
        $sql = self::$connection->prepare("SELECT * FROM products order by created_at desc limit ?");
        $sql->bind_param("i", $limit);
        if (!$sql->execute()) {
            throw new Exception("Thực thi sql không thành công!" . $sql->error);
            return;
        }

        // proceed only if a query is executed
        $products = new ArrayListSanPham();
        if ($result = $sql->get_result()) {
            while ($row = $result->fetch_assoc()) {
                $products->add($row);
            }
        }

        $sql->close();
        return $products->getList();
    }
    /**
     * 6 Phân trang paginator
     */
    public function selectLimitByOffset($limit, $offset)
    {
        $sql = self::$connection->prepare("SELECT * FROM products order by created_at desc limit ? offset ?");

        $sql->bind_param("ii", $limit, $offset);

        if (!$sql->execute()) {
            throw new Exception("Thực thi sql không thành công!" . $sql->error);
            return;
        }

        // proceed only if a query is executed
        if ($result = $sql->get_result()) {
            while ($row = $result->fetch_assoc()) {
                $this->products->add($row);
            }
        }

        $sql->close();
    }

    /**
     * 7 Chức năng tìm kiếm
     */
    public function searchByName($name)
    {
        // khai bao
        $ten = "%" . $name . "%";
        $string = "SELECT * FROM `products` WHERE `name` LIKE ?";

        // mo ket noi 
        $sql = self::$connection->prepare($string);

        // bind param with add value
        $sql->bind_param("s", $ten);

        // exec sql
        if (!$sql->execute()) {
            throw new Exception("Thực thi sql không thành công!" . $sql->error);
            return;
        }

        // proceed only if a query is executed
        if ($result = $sql->get_result()) {
            while ($row = $result->fetch_assoc()) {
                $this->products->add($row);
            }
        }
        $sql->close();
    }

    /**
     * 8 Chức năng Xoa
     */
    public function deleteByID($id)
    {
        $sql = self::$connection->prepare("DELETE from products where id = ?");
        $sql->bind_param("i", $id);
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
        if (!isset($products->getList()[0])) {
            throw new Exception("Phần tử không tồn tại");
            return;
        }
        return $products;
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
// if ($product_db->selectOne(10002512)) {
//     print_r($product_db->selectOne(10002512)->getList()[0]);
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
// $product_db->selectLimit(1);
// $product_db->Xuat();

// cau 6: paginator
// $product_db->selectLimitByOffset(10, 9);

// $product_db->Xuat();
// cau 7:searchbyname
// $product_db->searchByName("san");
// print_r($product_db->getProducts());

// cau 8: deletebyid
// $product_db->deleteByID(10002512);
// print_r($product_db->selectOne(10002512)->getList()[0]);

// cau 9: update

// $product = new Product(10002512, "phone_mac", 1000001, 100001, 204.22, "phone_mac.jpg", "điện thoại iphone 18 xịn", 1,  "2023/11/10");
// $products = $product_db->update($product);
// print_r($product_db->selectOne(10002512));


// cau 10: add
// $product = new Product(10002512, "san pham 1", 1000001, 100001, 204.22, "phone_mac.jpg", "điện thoại iphone 18 xịn", 1,  "2023/11/10");
// $products = $product_db->add($product);
// print_r($product_db->select()->getList());
