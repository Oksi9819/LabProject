<?php
namespace Itechart\InternshipProject\View;

use eftec\bladeone\BladeOne;
use Itechart\InternshipProject\Model\CategoryModel;

class BasicView
{
    protected $template;
    protected $session;
    protected $categories;
    protected $year;

    public function __construct()
    {
        global $BASEPATH;
        $templates = $BASEPATH.'src/Templates';
        $cache = $BASEPATH.'cache';
        if (isset($_SESSION['user'])) {
            $this->session = $_SESSION['user'];
        } else $this->session = NULL;
        $this->categories = (new CategoryModel())->getCategories();
        $this->year = date("Y");
        $this->template = new BladeOne($templates, $cache, BladeOne::MODE_AUTO);
    }

    public function errorView(string $message)
    {
        $title = "error page"; 
        echo $this->template->run("basic.error", [
            'categories' => $this->categories,
            'SESSION' => $this->session, 
            'BASEPATH' => BASEPATH, 
            'title' => $title, 
            'message' => $message,
            'year' => $this->year
        ]);  
    }
}