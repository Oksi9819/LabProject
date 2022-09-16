<?php
namespace Itechart\InternshipProject\Model;

class ProductModel
{
    //CREATE
    public function setProduct()
    {
        global $conn;
        $product_name = (string)$_POST['product_name'];
        $product_desc = (string)$_POST['product_desc'];
        $product_category = (int)$_POST['product_category'];
        $product_price = (float)$_POST['product_price'];
        if (isset($_POST['submit_setproduct'])) {
            $sql = "INSERT INTO `product`(`product_name`, `product_desc`, `product_category`, `product_price`) VALUES(?,?,?,?)";
            $query = $conn->prepare($sql);
            $query->bind_param('ssid', $product_name, $product_desc, $product_category, $product_price);
            $query->execute();   
            $result = $query->get_result();
            $result = $result->fetch_assoc(); 
            return $result;     
        } 
    }

    //READ
    public function getProducts($sort_field): array
    {
        global $conn;
        if ($sort_field === "по популярности") {
            $sql = "SELECT product.product_id, product.product_name, product.product_desc, product.product_price FROM product LEFT JOIN cart ON product.product_id = cart.product_id GROUP BY product_id ORDER BY COUNT(*)*cart.amount DESC; ";
        }
        if ($sort_field === "по возрастанию цены") {
            $sql = "SELECT * FROM `product` ORDER BY `product_price`";
        }
        if ($sort_field === "по убыванию цены") {
            $sql = "SELECT * FROM `product` ORDER BY `product_price` DESC";
        }
        if ($sort_field === "по названию А-Я") {
            $sql = "SELECT * FROM `product` ORDER BY `product_name`";
        }
        if ($sort_field === "по названию Я-А") {
            $sql = "SELECT * FROM `product` ORDER BY `product_name` DESC";
        }
        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->get_result();
        $result = $result->fetch_assoc(); 
        return $result;
    }

    public function getProductsByCategory(int $category_id): array
    {
        if (is_int($category_id)) {
            global $conn;
            $sql = "SELECT * FROM `product` WHERE `product_category` = ?";
            $query = $conn->prepare($sql);
            $query->bind_param('i', $category_id);
            $query->execute();
            $result = $query->get_result();
            $result = $result->fetch_assoc(); 
            return $result;
        } else {
            echo $conn->error;
        }
    }

    public function getProductById(int $product_id): array
    {
        if (is_int($product_id)) {
            global $conn;
            $sql = "SELECT * FROM `product` WHERE `product_id` = ?";
            $query = $conn->prepare($sql);
            $query->bind_param('i', $product_id);
            $query->execute();
            $result = $query->get_result();
            $result = $result->fetch_assoc(); 
            return $result;
        } else {
            echo $conn->error;
        }
    }

    public function getProductByName(): array
    {
        if (isset($_POST['search'])) {
            $product_name = trim((string)$_GET['search_product']);
            global $conn;
            $sql = "SELECT * FROM `product` WHERE `product_name` = ?";
            $query = $conn->prepare($sql);
            $query->bind_param('s', $product_name);
            if ($query->execute()) {
                $result = $query->get_result();
                $result = $result->fetch_assoc(); 
                return $result;
            } else {
                echo "There is no product with such name.<br>";
            }
        }
    }

    //UPDATE
    public function updateProduct(int $product_id):array
    {
        global $conn;
        if (is_int($product_id)) {
            $product_name = (string)$_POST['product_name'];
            $product_desc = (string)$_POST['product_desc'];
            $product_category = (int)$_POST['product_category'];
            $product_price = (float)$_POST['product_price'];
            if (isset($_POST['submit_updateproduct'])) {
                $sql = "UPDATE `product` SET `product_name` = ?, `product_desc` = ?, `product_category` = ?, `product_price` = ? WHERE `product_id` = ?";
                $query = $conn->prepare($sql);
                $query->bind_param('ssidi', $product_name, $product_desc, $product_category, $product_price, $product_id);
                $query->execute();   
                $result = $query->get_result();
                $result = $result->fetch_assoc(); 
                return $result;  
            }         
        } else {
            echo $conn->error;
        }
    }

    //DELETE
    public function deleteProduct()
    {   
        if (isset($_POST['delete_submit'])) {
            $product_id = (int)$_GET['$product_id'];
            global $conn;
            $sql = "DELETE * FROM `product` WHERE `product_id` = ?";
            $query = $conn->prepare($sql);
            $query->bind_param('i', $product_id);
            if ($query->execute()) {
                echo "Product deleted.";
            } else {
                $conn->error;
            }
        }
    }
}