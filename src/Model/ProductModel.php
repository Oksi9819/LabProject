<?php
namespace Itechart\InternshipProject\Model;

use Exception;
use Itechart\InternshipProject\Model\BasicModel;
use Itechart\InternshipProject\Model\CategoryModel;

class ProductModel extends BasicModel
{
    
    public function __construct()
    {
        parent::__construct();
    }

    //CREATE
    public function setProduct(string $product_name, string $product_desc, int $product_category, float $product_price) : string
    {
        $fields = array('product_name', 'product_desc', 'product_category', 'product_price', 'created_at');
        $created_at = date("Y-m-d h:i:s");
        $values = array($product_name, $product_desc, $product_category, $product_price, $created_at);
        return $this->setModel("product", $fields, "ssids", $values);
    }

    //READ
    public function getProducts(string $sort_field = NULL): array
    {
        if ($sort_field === "popularity") {
            $fields = "product.product_id AS product_id, 
                product.product_name AS product_name, 
                product.product_desc AS product_desc, 
                product.product_price AS product_price, 
                product.product_image AS product_image";
            return $this->getModel($fields, "product LEFT JOIN cart ON product.product_id = cart.product_id",  
            NULL, NULL, NULL, "product_id", "COUNT(*)*cart.amount DESC", NULL);
        }
        if ($sort_field === "pricelowhigh") {
            return $this->getModel("*", "product", NULL, NULL, NULL, NULL, "product_price", NULL);
        }
        if ($sort_field === "pricehighlow") {
            return $this->getModel("*", "product", NULL, NULL, NULL, NULL, "product_price DESC", NULL);
        }
        if ($sort_field === "az") {
            return $this->getModel("*", "product", NULL, NULL, NULL, NULL, "product_name", NULL);
        }
        if ($sort_field === "za") {
            return $this->getModel("*", "product", NULL, NULL, NULL, NULL, "product_name DESC", NULL);
        }
        if ($sort_field === NULL) {
            return $this->getModel("*", "product", NULL, NULL, NULL, NULL, NULL, NULL);
        }
    }

    public function getProductsByCategory(string $category_name, string $sort_field) : array
    {
        $categories = (new categoryModel())->getCategories();
        $category_id = NULL;
        for ($i=0; $i < count($categories); $i++) { 
            if ($categories[$i]['name_eng'] === $category_name) {
                $category_id = $categories[$i]['category_id'];
            }
        }
        if (!empty($category_id)) {
            if ($sort_field === "popularity") {
                $fields = "product.product_id AS product_id, 
                    product.product_name AS product_name, 
                    product.product_desc AS product_desc, 
                    product.product_price AS product_price, 
                    product.product_image AS product_image";
                $table = "product LEFT JOIN cart ON product.product_id = cart.product_id";
                $sort_clause = "COUNT(*)*cart.amount DESC";
                return $this->getModel($fields, $table, "product.product_category", $category_id, NULL, 
                "product.product_id", $sort_clause, "i");
            } elseif ($sort_field === "pricelowhigh") {
                $sort_clause = "product_price, product_name";
                return $this->getModel("*", "product", "product_category", $category_id, NULL, NULL, $sort_clause,  "i");
            } elseif ($sort_field === "pricehighlow") {
                $sort_clause = "product_price DESC, product_name";
                return $this->getModel("*", "product", "product_category", $category_id, NULL, NULL, $sort_clause, "i");
            } elseif ($sort_field === "az") {
                $sort_clause = "product_name";
                return $this->getModel("*", "product", "product_category", $category_id, NULL, NULL, $sort_clause, "i");
            } elseif ($sort_field === "za") {
                $sort_clause = "product_name DESC";
                return $this->getModel("*", "product", "product_category", $category_id, NULL, NULL, $sort_clause, "i");
            } else {
                throw new Exception("There are no products of such category.");
            }
        } else {
            throw new Exception("Such category was not found.");
        }
    }

    public function getProductById(int $product_id): array
    {
        return $this->getModel("*", "product", "product_id", $product_id, NULL, NULL, NULL, "i");
    }

   /* public function getProductByName(string $product_name): array
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
    }*/

    public function getProductsOfOrder(int $order_id): array
    {
        $order = (int)$order_id;
        $sql = "SELECT 
            cart.order_id AS order_id, 
            product.product_id AS product_id, 
            product.product_name AS product_name, 
            product.product_price AS product_price, 
            cart.amount AS amount, 
            cart.amount*product.product_price AS total_price 
        FROM `cart`
        LEFT JOIN product ON product.product_id = cart.product_id
        WHERE cart.order_id = ?;";
        $query = $this->connection->prepare($sql);
        $query->bind_param('i', $order);
        if ($query->execute()) {
            $result = $query->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            throw new Exception("There is no products.");
        }
    }

    //UPDATE
    public function updateProduct(array $fields, int $product_id, array $values, string $types)
    {
        $updated_at = date("Y-m-d h:i:s");
        array_push($fields, 'updated_at');
        array_push($values, $updated_at);
        $field = implode(", ", $fields);
        $types .= "si";
        return $this->updateModel($field, "product", "product_id", $product_id, $values, NULL, $types);         
    }

    //DELETE
    public function deleteProduct($product_id): string
    {   
        return $this->deleteModelItem("product", "product_id", $product_id, NULL, "i");
    }
}