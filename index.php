<?php
// Autoload files using composer
require_once __DIR__ . '/vendor/autoload.php';
/*require_once __DIR__ . '/database.php';*/
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dotenv->required(['DB_USER', 'DB_PASS', 'DB_NAME']);

// Use this namespace
use Steampixel\Route;
use Itechart\InternshipProject\Controller\ProductController;
use Itechart\InternshipProject\Controller\UserController;
use Itechart\InternshipProject\Controller\BasicController;
use Itechart\InternshipProject\Controller\CartController;

//Connect to the database
$conn = new mysqli('localhost', $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);
$conn->set_charset('utf8mb4');
if ($conn->connect_error) {
    die('Failed to connect to database: '.$conn->connect_error);
} else {
    echo 'You have successfully connected to the database!<br><br><br><br>';
}

define('BASEPATH','/');

function navi() {
  echo '
  Навигация:
  <ul>
    <li><a href="'.BASEPATH.'">Главная</a></li>
    <li><a href="'.BASEPATH.'catalog">Каталог</a>
      <ul>
        <li><a href="'.BASEPATH.'catalog/categoryVacuumCleaners">Категория Пылесосы</a></li>
        <li><a href="'.BASEPATH.'catalog/categoryAirCleaners">Категория Очистители воздуха</a></li>
        <li><a href="'.BASEPATH.'catalog/categoryHumidifiers">Категория Увлажнители воздуха</a></li>
        <li><a href="'.BASEPATH.'catalog/categoryLamps">Категория Светильники</a></li>
        <li><a href="'.BASEPATH.'catalog/categoryOther">Категория Другое</a></li>
        <li><a href="'.BASEPATH.'catalog/categoryVacuumCleaners/id1">Пылесосы артикул "1"</a></li>
        <li><a href="'.BASEPATH.'catalog/id2">Продукт с артикулом "2"</a></li>
        <li><a href="'.BASEPATH.'catalog/search">Поисковая строка в каталоге</a></li>
      </ul>
    </li>
    <li><a href="'.BASEPATH.'contacts">Контакты</a>
      <ul>
        <li><a href="'.BASEPATH.'contacts/contact-form">Форма обратной связи</a></li>
      </ul>
    </li>
    <li><a href="'.BASEPATH.'delivery">Доставка</a></li>
    <li><a href="'.BASEPATH.'registration-form">Регистрация</a></li>
    <li><a href="'.BASEPATH.'authorization-form">Авторизация</a></li>
    <li><a href="'.BASEPATH.'profile/111222">Пользователь id 111222</a>
      <ul>
        <li><a href="'.BASEPATH.'profile/111222/info">Пользователь id 111222. Информация</a></li>
        <li><a href="'.BASEPATH.'profile/111222/reviews">Пользователь id 111222. Отзывы</a></li>
        <li><a href="'.BASEPATH.'profile/111222/orders">Пользователь id 111222. Заказы</a></li>
      </ul>
    </li>
    <li><a href="'.BASEPATH.'profile/112">Пользователь id 112 = Админ</a>
      <ul>
        <li><a href="'.BASEPATH.'profile/112/info">Админ id 112. Информация</a></li>
        <li><a href="'.BASEPATH.'profile/112/reviews">Все отзывы</a></li>
        <li><a href="'.BASEPATH.'profile/112/orders">Все заказы</a></li>
      </ul>
    </li>
    <li><a href="'.BASEPATH.'cart/2256665">Корзина пользователя 2256665</a></li>
  </ul>
  ';
}

// Base route (startpage)
Route::add('/', function() {
  (new BasicController())->executeMainPage();
});

// Route to registration form
Route::add('/registration-form', function() {
  (new UserController())->sendUser();
}, 'get');

// Post route to registration-form
Route::add('/registration-form', function() {
  (new UserController())->setUser();
}, 'post');

// Route to auth form
Route::add('/authorization-form', function() {
  (new UserController())->authUser();
}, 'get');

// Post route to auth-form
Route::add('/authorization-form', function() {
  (new UserController())->checkUser();
}, 'post');

// Route to profile page
Route::add('/profile/([0-9]*)', function($user_id) {
  (new UserController())->getUserInfo($user_id);
});

// Route to profile page->info about user
Route::add('/profile/([0-9]*)/info', function($user_id) {
  (new UserController())->getUserInfo($user_id);
});

// Route to profile page->info about user's orders
Route::add('/profile/([0-9]*)/orders', function($user_id) {
  (new UserController())->getUserOrders($user_id);
});

// Route to profile page->info about user's reviews
Route::add('/profile/([0-9]*)/reviews', function($user_id) {
  (new UserController())->getUserReviews($user_id);
});

// Route to catalog
Route::add('/catalog', function() {
  (new ProductController())->getProducts();
}, 'get');

Route::add('/catalog', function() {
  (new ProductController())->getProductsSorted();
}, 'post');

// Route to a particular category of products
Route::add('/catalog/category([A-Za-z]*)', function($category) {
  (new ProductController())->getProductsByCategory($category);
});

// Route to product card
Route::add('/catalog/category([A-Za-z]*)/id([0-9]*)', function($category_id, $product_id) {
  (new ProductController())->getProductById($product_id);
});

// Route to product card by product Id
Route::add('/catalog/id([0-9]*)', function($product_id) {
  (new ProductController())->getProductById($product_id);
});

// Route to product card by product name
Route::add('/catalog/search', function($product_name) {
  (new ProductController())->getProductByName($product_name);
});

// Route to cart
Route::add('/cart/([0-9]*)', function($user_id) {
  (new CartController())->show($user_id);
});

/*Route to make an order
Route::add('/cart/([0-9]*)/order/([0-9]*)', function($user_id, $order_id) {
  (new CartController())->order($user_id, $order_id);
});*/

// Route to contacts
Route::add('/contacts', function() {
  (new BasicController())->executeContactsPage();
});

// Route to contact-form
Route::add('/contacts/contact-form', function() {
  (new BasicController())->sendContactForm();
}, 'get');

// Post route to contact-form
Route::add('/contacts/contact-form', function() {
  (new BasicController())->showContactForm();
}, 'post');

// Route to delivery page
Route::add('/delivery', function() {
  (new BasicController())->executeDeliveryPage();
});

Route::run(BASEPATH);


