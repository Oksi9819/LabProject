<?php

namespace Itechart\InternshipProject\Model;

/*require_once 'C:\wamp64\www\LabProject\database.php';*/

class UserModel
{
    //CREATE
    public function setUser()
    {
        global $conn;
        $user_surname = (string)$_POST['user_surname'];
        echo $user_surname."<br>";
        $user_name = (string)$_POST['user_name'];
        echo $user_name."<br>";
        $user_birthday = (string)$_POST['user_birthday'];
        $user_phone = (string)$_POST['user_phone'];
        $user_address = (string)$_POST['user_address'];
        $user_email = (string)$_POST['user_email'];
        $user_password = hash('md5', (string)$_POST['user_password']);
        if (isset($_POST['submit'])) {
            if (strlen($_POST['user_password']) < 9) {
                $sql = ("INSERT INTO `user`(`user_surname`, `user_name`, `user_birthday`, `user_phone`, `user_address`, `user_email`, `user_password`) VALUES(?,?,?,?,?,?,?)");
                $query = $conn->prepare($sql);
                $query->bind_param('sssssss', $user_surname, $user_name, $user_birthday, $user_phone, $user_address, $user_email, $user_password);
	            $query->execute();
            } else {
                echo "Password length should be less than 9 characters.";
            }        
        } 
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
            $user = array(
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