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
}