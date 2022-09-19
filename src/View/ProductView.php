<?php
namespace Itechart\InternshipProject\View;

class ProductView
{
    public function renderProductsPage($products)
    {
        navi();
        echo '<br><b>КАТАЛОГ</b><br><br>';
        echo '<b>Все товары каталога: </b><br>
        <form method="post">
            <select name="sort_choice">
                <option selected>по популярности</option>
                <option>по возрастанию цены</option>
                <option>по убыванию цены</option>
                <option>по названию А-Я</option>
                <option>по названию Я-А</option>
            </select>
            <input type="submit">
        </form>
        <br><b>Все товары каталога: </b><br><table><tr><td>Артикул</td><td>Наименование товара</td><td>Описание</td><td>Цена</td></tr>';
        foreach ($products as $product) {
            echo '<tr><td>'.$product['product_id'].'</td><td>'.$product['product_name'].'</td><td>'.$product['product_desc'].'</td><td>'.$product['product_price'].'</td></tr><br>';
        }
        echo '</table>';
    }
    
    public function renderProductListByCategory($category, $products)
    {
        navi();
        echo '<br><b>КАТАЛОГ</b><br><br>';
        echo '<b>Все товары категории: <i>'.$category.'</i></b><br><table><tr><td>Артикул</td><td>Наименование товара</td><td>Описание</td><td>Цена</td></tr>';
        if (is_array($products)) {
            foreach ($products as $product) {
                echo '<tr><td>'.$product['product_id'].'</td><td>'.$product['product_name'].'</td><td>'.$product['product_desc'].'</td><td>'.$product['product_price'].'</td></tr><br>';
            }
            echo '</table>';
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