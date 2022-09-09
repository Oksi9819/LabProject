<?php

class CatalogController
{
    public function execute()
    {
        navi();
        echo 'It is catalog here';
    }

    public function getCategory($category_id)
    {
        navi();
        echo 'There are products of category:'.$category_id.'<br>';
    }

    public function getProductByCategoryAndId($category_id, $product_id)
    {
        navi();
        echo 'It is a card of product: '.$product_id.'<br>';
    }
}