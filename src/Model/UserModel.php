<?php

namespace Itechart\InternshipProject\Model;

use Exception;
use DateTimeImmutable;
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
        if (preg_match("/([a-z0-9]+\.)*[a-z0-9]+@[a-z0-9]+(\.[a-z0-9]+)*\.[a-z]{2,4}$/", $user_email)) {
            if (preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/", $user_birthday)) {
                $format = 'Y-m-d';
                $user_bday = DateTimeImmutable::createFromFormat($format, $user_birthday);   
                if ($user_bday->format($format) === $user_birthday) {
                    if (preg_match("/(\+375)[\(](29|33|25|44)[\)](\d{3})-(\d{2})-(\d{2})$/", $user_phone)) {
                        $fields = array('user_surname', 'user_name', 'user_birthday', 'user_phone', 'user_address', 'user_email', 'user_password', 'created_at');
                        $created_at = date("Y-m-d h:i:s");
                        $values = array($user_surname, $user_name, $user_birthday, $user_phone, $user_address, $user_email, $user_password, $created_at);
                        $result = $this->setModel("user", $fields, "ssssssss", $values); 

                        return $result;
                    } else {
                        throw new Exception("Phone number should be in format '+375(29/33/..)111-11-11'.");
                    } 
                } else {
                    throw new Exception("Birthday does not follow the Gregorian calendar.");
                }
            } else {
                throw new Exception("Birthday should be in format 'YYYY-MM-DD'.");
            }
        } else {
            throw new Exception("Your email looks invalid.");
        }        
    }

    public function setAdmin(string $user_surname, string $user_name, string $user_birthday, string $user_phone, string $user_address, string $user_email, string $user_password): string
    {
        if (preg_match("/([a-z0-9]+\.)*[a-z0-9]+@[a-z0-9]+(\.[a-z0-9]+)*\.[a-z]{2,4}$/", $user_email)) {
            if (preg_match("/[0-9]{4}-[0-9]{2}-[0-9]{2}/", $user_birthday)) {
                $format = 'Y-m-d';
                $user_bday = DateTimeImmutable::createFromFormat($format, $user_birthday);   
                if ($user_bday->format($format) === $user_birthday) {
                    if (preg_match("/(\+375)[\(](29|33|25|44)[\)](\d{3})-(\d{2})-(\d{2})$/", $user_phone)) {
                        $fields = array('user_surname', 'user_name', 'user_birthday', 'user_phone', 'user_address', 'user_email', 'user_password', 'user_role', 'created_at');
                        $created_at = date("Y-m-d h:i:s");
                        $values = array($user_surname, $user_name, $user_birthday, $user_phone, $user_address, $user_email, $user_password, "2", $created_at);
                        $result = $this->setModel("user", $fields, "ssssssss", $values); 
                        return $result;
                    } else {
                        throw new Exception("Phone number should be in format '+375(29/33/..)111-11-11'.");
                    } 
                } else {
                    throw new Exception("Birthday does not follow the Gregorian calendar.");
                }
            } else {
                throw new Exception("Birthday should be in format 'YYYY-MM-DD'.");
            }
        } else {
            throw new Exception("Email looks invalid.");
        } 
    }

    //READ
    public function getUsers(): array
    {
        $result = $this->getModel("*", "user", NULL, NULL, NULL, NULL, NULL, NULL);
        if (!empty($result)) {
            return $result;
        } else {
            throw new Exception("There are no users yet.");
        }
        
    }

    public function getUserInfo(int $user_id): array
    {
        if (is_int($user_id)) {
            $result = $this->getModel("*", "user", "user_id", $user_id, NULL, NULL, NULL, "i");
            if (!empty($result)) {
                return $result;
            } else {
                throw new Exception("There is not such user.");
            }
        }
    }

    public function getUserInfoByEmail(string $user_email): array
    {
        if (preg_match("/([a-z0-9]+\.)*[a-z0-9]+@[a-z0-9]+(\.[a-z0-9]+)*\.[a-z]{2,4}$/", $user_email)) {
            $result = $this->getModel("*", "user", "user_email", $user_email, NULL, NULL, NULL, "s");
            if (!empty($result)) {
                return $result;
            } else {
                throw new Exception("There is not such user.");
            }
        } else {
            throw new Exception("Invalid email.");
        }  
    }

    public function auth(string $login, string $pass): array
    {
        $result = $this->getModel("*", "user", "user_email", $login, NULL, NULL, NULL, "s");
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