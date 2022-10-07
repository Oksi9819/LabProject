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
        if(isset($_SESSION['response'])) {
            echo $this->template->run("products.catalog", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title, 'products'=>$products, 'response'=>$_SESSION['response']]);
        } else {
            echo $this->template->run("products.catalog", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title, 'products'=>$products]);
        }
    }
    
    public function renderProductListByCategory(string $category_name, array $products)
    {
        $title = "catalog"; 
        echo $this->template->run("products.catalog", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title, 'category_name'=>$category_name, 'products'=>$products]);
    }

    public function renderProductListById(array $product)
    {
        $title = "product_card"; 
        if(isset($_SESSION['response'])) {
            echo $this->template->run("products.card", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title, 'product'=>$product[0], 'response'=>$_SESSION['response']]);
        } else {
            echo $this->template->run("products.card", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title, 'product'=>$product[0]]);
        }
        
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