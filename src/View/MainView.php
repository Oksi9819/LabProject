<?php

namespace Itechart\InternshipProject\View;

use Itechart\InternshipProject\Model\BasicModel;

class MainView
{
    public function getMainPage(array $info)
    {
        global $BASEPATH;
        echo '
        Навигация:
        <ul>
          <li><a href="'.BASEPATH.'">Главная</a></li>
          <li><a href="'.BASEPATH.'catalog">Каталог</a>
            <ul>
              <li><a href="'.BASEPATH.'catalog/categoryVacuumCleaners">Категория Пылесосы</a></li>
              <li><a href="'.BASEPATH.'catalog/categoryAirCleaners">Категория Очистители воздуха</a></li>
              <li><a href="'.BASEPATH.'catalog/categoryHumidifiers">Категория Увлажнители воздуха</a></li>
              <li><a href="'.BASEPATH.'catalog/categoryLamps">Категория Светильники</a></li>
              <li><a href="'.BASEPATH.'catalog/categoryOther">Категория Другое</a></li>
              <li><a href="'.BASEPATH.'catalog/categoryVacuumCleaners/id1">Пылесосы артикул "1"</a></li>
              <li><a href="'.BASEPATH.'catalog/id2">Продукт с артикулом "2"</a></li>
              <li><a href="'.BASEPATH.'catalog/search">Поисковая строка в каталоге</a></li>
            </ul>
          </li>
          <li><a href="'.BASEPATH.'contacts">Контакты</a>
            <ul>
              <li><a href="'.BASEPATH.'contacts/contact-form">Форма обратной связи</a></li>
            </ul>
          </li>
          <li><a href="'.BASEPATH.'delivery">Доставка</a></li>
          <li><a href="'.BASEPATH.'registration-form">Регистрация</a></li>
          <li><a href="'.BASEPATH.'authorization-form">Авторизация</a></li>
          <li><a href="'.BASEPATH.'profile/111222">Пользователь id 111222</a>
            <ul>
              <li><a href="'.BASEPATH.'profile/111222/info">Пользователь id 111222. Информация</a></li>
              <li><a href="'.BASEPATH.'profile/111222/reviews">Пользователь id 111222. Отзывы</a></li>
              <li><a href="'.BASEPATH.'profile/111222/orders">Пользователь id 111222. Заказы</a></li>
            </ul>
          </li>
          <li><a href="'.BASEPATH.'profile/112">Пользователь id 112 = Админ</a>
            <ul>
              <li><a href="'.BASEPATH.'profile/112/info">Админ id 112. Информация</a></li>
              <li><a href="'.BASEPATH.'profile/112/reviews">Все отзывы</a></li>
              <li><a href="'.BASEPATH.'profile/112/orders">Все заказы</a></li>
            </ul>
          </li>
          <li><a href="'.BASEPATH.'cart/2256665">Корзина пользователя 2256665</a></li>
        </ul>
        ';
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