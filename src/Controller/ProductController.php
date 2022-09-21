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

    public function getProductById($product_id)
    {
        $product=$this->productModel->getProductById($product_id);
        return $this->productView->renderProductListById($product);
    }

    public function getProductByName($product_name)
    {
        $product=(new ProductModel())->getProductByName($product_name);
        return (new ProductView())->renderProductListByName($product);
    }
}