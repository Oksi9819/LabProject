<?php

namespace Itechart\InternshipProject\Model;

use Exception;
use Itechart\InternshipProject\Model\BasicModel;

class UserModel extends BasicModel
{
    public function __construct()
    {
        parent::__construct();
    }

    //CREATE
    public function setUser(array $values): string
    {
        $fields = array('user_surname', 'user_name', 'user_birthday', 'user_phone', 'user_address', 'user_email', 'user_password');
	    $result = setModel("user", $fields, "sssssss", $values); 
        return $result;  
    }

    //READ
    public function getUsers(): array
    {
        $result = getModel("*", "user", NULL, NULL, NULL, NULL, NULL, NULL);
        return $result;
    }

    public function getUserInfo(int $user_id): array
    {
        if (is_int($user_id)) {
            $result = getModel("*", "user", "user_id", $user_id, NULL, NULL, NULL, "i");
            return $result;
        }
    }

    public function auth(string $login, string $pass): array
    {
        $result = getModel("*", "user", "user_email", $login, NULL, NULL, NULL, "s");
        if ($result) {
            if (hash('md5', $pass) == $result[0]['user_password']) {
                return $this->getUserInfo($result[0]['user_id']);
            } else {
                throw new Exception("Incorrect password.");
            }
        } else {
            throw new Exception("You are not registered yet.");
        }
    }

    //UPDATE
    public function updateUser($fields, $user_id, $value, $types):array
    {
        $result = updateModel($fields, "user", "user_id", $user_id, $value, NULL, $types);
        return $result;        
    }

    public function updateUserPasword(int $user_id)
    {
        $result = updateModel($fields, "user", "user_id", $user_id, $value, NULL, $types);
        return $result;                     
    }

    //DELETE
    public function deleteUser(int $user_id)
    {   
        $result = deleteModelItem("user", "user_id", $user_id, NULL, "i");
        return $result;   
    }
}