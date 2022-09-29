<?php
namespace Itechart\InternshipProject\Controller;

use Itechart\InternshipProject\Controller\BasicController;
use Itechart\InternshipProject\View\ProductView;
use Itechart\InternshipProject\Model\ProductModel;

class ProductController extends BasicController
{
    public $productModel;
    public $productView;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->productView = new ProductView();
    }

    public function getProducts()
    {
        $products = $this->productModel->getProducts("popularity");
        return $this->productView->renderProductsPage($products);
    }

    public function getProductsSorted()
    {
        $sort = $_POST['sort_choice'];
        $products = $this->productModel->getProducts($sort);
        return $this->productView->renderProductsPage($products);
    }

    public function getProductsByCategory($category)
    {
        if ($category == "VacuumCleaners") {
            $category_id = 1;
        }
        if ($category == "AirCleaners") {
            $category_id = 3;
        }    
        if ($category == "Humidifiers") {
            $category_id = 2;
        } 
        if ($category == "Lamps") {
            $category_id = 4; 
        } 
        if ($category == "Other") {
            $category_id = 5;
        }
        $products = $this->productModel->getProductsByCategory($category_id, "pricelowhigh");
        return $this->productView->renderProductListByCategory($category, $products);
    }

    public function getProductsByCategorySorted($category)
    {

        $sort = $_POST['sort_choice'];
        if ($category === "VacuumCleaners") {
            $category_id = 1;;
        } elseif ($category === "AirCleaners") {
            $category_id = 3;
        } elseif ($category === "Humidifiers") {
            $category_id = 2;
        } elseif ($category === "Lamps") {
            $category_id = 4; 
        } elseif ($category === "Other") {
            $category_id = 5;
        }
        $products = $this->productModel->getProductsByCategory($category_id, $sort);
        return $this->productView->renderProductListByCategory($category, $products);
    }

    public function getProductById(int $product_id)
    {
        $product=$this->productModel->getProductById($product_id);
        return $this->productView->renderProductListById($product);
    }

    /*public function getProductByName($product_name)
    {
        $product=(new ProductModel())->getProductByName($product_name);
        return (new ProductView())->renderProductListByName($product);
    }*/

    public function updateProduct(int $product_id)
    {
        global $BASEPATH;
        $product_id = (int)$product_id;
        $field = array();
        $value = array();
        $types = "";
        if (!empty($_POST['submit_update_product'])) {
            if (!empty($_POST['product_name'])) {
                $product_name = (string)$_POST['product_name'];
                array_push($field, "product_name");
                array_push($value, $product_name);
                $types.="s";
            }
            if (!empty($_POST['product_desc'])) {
                $product_desc = (string)$_POST['product_desc'];
                array_push($field, "product_desc");
                array_push($value, $product_desc);
                $types.="s";
            }
            if (!empty($_POST['product_price'])) {
                $product_price = (float)$_POST['product_price'];
                array_push($field, "product_price");
                array_push($value, $product_price);
                $types.="d";
            }
            if (!empty($value)) {
                $types.="i";
                $fields = implode(", ", $field);
                $product=$this->productModel->updateProduct($fields, $product_id, $value, $types);
                return header('Location: '.BASEPATH.'catalog/id'.$product_id);
            } 
        }
    }

    public function deleteProduct(int $product_id)
    {
        if (isset($_POST['submit_delete_product'])) {
            $result=$this->productModel->deleteProduct($product_id);
            return $this->productView->renderProductDeletedPage($result, $product_id);
        }
    }
}