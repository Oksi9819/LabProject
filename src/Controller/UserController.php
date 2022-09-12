<?php

namespace Itechart\InternshipProject\Controller;

use Itechart\InternshipProject\Model\UserModel;
use Itechart\InternshipProject\View\UserView;

class UserController
{
    public function getUserInfo($user_id)
    {
        $user=(new UserModel())->getUserInfo($user_id);
        return (new UserView())->renderUserPage($user);
    }

    /*public function getUserOrders($user_id)
    {

    }*/
}