<?php

//Подключение к серверу
function connectServer()
{
    $conn = new mysqli('localhost', 'root', '1234');
    $conn->set_charset('utf8mb4');
    if ($conn->connect_error) {
    die('Ошибка: невозможно подключиться к серверу MySQL: '.$conn->connect_error);
    }else echo 'Вы успешно подключились к серверу MySQL!<br><br><br><br>';
}

//Создание БД
function createDB()
{
    $conn = new mysqli('localhost', 'root', '1234');
    $conn->set_charset('utf8mb4');
    $sql = "CREATE DATABASE IF NOT EXISTS shop";
    if($conn->query($sql)){
    echo "База данных создана!<br><br>";
    } else{
    echo "База данных не создана<br><br>" . $conn->error;
    }
}

//Подключение к БД
function connectDB()
{
    $conn = new mysqli('localhost', 'root', '1234', 'shop');
    $conn->set_charset('utf8mb4');
    if ($conn->connect_error) {
    die('Не удалось подлкючиться к базе данных: '.$conn->connect_error);
    }else echo 'Вы успешно подключились к БД "Shop"!<br><br><br><br>';
}

//Создание таблиц 
function createTables()
{
    $conn = new mysqli('localhost', 'root', '1234', 'shop');
    $conn->set_charset('utf8mb4');
    $sql = "CREATE TABLE IF NOT EXISTS user (user_id INTEGER AUTO_INCREMENT PRIMARY KEY, user_name VARCHAR(30) NOT NULL, user_surname VARCHAR(30) NOT NULL, user_birthday VARCHAR(30) NOT NULL, user_phone VARCHAR(15) UNIQUE NOT NULL, user_address VARCHAR(50) NOT NULL, user_email VARCHAR(20) NOT NULL, user_password VARCHAR(8) NOT NULL);";
    if($conn->query($sql)){
    echo "Таблица Users успешно создана.<br><br>";
    } else{
            echo "Ошибка: " . $conn->error;
        }
}