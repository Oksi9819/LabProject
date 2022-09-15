<?php

namespace Itechart\InternshipProject\Controller;

use Itechart\InternshipProject\Model\UserModel;
use Itechart\InternshipProject\Model\ReviewModel;
use Itechart\InternshipProject\Model\OrderModel;
use Itechart\InternshipProject\View\UserView;

class UserController
{
    public function sendUser()
    {
        return (new UserView())->sendUser();
    }

    public function setUser()
    {
        $registeredUser = (new UserModel())->setUser();
        /*$registeredUsers=array();
        $registeredUsers+=$registeredUser;*/
        return (new UserView())->setUser($registeredUser);
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