<?php
namespace Itechart\InternshipProject\View;

use Itechart\InternshipProject\View\BasicView;
use eftec\bladeone\BladeOne;

class ProductView extends BasicView
{
    public function __construct()
    {
        parent::__construct();
    }

    //User functions
    public function renderProductsPage(array $products)
    {
        $title = "catalog"; 
        echo $this->template->run("products.catalog", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title, 'products'=>$products]);
    }
    
    public function renderProductListByCategory(string $category_name, array $products)
    {
        $title = "catalog"; 
        echo $this->template->run("products.catalog", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title, 'category_name'=>$category_name, 'products'=>$products]);
    }

    public function renderProductListById(array $product)
    {
        $title = "product_card"; 
        echo $this->template->run("products.card", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title, 'product'=>$product[0]]);
    }

    public function renderProductAddedPage(string $new_prod_name)
    {
        $title = "catalog"; 
        echo $this->template->run("products.catalog", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title, 'products'=>$products, 'response["new_product"]'=>$new_prod_name]);
    }

    public function renderProductUpdatedPage(int $product_id, array $product)
    {
        $title = "product_card"; 
        echo $this->template->run("products.card", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title, 'product'=>$product[0], 'response["updated_product"]'=>$product_id]);
    }

    public function renderProductDeletedPage(int $product_id)
    {
        $title = "catalog"; 
        echo $this->template->run("products.catalog", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title, 'products'=>$products, 'response["deleted_product"]'=>$product_id]);
    }

    public function renderCategoryAddedPage(string $new_category_name)
    {
        $title = "catalog"; 
        echo $this->template->run("products.catalog", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title, 'products'=>$products, 'response["new_category"]'=>$new_category_name]);
    }

    public function renderCategoryUpdatedPage(int $category_id)
    {
        $title = "product_card"; 
        echo $this->template->run("products.catalog", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title, 'products'=>$products, 'response["updated_category"]'=>$category_id]);
    }

    public function renderCategoryDeletedPage(int $category_id)
    {
        $title = "product_card"; 
        echo $this->template->run("products.catalog", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title, 'products'=>$products, 'response["deleted_category"]'=>$category_id]);  
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
}