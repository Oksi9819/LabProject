<?php

namespace Itechart\InternshipProject\View;

use Itechart\InternshipProject\View\BasicView;
use eftec\bladeone\BladeOne;

class UserView extends BasicView
{
    private $title;

    public function __construct()
    {
        parent::__construct();
    }

    public function sendUser()
    {
        $this->title = "registration"; 
        echo $this->template->run("user.registration", [
            'categories' => $this->categories,
            'SESSION' => $this->session, 
            'BASEPATH' => BASEPATH, 
            'title' => $this->title,
            'year' => $this->year
        ]);
    }

    public function authUser()
    {
        $this->title = "authorization"; 
        echo $this->template->run("user.auth", [
            'categories' => $this->categories,
            'SESSION' => $this->session, 
            'BASEPATH' => BASEPATH,
            'title' => $this->title,
            'year' => $this->year
        ]);
    }

    public function renderUserPage(array $user)
    {
        $this->title = "user profile"; 
        echo $this->template->run("user.user_profile", [
            'categories' => $this->categories,
            'SESSION' => $this->session, 
            'BASEPATH' => BASEPATH, 
            'title' => $this->title, 
            'user' => $user[0],
            'year' => $this->year
        ]);
    }

    public function renderUserDeletedPage(int $user_id)
    {
        $this->title = "main"; 
        echo $this->template->run("main.main", [
            'categories'=>$this->categories,
            'SESSION'=>$this->session, 
            'BASEPATH'=>BASEPATH, 
            'title'=>$this->title,
            'year' => $this->year,
            'response'=> isset($_SESSION['response']) ? $_SESSION['response'] : NULL
        ]);
    }

    public function renderUserReviewsPage(array $reviews)
    {
        $this->title = "user reviews"; 
        echo $this->template->run("user.user_reviews", [
            'categories' => $this->categories,
            'SESSION' => $this->session, 
            'BASEPATH' => BASEPATH, 
            'title' => $this->title, 
            'reviews' => $reviews,
            'year' => $this->year
        ]);   
    }

    public function renderUserOrdersPage(array $orders, array $order_details)
    {
        $this->title = "user orders"; 
        echo $this->template->run("user.user_orders", [
            'categories' => $this->categories,
            'SESSION' => $this->session, 
            'BASEPATH' => BASEPATH, 
            'title' => $this->title, 
            'orders' => $orders, 
            'order_details' => $order_details, 
            'year' => $this->year,
            'response' => isset($_SESSION['response']) ? $_SESSION['response'] : NULL
        ]);
    }

    public function renderAdminPage(array $user)
    {
        $this->title = "admin profile"; 
        echo $this->template->run("user.admin_profile", [
            'categories' => $this->categories,
            'SESSION' => $this->session, 
            'BASEPATH' => BASEPATH, 
            'title' => $this->title, 
            'user' => $user[0],
            'year' => $this->year
        ]);
    }

    public function renderAdminReviewsPage(array $reviews)
    {
        $this->title = "admin reviews"; 
        echo $this->template->run("user.admin_reviews", [
            'categories' => $this->categories,
            'SESSION' => $this->session, 
            'BASEPATH' => BASEPATH, 
            'title' => $this->title, 
            'reviews' => $reviews,
            'year' => $this->year
        ]);
    }

    public function renderAdminOrdersPage(array $orders, array $order_details, array $order_statuses)
    {
        $this->title = "user orders"; 
        echo $this->template->run("user.admin_orders", [
            'categories' => $this->categories,
            'SESSION' => $this->session, 
            'BASEPATH' => BASEPATH, 
            'title' => $this->title, 
            'orders' => $orders, 
            'order_details' => $order_details, 
            'order_statuses' => $order_statuses, 
            'year' => $this->year,
            'response' => isset($_SESSION['response']) ? $_SESSION['response'] : NULL
        ]);
    }

    public function renderAdminUsersPage(array $users)
    {
        $this->title = "admin users"; 
        echo $this->template->run("user.admin_allusers", [
            'categories' => $this->categories,
            'SESSION' => $this->session, 
            'BASEPATH' => BASEPATH, 
            'title' => $this->title, 
            'users' => $users,
            'year' => $this->year
        ]);
    }
}