<?php

namespace Itechart\InternshipProject\View;

class UserView
{
    public function renderUserPage(array $user)
    {
        navi();
        
        echo "Данные о пользователе: <br>";
        echo "Id: ".$user['user_id']."<br>";
        echo "Фамилия: ".$user['user_name']."<br>";
        echo "Имя: ".$user['user_surname']."<br>";
        echo "День рождения: ".$user['user_birthday']."<br>";
        echo "Номер телефона: ".$user['user_phone']."<br>";
        echo "Адрес: ".$user['user_address']."<br>";
        echo "Email: ".$user['user_email']."<br>";
    }

    public function renderUserReviewsPage(array $reviews)
    {
        navi();
        $i=1;
        foreach ($reviews as $review)
        {
            echo $i."-ый отзыв:".$review."<br>";
            $i++;
        }
    }

    public function renderUserOrdersPage(array $orders)
    {
        navi();
        $i=1;
        echo "Код заказа        ";
        echo "Список товаров заказа     ";
        echo "Сумма заказа      ";
        echo "Адрес заказа<br>";
        foreach ($orders as $order)
        {
            echo $i."-ый заказ:<br>";
            echo $order['order_id']." \t\t";
            foreach ($order['order_product_list'] as $order_product)
            {
                echo $order_product." ";
            }
            echo $order['order_sum']." BYN ";
            echo $order['order_address']."<br>";
            $i++;
        }
    }

    public function renderAdminPage(array $user)
    {
        navi();
        
        echo "Данные об Администраторе: <br>";
        echo "Id: ".$user['user_id']."<br>";
        echo "Фамилия: ".$user['user_name']."<br>";
        echo "Имя: ".$user['user_surname']."<br>";
        echo "День рождения: ".$user['user_birthday']."<br>";
        echo "Номер телефона: ".$user['user_phone']."<br>";
        echo "Адрес: ".$user['user_address']."<br>";
        echo "Email: ".$user['user_email']."<br>";
    }

    public function renderAdminReviewsPage(array $reviews)
    {
        navi();
        $i=1;
        foreach ($reviews as $review)
        {
            echo $i."-ый отзыв:".$review."<br>";
            $i++;
        }
    }

    public function renderAdminOrdersPage(array $orders)
    {
        navi();
        $i=1;
        echo "Все Заказы<br>";
        echo "Код заказа        ";
        echo "Список товаров заказа     ";
        echo "Сумма заказа      ";
        echo "Адрес заказа      ";
        echo "Телефон заказа        ";
        echo "Email заказа      ";
        foreach ($orders as $order)
        {
            echo $i."-ый заказ:<br>";
            echo $order['order_id']." \t\t";
            foreach ($order['order_product_list'] as $order_product)
            {
                echo $order_product." ";
            }
            echo $order['order_sum']." BYN ";
            echo $order['order_address']." ";
            echo $order['order_phone']." ";
            echo $order['order_email']."<br>";
            $i++;
        }
    }
}