<?php

namespace Itechart\InternshipProject\View;

class CartView
{
    public function show(int $user_id, array $cartProducts)
    {
        navi();
        echo '<b>Это Корзина клиента с Id: '.$user_id.'</b><br><br>';
        echo '<b>Добавленные товары: </b><br><br>';
        $i=1;
        foreach ($cartProducts as $cartProduct) {
            echo $i.")  ".$cartProduct."<br>";
            $i++;
        }
    }

    /*public function order($user_id, $order_id)
    {
        navi();
        echo 'It is an order '.$order_id.' of client '.$user_id.'.<br>';
    }*/
}
