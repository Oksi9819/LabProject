<?php

namespace Itechart\InternshipProject\View;

use Itechart\InternshipProject\Model\BasicModel;

class MainView
{
    public function getMainPage(array $info)
    {
        navi();
        echo "<b>".$info['topic']."</b><br><br>";
        echo $info['desc']."<br>";
    }

    public function getDeliveryPage(array $info)
    {
        navi();
        echo "<b>".$info['topic']."</b><br><br>";
        echo $info['desc']."<br>";
    }

    public function getContactsPage(array $info)
    {
        navi();
        echo "<b>".$info['topic']."</b><br><br>";
        echo "Номера телефонов: ".$info['phone_1']."<br>".$info['phone_2']."<br>";
        echo "Адрес: ".$info['addres']."<br>";
    }

    public function sendContactForm()
    {
        navi();
        echo '<b>Заполните форму для связи: </b><br><br>';
        echo '<form method="post">Ваше имя: <input type="text" name="contact_name"><br>Ваш email для связи: <input type="email" name="contact_email"><br><input type="text" name="contact_text" value="Введите ваше сообщение"><br><input type="submit" value="Отправить"></form>';
    }

    public function showContactForm()
    {
        navi();
        echo '<b>Форма успешно отправлена:</b><br><br>';
        echo 'Ваше имя: '.$_POST['contact_name'].'<br>Ваш email для связи: '.$_POST['contact_email'].'<br>Ваше сообщение: '.$_POST['contact_text'].'<br>';
    }
}