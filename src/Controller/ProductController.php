<?php
namespace Itechart\InternshipProject\Controller;

use Itechart\InternshipProject\Controller\BasicController;
use Itechart\InternshipProject\View\ProductView;
use Itechart\InternshipProject\Model\ProductModel;
use Itechart\InternshipProject\Model\CategoryModel;

class ProductController extends BasicController
{
    public $productModel;
    public $productView;

    public function __construct()
    {
        $this->productModel = new ProductModel();
        $this->productView = new ProductView();
    }

    public function getProducts()
    {
        $products = $this->productModel->getProducts("popularity");
        $categories = (new CategoryModel())->getCategories();
        //$blade->run("products.catalog",['products'=>$products,'categories'=>$categories]);
        return $this->productView->renderProductsPage($products, $categories);
    }

    public function getProductsSorted()
    {
        $sort = $_POST['sort_choice'];
        $products = $this->productModel->getProducts($sort);
        $categories = (new CategoryModel())->getCategories();
        return $this->productView->renderProductsPage($products, $categories);
    }

    public function getProductsByCategory($category_name)
    {
        try {
            $products = $this->productModel->getProductsByCategory($category_name, "pricelowhigh");
            $categories = (new CategoryModel())->getCategories();
            return $this->productView->renderProductListByCategory($category_name, $products, $categories); 
        } catch (Exception $e) {
            return $this->productView->errorView($e->getMessage());
        }
    }

    public function getProductsByCategorySorted($category_name)
    {
        if (!empty($_POST['sort_choice'])) {
            $sort = (string)$_POST['sort_choice'];
            try {
                $products = $this->productModel->getProductsByCategory($category_name, $sort);
                $categories = (new CategoryModel())->getCategories();
                return $this->productView->renderProductListByCategory($category_name, $products, $categories);
            } catch (Exception $e) {
                return $this->productView->errorView($e->getMessage());
            }
        } else {
            return header('Location: '.BASEPATH.'profile/'.$user[0]['user_id']);
        }  
    }

    public function getProductById(int $product_id)
    {
        $product=$this->productModel->getProductById($product_id);
        $categories = (new CategoryModel())->getCategories();
        return $this->productView->renderProductListById($product, $categories);
    }

    /*public function getProductByName($product_name)
    {
        $product=(new ProductModel())->getProductByName($product_name);
        return (new ProductView())->renderProductListByName($product);
    }*/

    //Admin functions
    public function addProduct()
    {
        if(!isset($_SESSION['user'])) {
            return $this->productView->errorView("You have no permissions to do this action. Available only for administrators.");
		} else {
            if($_SESSION['user']['role'] === "Admin") {
                global $BASEPATH;
                $values = array();
                if (!empty($_POST['submit_update_product'])) {
                    if (!empty($_POST['prod_name']) && !empty($_POST['prod_desc']) && !empty($_POST['prod_price']) && !empty($_POST['id_new_prod_category'])) {
                        $product_name = (string)$_POST['prod_name'];
                        $product_desc = (string)$_POST['prod_desc'];
                        $product_category = (int)$_POST['id_new_prod_category'];
                        $product_price = (float)$_POST['prod_price'];
                        $product=$this->productModel->setProduct($product_name, $product_desc, $product_category, $product_price);
                        return header('Location: '.BASEPATH.'catalog');
                    }  
                }               
            } else {
                return $this->productView->errorView("You have no permissions to do this action. Available only for administrators.");   
            }
        }
    }

    public function updateProduct(int $product_id)
    {
        if(!isset($_SESSION['user'])) {
            return $this->productView->errorView("You have no permissions to do this action. Available only for administrators.");
		} else {
            if($_SESSION['user']['role'] === "Admin") {
                global $BASEPATH;
                $product_id = (int)$product_id;
                $field = array();
                $value = array();
                $types = "";
                if (!empty($_POST['submit_update_product'])) {
                    if (!empty($_POST['product_name'])) {
                        $product_name = (string)$_POST['product_name'];
                        array_push($field, "product_name");
                        array_push($value, $product_name);
                        $types.="s";
                    }
                    if (!empty($_POST['product_desc'])) {
                        $product_desc = (string)$_POST['product_desc'];
                        array_push($field, "product_desc");
                        array_push($value, $product_desc);
                        $types.="s";
                    }
                    if (!empty($_POST['product_price'])) {
                        $product_price = (float)$_POST['product_price'];
                        array_push($field, "product_price");
                        array_push($value, $product_price);
                        $types.="d";
                    }
                    if (!empty($value)) {
                        $product=$this->productModel->updateProduct($field, $product_id, $value, $types);
                        return header('Location: '.BASEPATH.'catalog/id'.$product_id);
                    }
                }           
            } else {
                return $this->productView->errorView("You have no permissions to do this action. Available only for administrators.");   
            }
        }
    }

    public function deleteProduct(int $product_id)
    {
        if(!isset($_SESSION['user'])) {
            return $this->productView->errorView("You have no permissions to do this action. Available only for administrators.");
		} else {
            if($_SESSION['user']['role'] === "Admin") {
                if (!empty($_POST['submit_delete_product'])) {
                    $result=$this->productModel->deleteProduct($product_id);
                    $categories = (new CategoryModel())->getCategories();
                    return $this->productView->renderProductDeletedPage($result, $product_id, $categories);
                }           
            } else {
                return $this->productView->errorView("You have no permissions to do this action. Available only for administrators.");
            }
        }
    }

    public function addProductCategory() 
    {
        if(!isset($_SESSION['user'])) {
            return $this->productView->errorView("You have no permissions to do this action. Available only for administrators.");
		} else {
            if($_SESSION['user']['role'] === "Admin") {
                global $BASEPATH;
                if (!empty($_POST['submit_add_category'])) {
                        $new_category = trim((string)$_POST['category_name']);
                        $new_category_eng = trim((string)$_POST['category_eng']);
                        $result = (new CategoryModel())->setCategory($new_category, $new_category_eng);
                        return header('Location: '.BASEPATH.'catalog');
                }           
            } else {
                return $this->productView->errorView("You have no permissions to do this action. Available only for administrators.");
            }
        }
    }

    public function updateProductCategory() 
    {
        if(!isset($_SESSION['user'])) {
            return $this->productView->errorView("You have no permissions to do this action. Available only for administrators.");
		} else {
            if($_SESSION['user']['role'] === "Admin") {
                global $BASEPATH;
                if (!empty($_POST['submit_update_category'])) {
                    $category_id = $_POST['update_id_category'];
                    $new_category = trim((string)$_POST['new_category']);
                    $new_category_eng = trim((string)$_POST['new_category_eng']);
                    $result = (new CategoryModel())->updateCategory($category_id, $new_category, $new_category_eng);
                    return header('Location: '.BASEPATH.'catalog');
                }              
            } else {
                return $this->productView->errorView("You have no permissions to do this action. Available only for administrators.");  
            }
        }  
    }

    public function deleteProductCategory()
    {
        if(!isset($_SESSION['user'])) {
            return $this->productView->errorView("You have no permissions to do this action. Available only for administrators.");
		} else {
            if($_SESSION['user']['role'] === "Admin") {
                if (!empty($_POST['submit_delete_category'])) {
                    $category_id = $_POST['id_del_category'];
                    $result = (new CategoryModel())->deleteCategory($category_id);
                    return header('Location: '.BASEPATH.'catalog');
                }               
            } else {
                return $this->productView->errorView("You have no permissions to do this action. Available only for administrators.");  
            }
        }  
    } 
}