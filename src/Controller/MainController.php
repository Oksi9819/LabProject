<?php

namespace Itechart\InternshipProject\Controller;

use Itechart\InternshipProject\View\MainView;
use Itechart\InternshipProject\Model\MainModel;
use Itechart\InternshipProject\Controller\BasicController;

class MainController extends BasicController
{
    public $mainModel;
    public $mainView;

    public function __construct()
    {
        $this->mainModel = new MainModel();
        $this->mainView = new MainView();
    }
    
    public function executeMainPage()
    {
        return $this->mainView->getMainPage($this->mainModel->getMainInfo());
    }

    public function executeContactsPage()
    {
        return $this->mainView->getContactsPage($this->mainModel->getContactsInfo());
    }

    public function executeDeliveryPage()
    {
        return $this->mainView->getDeliveryPage($this->mainModel->getDeliveryInfo());
    }
    
    public function sendContactForm()
    {
        return $this->mainView->sendContactForm();   
    }

    public function showContactForm()
    {
        return $this->mainView->showContactForm($this->mainModel->setContact());
    }

}