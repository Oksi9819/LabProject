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
        return $this->productView->renderProductsPage($this->productModel->getProducts("popularity"));
    }

    public function getProductsSorted()
    {
        $sort = htmlspecialchars($_POST['sort_choice'], ENT_QUOTES);
        return $this->productView->renderProductsPage($this->productModel->getProducts($sort));
    }

    public function getProductsByCategory($category_name)
    {
        try {
            $products = $this->productModel->getProductsByCategory($category_name, "pricelowhigh");
            return $this->productView->renderProductListByCategory($category_name, $products); 
        } catch (Exception $e) {
            return $this->productView->errorView($e->getMessage());
        }
    }

    public function getProductsByCategorySorted($category_name)
    {
        if (!empty($_POST['sort_choice'])) {
            $sort = htmlspecialchars($_POST['sort_choice'], ENT_QUOTES);
            try {
                $products = $this->productModel->getProductsByCategory($category_name, $sort);
                return $this->productView->renderProductListByCategory($category_name, $products);
            } catch (Exception $e) {
                return $this->productView->errorView($e->getMessage());
            }
        } else {
            return header('Location: ' . BASEPATH . 'profile/' . $user[0]['user_id']);
        }  
    }

    public function getProductById(int $product_id)
    {
        return $this->productView->renderProductListById($this->productModel->getProductById($product_id));
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
            return $this->productView->errorView("You have no permissions to do this action. Available only for administrators. ");
		} else {
            if($_SESSION['user']['role'] === "Admin") {
                if (!empty($_POST['submit_update_product'])) {
                    if (!empty($_POST['prod_name']) && !empty($_POST['prod_desc']) && !empty($_POST['prod_price']) && !empty($_POST['id_new_prod_category'])) {
                        $product_name = htmlspecialchars($_POST['prod_name'], ENT_QUOTES);
                        $product_desc = htmlspecialchars($_POST['prod_desc'], ENT_QUOTES);
                        $product_category = (int)(htmlspecialchars($_POST['id_new_prod_category'], ENT_QUOTES));
                        $product_price = (float)(htmlspecialchars($_POST['prod_price'], ENT_QUOTES));
                        $result=$this->productModel->setProduct($product_name, $product_desc, $product_category, $product_price);
                        if (empty($result))
                        {
                            return header('Location: ' . BASEPATH . 'catalog');
                        } else {
                            $_SESSION['response'] = [
                                'new_product '=> $product_name,
                            ];
                            return header('Location: ' . BASEPATH . 'catalog');
                        }                        
                    }  
                } return header('Location: ' . BASEPATH . 'catalog');               
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
                $product_id = (int)$product_id;
                $field = array();
                $value = array();
                $types = "";
                if (!empty($_POST['submit_update_product'])) {
                    if (!empty($_POST['product_name'])) {
                        $product_name = htmlspecialchars($_POST['product_name'], ENT_QUOTES);
                        array_push($field, "product_name");
                        array_push($value, $product_name);
                        $types .= "s";
                    }
                    if (!empty($_POST['product_desc'])) {
                        $product_desc = htmlspecialchars($_POST['product_desc'], ENT_QUOTES);
                        array_push($field, "product_desc");
                        array_push($value, $product_desc);
                        $types .= "s";
                    }
                    if (!empty($_POST['product_price'])) {
                        $product_price = (float)(htmlspecialchars($_POST['product_price'], ENT_QUOTES));
                        array_push($field, "product_price");
                        array_push($value, $product_price);
                        $types .= "d";
                    }
                    if (!empty($value)) {
                        $this->productModel->updateProduct($field, $product_id, $value, $types);
                        $_SESSION['response'] = array (
                            'updated_product' => $product_id,
                        );
                        return header('Location: ' . BASEPATH . 'catalog/id' . $product_id);
                    }
                } return header('Location: ' . BASEPATH . 'catalog/id' . $product_id);           
            } else {
                return $this->productView->errorView("You have no permissions to do this action. Available only for administrators. ");   
            }
        }
    }

    public function deleteProduct(int $product_id)
    {
        if(!isset($_SESSION['user'])) {
            return $this->productView->errorView("You have no permissions to do this action. Available only for administrators. ");
		} else {
            if($_SESSION['user']['role'] === "Admin") {
                if (!empty($_POST['submit_delete_product'])) {
                    $this->productModel->deleteProduct($product_id);
                    $_SESSION['response'] = [
                        'deleted_product' => $product_name,
                    ];
                    return header('Location: ' . BASEPATH . 'catalog');
                }           
            } else {
                return $this->productView->errorView("You have no permissions to do this action. Available only for administrators. ");
            }
        }
    }

    public function addProductCategory() 
    {
        if(!isset($_SESSION['user'])) {
            return $this->productView->errorView("You have no permissions to do this action. Available only for administrators. ");
		} else {
            if($_SESSION['user']['role'] === "Admin") {
                if (!empty($_POST['submit_add_category'])) {
                        $new_category = trim(htmlspecialchars($_POST['category_name'], ENT_QUOTES));
                        $new_category_eng = trim(htmlspecialchars($_POST['category_eng'], ENT_QUOTES));
                        $result = (new CategoryModel())->setCategory($new_category, $new_category_eng);
                        $_SESSION['response'] = [
                            'new_category' => $new_category,
                        ];
                        return header('Location: ' . BASEPATH . 'catalog');
                } return header('Location: ' . BASEPATH . 'catalog');          
            } else {
                return $this->productView->errorView("You have no permissions to do this action. Available only for administrators. ");
            }
        }
    }

    public function updateProductCategory() 
    {
        if(!isset($_SESSION['user'])) {
            return $this->productView->errorView("You have no permissions to do this action . Available only for administrators . ");
		} else {
            if($_SESSION['user']['role'] === "Admin") {
                if (!empty($_POST['submit_update_category'])) {
                    $category_id = $_POST['update_id_category'];
                    $new_category = trim(htmlspecialchars($_POST['new_category'], ENT_QUOTES));
                    $new_category_eng = trim(htmlspecialchars($_POST['new_category_eng'], ENT_QUOTES));
                    (new CategoryModel())->updateCategory($category_id, $new_category, $new_category_eng);
                    $_SESSION['response'] = [
                        'updated_category' => $category_id,
                    ];
                    return header('Location: ' . BASEPATH . 'catalog');
                } return header('Location: ' . BASEPATH . 'catalog');               
            } else {
                return $this->productView->errorView("You have no permissions to do this action. Available only for administrators. ");  
            }
        }  
    }

    public function deleteProductCategory()
    {
        if(!isset($_SESSION['user'])) {
            return $this->productView->errorView("You have no permissions to do this action. Available only for administrators. ");
		} else {
            if($_SESSION['user']['role'] === "Admin") {
                if (!empty($_POST['submit_delete_category'])) {
                    $category_id = htmlspecialchars($_POST['id_del_category'], ENT_QUOTES);
                    (new CategoryModel())->deleteCategory($category_id);
                    $_SESSION['response'] = [
                        'deleted_category' => $category_id,
                    ];
                    return header('Location: ' . BASEPATH . 'catalog');
                } return header('Location: ' . BASEPATH . 'catalog');               
            } else {
                return $this->productView->errorView("You have no permissions to do this action. Available only for administrators. ");  
            }
        }  
    } 
}