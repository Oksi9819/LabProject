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
                $sql = "INSERT INTO `user`(`user_surname`, `user_name`, `user_birthday`, `user_phone`, `user_address`, `user_email`, `user_password`) VALUES(?,?,?,?,?,?,?)";
                $query = $conn->prepare($sql);
                $query->bind_param('sssssss', $user_surname, $user_name, $user_birthday, $user_phone, $user_address, $user_email, $user_password);
	            $query->execute();
            } else {
                echo "Password length should be less than 9 characters.";
            }        
        } 
    }

    //READ
    public function getUsers(): array
    {
        global $conn;
        $sql = "SELECT * FROM `user`";
        $query = $conn->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();
    }

    public function getUserInfo(int $user_id): array
    {
        global $conn;
        $sql = "SELECT * FROM `user` WHERE `user_id` = ?";
        $query = $conn->prepare($sql);
        $query->bind_param('i', $user_id);
        $query->execute();
        $result = $query->get_result();
        $result = $result->fetch_assoc(); 
        return $result;
    }

    public function auth(): array
    {
        global $conn;
        $user_login = $_POST['user_email'];
        $user_pass = $_POST['user_password'];
        $sql = "SELECT * FROM `user` WHERE `user_email` = ?";
        $query = $conn->prepare($sql);
        $query->bind_param('s', $user_login);
        if ($query->execute()) {
            $result = $query->get_result();
            $result = $result->fetch_assoc();
            if (hash('md5', $user_pass) == $result['user_password']) {
                return $this->getUserInfo($result['user_id']);
            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "You are not registered yet.";
        }
    }



    //UPDATE
    /*public function authUser():array
    {
        
        $user
        return $user;
    }*/

    //DELETE
    public function deleteUser()
    {
        $user_id = $_GET['delete_user'];
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