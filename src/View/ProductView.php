<?php
namespace Itechart\InternshipProject\View;

use Itechart\InternshipProject\View\BasicView;

class ProductView extends BasicView
{
    public function renderProductsPage($products)
    {
        parent::navi();
        echo '<br><b>КАТАЛОГ</b><br><br>';
        echo '<b>Все товары каталога: </b><br>
        <form method="post" name="sort_form">
            <select name="sort_choice">
                <option value="popularity">по популярности</option>
                <option value="pricelowhigh">по возрастанию цены</option>
                <option value="pricehighlow">по убыванию цены</option>
                <option value="az">по названию А-Я</option>
                <option value="za">по названию Я-А</option>
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
        parent::navi();
        echo '<br><b>КАТАЛОГ</b><br><br>';
        echo '<b>Все товары категории: </b>'.$category.'<br>
        <form method="post">
            <select name="sort_choice">
                <option value="popularity">по популярности</option>
                <option value="pricelowhigh">по возрастанию цены</option>
                <option value="pricehighlow">по убыванию цены</option>
                <option value="az">по названию А-Я</option>
                <option value="za">по названию Я-А</option>
            </select>
            <input type="submit">
        </form><br>
        <table><tr><td>Артикул</td><td>Наименование товара</td><td>Описание</td><td>Цена</td></tr>';
        if (is_array($products)) {
            foreach ($products as $product) {
                echo '<tr><td>'.$product['product_id'].'</td><td>'.$product['product_name'].'</td><td>'.$product['product_desc'].'</td><td>'.$product['product_price'].'</td></tr><br>';
            }
            echo '</table>';
        }
        
    }

    public function renderProductListById($product)
    {
        parent::navi();
        echo 'Товар с id: '.$product[0]['product_id'].'<br>';
        echo 'Наименование товара: '.$product[0]['product_name'].'<br>';
        echo 'Описание товара: '.$product[0]['product_desc'].'<br>';
        echo 'Цена: '.$product[0]['product_price'].' BYN<br><br>
        <b>Изменить данные о товаре:</b><br>
        <form method="post" name="update_product_form">
            Новое наименование: <input type="text" name="product_name"><br>
            Новое описание: <input type="text" name="product_desc"><br>
            Новая цена: <input type="number" min="1" name="product_price" step="0.01"><br>
            <input type="submit" name="submit_update_product"><br>
        </form><br>
        <b>Удалить товар:</b><br>
        <form method="post" name="delete_product_form">
            <input type="submit" name="submit_delete_product" value = DELETE><br>
        </form>';
    }

    public function renderProductListByName($product)
    {
        parent::navi();
        echo '
        <form methode="post"> 
            <input type="text" name=text" class="search" placeholder="Search here!">
            <input type="submit" name="submit" class="submit" value="Search">
        </form>';
        echo "<br>Товар с наимениванием: ".$product['product_name']."<br>";
        echo "Артикул товара: ".$product['product_id']."<br>";
        echo "Описание товара: ".$product['product_desc']."<br>";
        echo "Цена: ".$product['product_price']." BYN<br>";
    }

    public function renderProductDeletedPage(string $result, int $product_id)
    {
        parent::navi();
        echo $result.' Товар с id: '.$product_id.' был удален.<br>';
    }
}