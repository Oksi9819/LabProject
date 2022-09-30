<?php

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dbuser = $_ENV['DB_USER'];
$dbpassword = $_ENV['DB_PASS']; 
$dbname = $_ENV['DB_NAME'];

//Connect to server
function connectServer()
{
    $conn = new mysqli('localhost', $dbuser, $dbpassword);
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
    $dbuser = $_ENV['DB_USER'];
    $dbpassword = $_ENV['DB_PASS']; 
    $dbname = $_ENV['DB_NAME'];
    $conn = new mysqli('localhost', $dbuser, $dbpassword);
    $sql = "CREATE DATABASE IF NOT EXISTS shop DEFAULT CHARACTER SET utf8mb4";
    if ($conn->query($sql)) {
        echo "Database created!<br><br>";
    } else {
        echo "Database not created<br><br>" . $conn->error;
    }
}

//Connect to the database
function connectDB()
{
    $dbuser = $_ENV['DB_USER'];
    $dbpassword = $_ENV['DB_PASS']; 
    $dbname = $_ENV['DB_NAME'];
    $conn = new mysqli('localhost', $dbuser, $dbpassword, $dbname);
    $conn->set_charset('utf8mb4');
    if ($conn->connect_error) {
        die('Failed to connect to database: '.$conn->connect_error);
    } else {
        echo 'You have successfully connected to the database!<br><br><br><br>';
        return $conn;
    }
}

