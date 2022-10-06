<?php
namespace Itechart\InternshipProject\View;

use eftec\bladeone\BladeOne;
use Itechart\InternshipProject\Model\CategoryModel;

class BasicView
{
    protected $template;

    protected function __construct()
    {
        global $BASEPATH;
        $templates = $BASEPATH.'src/Templates';
        $cache = $BASEPATH.'cache';
        $this->template = new BladeOne($templates, $cache, BladeOne::MODE_AUTO);
    }

    protected function basicPage()
    {
      $categories = (new CategoryModel())->getCategories();
      echo $this->template->run("basic.basic", ['categories'=>$categories,'SESSION'=>$_SESSION['user'], 'BASEPATH'=>BASEPATH, 'title'=>'BasicPage']);
    }

    public function errorView(string $message, array $categories)
    {
        $this->navi($categories);
        echo "Oops! There seems to be an error. Details: $message.";
    }
}