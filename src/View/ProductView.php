<?php
namespace Itechart\InternshipProject\View;

class ProductView
{
    public function renderProductsPage($products){
        echo "Все товары каталога: <br>";
        foreach($products as $product)
        {
            $i=1;
            echo $i."-ый товар: ".$product."<br>";
            $i++;
        }
    }
    
    public function renderProductListByCategory($category_id, $products){
        echo "Все товары категории: ".$category_id."<br>";
        foreach($products as $product)
        {
            $i=1;
            echo $i."-ый товар: ".$product."<br>";
            $i++;
        }
    }

    public function renderProductListById($product)
    {
        echo "Товар с id: ".$product['product_id']."<br>";
        echo "Наименование товара: ".$product['product_name']."<br>";
        echo "Описание товара: ".$product['product_desc']."<br>";
        echo "Цена: ".$product['product_price']." BYN<br>";
    }

    public function renderProductListByName($product){
        echo "Товар с наимениванием: ".$product['product_name']."<br>";
        echo "Артикул товара: ".$product['product_id']."<br>";
        echo "Описание товара: ".$product['product_desc']."<br>";
        echo "Цена: ".$product['product_price']." BYN<br>";
    }
}