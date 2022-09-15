<?php

//Connect to server
function connectServer()
{
    $conn = new mysqli('localhost', 'root', '1234');
    $conn->set_charset('utf8mb4');
    if ($conn->connect_error) {
        die('Error: Unable to connect to MySQL server: '.$conn->connect_error);
    } else {
        echo 'You have successfully connected to the MySQL server!<br><br><br><br>';
    }
}

//Create database
function createDB()
{
    $conn = new mysqli('localhost', 'root', '1234');
    $sql = "CREATE DATABASE IF NOT EXISTS shop DEFAULT CHARACTER SET utf8mb4";
    if($conn->query($sql)) {
        echo "Database created!<br><br>";
    } else {
        echo "Database not created<br><br>" . $conn->error;
    }
}

//Connect to the database
function connectDB()
{
    $conn = new mysqli('localhost', 'root', '1234', 'shop');
    $conn->set_charset('utf8mb4');
    if ($conn->connect_error) {
        die('Failed to connect to database: '.$conn->connect_error);
    } else {
        echo 'You have successfully connected to the database "Shop"!<br><br><br><br>';
    }
}

//Create tables 
function createTables()
{
    $conn = new mysqli('localhost', 'root', '1234', 'shop');
    $conn->set_charset('utf8mb4');

    //Create table user
    $sql = "CREATE TABLE IF NOT EXISTS user (user_id INTEGER AUTO_INCREMENT PRIMARY KEY, user_name VARCHAR(30) NOT NULL, user_surname VARCHAR(30) NOT NULL, user_birthday VARCHAR(30) NOT NULL, user_phone VARCHAR(15) UNIQUE NOT NULL, user_address VARCHAR(250) NOT NULL, user_email VARCHAR(20) NOT NULL, user_password VARCHAR(8) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    if($conn->query($sql)) {
        echo "User table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }
    
    //Create table category
    $sql = "CREATE TABLE IF NOT EXISTS category (category_id INTEGER AUTO_INCREMENT PRIMARY KEY, category_name VARCHAR(30) UNIQUE NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    if($conn->query($sql)) {
        echo "Category table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }

    ////Create table product
    $sql = "CREATE TABLE IF NOT EXISTS product (product_id INTEGER AUTO_INCREMENT PRIMARY KEY, product_name VARCHAR(50) NOT NULL, product_desc VARCHAR(450) NOT NULL, product_category INTEGER NOT NULL, product_price DECIMAL(19,2) NOT NULL, FOREIGN KEY (product_category) REFERENCES category(category_id) ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    if($conn->query($sql)) {
        echo "Product table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }
    
    //Create table order
    $sql = "CREATE TABLE IF NOT EXISTS order_product (order_id INTEGER AUTO_INCREMENT PRIMARY KEY, user_id INTEGER NOT NULL, order_address VARCHAR(250) NOT NULL, FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    if($conn->query($sql)) {
        echo "Order table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }

    //Create table review
    $sql = "CREATE TABLE IF NOT EXISTS review (review_id INTEGER AUTO_INCREMENT PRIMARY KEY, user_id INTEGER NOT NULL, review_text VARCHAR(500) NOT NULL, FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    if($conn->query($sql)) {
        echo "Review table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }

    //Create table cart
    $sql = "CREATE TABLE IF NOT EXISTS cart (order_id INTEGER NOT NULL, product_id INTEGER NOT NULL, amount INTEGER NOT NULL, FOREIGN KEY (order_id) REFERENCES order_product(order_id) ON DELETE CASCADE, PRIMARY KEY(order_id, product_id), FOREIGN KEY (product_id) REFERENCES product(product_id) ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    if($conn->query($sql)) {
        echo "Cart table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }
}