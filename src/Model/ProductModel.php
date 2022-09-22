<?php
namespace Itechart\InternshipProject\Model;

use Itechart\InternshipProject\Model\BasicModel;

class ProductModel extends BasicModel
{
    
    public function __construct()
    {
        parent::__construct();
    }

    //CREATE
    public function setProduct(array $values): array
    {
        $result = parent::setModel("product", [`product_name`, `product_desc`, `product_category`, `product_price`], "ssid", $values);
        return $result;
    }

    //READ
    public function getProducts(string $sort_field): array
    {
        global $conn;
        if ($sort_field === "popularity") {
            $result = parent::getModel("product.product_id AS product_id, product.product_name AS product_name, product.product_desc AS product_desc, product.product_price AS product_price", "product LEFT JOIN cart ON product.product_id = cart.product_id",  NULL, NULL, NULL, "product_id", "COUNT(*)*cart.amount DESC", NULL);
        }
        if ($sort_field === "pricelowhigh") {
            $result = parent::getModel("*", "product", NULL, NULL, NULL, NULL, "product_price", NULL);
        }
        if ($sort_field === "pricehighlow") {
            $result = parent::getModel("*", "product", NULL, NULL, NULL, NULL, "product_price DESC", NULL);
        }
        if ($sort_field === "az") {
            $result = parent::getModel("*", "product", NULL, NULL, NULL, NULL, "product_name", NULL);
        }
        if ($sort_field === "za") {
            $result = parent::getModel("*", "product", NULL, NULL, NULL, NULL, "product_name DESC", NULL);
        }
        return $result;
    }

    public function getProductsByCategory(int $category_id, string $sort_field): array
    {
        if ($sort_field === "popularity") {
            $table = "product LEFT JOIN cart ON product.product_id = cart.product_id";
             /*WHERE product.product_category = ".$category_id." GROUP BY product_id";*/
            $result = parent::getModel("product.product_id AS product_id, product.product_name AS product_name, product.product_desc AS product_desc, product.product_price AS product_price", $table, "product.product_category", $category_id, NULL, NULL, "COUNT(*)*cart.amount DESC", "i");
        }
        if ($sort_field === "pricelowhigh") {
            $result = parent::getModel("*", "product", "product_category", $category_id, NULL, NULL, "product_price, product_name",  "i");
        }
        if ($sort_field === "pricehighlow") {
            $result = parent::getModel("*", "product", "product_category", $category_id, NULL, NULL, "product_price DESC, product_name", "i");
        }
        if ($sort_field === "az") {
            $result = parent::getModel("*", "product", "product_category", $category_id, NULL, NULL, "product_name", "i");
        }
        if ($sort_field === "za") {
            $result = parent::getModel("*", "product", "product_category", $category_id, NULL, NULL, "product_name DESC", "i");
        }
        return $result;
    }

    public function getProductById(int $product_id): array
    {
        $result = parent::getModel("*", "product", "product_id", $product_id, NULL, NULL, NULL, "i");
        return $result;
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

    public function getProductsOfOrder(int $order_id): array
    {
        $order = (int)$order_id;
        global $conn;
        $sql = "SELECT cart.order_id AS order_id, product.product_id AS product_id, product.product_name AS product_name, product.product_price AS product_price, cart.amount AS amount, cart.amount*product.product_price AS total_price 
        FROM `cart`
        LEFT JOIN product ON product.product_id = cart.product_id
        WHERE cart.order_id = ?;";
        $query = $conn->prepare($sql);
        $query->bind_param('i', $order);
        if ($query->execute()) {
            $result = $query->get_result();
            $result = $result->fetch_all(MYSQLI_ASSOC); 
            return $result;
        } else {
            echo "There is no products.<br>";
        }
    }

    //UPDATE
    public function updateProduct(string $fields, int $product_id, array $values, string $types)
    {
        $result = parent::updateModel($fields, "product", "product_id", $product_id, $values, NULL, $types);
        return $result;           
    }

    //DELETE
    public function deleteProduct($product_id): array
    {   
        $result = parent::deleteModelItem("product", "product_id", $product_id, NULL, "i");
        return $result;
    }
}