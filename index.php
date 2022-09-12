<?php
// Autoload files using composer
require_once __DIR__ . '/vendor/autoload.php';


spl_autoload_register(static function($className){
  $file = __DIR__. '\\src\\Controller\\' . $className . '.php';
  $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);

  if (file_exists($file)) {
      require_once($file);
  }
});

// Use this namespace
use Steampixel\Route;
use Itechart\InternshipProject\Controller\ProductController;

define('BASEPATH','/LabProject/');

function navi() {
  echo '
  Navigation:
  <ul>
      <li><a href="'.BASEPATH.'">Главная</a></li>
      <li><a href="'.BASEPATH.'catalog">Каталог</a>
      <ul><li><a href="'.BASEPATH.'catalog/categoryVacuumCleaners">Категория Пылесосы</a></li>
          <li><a href="'.BASEPATH.'catalog/categoryVacuumCleaners/id111222">Пылесосы id111222</a></li>
          <li><a href="'.BASEPATH.'catalog/id111222">Продукт id111222</a></li>
          <li><a href="'.BASEPATH.'catalog/xiaomi-mi-robot-vacuum-mop-2">Xiaomi Mi Robot Vacuum Mop</a></li></ul></li>
      <li><a href="'.BASEPATH.'contacts">Контакты</a>
      <ul><li><a href="'.BASEPATH.'contacts/contact-form">Форма обратной связи</a></li></ul></li>
      <li><a href="'.BASEPATH.'delivery">Доставка</a></li>
      <li><a href="'.BASEPATH.'registration-form">Регистрация</a></li>
      <li><a href="'.BASEPATH.'cart/2256665">Корзина пользователя 2256665</a></li>
      <li><a href="'.BASEPATH.'cart/2256665/order/265478555">Заказ 265478555 пользователя 2256665</a></li>
  </ul>
  ';
}

// Base route (startpage)
Route::add('/', function() {
  (new HomeController())->execute();
});

// Route to registration form
Route::add('/registration-form', function() {
  (new RegistrationAuthorizationController())->save();
}, 'get');

// Post route to registration-form
Route::add('/registration-form', function() {
  (new RegistrationAuthorizationController())->show();
}, 'post');

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
  (new BasicController())->execute();
});

// Route to contact-form
Route::add('/contacts/contact-form', function() {
  (new BasicController())->send();
}, 'get');

// Post route to contact-form
Route::add('/contacts/contact-form', function() {
  (new BasicController())->show();
}, 'post');

// Route to delivery page
Route::add('/delivery', function() {
  (new BasicController())->execute();
});

Route::run(BASEPATH);


