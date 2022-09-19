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

    //Create table user
    $sql = "CREATE TABLE IF NOT EXISTS user (user_id INTEGER AUTO_INCREMENT PRIMARY KEY, user_name VARCHAR(30) NOT NULL, user_surname VARCHAR(30) NOT NULL, user_birthday VARCHAR(30) NOT NULL, user_phone VARCHAR(17) UNIQUE NOT NULL, user_address VARCHAR(250) NOT NULL, user_email VARCHAR(50) UNIQUE NOT NULL, user_password VARCHAR(100) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    if ($conn->query($sql)) {
        echo "User table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }
    
    //Create table category
    $sql = "CREATE TABLE IF NOT EXISTS category (category_id INTEGER AUTO_INCREMENT PRIMARY KEY, category_name VARCHAR(30) UNIQUE NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    if ($conn->query($sql)) {
        echo "Category table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }

    ////Create table product
    $sql = "CREATE TABLE IF NOT EXISTS product (product_id INTEGER AUTO_INCREMENT PRIMARY KEY, product_name VARCHAR(250) NOT NULL, product_desc VARCHAR(450) NOT NULL, product_category INTEGER NOT NULL, product_price DECIMAL(19,2) NOT NULL, FOREIGN KEY (product_category) REFERENCES category(category_id) ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    if ($conn->query($sql)) {
        echo "Product table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }
    
    //Create table order_status
    $sql = "CREATE TABLE IF NOT EXISTS order_status (status_id INTEGER AUTO_INCREMENT PRIMARY KEY, status_name VARCHAR(50) NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    if ($conn->query($sql)) {
        echo "User table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }

    //Create table order
    $sql = "CREATE TABLE IF NOT EXISTS order_product (order_id INTEGER AUTO_INCREMENT PRIMARY KEY, user_id INTEGER NOT NULL, order_address VARCHAR(250) NOT NULL, status INTEGER NOT NULL DEFAULT 1, FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE, FOREIGN KEY (status) REFERENCES order_status(status_id)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    if ($conn->query($sql)) {
        echo "Order table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }

    //Create table review
    $sql = "CREATE TABLE IF NOT EXISTS review (review_id INTEGER AUTO_INCREMENT PRIMARY KEY, user_id INTEGER, review_text VARCHAR(500) NOT NULL, FOREIGN KEY (user_id) REFERENCES user(user_id) ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    if ($conn->query($sql)) {
        echo "Review table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }

    //Create table cart
    $sql = "CREATE TABLE IF NOT EXISTS cart (order_id INTEGER NOT NULL, product_id INTEGER NOT NULL, amount INTEGER NOT NULL, FOREIGN KEY (order_id) REFERENCES order_product(order_id) ON DELETE CASCADE, PRIMARY KEY(order_id, product_id), FOREIGN KEY (product_id) REFERENCES product(product_id) ON DELETE CASCADE) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    if ($conn->query($sql)) {
        echo "Cart table successfully created.<br><br>";
    } else {
        echo "Error: " . $conn->error;
    }
}

//Fulfil row of table
function fulfilRow(string $path, string $values)
{
    $dbuser = $_ENV['DB_USER'];
    $dbpassword = $_ENV['DB_PASS']; 
    $dbname = $_ENV['DB_NAME'];
    $conn = new mysqli('localhost', $dbuser, $dbpassword, $dbname);
    $conn->set_charset('utf8mb4');
    $sql = "INSERT INTO ".$path." VALUES (".$values.")";
    if ($conn->query($sql)) {
        echo "New row added to the table.<br><br>";
    } else {
        echo "Error: " .$conn->error."<br>";
    }
}

//Fulfil table
function fulfilTable(string $path, array $values)
{
    foreach ($values as $value) {
    fulfilRow($path, $value);
    }   
}

