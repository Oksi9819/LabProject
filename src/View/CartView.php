<?php

namespace Itechart\InternshipProject\View;

use Itechart\InternshipProject\View\BasicView;
use eftec\bladeone\BladeOne;

class CartView extends BasicView
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getCartPage()
    {
        echo $this->template->run("main.cart", [
            'categories' => $this->categories,
            'SESSION' => $this->session, 
            'BASEPATH' => BASEPATH,
            'year' => $this->year
        ]);
    }

    /*public function order($user_id, $order_id)
    {
        navi();
        echo 'It is an order '.$order_id.' of client '.$user_id.'.<br>';
    }*/
}
