<?php

namespace Itechart\InternshipProject\Controller;

use Exception;
use Itechart\InternshipProject\View\UserView;
use Itechart\InternshipProject\Model\UserModel;
use Itechart\InternshipProject\Model\OrderModel;
use Itechart\InternshipProject\Model\ReviewModel;
use Itechart\InternshipProject\Controller\BasicController;

class UserController extends BasicController
{
    public $userModel;
    public $userView;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->userView = new UserView();
    }

    public function sendUser()
    {
        return $this->userView->sendUser();
    }

    public function setUser()
    {
        if (isset($_POST['submit_reg_user'])) {
            if (strlen($_POST['user_password']) < 9) {
                $user_surname = (string)$_POST['user_surname'];
                $user_name = (string)$_POST['user_name'];
                $user_birthday = (string)$_POST['user_birthday'];
                $user_phone = (string)$_POST['user_phone'];
                $user_address = (string)$_POST['user_address'];
                $user_email = (string)$_POST['user_email'];
                $user_password = hash('md5', (string)$_POST['user_password']);
                $values = array ($user_surname, $user_name, $user_birthday, $user_phone, $user_address, $user_email, $user_password);
                $result = $this->userModel->setUser($values);
                return $this->userView->setUser($result);
            } else {
                echo "Password length should be not less than 9 characters.";
            }   
        } 
    }

    public function authUser()
    {
        return $this->userView->authUser();
    }

    public function checkUser()
    {
        global $BASEPATH;
        $user_login = trim($_POST['user_email']);
        $user_pass = trim($_POST['user_password']);
        $user = $this->userModel->auth($user_login, $user_pass);
        return header('Location: '.BASEPATH.'profile/'.$user[0]['user_id']);
    }

    public function getUserInfo(int $user_id)
    {
        if ($user_id === '1' || $user_id ==='2') {
            $user = $this->userModel->getUserInfo($user_id);
            return $this->userView->renderAdminPage($user);
        } else {
            $user = $this->userModel->getUserInfo($user_id);
            return $this->userView->renderUserPage($user);
        }
    }

    public function getUserReviews(int $user_id)
    {
        if ($user_id == '1' || $user_id == '2') {
            echo "YOU ARE ADMIN";
            $reviews = (new ReviewModel())->getReviews();
            return $this->userView->renderAdminReviewsPage($reviews);
        } else {
            $reviews = (new ReviewModel())->getReviewsByUserId($user_id);
            return $this->userView->renderUserReviewsPage($reviews, $user_id);
        }
    }

    public function setReview(int $user_id)
    {
        global $BASEPATH;
        if (!empty($_POST['submit_set_review'])) {
            $reviewText = (string)$_POST['reviewText'];
            echo $reviewText."<br>".$user_id;
            $new_review = (new ReviewModel())->setReview($user_id, $reviewText);
            return header('Location: '.BASEPATH.'profile/'.$user_id.'/reviews');
        }
    }

    public function editReviewText(int $user_id)
    {
        global $BASEPATH;
        if (!empty($_POST['submit_update_review_text'])) {
            $review_id = (int)$_POST['id_review'];
            $review_text = (string)$_POST['newReviewText'];
            $updated_review = (new ReviewModel())->updateReview($review_id, $review_text);
            return header('Location: '.BASEPATH.'profile/'.$user_id.'/reviews');
        }
    }

    public function deleteReview(int $user_id)
    {
        global $BASEPATH;
        if (!empty($_POST['submit_delete_review'])) {
            $review_id = (int)$_POST['id_review_delete'];
            $result = (new ReviewModel())->deleteReview($review_id);
            return header('Location: '.BASEPATH.'profile/'.$user_id.'/reviews');
        }
    }

    public function getUserOrders(int $user_id)
    {
        if ($user_id === '1' || $user_id === '2') {
            echo "YOU ARE ADMIN";
            $orders = (new OrderModel())->getOrders();
            $order_details = (new OrderModel())->getOrdersDetails();
            return $this->userView->renderAdminOrdersPage($orders, $order_details);
        } else {
            //echo "YOU ARE NOT ADMIN";
            $orders = (new OrderModel())->getOrdersByUserId($user_id);
            $order_details = (new OrderModel())->getOrderDetails($user_id);
            return $this->userView->renderUserOrdersPage($orders, $order_details, $user_id);
        }
    }

    public function updateUser(int $user_id) {
        $user_id = (int)$user_id;
        $field = array();
        $value = array();
        $types = "";
        if (!empty($_POST['submit_update_user'])) {
            if (!empty($_POST['new_surname'])) {
                $new_surname = (string)$_POST['new_surname'];
                array_push($field, "user_surname");
                array_push($value, $new_surname);
                $types.="s";
            }
            if (!empty($_POST['new_name'])) {
                $new_name = (string)$_POST['new_name'];
                array_push($field, "user_name");
                array_push($value, $new_name);
                $types.="s";
            }
            if (!empty($_POST['new_birthday'])) {
                $new_birthday = (string)$_POST['new_birthday'];
                array_push($field, "user_birthday");
                array_push($value, $new_birthday);
                $types.="s";
            }
            if (!empty($_POST['new_phone'])) {
                $new_phone = (string)$_POST['new_phone'];
                array_push($field, "user_phone");
                array_push($value, $new_phone);
                $types.="s";
            }
            if (!empty($_POST['new_address'])) {
                $new_address = (string)$_POST['new_address'];
                array_push($field, "user_address");
                array_push($value, $new_address);
                $types.="s";
            }
            if (!empty($_POST['new_email'])) {
                $new_email = (string)$_POST['new_email'];
                array_push($field, "user_email");
                array_push($value, $new_email);
                $types.="s";
            }
            if (!empty($value)) {
                $types.="i";
                $fields = implode(", ", $field);
                return $user = $this->userModel->updateUser($fields, $user_id, $value, $types);
            }     
        }   
    }

    public function updateUserPass(int $user_id) {
        $user_id = (int)$user_id;
        $field = array();
        $value = array();
        $types = "";
        if (!empty($_POST['submit_update_pass'])) {
            $user_password = (string)$_POST['user_pass'];
            $user_checkpass = (string)$_POST['user_pass_check'];
            if ($user_password === $user_checkpass) {
                array_push($field, "user_password");
                $user_password = hash('md5', $user_password);
                array_push($value, $user_password);
                $types.="s";
                if (!empty($value)) {
                    $types.="i";
                    $fields = implode(", ", $field);
                    return $user = $this->userModel->updateUser($fields, $user_id, $value, $types);
                }  
            } else {
                throw new Exception("Passwords don't match");
            }
        }    
    }
    
    public function deleteUser(int $user_id)
    {
        if (isset($_POST['submit_delete_user'])) {
            $result=$this->userModel->deleteUser($user_id);
            return $this->userView->renderUserDeletedPage($result, $user_id);
        }
    }
}