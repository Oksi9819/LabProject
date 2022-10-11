<?php

namespace Itechart\InternshipProject\View;

use Itechart\InternshipProject\View\BasicView;
use eftec\bladeone\BladeOne;

class UserView extends BasicView
{
    public function __construct()
    {
        parent::__construct();
    }

    public function sendUser()
    {
        $title = "registration"; 
        echo $this->template->run("user.registration", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title]);
    }

    public function authUser()
    {
        $title = "authorization"; 
        echo $this->template->run("user.auth", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title]);
    }

    public function renderUserPage(array $user)
    {
        $title = "user profile"; 
        echo $this->template->run("user.user_profile", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title, 'user'=>$user[0]]);
    }

    public function renderUserDeletedPage(int $user_id)
    {
        $title = "main"; 
        if(isset($_SESSION['response'])) {
            echo $this->template->run("main.main", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title,'response'=>$_SESSION['response']]);
        } else {
            echo $this->template->run("main.main", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title]);
        }
    }

    public function renderUserReviewsPage(array $reviews)
    {
        $title = "user reviews"; 
        echo $this->template->run("user.user_reviews", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title, 'reviews'=>$reviews]);   
    }

    public function renderUserOrdersPage(array $orders, array $order_details)
    {
        $title = "user orders"; 
        if(!empty($_SESSION['response'])) {
            echo $this->template->run("user.user_orders", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title, 'orders'=>$orders, 'order_details'=>$order_details, 'response'=>$_SESSION['response']]);
        } else {
            echo $this->template->run("user.user_orders", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title, 'orders'=>$orders, 'order_details'=>$order_details]);
        }
    }

    public function renderAdminPage(array $user)
    {
        $title = "admin profile"; 
        echo $this->template->run("user.admin_profile", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title, 'user'=>$user[0]]);
    }

    public function renderAdminReviewsPage(array $reviews)
    {
        $title = "admin reviews"; 
        echo $this->template->run("user.admin_reviews", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title, 'reviews'=>$reviews]);
    }

    public function renderAdminOrdersPage(array $orders, array $order_details, array $order_statuses)
    {
        $title = "user orders"; 
        if(!empty($_SESSION['response'])) {
            echo $this->template->run("user.admin_orders", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title, 'orders'=>$orders, 'order_details'=>$order_details, 'order_statuses'=>$order_statuses, 'response'=>$_SESSION['response']]);
        } else {
            echo $this->template->run("user.admin_orders", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title, 'orders'=>$orders, 'order_details'=>$order_details, 'order_statuses'=>$order_statuses]);
        }
    }

    public function renderAdminUsersPage(array $users)
    {
        $title = "admin users"; 
        echo $this->template->run("user.admin_allusers", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title, 'users'=>$users]);
    }
}