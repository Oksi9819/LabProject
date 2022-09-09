<?php

class CartController
{
    public function show($user_id)
    {
        navi();
        echo 'It is cart of client with id: '.$user_id.'<br>';
    }

    public function order($user_id, $order_id)
    {
        navi();
        echo 'It is an order '.$order_id.' of client '.$user_id.'.<br>';
    }
}