function fulfilDB()
{
    //Fulfil table category
    $path = "category(category_name)";
    $values = array(
        "'Пылесосы'",
        "'Увлажнители водуха'",
        "'Очистители воздуха'",
        "'Светильники'",
        "'Другое'",
    );
    fulfilTable($path, $values);
        
    //Fulfil table product
    $path = "product(product_name, product_desc, product_category, product_price)";
    $values = array(
        "'Робот-пылесос моющий Xiaomi Mi Robot Vacuum Mop', 'Мощность всасывания 2500 Па; Влажная уборка; Емкость аккумулятора 2400 мАч', 1, 750",
        "'Вертикальный беспроводной пылесос Dreame T30 Cordless Vacuum Cleaner', 'Мощность 400 Вт; Мощность всасывания: 190 аВт; Емкость аккумулятора 2900 мАч', 1, 1200",
        "'Мультифункциональный пароочиститель Deerma Steam Cleaner DEM-ZQ610', 'Максимальная мощность: 1600 Вт; Давление пара: 3 бар; Источник питания: От сети', 1, 300",
        "'Увлажнитель воздуха Xiaomi Mi Smart Antibacterial Humidifier', 'Объем резервуара для воды 4.5 л; Эффективная площадь до 25 кв. м; Производительность 300 ± 50 мл/ч', 2, 200",
        "'Увлажнитель воздуха Deerma Air Humidifier DEM F327W', 'Производительность до 300 мл/ч; Рекомендуемая площадь до 30 кв.м.; Объем резервуара для воды 5 л', 2, 150",
        "'Увлажнитель воздуха Deerma Water Humidifier DEM F600', 'Объем резервуара для воды 5 л; Скорость распыления 340 мл/ч; Полезная площадь 25-30 м2', 2, 150",
        "'Очиститель воздуха Xiaomi Mi Air Purifier 4 Pro', 'Эффективность очистки воздуха: до 500 м3/ч; Эффективная площадь очистки: до 60 м2; Потребляемая мощность: 1.5 - 66 Вт', 3, 760",
        "'Очиститель воздуха Xiaomi Mi Air Purifier 4', 'Эффективность очистки воздуха: до 400 м3/ч; Эффективная площадь очистки: до 48 м2; Уровень шума в ночном режиме: 32,1 дБ', 3, 590",
        "'Умный потолочный светильник Yeelight Arwen Ceiling Light S', 'Номинальная мощность 50 Вт; Световой поток до 3000 лм; Интеллектуальное управление', 4, 460",
        "'Умная настольная лампа Xiaomi Mi Smart LED Desk Lamp Pro', 'Световой поток: 700 лм; Срок службы около: 25000 часов; Индекс цветопередачи: Ra90', 4, 209",
        "'Беспроводной двухклавишный выключатель Aqara Wireless Remote Switch H1', 'Время автономной работы: до 5 лет', 5, 120",
        "'Умный дверной замок Aqara Smart Door Lock N100', 'Питание: Элементы питания АА (8 шт.); Порт Type-C для аварийного питания; До 28 дней автономной работы', 5, 1000",
        "'Шлюз умного дома Aqara Hub M2', 'Wi-Fi IEEE 802.11 b/g/n 2,4 ГГц; Порт Ethernet; Протокол Zigbee 3.0; Bluetooth 5.0; Подключение до 128 устройств', 5, 250",
    );
    fulfilTable($path, $values); 

    //Fulfil table user
    $path = "user(user_surname, user_name, user_birthday, user_phone, user_address, user_email, user_password)";
    $values = array(
        "'Петров', 'Петр', '01/01/1975', '+375(29)111-11-11', 'г. Минск, пр-т Независимости, 31', 'petrovpetr@gmail.com', '".hash('md5','vu5678')."'",
        "'Иванова', 'Иванка', '02/02/1986', '+375(29)222-22-22', 'г. Минск, пр-т Независимости, 41', 'ivanovaivanka@gmail.com', '".hash('md5','fgh11111')."'",
        "'Смирнов', 'Александр', '03/03/1997', '+375(29)333-33-33', 'г. Минск, пр-т Независимости, 51', 'smirnovalex@gmail.com', '".hash('md5','2fj7856')."'",
        "'Петрова', 'Мария', '04/04/1998', '+375(29)444-44-44', 'г. Минск, пр-т Независимости, 61', 'petrovamaria@gmail.com', '".hash('md5','4khgf662')."'",
        "'Васильева', 'Василиса', '05/05/1999', '+375(29)555-55-55', 'г. Минск, пр-т Независимости, 71', 'vasilievavasya@gmail.com', '".hash('md5','okjf8546')."'",
    );
    fulfilTable($path, $values); 

    //Fulfil table review
    $path = "review(user_id, review_text)";
    $values = array(
        "1, 'Отличный персонал.'",
        "2, 'Все прекрасно.'",
        "3, 'Очень довольны обслуживанием.'",
        "4, 'Лучшие цены'",
        "5, 'Очень приятный персонал.'",
    );
    fulfilTable($path, $values); 

    //Fulfil table order_status
    $path = "order_status(status_name)";
    $values = array(
        "'Обрабатывается'",
        "'В пути'",
        "'Отменен'",
        "'Выполнен'",
    );
    fulfilTable($path, $values); 

    //Fulfil table order_product
    $path = "order_product(user_id, order_address, status)";
    $values = array(
        "1, 'г. Минск, пр-т Партизанский, 101', 1",
        "2, 'г. Минск, пр-т Партизанский, 102', 1",
        "3, 'г. Минск, пр-т Партизанский, 105', 1",
        "3, 'г. Минск, пр-т Партизанский, 15', 1",
        "4, 'г. Минск, пр-т Партизанский, 12', 1",
    );
    fulfilTable($path, $values); 

    //Fulfil table cart
    $path = "cart(order_id, product_id, amount)";
    $values = array(
        "1, 1, 1",
        "1, 8, 1",
        "1, 2, 1",
        "2, 3, 3",
        "2, 4, 1",
        "3, 4, 1",
        "4, 6, 1",
        "4, 8, 1",
        "3, 7, 1",
    );
    fulfilTable($path, $values);
}
