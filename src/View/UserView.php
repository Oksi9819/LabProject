<?php

namespace Itechart\InternshipProject\View;

use Itechart\InternshipProject\View\BasicView;

class UserView extends BasicView
{
    public function sendUser()
    {
        parent::navi();
        echo '<b>Заполните пожалуйста форму регистрации: </b><br><br>';
        echo '<form method="post">Введите фамилию: <input type="text" name="user_surname" required="required"><br>Введите фамилию: <input type="text" name="user_name" required="required"><br>Введите дату рождения: <input type="date" name="user_birthday" required="required"><br>Введите телефон: <input type="tel" name="user_phone" required="required"><br>Введите адрес: <input type="text" name="user_address" required="required"><br>Введите email: <input type="email" name="user_email" value="Введите email" required="required"><br>Введите пароль: <input type="password" name="user_password" maxlength="8" required="required"><br><input type="submit" name="submit_reg_user" value="Зарегистрироваться"></form>';
    }

    public function setUser($result)
    {
        parent::navi();
        echo $result." Вы успешно зарегистрировались!:<br>Далее необходимо <a href='/authorization-form'>авторизоваться!</a><br>";
    }

    public function authUser()
    {
        parent::navi();
        echo '<b>Заполните пожалуйста поля авторизации: </b><br><br>';
        echo '<form method="post">Введите email: <input type="email" name="user_email"><br>Введите пароль: <input type="password" name="user_password" maxlength="8"><br><input type="submit" value="Зарегистрироваться"></form>';
    }

    public function renderUserPage(array $user)
    {
        parent::navi();
        echo "Данные о пользователе: <br>";
        echo "Id: ".$user[0]['user_id']."<br>";
        echo "Фамилия: ".$user[0]['user_name']."<br>";
        echo "Имя: ".$user[0]['user_surname']."<br>";
        echo "День рождения: ".$user[0]['user_birthday']."<br>";
        echo "Номер телефона: ".$user[0]['user_phone']."<br>";
        echo "Адрес: ".$user[0]['user_address']."<br>";
        echo "Email: ".$user[0]['user_email']."<br><br>";
        //Перейти в <a href='/profile/".$user[0]['user_id']."/info'>профиль!</a>";
        echo "Перейти в <a href='/profile/".$user[0]['user_id']."/orders'>заказы.</a><br>";
        echo "Перейти в <a href='/profile/".$user[0]['user_id']."/reviews'>отзывы.</a><br><br>";
        echo '<b>Изменить сведения о пользователе:</b><br>
        <form method="post" name="update_user_info">
            Введите фамилию: <input type="text" name="new_surname" required="required"><br>
            Введите фамилию: <input type="text" name="new_name" required="required"><br>
            Введите дату рождения: <input type="date" name="new_birthday" required="required"><br>
            Введите телефон: <input type="tel" name="new_phone" required="required"><br>
            Введите адрес: <input type="text" name="new_address" required="required"><br>
            Введите email: <input type="email" name="new_email" value="Введите email" required="required"><br>
            <input type="submit" name="submit_update_user"><br>
        </form><br>
        <b>Изменить пароль:</b><br>
        <form method="post" name="update_user_pass">
            Введите пароль: <input type="password" name="user_pass" maxlength="8"><br>
            повторите пароль: <input type="password" name="user_pass_check" maxlength="8"><br>
            <input type="submit" name="submit_update_pass"><br>
        </form><br>
        <b>Удалить пользователя:</b><br>
        <form method="post" name="delete_user_form">
            <input type="submit" name="submit_delete_user" value = DELETE><br>
        </form><br>';
    }

    public function renderUserDeletedPage( string $result, int $user_id)
    {
        parent::navi();
        echo $result.' Пользователь с id: '.$user_id.' был удален.<br>';
    }

    public function renderUserReviewsPage(array $reviews)
    {
        $i=1;
        foreach ($reviews as $review) {
            echo $i."-ый отзыв:".$review."<br>";
            $i++;
        }
    }

    public function renderUserOrdersPage(array $orders)
    {
        $i=1;
        echo "Код заказа        ";
        echo "Список товаров заказа     ";
        echo "Сумма заказа      ";
        echo "Адрес заказа<br>";
        foreach ($orders as $order) {
            echo $i."-ый заказ:<br>";
            echo $order['order_id']." \t\t";
            foreach ($order['order_product_list'] as $order_product) {
                echo $order_product." ";
            }
            echo $order['order_sum']." BYN ";
            echo $order['order_address']."<br>";
            $i++;
        }
    }

    public function renderAdminPage(array $user)
    {
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
        $i=1;
        foreach ($reviews as $review) {
            echo $i."-ый отзыв:".$review."<br>";
            $i++;
        }
    }

    public function renderAdminOrdersPage(array $orders)
    {
        $i=1;
        echo "Все Заказы<br>";
        echo "Код заказа        ";
        echo "Список товаров заказа     ";
        echo "Сумма заказа      ";
        echo "Адрес заказа      ";
        echo "Телефон заказа        ";
        echo "Email заказа      ";
        foreach ($orders as $order) {
            echo $i."-ый заказ:<br>";
            echo $order['order_id']." <br>";
            foreach ($order['order_product_list'] as $order_product) {
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