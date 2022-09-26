<?php
namespace Itechart\InternshipProject\View;

class BasicView
{
    public function navi()
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
              <li><a href="'.BASEPATH.'profile/1/info">Пользователь id 1. Информация</a></li>
              <li><a href="'.BASEPATH.'profile/2/reviews">Пользователь id 2. Отзывы</a></li>
              <li><a href="'.BASEPATH.'profile/3/orders">Пользователь id 3. Заказы</a></li>
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
    }
}