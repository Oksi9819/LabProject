<?php

namespace Itechart\InternshipProject\Model;

class UserModel
{
    public function setUser(): array
    {
        $registeredUser=array(
            "user_id"=>(int)$_POST['user_password'],
            "user_name"=>(int)$_POST['user_name'],
            "user_surname"=>(string)$_POST['user_surname'],
            "user_birthday"=>(string)$_POST['user_birthday'],
            "user_phone"=>(string)$_POST['user_phone'],
            "user_address"=>(string)$_POST['user_address'],
            "user_email"=>(string)$_POST['user_email'],
            "user_password"=>(string)$_POST['user_password'],
            );
        return $registeredUser;
    }

    /*public function authUser():array
    {
        
        $user
        return $user;
    }*/

    /*public function deleteUser(array $user):void
    {
        unset($user);
    }*/

    public function getUserInfo(int $user_id): array
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