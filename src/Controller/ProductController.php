<?php
namespace Itechart\InternshipProject\Controller;

use Exception;
use Itechart\InternshipProject\View\ProductView;
use Itechart\InternshipProject\Model\ProductModel;
use Itechart\InternshipProject\Model\CategoryModel;
use Itechart\InternshipProject\Controller\BasicController;

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
            echo json_encode(array(
                'result' => 'Error',
                'msg' => 'You have no permissions to do this action. Available only for administrators.'
            ));
            return;
		} else {
            if($_SESSION['user']['role'] === "Admin") {
                    if (!empty($_POST['prod_name']) && !empty($_POST['prod_desc']) && !empty($_POST['prod_price']) && !empty($_POST['id_new_prod_category'])) {
                        $product_name = htmlspecialchars($_POST['prod_name'], ENT_QUOTES);
                        $product_desc = htmlspecialchars($_POST['prod_desc'], ENT_QUOTES);
                        $product_category = (int)(htmlspecialchars($_POST['id_new_prod_category'], ENT_QUOTES));
                        $product_price = (float)(htmlspecialchars($_POST['prod_price'], ENT_QUOTES));
                        try {
                            $result = $this->productModel->setProduct($product_name, $product_desc, $product_category, $product_price);
                            if (!empty($result)) {
                                $products = $this->productModel->getProducts();
                                echo json_encode(array(
                                    'result' => 'Success',
                                    'msg' => 'Was added new product to catalog',
                                    'product' => $products[count($products) - 1]
                                ));
                            } else {
                                echo json_encode(array(
                                    'result' => 'Error',
                                    'msg' => 'Fail to add new product. Please, try again.'
                                ));
                            }
                        } catch (Exception $ex) {
                            echo json_encode(array(
                                'result' => 'Error',
                                'msg' => ($ex->getMessage()),
                            ));
                        }
                        return;                        
                    } else {
                        echo json_encode(array(
                            'result' => 'Error',
                            'msg' => 'All fields should be fullfilled.'
                        ));
                        return;
                    }
            } else {
                echo json_encode(array(
                    'result' => 'Error',
                    'msg' => 'You have no permissions to do this action. Available only for administrators.'
                ));
                return;
            }
        }
    }

    public function updateProduct(int $product_id)
    {
        if(!isset($_SESSION['user'])) {
            echo json_encode(array(
                'result' => 'Error',
                'msg' => 'You have no permissions to do this action. Available only for administrators.'
            ));
            return; 
		} else {
            if($_SESSION['user']['role'] === "Admin") {
                $product_id = (int)$product_id;
                $field = array();
                $value = array();
                $output = array();
                $types = "";
                    if (!empty($_POST['product_name'])) {
                        $product_name = htmlspecialchars($_POST['product_name'], ENT_QUOTES);
                        array_push($field, "product_name");
                        array_push($value, $product_name);
                        $types .= "s";
                        array_push($output, 0); 
                    }
                    if (!empty($_POST['product_desc'])) {
                        $product_desc = htmlspecialchars($_POST['product_desc'], ENT_QUOTES);
                        array_push($field, "product_desc");
                        array_push($value, $product_desc);
                        $types .= "s";
                        array_push($output, 1); 
                    }
                    if (!empty($_POST['product_price'])) {
                        $product_price = (float)(htmlspecialchars($_POST['product_price'], ENT_QUOTES));
                        array_push($field, "product_price");
                        array_push($value, $product_price);
                        $types .= "d";
                        array_push($output, 2); 
                    }
                    if (!empty($value)) {
                        $this->productModel->updateProduct($field, $product_id, $value, $types);
                        echo json_encode(array(
                            'result' => 'Success',
                            'msg' => 'Information was edited.',
                            'product' => $product_id,
                            'fields' => $output,
                            'values' => $value,
                        ));
                        return; 
                    }        
            } else {
                echo json_encode(array(
                    'result' => 'Error',
                    'msg' => 'You have no permissions to do this action. Available only for administrators.'
                ));
                return;
            }
        }
    }

    public function deleteProduct(int $product_id)
    {
        if(!isset($_SESSION['user'])) {
            echo json_encode(array(
                'result' => 'Error',
                'msg' => 'You have no permissions to do this action. Available only for administrators.'
            ));
            return;
		} else {
            if($_SESSION['user']['role'] === "Admin") {
                if (!empty($_POST['submit_delete_product'])) {
                    $this->productModel->deleteProduct($product_id);
                    echo json_encode(array(
                        'result' => 'Success',
                        'msg' => 'Product was deleted.'
                    ));
                    return;
                }           
            } else {
                echo json_encode(array(
                    'result' => 'Error',
                    'msg' => 'You have no permissions to do this action. Available only for administrators.'
                ));
                return;
            }
        }
    }

    public function addProductCategory() 
    {
        if(!isset($_SESSION['user'])) {
            echo json_encode(array(
                'result' => 'Error',
                'msg' => 'You\'re not authorized.'
            ));
            return;
		}
        if($_SESSION['user']['role'] !== "Admin") {
            echo json_encode(array(
                'result' => 'Error',
                'msg' => 'You have no permissions to do this action. Available only for administrators.'
            ));
            return;
        }
        if (empty($_POST['category_name']) || empty($_POST['category_eng'])) {
            echo json_encode(array(
                'result' => 'Error',
                'msg' => 'Fields should be fullfilled.'
            ));
            return;
        }
        $new_category = trim(htmlspecialchars($_POST['category_name'], ENT_QUOTES));
        $new_category_eng = trim(htmlspecialchars($_POST['category_eng'], ENT_QUOTES));
        try {
            (new CategoryModel())->setCategory($new_category, $new_category_eng);
            $result = (new CategoryModel())->getCategoryByName($new_category_eng);
            echo json_encode(array(
                'result' => 'Success',
                'msg' => 'New category was added to catalog.',
                'category_name' => $new_category,
                'category_id' => $result[0]['category_id'],
            ));
        } catch (Exception $e) {
            echo json_encode(array(
                'result' => 'Error',
                'msg' => ($e->getMessage()),
            ));
        }
        return;
    }

    public function updateProductCategory() 
    {
        if(!isset($_SESSION['user'])) {
            echo json_encode(array(
                'result' => 'Error',
                'msg' => 'You\'re not authorized.'
            ));
            return;
		}
        if($_SESSION['user']['role'] !== "Admin") {
            echo json_encode(array(
                'result' => 'Error',
                'msg' => 'You have no permissions to do this action. Available only for administrators.'
            ));
            return;
        }
        if (empty($_POST['category_name']) || empty($_POST['category_eng'])) {
            echo json_encode(array(
                'result' => 'Error',
                'msg' => 'Fields should be fullfilled.'
            ));
            return;
        }
        $category_id = $_POST['update_id_category'];
        $new_category = trim(htmlspecialchars($_POST['new_category'], ENT_QUOTES));
        $new_category_eng = trim(htmlspecialchars($_POST['new_category_eng'], ENT_QUOTES));
        try {
            (new CategoryModel())->updateCategory($category_id, $new_category, $new_category_eng);
            echo json_encode(array(
                'result' => 'Success',
                'msg' => 'Category was successfully updated.',
                'category_id' => $category_id,
                'category_name' => $new_category,
            ));
        } catch (Exception $e) {
            echo json_encode(array(
                'result' => 'Error',
                'msg' => ($e->getMessage()),
            ));
        }
        return;
    }

    public function deleteProductCategory()
    {
        if(!isset($_SESSION['user'])) {
            echo json_encode(array(
                'result' => 'Error',
                'msg' => 'You have no permissions to do this action. Available only for administrators.'
            ));
            return;
		} else {
            if($_SESSION['user']['role'] === "Admin") {
                    $category_id = htmlspecialchars($_POST['id_del_category'], ENT_QUOTES);
                    (new CategoryModel())->deleteCategory($category_id);
                    echo json_encode(array(
                        'result' => 'Success',
                        'msg' => 'Category was deleted.',
                        'category_id' => $category_id,
                    ));
                    return;              
            } else {
                echo json_encode(array(
                    'result' => 'Error',
                    'msg' => 'You have no permissions to do this action. Available only for administrators.'
                ));
                return;
            }
        }  
    } 
}