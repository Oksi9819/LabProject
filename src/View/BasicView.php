<?php
namespace Itechart\InternshipProject\View;

class BasicView
{
    protected function navi()
    {
        global $BASEPATH;
        echo '
        Навигация:
        <ul>
          <li><a href="'.BASEPATH.'">Главная</a></li>
          <li><a href="'.BASEPATH.'catalog">Каталог</a>
            <ul>
              <li><a href="'.BASEPATH.'catalog/category/VacuumCleaners">Категория Пылесосы</a></li>
              <li><a href="'.BASEPATH.'catalog/category/AirCleaners">Категория Очистители воздуха</a></li>
              <li><a href="'.BASEPATH.'catalog/category/Humidifiers">Категория Увлажнители воздуха</a></li>
              <li><a href="'.BASEPATH.'catalog/category/Lamps">Категория Светильники</a></li>
              <li><a href="'.BASEPATH.'catalog/category/Other">Категория Другое</a></li>
              <li><a href="'.BASEPATH.'catalog/category/VacuumCleaners/id1">Пылесосы артикул "1"</a></li>
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
          <li><a href="'.BASEPATH.'profile/3">Пользователь id 3</a>
            <ul>
              <li><a href="'.BASEPATH.'profile/3/info">Пользователь id 3. Информация</a></li>
              <li><a href="'.BASEPATH.'profile/5/reviews">Пользователь id 5. Отзывы</a></li>
              <li><a href="'.BASEPATH.'profile/3/orders">Пользователь id 3. Заказы</a></li>
            </ul>
          </li>
          <li><a href="'.BASEPATH.'profile/1">Пользователь id 1 = Админ</a>
            <ul>
              <li><a href="'.BASEPATH.'profile/1/info">Админ id 1. Информация</a></li>
              <li><a href="'.BASEPATH.'profile/1/reviews">Все отзывы</a></li>
              <li><a href="'.BASEPATH.'profile/1/orders">Все заказы</a></li>
            </ul>
          </li>
          <li><a href="'.BASEPATH.'cart/2256665">Корзина пользователя 2256665</a></li>
        </ul>
        ';
    }
}