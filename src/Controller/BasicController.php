<?php

namespace Itechart\InternshipProject\Controller;

use Itechart\InternshipProject\Model\BasicModel;
use Itechart\InternshipProject\View\BasicView;

class BasicController
{
    public function executeMainPage()
    {
        return (new BasicView())->getMainPage((new BasicModel())->getMainInfo());
    }

    public function executeContactsPage()
    {
        return (new BasicView())->getContactsPage((new BasicModel())->getContactsInfo());
    }

    public function executeDeliveryPage()
    {
        return (new BasicView())->getDeliveryPage((new BasicModel())->getDeliveryInfo());
    }
    
    public function sendContactForm()
    {
        return (new BasicView())->sendContactForm();   
    }

    public function showContactForm()
    {
        return (new BasicView())->showContactForm();
    }

}