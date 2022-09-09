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

define('BASEPATH','/LabProject/');

function navi() {
  echo '
  Navigation:
  <ul>
      <li><a href="'.BASEPATH.'">Главная</a></li>
      <li><a href="'.BASEPATH.'catalog">Каталог</a>
      <ul><li><a href="'.BASEPATH.'catalog/category/A">Категория A</a></li></ul>
      <ul><li><a href="'.BASEPATH.'catalog/category/A/Lamba335">Категория A Ламба335</a></li></ul></li>
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
  (new RegistrationFormController())->save();
}, 'get');

// Post route to registration-form
Route::add('/registration-form', function() {
  (new RegistrationFormController())->show();
}, 'post');

// Route to catalog
Route::add('/catalog', function() {
  (new CatalogController())->execute();
});

// Route to a particular category of products
Route::add('/catalog/category/([A-Za-z]*)', function($category_id) {
  (new CatalogController())->getCategory($category_id);
});

// Route to product card
Route::add('/catalog/category/([A-Za-z]*)/([a-z-0-9-]*)', function($category_id, $product_id) {
  (new CatalogController())->getProductByCategoryAndId($category_id, $product_id);
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
  (new ContactsController())->execute();
});

// Route to contact-form
Route::add('/contacts/contact-form', function() {
  (new ContactsController())->send();
}, 'get');

// Post route to contact-form
Route::add('/contacts/contact-form', function() {
  (new ContactsController())->show();
}, 'post');

// Route to delivery page
Route::add('/delivery', function() {
  (new DeliveryController())->execute();
});

Route::run(BASEPATH);


