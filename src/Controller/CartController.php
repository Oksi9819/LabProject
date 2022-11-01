<?php

namespace Itechart\InternshipProject\Controller;

use Itechart\InternshipProject\View\CartView;
use Itechart\InternshipProject\Controller\BasicController;

class CartController extends BasicController
{
    public $cartView;

    public function __construct()
    {
        $this->cartView = new CartView();
    }

    public function show()
    {
        return $this->cartView->getCartPage();
    }

    /*public function order($user_id, $order_id)
    {
        navi();
        echo 'It is an order '.$order_id.' of client '.$user_id.'.<br>';
    }*/
}