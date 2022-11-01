<?php

namespace Itechart\InternshipProject\View;

use Itechart\InternshipProject\View\BasicView;
use eftec\bladeone\BladeOne;

class MainView extends BasicView
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getMainPage(array $info)
    {
        $title = $info[0]['page_name']; 
        echo $this->template->run("main.main", [
            'categories' => $this->categories,
            'SESSION' => $this->session, 
            'BASEPATH' => BASEPATH, 
            'title' => $title, 
            'info' => $info[0]
        ]);  
    }

    public function getDeliveryPage(array $info)
    {
        $title = $info[0]['page_name']; 
        echo $this->template->run("main.main", [
            'categories' => $this->categories,
            'SESSION' => $this->session, 
            'BASEPATH' => BASEPATH, 
            'title' => $title, 
            'info' => $info[0]
        ]);
    }

    public function getContactsPage(array $info)
    {
        $title = $info[0]['page_name']; 
        echo $this->template->run("main.contacts", [
            'categories' => $this->categories,
            'SESSION' => $this->session, 
            'BASEPATH' => BASEPATH, 
            'title' => $title, 
            'info' => $info[0]
        ]);
    }

    public function showContactForm(array $info, array $values)
    {
        $title = $info[0]['page_name'];  
        echo $this->template->run("main.contacts", [
            'categories' => $this->categories,
            'SESSION' => $this->session, 
            'BASEPATH' => BASEPATH, 
            'title' => $title, 
            'info' => $info[0], 
            'values' => $values
        ]);   
    }
}