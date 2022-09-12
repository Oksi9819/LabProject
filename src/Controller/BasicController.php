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
        navi();
        echo 'There is contact-form here';
        echo '<form method="post"><input type="text" name="test"><input type="submit" value="send"></form>';
    }

    public function showContactForm()
    {
        navi();
        echo 'The form has been sent:<br>';
        print_r($_POST);
    }

}