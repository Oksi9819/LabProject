<?php
// Autoload files using composer
require_once __DIR__ . '/vendor/autoload.php';

// Use this namespace
use Steampixel\Route;

// Add your first route
Route::add('/', function() {
  echo 'Welcome :-)';
});

// Run the router
Route::run('/');
?>
