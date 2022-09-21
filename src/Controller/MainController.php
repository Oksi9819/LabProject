<?php

namespace Itechart\InternshipProject\Controller;

use Itechart\InternshipProject\Model\MainModel;
use Itechart\InternshipProject\View\MainView;

class MainController
{
    public function executeMainPage()
    {
        return (new MainView())->getMainPage((new MainModel())->getMainInfo());
    }

    public function executeContactsPage()
    {
        return (new MainView())->getContactsPage((new MaincModel())->getContactsInfo());
    }

    public function executeDeliveryPage()
    {
        return (new MainView())->getDeliveryPage((new MainModel())->getDeliveryInfo());
    }
    
    public function sendContactForm()
    {
        return (new MainView())->sendContactForm();   
    }

    public function showContactForm()
    {
        return (new MainView())->showContactForm();
    }

}