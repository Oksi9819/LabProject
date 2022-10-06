<?php

namespace Itechart\InternshipProject\View;

use Itechart\InternshipProject\View\BasicView;
use Itechart\InternshipProject\Model\CategoryModel;
use eftec\bladeone\BladeOne;

class MainView extends BasicView
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getMainPage(array $info)
    {
        $title = "Main Page"; 
        echo $this->template->run("main.main", ['categories'=>$this->categories,'SESSION'=>$this->session, 'BASEPATH'=>BASEPATH, 'title'=>$title, 'info'=>$info[0]]);  
    }

    public function getDeliveryPage(array $info, array $categories)
    {
        $this->navi($categories);
        echo "<b>".$info[0]['topic']."</b><br><br>";
        echo $info[0]['desc']."<br>";
    }

    public function getContactsPage(array $info, array $categories)
    {
        $this->navi($categories);
        echo "<b>".$info[0]['topic']."</b><br><br>";
        echo "Номера телефонов: ".$info[0]['phone_1']."<br>".$info[0]['phone_2']."<br>";
        echo "Адрес: ".$info[0]['address']."<br>";
    }

    public function sendContactForm(array $categories)
    {
        $this->navi($categories);
        echo '<b>Заполните форму для связи: </b><br><br>';
        echo '<form method="post">Ваше имя: <input type="text" name="contact_name"><br>Ваш email для связи: <input type="email" name="contact_email"><br>Введите ваше сообщение: <input type="text" name="contact_text"><br><input type="submit" value="Отправить"></form>';
    }

    public function showContactForm(array $values, array $categories)
    {
        $this->navi($categories);
        echo '<b>Форма успешно отправлена:</b><br><br>';
        echo 'Ваше имя: '.$values['contact_name'].'<br>Ваш email для связи: '.$values['contact_email'].'<br>Ваше сообщение: '.$values['contact_text'].'<br>';
    }
}