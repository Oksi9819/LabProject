<?php
require_once __DIR__.'/View/View.php';

class HomeController
{
    public function execute()
    {
        (new View/HomeView())->render();
    }
}