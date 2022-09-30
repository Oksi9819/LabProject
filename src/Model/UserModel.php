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
    public function setUser(string $user_surname, string $user_name, string $user_birthday, string $user_phone, string $user_address, string $user_email, string $user_password): string
    {
        $fields = array('user_surname', 'user_name', 'user_birthday', 'user_phone', 'user_address', 'user_email', 'user_password', 'created_at');
        $created_at = date("Y-m-d h:i:s");
        $values = array($user_surname, $user_name, $user_birthday, $user_phone, $user_address, $user_email, $user_password, $created_at);
	    $result = $this->setModel("user", $fields, "ssssssss", $values); 
        return $result;  
    }

    public function setAdmin(array $values): string
    {
        $fields = array('user_surname', 'user_name', 'user_birthday', 'user_phone', 'user_address', 'user_email', 'user_password', 'user_role');
	    $result = $this->setModel("user", $fields, "sssssssi", $values); 
        return $result;  
    }

    //READ
    public function getUsers(): array
    {
        $result = $this->getModel("*", "user", NULL, NULL, NULL, NULL, NULL, NULL);
        return $result;
    }

    public function getUserInfo(int $user_id): array
    {
        if (is_int($user_id)) {
            $result = $this->getModel("*", "user", "user_id", $user_id, NULL, NULL, NULL, "i");
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
    public function updateUser(array $fields, int $user_id, array $value, $types):array
    {
        $updated_at = date("Y-m-d h:i:s");
        array_push($fields, 'updated_at');
        array_push($value, $updated_at);
        $field = implode(", ", $fields);
        $types.="si";
        $result = $this->updateModel($field, "user", "user_id", $user_id, $value, NULL, $types);
        return $result;        
    }

    //DELETE
    public function deleteUser(int $user_id)
    {   
        $result = $this->deleteModelItem("user", "user_id", $user_id, NULL, "i");
        return $result;   
    }
}