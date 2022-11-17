<?php
session_start();
// Autoload files using composer
require_once __DIR__ . '/vendor/autoload.php';
//require_once __DIR__ . '/database.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$dotenv->required(['DB_USER', 'DB_PASS', 'DB_NAME']);

// Use this namespace
use Dotenv\Dotenv;
use Steampixel\Route;
use Itechart\InternshipProject\Controller\CartController;
use Itechart\InternshipProject\Controller\MainController;
use Itechart\InternshipProject\Controller\UserController;
use Itechart\InternshipProject\Controller\BasicController;
use Itechart\InternshipProject\Controller\ProductController;

/*createDB();
createTables();
fulfilTables();*/

//Connect to the database
$conn = new mysqli('localhost', $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);
$conn->set_charset('utf8mb4');
if ($conn->connect_error) {
    die('Failed to connect to database: '.$conn->connect_error);
}

define('BASEPATH','/');

// Base route (startpage)
Route::add('/', function() {
  (new MainController())->executeMainPage();
});

//Route to cart
Route::add('/cart', function() {
  (new CartController())->show();
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

// Route to profile page->info about user
Route::add('/profile/([0-9]*)/info', function($user_id) {
  (new UserController())->getUserInfo($user_id);
}, 'get');

// Route to profile page
Route::add('/profile/([0-9]*)', function($user_id) {
  (new UserController())->getUserInfo($user_id);
}, 'get');

// Route to profile page
Route::add('/([A-Za-z]*)/profile/([0-9]*)', function($method, $user_id) {
  (new UserController())->$method($user_id);
}, 'post');

// Route to profile page
Route::add('/([A-Za-z]*)/profile/([0-9]*)', function($method, $user_id) {
  (new UserController())->$method($user_id);
}, 'get');

// Route to profile page->info about user's orders
Route::add('/profile/([0-9]*)/orders', function($user_id) {
  (new UserController())->getUserOrders($user_id);
}, 'get');

// Route to profile page->info about user's reviews
Route::add('/profile/([0-9]*)/reviews', function($user_id) {
  (new UserController())->getUserReviews($user_id);
}, 'get');

// Route to profile page->info about all users
Route::add('/profile/([0-9]*)/users', function($user_id) {
  (new UserController())->getUsers($user_id);
}, 'get');

// Route to profile page->info about all admins
Route::add('/profile/([0-9]*)/admins', function($user_id) {
  (new UserController())->getAdmins($user_id);
}, 'get');

// Route to profile page->add new review
Route::add('/profile/([0-9]*)/reviews/set-review', function($user_id) {
  (new UserController())->setReview($user_id);
}, 'post');

// Route to profile page->edit review text
Route::add('/profile/([0-9]*)/reviews/update-review-text', function($user_id) {
  (new UserController())->editReviewText($user_id);
}, 'post');

// Route to profile page->edit review text
Route::add('/profile/([0-9]*)/reviews/delete-review', function($user_id) {
  (new UserController())->deleteReview($user_id);
}, 'post');

// Route to profile page->set new order
Route::add('/profile/([0-9]*)/orders/set-order', function($user_id) {
  (new UserController())->setOrder($user_id);
}, 'post');

// Route to profile page->edit order address
Route::add('/profile/([0-9]*)/orders/edit-order-address/([0-9]*)', function($user_id, $order_id) {
  (new UserController())->editOrderAddress($user_id, $order_id);
}, 'post');

// Route to profile page->edit order status
Route::add('/profile/([0-9]*)/orders/edit-order-status/([0-9]*)', function($user_id, $order_id) {
  (new UserController())->editOrderStatus($user_id, $order_id);
}, 'post');

// Route to profile page->cancel order
Route::add('/profile/([0-9]*)/orders/cancel-order/([0-9]*)', function($user_id, $order_id) {
  (new UserController())->cancelOrder($user_id, $order_id);
}, 'post');

// Route to catalog
Route::add('/catalog', function() {
  (new ProductController())->getProducts();
}, 'get');

// Route to catalog->sorted
Route::add('/catalog/sort', function() {
  (new ProductController())->getProductsSorted();
}, 'post');

// Route to catalog->admin functions
Route::add('/([A-Za-z]*)/catalog', function($method) {
  (new ProductController())->$method();
}, 'post');

// Route to a particular category of products
Route::add('/catalog/category/([A-Za-z]*)', function($category) {
  (new ProductController())->getProductsByCategory($category);
}, 'get');

// Route to a particular category of products
Route::add('/catalog/category/([A-Za-z]*)', function($category) {
  (new ProductController())->getProductsByCategorySorted($category);
}, 'post');

// Route to a particular category of products->sorted
Route::add('/catalog/category/([A-Za-z]*)/sort', function($category) {
  (new ProductController())->getProductsByCategorySorted($category);
}, 'post');

// Route to product card
Route::add('/catalog/category/([A-Za-z]*)/id([0-9]*)', function($category_id, $product_id) {
  (new ProductController())->getProductById($product_id);
}, 'get');

// Route to product card by product Id
Route::add('/catalog/id([0-9]*)', function($product_id) {
  (new ProductController())->getProductById($product_id);
}, 'get');

// Route to product card by product Id
Route::add('/catalog/([A-Za-z]*)/id([0-9]*)', function($method, $product_id) {
  (new ProductController())->$method($product_id);
}, 'post');

// Route to product card by product name
Route::add('/catalog/search', function($product_name) {
  (new ProductController())->getProductByName($product_name);
});

// Route to make an order
Route::add('/order', function() {
  (new CartController())->order();
}, 'post');

// Route to contacts
Route::add('/contacts', function() {
  (new MainController())->executeContactsPage();
});

// Post route to contact-form
Route::add('/contacts/contact-form', function() {
  (new MainController())->showContactForm();
}, 'post');

// Route to delivery page
Route::add('/delivery', function() {
  (new MainController())->executeDeliveryPage();
});

Route::run(BASEPATH);


