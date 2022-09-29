<?php
namespace Itechart\InternshipProject\View;

use Itechart\InternshipProject\View\BasicView;

class ProductView extends BasicView
{
    //User functions
    public function renderProductsPage(array $products)
    {
        $this->navi();
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
    
    public function renderProductListByCategory(string $category_name, array $products)
    {
        $this->navi();
        echo '<br><b>КАТАЛОГ</b><br><br>';
        echo '<b>Все товары категории: </b>'.$category_name.'<br>
        <form method="post" action="'.BASEPATH.'catalog/sort">
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

    public function renderProductListById(array $product)
    {
        $this->navi();
        global $BASEPATH;
        echo 'Товар с id: '.$product[0]['product_id'].'<br>';
        echo 'Наименование товара: '.$product[0]['product_name'].'<br>';
        echo 'Описание товара: '.$product[0]['product_desc'].'<br>';
        echo 'Цена: '.$product[0]['product_price'].' BYN<br><br>';
    }

    /*public function renderProductListByName($product)
    {
        $this->navi();
        echo '
        <form methode="post"> 
            <input type="text" name=text" class="search" placeholder="Search here!">
            <input type="submit" name="submit" class="submit" value="Search">
        </form>';
        echo "<br>Товар с наимениванием: ".$product['product_name']."<br>";
        echo "Артикул товара: ".$product['product_id']."<br>";
        echo "Описание товара: ".$product['product_desc']."<br>";
        echo "Цена: ".$product['product_price']." BYN<br>";
    }*/


    //Admin functions
    public function adminCatalogFunctions(array $categories)
    {
        echo '
        <b>Добавить товар:</b><br>
        <form method="post" name="add_product" action="'.BASEPATH.'addProduct/catalog">
            Наименование: <input type="text" name="prod_name" required><br>
            Описание: <input type="text" name="prod_desc" required><br>
            Цена: <input type="number" min="1" name="prod_price" step="0.01" required><br>
            Категория: <select name="id_new_prod_category" required>';
            foreach ($categories as $category) {
                echo '<option value="'.$category['category_id'].'">'.$category['category_id'].' - '.$category['category_name'].'</option>';
            } 
            echo '</select><br>
            <input type="submit" name="submit_add_product"><br>
        </form><br>
        </form><br>
        <b>Добавить категорию:</b><br>
        <form method="post" name="add_category" action="'.BASEPATH.'addProductCategory/catalog">
            Введите название категории: <input type="text" name="category_name" required><br>
            Введите название категории на английском без пробела и знаков препинания: <input type="text" name="category_eng" required><br>
            <input type="submit" name="submit_add_category"><br>
        </form><br>
        <b>Изменить категорию:</b><br>
        <form method="post" name="update_category" action="'.BASEPATH.'updateProductCategorycatalog">
            Id категории: <select name="update_id_category" required>';
            foreach ($categories as $category) {
                echo '<option value="'.$category['category_id'].'">'.$category['category_id'].' - '.$category['category_name'].'</option>';
            } 
            echo '</select><br>
            Новое название категории: <input type="text" name="new_category" required><br>
            Новое название категории на английском без пробела и знаков препинания: <input type="text" name="new_category_eng" required><br>
            <input type="submit" name="submit_update_category"><br>
        </form><br>
        <b>Удалить категорию:</b><br>
        <form method="post" name="delete_category" action="'.BASEPATH.'deleteProductCategory/catalog">
            Id категории: <select name="id_del_category" required>';
            foreach ($categories as $category) {
                echo '<option value="'.$category['category_id'].'">'.$category['category_id'].' - '.$category['category_name'].'</option>';
            } 
            echo '</select><br>
            <input type="submit" name="submit_delete_category"><br>
        </form><br>';
    }

    public function renderProductsPageAdmin(array $products, array $categories)
    {
        $this->renderProductsPage($products);
        $this->adminCatalogFunctions($categories);
    }
    
    public function renderProductListByCategoryAdmin(string $category_name, array $products, array $categories)
    {
        $this->renderProductListByCategory($category_name, $products);
        $this->adminCatalogFunctions($categories);
    }

    public function renderProductListByIdAdmin(array $product, array $categories)
    {
        $this->renderProductListById($product);
        $this->adminCatalogFunctions($categories);
        echo '
        <b>Изменить данные о товаре:</b><br>
        <form method="post" name="update_product_form" action="'.BASEPATH.'catalog/updateProduct/id'.$product[0]['product_id'].'">
            Новое наименование: <input type="text" name="product_name"><br>
            Новое описание: <input type="text" name="product_desc"><br>
            Новая цена: <input type="number" min="1" name="product_price" step="0.01"><br>
            <input type="submit" name="submit_update_product"><br>
        </form><br>
        <b>Удалить товар:</b><br>
        <form method="post" name="delete_product_form" action="'.BASEPATH.'catalog/deleteProduct/id'.$product[0]['product_id'].'">
            <input type="submit" name="submit_delete_product" value = DELETE><br>
        </form>';
    }

    public function renderProductDeletedPage(string $result, int $product_id)
    {
        $this->navi();
        echo $result.' Товар с id: '.$product_id.' был удален.<br>';
    }
}