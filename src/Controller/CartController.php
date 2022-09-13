<?php

namespace Itechart\InternshipProject\Controller;

use Itechart\InternshipProject\View\CartView;
use Itechart\InternshipProject\Model\CartModel;

class CartController
{
    public function show($user_id)
    {
        return (new CartView())->show($user_id, (new CartModel())->showCart($user_id));
    }

    /*public function order($user_id, $order_id)
    {
        navi();
        echo 'It is an order '.$order_id.' of client '.$user_id.'.<br>';
    }*/
}