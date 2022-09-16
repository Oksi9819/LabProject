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
        $user_name = (string)$_POST['user_name'];
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
        if (is_int($user_id)) {
            global $conn;
            $sql = "SELECT * FROM `user` WHERE `user_id` = ?";
            $query = $conn->prepare($sql);
            $query->bind_param('i', $user_id);
            $query->execute();
            $result = $query->get_result();
            $result = $result->fetch_assoc(); 
            return $result;
        } else {
            echo $conn->error;
        }
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
        } else {
            echo $conn->error;
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
        } else {
            echo $conn->error;
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