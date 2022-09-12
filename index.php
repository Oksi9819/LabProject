<?php
// Autoload files using composer
require_once __DIR__ . '/vendor/autoload.php';

// Use this namespace
use Steampixel\Route;
use Itechart\InternshipProject\Controller\ProductController;
use Itechart\InternshipProject\Controller\UserController;
use Itechart\InternshipProject\Controller\BasicController;

define('BASEPATH','/LabProject/');

function navi() {
  echo '
  Navigation:
  <ul>
      <li><a href="'.BASEPATH.'">Главная</a></li>
      <li><a href="'.BASEPATH.'catalog">Каталог</a>
      <ul><li><a href="'.BASEPATH.'catalog/categoryVacuumCleaners">Категория Пылесосы</a></li>
          <li><a href="'.BASEPATH.'catalog/categoryVacuumCleaners/id111222">Пылесосы id111222</a></li>
          <li><a href="'.BASEPATH.'catalog/id11122">Продукт id1112222</a></li>
          <li><a href="'.BASEPATH.'catalog/xiaomi-mi-robot-vacuum-mop-2">Xiaomi Mi Robot Vacuum Mop</a></li></ul></li>
      <li><a href="'.BASEPATH.'contacts">Контакты</a>
      <ul><li><a href="'.BASEPATH.'contacts/contact-form">Форма обратной связи</a></li></ul></li>
      <li><a href="'.BASEPATH.'delivery">Доставка</a></li>
      <li><a href="'.BASEPATH.'registration-form">Регистрация/Авторизация</a></li>
      <li><a href="'.BASEPATH.'profile/111222">Пользователь id 111222</a>
      <ul><li><a href="'.BASEPATH.'profile/111222/info">Пользователь id 111222. Информация</a></li>
          <li><a href="'.BASEPATH.'profile/111222/reviews">Пользователь id 111222. Отзывы</a></li>
          <li><a href="'.BASEPATH.'profile/111222/orders">Пользователь id 111222. Заказы</a></li></ul></li>
      <li><a href="'.BASEPATH.'profile/112">Пользователь id 112 = Админ</a>
      <ul><li><a href="'.BASEPATH.'profile/112/info">Админ id 112. Информация</a></li>
          <li><a href="'.BASEPATH.'profile/112/reviews">Все отзывы</a></li>
          <li><a href="'.BASEPATH.'profile/112/orders">Все заказы</a></li></ul></li>
      <li><a href="'.BASEPATH.'cart/2256665">Корзина пользователя 2256665</a></li>
      <li><a href="'.BASEPATH.'cart/2256665/order/265478555">Заказ 265478555 пользователя 2256665</a></li>

  </ul>
  ';
}

// Base route (startpage)
Route::add('/', function() {
  (new BasicController())->executeMainPage();
});

// Route to registration form
Route::add('/registration-form', function() {
  (new RegistrationAuthorizationController())->save();
}, 'get');

// Post route to registration-form
Route::add('/registration-form', function() {
  (new RegistrationAuthorizationController())->show();
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
  (new UserController())->getUserInfo($user_id);
});

// Route to profile page->info about user's reviews
Route::add('/profile/([0-9]*)/reviews', function($user_id) {
  (new UserController())->getUserReviews($user_id);
});

// Route to catalog
Route::add('/catalog', function() {
  (new ProductController())->getProducts();
});

// Route to a particular category of products
Route::add('/catalog/category([A-Za-z]*)', function($category_id) {
  (new ProductController())->getProductsByCategory($category_id);
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
Route::add('/catalog/([a-z-0-9-]*)', function($product_name) {
  (new ProductController())->getProductByName($product_name);
});

// Route to cart
Route::add('/cart/([0-9]*)', function($user_id) {
  (new CartController())->show($user_id);
});

// Route to make an order
Route::add('/cart/([0-9]*)/order/([0-9]*)', function($user_id, $order_id) {
  (new CartController())->order($user_id, $order_id);
});

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


