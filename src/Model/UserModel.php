<?php

namespace Itechart\InternshipProject\Model;

class UserModel
{
    public function setUser(int $user_id, string $user_name, string $user_surname, string $user_birthday, string $user_phone, string $user_address, string $user_email):array
    {
        $user=array(
            "user_id"=>$user_id,
            "user_name"=>$user_name,
            "user_surname"=>$user_surname,
            "user_birthday"=>$user_birthday,
            "user_phone"=>$user_phone,
            "user_address"=>$user_address,
            "user_email"=>$user_email,
            );
        return $user;
    }

    /*public function deleteUser(array $user):void
    {
        unset($user);
    }*/

    public function getUserInfo(int $user_id):array
    {
            $user=array(
            "user_id"=>$user_id,
            "user_name"=>"Смирнов",
            "user_surname"=>"Петр",
            "user_birthday"=>"01/01/1998",
            "user_phone"=>"+375 (29) 111-11-11",
            "user_address"=>"г. Минск, пр-т Независимости, 116",
            "user_email"=>"testclient@gmail.com",
            );
            return $user;
    }
}