<?php

namespace Itechart\InternshipProject\View;

use Itechart\InternshipProject\View\BasicView;

class MainView extends BasicView
{
    public function getMainPage(array $info)
    {
        navi();
        echo "<b>".$info[0]['topic']."</b><br><br>";
        echo $info[0]['desc']."<br>";
    }

    public function getDeliveryPage(array $info)
    {
        navi();
        echo "<b>".$info[0]['topic']."</b><br><br>";
        echo $info[0]['desc']."<br>";
    }

    public function getContactsPage(array $info)
    {
        navi();
        echo "<b>".$info[0]['topic']."</b><br><br>";
        echo "Номера телефонов: ".$info[0]['phone_1']."<br>".$info[0]['phone_2']."<br>";
        echo "Адрес: ".$info[0]['address']."<br>";
    }

    public function sendContactForm()
    {
        navi();
        echo '<b>Заполните форму для связи: </b><br><br>';
        echo '<form method="post">Ваше имя: <input type="text" name="contact_name"><br>Ваш email для связи: <input type="email" name="contact_email"><br>Введите ваше сообщение: <input type="text" name="contact_text"><br><input type="submit" value="Отправить"></form>';
    }

    public function showContactForm(array $values)
    {
        navi();
        echo '<b>Форма успешно отправлена:</b><br><br>';
        echo 'Ваше имя: '.$values['contact_name'].'<br>Ваш email для связи: '.$values['contact_email'].'<br>Ваше сообщение: '.$values['contact_text'].'<br>';
    }
}