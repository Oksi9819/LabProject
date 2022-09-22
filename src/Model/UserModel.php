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
	    $result = parent::setModel("user", $fields, "sssssss", $values); 
        return $result;  
    }

    //READ
    public function getUsers(): array
    {
        global $conn;
        $sql = "SELECT * FROM `user`";
        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->get_result();
        $result = $result->fetch_assoc(); 
        return $result;
    }

    public function getUserInfo(int $user_id): array
    {
        if (is_int($user_id)) {
            $result = parent::getModel("*", "user", "user_id", $user_id, NULL, NULL, NULL, "i");
            return $result;
        }
    }

    public function auth(string $login, string $pass): array
    {
        $result = parent::getModel("*", "user", "user_email", $login, NULL, NULL, NULL, "s");
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
    public function updateUser(int $user_id):array
    {
        global $conn;
        if (is_int($user_id)) {
            $user_surname = (string)$_POST['new_surname'];
            $user_name = (string)$_POST['new_name'];
            $user_birthday = (string)$_POST['new_birthday'];
            $user_phone = (string)$_POST['new_phone'];
            $user_address = (string)$_POST['new_address'];
            $user_email = (string)$_POST['new_email'];
            if (isset($_POST['updateinfo_submit'])) {
                $sql = "UPDATE `user` SET `user_surname` = ?, `user_name` = ?, `user_birthday` = ?, `user_phone` = ?, `user_address` = ?, `user_email` = ? WHERE `user_id` = ?";
                $query = $conn->prepare($sql);
                $query->bind_param('ssssssi', $user_surname, $user_name, $user_birthday, $user_phone, $user_address, $user_email, $user_id);
	            $query->execute();
                $result = $query->get_result();
                $result = $result->fetch_assoc(); 
                return $result;
            }         
        }
    }

    public function updateUserPasword(int $user_id):array
    {
        global $conn;
        if (is_int($user_id)) {
            $user_password = (string)$_POST['new_password'];
            $user_checkpass = (string)$_POST['new_checkpass'];
            if (isset($_POST['updatepass_submit'])) {
                if ($user_password === $user_checkpass) {
                    $sql = "UPDATE `user` SET `user_password` = ? WHERE `user_id` = ?";
                    $query = $conn->prepare($sql);
                    $query->bind_param('si', $user_password, $user_id);
	                $query->execute();
                    $result = $query->get_result();
                    $result = $result->fetch_assoc(); 
                    return $result;
                } else {
                    echo "Passwords don't match.<br>";
                }
            }         
        }
    }

    //DELETE
    public function deleteUser()
    {   
        if (isset($_POST['delete_submit'])) {
            $user_id = (int)$_GET['delete_user'];
            global $conn;
            $sql = "DELETE * FROM `user` WHERE `user_id` = ?";
            $query = $conn->prepare($sql);
            $query->bind_param('i', $user_id);
            if ($query->execute()) {
                echo "User deleted.";
            } else {
                $conn->error;
            }
        }
    }
}