<?php
namespace Itechart\InternshipProject\Model;

class ProductModel
{
    public function getProducts():array
    {
        $products=array("Робот-пылесос моющий Xiaomi Mi Robot Vacuum Mop 2 Ultra", "Электрический чайник Xiaomi Water Kettle 1.5L", "Увлажнитель воздуха Deerma Air Humidifier DEM F628S", "Мультифункциональный пароочиститель Deerma Steam Cleaner DEM-ZQ610");
        return $products;
    }

    public function getProductsByCategory($category_id):array
    {
        $productsByCategory=array("Робот-пылесос моющий Xiaomi Mi Robot Vacuum Mop 2 Ultra", "Робот-пылесос моющий Dreame D9 Max Robot Vacuum Cleaner", "Робот-пылесос моющий Dreame Bot Z10 Pro", "Робот-пылесос моющий Trouver Finder Vacuum Mop LDS RLS3");
        return $productsByCategory;
    }

    public function getProductById($category_id, $product_id):array
    {
        $productById=array(
            "product_id"=>111222,
            "product_name"=>"Робот-пылесос моющий Xiaomi Mi Robot Vacuum Mop 2 Ultra",
            "product_desc"=>"Робот-пылесос оснащен передовой технологией лазерной навигации LDS, обеспечивающей максимально точное сканирование помещения.",
            "product_price"=>900,
            );
        return $productById;
    }

    public function getProductByName($product_name):array
    {
        $productByName=array(
        "product_id"=>111222,
        "product_name"=>"Робот-пылесос моющий Xiaomi Mi Robot Vacuum Mop 2 Ultra",
        "product_desc"=>"Робот-пылесос оснащен передовой технологией лазерной навигации LDS, обеспечивающей максимально точное сканирование помещения.",
        "product_price"=>900,
        );
        return $productByName;
    }
}