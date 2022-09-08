<?php
// Autoload files using composer
require_once __DIR__ . '/vendor/autoload.php';

// Use this namespace
use Steampixel\Route;

define('BASEPATH','/LabProject/');

function navi() {
  echo '
  Navigation:
  <ul>
      <li><a href="'.BASEPATH.'">Главная</a></li>
      <li><a href="'.BASEPATH.'catalog">Каталог</a>
      <ul><li><a href="'.BASEPATH.'catalog/category/A">Категория 1</a></li></ul></li>
      <li><a href="'.BASEPATH.'contacts">Контакты</a></li>
      <li><a href="'.BASEPATH.'delivery">Доставка</a></li> 
  </ul>
  ';
}

// Base route (startpage)
Route::add('/', function() {
  navi();
  echo 'Welcome to the main page!';
});

// Route to registration form
Route::add('/registration-form', function() {
  navi();
  echo 'There is registration form here';
}, 'get');

// Post route to registration-form
Route::add('/registration-form', function() {
  navi();
  echo 'You are already registered:<br>';
  print_r($_POST);
}, 'post');

// Route to catalog
Route::add('/catalog', function() {
  navi();
  echo 'It is catalog here';
});

// Route to a particular category of products
Route::add('/catalog/category/([A-Za-z]*)', function($category_id) {
  navi();
  echo 'There are products of category:'.$category_id.'<br>';
});

// Route to product card
Route::add('/catalog/category/([A-Za-z]*)/([a-z-0-9-]*)', function($category_id, $product_id) {
  navi();
  echo 'It is a card of product: '.$product_id.'<br>';
});

// Route to cart
Route::add('/cart/([0-9]*)', function($user_id) {
  navi();
  echo 'It is cart of client with id: '.$user_id.'<br>';
});

// Route to make an order
Route::add('/cart/([0-9]*)/order/([0-9]*)', function($user_id, $order_id) {
  navi();
  echo 'It is an order '.$order_id.' of client '.$user_id.'.<br>';
});

// Route to contacts
Route::add('/contacts', function() {
  navi();
  echo 'It is page with contacts here';
});

// Route to contact-form
Route::add('/contacts/contact-form', function() {
  navi();
  echo 'There is contact-form here';
}, 'get');

// Post route to contact-form
Route::add('/contacts/contact-form', function() {
  navi();
  echo 'The form has been sent:<br>';
  print_r($_POST);
}, 'post');

// Route to delivery page
Route::add('/delivery', function() {
  navi();
  echo 'It is page about delivery here';
});

Route::run(BASEPATH);