//Create tables 
function createTables()
{
    $dbuser = $_ENV['DB_USER'];
    $dbpassword = $_ENV['DB_PASS']; 
    $dbname = $_ENV['DB_NAME'];
    $conn = new mysqli('localhost', $dbuser, $dbpassword, $dbname);
    $conn->set_charset('utf8mb4');

    //Create table page_info
    $sql = "CREATE TABLE IF NOT EXISTS `page_info` (
        `page_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `page_name` varchar(50) NOT NULL,
        `topic` varchar(500) DEFAULT NULL,
        `desc` varchar(1000) DEFAULT NULL,
        `phone_1` varchar(250) DEFAULT NULL,
        `phone_2` varchar(250) DEFAULT NULL,
        `address` varchar(250) DEFAULT NULL,
        `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` datetime DEFAULT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    if ($conn->query($sql)) {
        echo "User_role table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }

    //Create table user_role
    $sql = "CREATE TABLE IF NOT EXISTS `user_role` (
        `role_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `role_name` varchar(50) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    if ($conn->query($sql)) {
        echo "User_role table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }

    //Create table user
    $sql = "CREATE TABLE IF NOT EXISTS `user` (
        `user_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `user_role` int(11) NOT NULL DEFAULT '1',
        `user_name` varchar(30) NOT NULL,
        `user_surname` varchar(30) NOT NULL,
        `user_birthday` varchar(30) NOT NULL,
        `user_phone` varchar(17) NOT NULL UNIQUE,
        `user_address` varchar(250) NOT NULL,
        `user_email` varchar(50) NOT NULL UNIQUE,
        `user_password` varchar(100) NOT NULL,
        `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` datetime DEFAULT NULL,
        FOREIGN KEY (user_role) REFERENCES user_role(role_id) ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    if ($conn->query($sql)) {
        echo "User table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }
    
    //Create table category
    $sql = "CREATE TABLE IF NOT EXISTS `category` (
        `category_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `category_name` varchar(30) NOT NULL UNIQUE,
        `name_eng` varchar(30) NOT NULL,
        `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` datetime DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    if ($conn->query($sql)) {
        echo "Category table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }

    ////Create table product
    $sql = "CREATE TABLE IF NOT EXISTS `product` (
        `product_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `product_name` varchar(250) NOT NULL,
        `product_desc` varchar(450) NOT NULL,
        `product_category` int(11) NOT NULL,
        `product_price` decimal(19,2) NOT NULL,
        `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` datetime DEFAULT NULL,
        FOREIGN KEY (product_category) REFERENCES category(category_id) ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    if ($conn->query($sql)) {
        echo "Product table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }
    
    //Create table order_status
    $sql = "CREATE TABLE IF NOT EXISTS `order_status` (
        `status_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `status_name` varchar(50) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    if ($conn->query($sql)) {
        echo "Order_status table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }

    //Create table order_product
    $sql = "CREATE TABLE IF NOT EXISTS `order_product` (
        `order_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `user_id` int(11) NOT NULL,
        `order_address` varchar(250) NOT NULL,
        `status` int(11) NOT NULL DEFAULT '1',
        `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` datetime DEFAULT NULL,
        FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE,
        FOREIGN KEY (status) REFERENCES order_status(status_id) ON DELETE CASCADE
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    if ($conn->query($sql)) {
        echo "Order table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }

    //Create table review
    $sql = "CREATE TABLE IF NOT EXISTS `review` (
        `review_id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `user_id` int(11) DEFAULT NULL,
        `review_text` varchar(500) NOT NULL,
        `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` datetime DEFAULT NULL,
        FOREIGN KEY (user_id)  REFERENCES user(user_id) ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    if ($conn->query($sql)) {
        echo "Review table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }

    //Create table cart
    $sql = "CREATE TABLE IF NOT EXISTS `cart` (
        `order_id` int(11) NOT NULL,
        `product_id` int(11) NOT NULL,
        `amount` int(11) NOT NULL,
        `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        `updated_at` datetime DEFAULT NULL,
        PRIMARY KEY (`order_id`,`product_id`),
        FOREIGN KEY (product_id) REFERENCES product(product_id) ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    if ($conn->query($sql)) {
        echo "Cart table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }
}

//Fulfil tables 
function fulfilTables()
{
    $dbuser = $_ENV['DB_USER'];
    $dbpassword = $_ENV['DB_PASS']; 
    $dbname = $_ENV['DB_NAME'];
    $conn = new mysqli('localhost', $dbuser, $dbpassword, $dbname);
    $conn->set_charset('utf8mb4');

    //Fulfil table page_info
    $sql = "INSERT INTO `page_info` (`page_id`, `page_name`, `topic`, `desc`, `phone_1`, `phone_2`, `address`, `created_at`, `updated_at`) VALUES
    (1, 'main', 'ГЛАВНАЯ', 'ЭТО ГЛАВНАЯ СТРАНИЦА! Заполним ее позже:)', NULL, NULL, NULL, '2022-09-30 11:38:25', NULL),
    (4, 'delivery', 'ДОСТАВКА', 'Осуществляем доставку по всей Беларуси. Бесплатная доставка в пределах МКАД. Стоимость доставки в регионы от 25 BYN*.', NULL, NULL, NULL, '2022-09-30 11:38:25', NULL),
    (6, 'contacts', 'КОНТАКТЫ', NULL, '+375 (29) 111-11-11', '+375 (29) 222-22-22', 'г. Минск, пр-т Независимости, 4; 220030, Республика Беларусь.', '2022-09-30 11:38:25', NULL)";
    if ($conn->query($sql)) {
        echo "User_role table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }

    //Fulfil table user_role
    $sql = "INSERT INTO `user_role` (`role_id`, `role_name`) VALUES
    (1, 'User'),
    (2, 'Admin')";
    if ($conn->query($sql)) {
        echo "User_role table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }

    //Fulfil table user
    $sql = "INSERT INTO `user` (`user_id`, `user_role`, `user_name`, `user_surname`, `user_birthday`, `user_phone`, `user_address`, `user_email`, `user_password`, `created_at`, `updated_at`) VALUES
    (1, 2, 'Петр', 'Петров', '01/01/1975', '+375(29)111-11-11', 'г. Минск, пр-т Независимости, 31', 'petrovpetr@gmail.com', '0d25c4510e3dab265ef052f2473d34a0', '2022-09-30 11:35:03', NULL),
    (2, 2, 'Иванка', 'Иванова', '02/02/1986', '+375(29)222-22-22', 'г. Минск, пр-т Независимости, 41', 'ivanovaivanka@gmail.com', '806a3df9e03a95645e9ed17882ff713e', '2022-09-30 11:35:03', NULL),
    (3, 1, 'Александр', 'Смирновин', '03/03/1997', '+375(29)333-33-33', 'г. Минск, пр-т Независимости, 51', 'smirnovalex@gmail.com', 'c5fe25896e49ddfe996db7508cf00534', '2022-09-30 11:35:03', NULL),
    (5, 1, 'Василиса', 'Васильева', '05/05/1999', '+375(29)555-55-55', 'г. Минск, пр-т Независимости, 71', 'vasilievavasya@gmail.com', 'd485db679cbcf5841c5809f97f97a79e', '2022-09-30 11:35:03', NULL),
    (6, 1, 'Клизавета', 'Елизавета', '1975-05-01', '+375332525252', 'ул. Невского, 32б Кобрин', 'oklizzi@mail.ru', 'b0baee9d279d34fa1dfd71aadb908c3f', '2022-09-30 11:35:03', NULL)";
    if ($conn->query($sql)) {
        echo "User table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }
    
    //Fulfil table category
    $sql = "INSERT INTO `category` (`category_id`, `category_name`, `name_eng`, `created_at`, `updated_at`) VALUES
    (1, 'Пылесосы', 'VacuumCleaners', '2022-09-30 11:40:29', NULL),
    (2, 'Увлажнители водуха', 'Humidifiers', '2022-09-30 11:40:29', NULL),
    (3, 'Очистители воздуха', 'AirCleaners', '2022-09-30 11:40:29', NULL),
    (4, 'Светильники', 'Lamps', '2022-09-30 11:40:29', NULL),
    (5, 'Другое', 'Other', '2022-09-30 11:40:29', NULL)";
    if ($conn->query($sql)) {
        echo "Category table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }

    //Fulfil table product
    $sql = "INSERT INTO `product` (`product_id`, `product_name`, `product_desc`, `product_category`, `product_price`, `created_at`, `updated_at`) VALUES
    (1, 'Робот-пылесос моющий Xiaomi Mi Robot Vacuum Mop 2 ProV Compact', 'Мощность всасывания 2500 Па; Влажная уборка; Емкость аккумулятора 2400 мАч', 1, '753.00', '2022-09-30 11:37:31', NULL),
    (2, 'Вертикальный беспроводной пылесос Dreame T30 Cordless Vacuum Cleaner', 'Мощность 400 Вт; Мощность всасывания: 190 аВт; Емкость аккумулятора 2900 мАч', 1, '1200.00', '2022-09-30 11:37:31', NULL),
    (3, 'Мультифункциональный пароочиститель Deerma Steam Cleaner DEM-ZQ610', 'Максимальная мощность: 1600 Вт; Давление пара: 3 бар; Источник питания: От сети', 1, '300.00', '2022-09-30 11:37:31', NULL),
    (4, 'Увлажнитель воздуха Xiaomi Mi Smart Antibacterial Humidifier', 'Объем резервуара для воды 4.5 л; Эффективная площадь до 25 кв. м; Производительность 300 ± 50 мл/ч', 2, '200.00', '2022-09-30 11:37:31', NULL),
    (5, 'Увлажнитель воздуха Deerma Air Humidifier DEM F327W', 'Производительность до 300 мл/ч; Рекомендуемая площадь до 30 кв.м.; Объем резервуара для воды 5 л', 2, '150.00', '2022-09-30 11:37:31', NULL),
    (6, 'Увлажнитель воздуха Deerma Water Humidifier DEM F600', 'Объем резервуара для воды 5 л; Скорость распыления 340 мл/ч; Полезная площадь 25-30 м2', 2, '150.00', '2022-09-30 11:37:31', NULL),
    (7, 'Очиститель воздуха Xiaomi Mi Air Purifier 4 Pro', 'Эффективность очистки воздуха: до 500 м3/ч; Эффективная площадь очистки: до 60 м2; Потребляемая мощность: 1.5 - 66 Вт', 3, '760.00', '2022-09-30 11:37:31', NULL),
    (8, 'Очиститель воздуха Xiaomi Mi Air Purifier 4', 'Эффективность очистки воздуха: до 400 м3/ч; Эффективная площадь очистки: до 48 м2; Уровень шума в ночном режиме: 32,1 дБ', 3, '590.00', '2022-09-30 11:37:31', NULL),
    (9, 'Умный потолочный светильник Yeelight Arwen Ceiling Light S', 'Номинальная мощность 50 Вт; Световой поток до 3000 лм; Интеллектуальное управление', 4, '460.00', '2022-09-30 11:37:31', NULL),
    (10, 'Умная настольная лампа Xiaomi Mi Smart LED Desk Lamp Pro', 'Световой поток: 700 лм; Срок службы около: 25000 часов; Индекс цветопередачи: Ra90', 4, '209.00', '2022-09-30 11:37:31', NULL),
    (11, 'Беспроводной двухклавишный выключатель Aqara Wireless Remote Switch H1', 'Время автономной работы: до 5 лет', 5, '120.00', '2022-09-30 11:37:31', NULL),
    (12, 'Умный дверной замок Aqara Smart Door Lock N100', 'Питание: Элементы питания АА (8 шт.); Порт Type-C для аварийного питания; До 28 дней автономной работы', 5, '1000.00', '2022-09-30 11:37:31', NULL)";
    if ($conn->query($sql)) {
        echo "Product table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }
    
    //Fulfil table order_status
    $sql = "INSERT INTO `order_status` (`status_id`, `status_name`) VALUES
    (1, 'Обрабатывается'),
    (2, 'В пути'),
    (3, 'Отменен'),
    (4, 'Выполнен')";
    if ($conn->query($sql)) {
        echo "Order_status table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }

    //Fulfil table order_product
    $sql = "INSERT INTO `order_product` (`order_id`, `user_id`, `order_address`, `status`, `created_at`, `updated_at`) VALUES
    (1, 1, 'г. Минск, пр-т Партизанский, 101', 1, '2022-09-30 11:39:35', NULL),
    (2, 2, 'г. Минск, пр-т Партизанский, 102', 1, '2022-09-30 11:39:35', NULL),
    (3, 3, 'г. Минск, пр-т Партизанский, 105', 1, '2022-09-30 11:39:35', NULL),
    (4, 3, 'г. Минск, пр-т Партизанский, 15', 1, '2022-09-30 11:39:35', NULL)";
    if ($conn->query($sql)) {
        echo "Order table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }

    //Fulfil table review
    $sql = "INSERT INTO `review` (`review_id`, `user_id`, `review_text`, `created_at`, `updated_at`) VALUES
    (1, 1, 'Отличный персонал.', '2022-09-30 11:36:33', NULL),
    (2, 2, 'Все прекрасно.', '2022-09-30 11:36:33', NULL),
    (3, 3, 'Очень довольны обслуживанием.', '2022-09-30 11:36:33', NULL),
    (5, 5, 'Очень приятный персонал.', '2022-09-30 11:36:33', NULL),
    (6, 3, 'Большой ассортимент!', '2022-09-30 11:36:33', NULL)";
    if ($conn->query($sql)) {
        echo "Review table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }

    //Fulfil table cart
    $sql = "INSERT INTO `cart` (`order_id`, `product_id`, `amount`, `created_at`, `updated_at`) VALUES
    (1, 1, 1, '2022-09-30 11:41:26', NULL),
    (1, 2, 1, '2022-09-30 11:41:26', NULL),
    (1, 8, 1, '2022-09-30 11:41:26', NULL),
    (2, 3, 3, '2022-09-30 11:41:26', NULL),
    (2, 4, 1, '2022-09-30 11:41:26', NULL),
    (3, 4, 1, '2022-09-30 11:41:26', NULL),
    (3, 7, 1, '2022-09-30 11:41:26', NULL),
    (4, 6, 1, '2022-09-30 11:41:26', NULL)";
    if ($conn->query($sql)) {
        echo "Cart table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }
}
