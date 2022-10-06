<?php
namespace Itechart\InternshipProject\View;

use eftec\bladeone\BladeOne;
use Itechart\InternshipProject\Model\CategoryModel;

class BasicView
{
    protected $template;
    protected $session;
    protected $categories;

    protected function __construct()
    {
        global $BASEPATH;
        $templates = $BASEPATH.'src/Templates';
        $cache = $BASEPATH.'cache';
        if (isset($_SESSION['user'])) {
            $this->session = $_SESSION['user'];
        } else $this->session = NULL;
        $this->categories = (new CategoryModel())->getCategories();
        $this->template = new BladeOne($templates, $cache, BladeOne::MODE_AUTO);
    }

    protected function main($title)
    {
        return $this->template->run("basic.basic", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title]);
    }

    public function errorView(string $message, array $categories)
    {
        $this->navi($categories);
        echo "Oops! There seems to be an error. Details: $message.";
    }
}