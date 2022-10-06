<?php

echo '<br><b>КАТАЛОГ</b><br><br>';
        echo '<b>Все товары каталога: </b><br>
        <form method="post" name="sort_form" action="'.BASEPATH.'catalog/sort">
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