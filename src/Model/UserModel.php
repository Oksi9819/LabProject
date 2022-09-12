<?php

namespace Itechart\InternshipProject\Model;

class UserModel
{
    public function getUserInfo($user_id):array
    {
        $user=array(
            "user_id"=>111222,
            "user_name"=>"Смирнов",
            "user_surname"=>"Петр",
            "user_birthday"=>"01/01/1998",
            "user_phone"=>"+375 (29) 111-11-11",
            "user_address"=>"г. Минск, пр-т Независимости, 116",
            "user_email"=>"testclient@gmail.com",
            );
        return $user;
    }

/*    public function getUserOrders($user_id)
    {
        echo "Заказы пользователя id".$user_id.":<br>";

    }*/
}