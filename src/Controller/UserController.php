<?php

namespace Itechart\InternshipProject\Controller;

use Itechart\InternshipProject\Controller\BasicController;
use Itechart\InternshipProject\Model\UserModel;
use Itechart\InternshipProject\Model\ReviewModel;
use Itechart\InternshipProject\Model\OrderModel;
use Itechart\InternshipProject\View\UserView;

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
                echo "Password length should be less than 9 characters.";
            }   
        } 
    }

    public function authUser()
    {
       return (new UserView())->authUser();
    }

    public function checkUser()
    {
        $user = (new UserModel())->auth();
        return (new UserView())->renderUserPage($user);
    }

    public function getUserInfo(int $user_id)
    {
        if ($user_id === '111' || $user_id === '112' || $user_id ==='113') {
            $user = (new UserModel())->getUserInfo($user_id);
            return (new UserView())->renderAdminPage($user);
        } else {
            $user = (new UserModel())->getUserInfo($user_id);
            return (new UserView())->renderUserPage($user);
        }
    }

    public function getUserReviews(int $user_id)
    {
        if ($user_id === '111' || $user_id === '112' || $user_id === '113') {
            $reviews = (new ReviewModel())->getReviews();
            return (new UserView())->renderAdminReviewsPage($reviews);
        } else {
            $reviews = (new ReviewModel())->getReviewsByUserId($user_id);
            return (new UserView())->renderUserReviewsPage($reviews);
        }
    }

    public function getUserOrders(int $user_id)
    {
        if ($user_id === '111' || $user_id === '112' || $user_id === '113') {
            $orders = (new OrderModel())->getOrders();
            return (new UserView())->renderAdminOrdersPage($orders);
        } else {
            $orders = (new OrderModel())->getOrdersByUserId($user_id);
            return (new UserView())->renderUserOrdersPage($orders);
        }
    }
}