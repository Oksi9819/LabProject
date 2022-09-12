<?php
namespace Itechart\InternshipProject\Controller;

use Itechart\InternshipProject\View\ProductView;
use Itechart\InternshipProject\Model\ProductModel;

class ProductController
{
    public function getProducts()
    {
        $products=(new ProductModel())->getProducts();
        return (new ProductView())->renderProductsPage($products);
    }

    public function getProductsByCategory($category_id)
    {
        $products=(new ProductModel())->getProductsByCategory($category_id);
        return (new ProductView())->renderProductListByCategory($category_id, $products);
    }

    public function getProductById($product_id)
    {
        $product=(new ProductModel())->getProductsById($product_id);
        return (new ProductView())->renderProductListById($product);
    }

    public function getProductByName($product_name)
    {
        $product=(new ProductModel())->getProductByName($product_name);
        return (new ProductView())->renderProductListByName($product);
    }
}