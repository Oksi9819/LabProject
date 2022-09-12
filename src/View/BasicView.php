<?php

namespace Itechart\InternshipProject\View;

use Itechart\InternshipProject\Model\BasicModel;

class BasicView
{
    public function getMainPage(array $info)
    {
        navi();
        echo $info['topic']."<br>";
        echo $info['desc']."<br>";
    }

    public function getDeliveryPage(array $info)
    {
        navi();
        echo $info['topic']."<br>";
        echo $info['desc']."<br>";
    }

    public function getContactsPage(array $info)
    {
        navi();
        echo $info['topic']."<br>";
        echo "Номера телефонов: ".$info['phone_1']."<br>".$info['phone_2']."<br>";
        echo "Адрес: ".$info['addres']."<br>";
    }
}