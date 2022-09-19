<?php
namespace Itechart\InternshipProject\Controller;

use Itechart\InternshipProject\View\ProductView;
use Itechart\InternshipProject\Model\ProductModel;

class ProductController
{
    public function getProducts()
    {
        $products=(new ProductModel())->getProducts("по популярности");
        return (new ProductView())->renderProductsPage($products);
    }

    public function getProductsSorted()
    {
        $products=(new ProductModel())->getProducts($_POST['sort_choice']);
        return (new ProductView())->renderProductsPage($products);
    }

    public function getProductsByCategory($category)
    {
        $products=(new ProductModel())->getProductsByCategory($category);
        return (new ProductView())->renderProductListByCategory($category, $products);
    }

    public function getProductById($product_id)
    {
        $product=(new ProductModel())->getProductById($product_id);
        return (new ProductView())->renderProductListById($product);
    }

    public function getProductByName($product_name)
    {
        $product=(new ProductModel())->getProductByName($product_name);
        return (new ProductView())->renderProductListByName($product);
    }
}