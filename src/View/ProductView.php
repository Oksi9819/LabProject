<?php
namespace Itechart\InternshipProject\View;

class ProductView
{
    public function renderProductsPage($products)
    {
        navi();
        echo "<br><b>КАТАЛОГ</b><br><br>";
        echo "<b>Все товары каталога: </b><br>";
        $i=1;
        foreach ($products as $product) {
            echo $i."-ый товар: ".$product."<br>";
            $i++;
        }
    }
    
    public function renderProductListByCategory($category_id, $products)
    {
        navi();
        echo "<br><b>КАТАЛОГ</b><br><br>";
        echo "<b>Все товары категории: <i>".$category_id."</i></b><br>";
        $i=1;
        foreach ($products as $product) {
            echo $i."-ый товар: ".$product."<br>";
            $i++;
        }
    }

    public function renderProductListById($product)
    {
        navi();
        echo "Товар с id: ".$product['product_id']."<br>";
        echo "Наименование товара: ".$product['product_name']."<br>";
        echo "Описание товара: ".$product['product_desc']."<br>";
        echo "Цена: ".$product['product_price']." BYN<br>";
    }

    public function renderProductListByName($product)
    {
        navi();
        echo "Товар с наимениванием: ".$product['product_name']."<br>";
        echo "Артикул товара: ".$product['product_id']."<br>";
        echo "Описание товара: ".$product['product_desc']."<br>";
        echo "Цена: ".$product['product_price']." BYN<br>";
    }
}