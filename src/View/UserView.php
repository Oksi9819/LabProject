<?php

namespace Itechart\InternshipProject\View;

use Itechart\InternshipProject\View\BasicView;

class UserView extends BasicView
{
    public function sendUser()
    {
        $this->navi();
        echo '<b>Заполните пожалуйста форму регистрации: </b><br><br>';
        echo '<form method="post">Введите фамилию: <input type="text" name="user_surname" required="required"><br>Введите фамилию: <input type="text" name="user_name" required="required"><br>Введите дату рождения: <input type="date" name="user_birthday" required="required"><br>Введите телефон: <input type="tel" name="user_phone" required="required"><br>Введите адрес: <input type="text" name="user_address" required="required"><br>Введите email: <input type="email" name="user_email" value="Введите email" required="required"><br>Введите пароль: <input type="password" name="user_password" maxlength="8" required="required"><br><input type="submit" name="submit_reg_user" value="Зарегистрироваться"></form>';
    }

    public function setUser($result)
    {
        $this->navi();
        echo $result." Вы успешно зарегистрировались!:<br>Далее необходимо <a href='/authorization-form'>авторизоваться!</a><br>";
    }

    public function authUser()
    {
        $this->navi();
        echo '<b>Заполните пожалуйста поля авторизации: </b><br><br>';
        echo '<form method="post">Введите email: <input type="email" name="user_email"><br>Введите пароль: <input type="password" name="user_password" maxlength="8"><br><input type="submit" value="Зарегистрироваться"></form>';
    }

    public function renderUserPage(array $user)
    {
        $this->navi();
        echo "Данные о пользователе: <br>";
        echo "Id: ".$user[0]['user_id']."<br>";
        echo "Фамилия: ".$user[0]['user_name']."<br>";
        echo "Имя: ".$user[0]['user_surname']."<br>";
        echo "День рождения: ".$user[0]['user_birthday']."<br>";
        echo "Номер телефона: ".$user[0]['user_phone']."<br>";
        echo "Адрес: ".$user[0]['user_address']."<br>";
        echo "Email: ".$user[0]['user_email']."<br><br>";
        echo "Перейти в <a href='/profile/".$user[0]['user_id']."/orders'>заказы.</a><br>";
        echo "Перейти в <a href='/profile/".$user[0]['user_id']."/reviews'>отзывы.</a><br><br>";
        echo '<b>Изменить сведения о пользователе:</b><br>
        <form method="post" name="update_user_info">
            Введите фамилию: <input type="text" name="new_surname"><br>
            Введите имя: <input type="text" name="new_name"><br>
            Введите дату рождения: <input type="date" name="new_birthday"><br>
            Введите телефон: <input type="tel" name="new_phone"><br>
            Введите адрес: <input type="text" name="new_address"><br>
            Введите email: <input type="email" name="new_email"><br>
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
        $this->navi();
        echo $result.' Пользователь с id: '.$user_id.' был удален.<br>';
    }

    public function renderUserReviewsPage(array $reviews, int $user_id)
    {
        global $BASEPATH;
        echo BASEPATH;
        $this->navi();
        $i=1;
        foreach ($reviews as $review) {
            echo $i."-ый отзыв<br>";
            echo "Код отзыва: ".$review['review_id']."<br>Текст отзыва: ".$review['review_text']."<br><br>";
            $i++;
        }
        echo '
        <b>Оставить отзыв:</b><br>
        <form method="post" name="set_review" action="'.BASEPATH.'profile/'.$user_id.'/reviews/set-review">
            Ваш отзыв: <input type="text" name="reviewText" maxlength="501"><br>
            <input type="submit" name="submit_set_review"><br>
        </form><br><br>
        <b>Изменить текст отзыва:</b><br>
        <form method="post" name="update_review_text" action="'.BASEPATH.'profile/'.$user_id.'/reviews/update-review-text">
            Id отзыва: <select name="id_review">';
            foreach ($reviews as $review) {
                echo '<option value="'.$review['review_id'].'">'.$review['review_id'].'</option>';
            } 
            echo '</select><br>
            Новый текст отзыва: <input type="text" name="newReviewText" maxlength="501"><br>
            <input type="submit" name="submit_update_review_text"><br>
        </form><br>
        <b>Удалить отзыв:</b><br>
        <form method="post" name="delete_review" action="'.BASEPATH.'profile/'.$user_id.'/reviews/delete-review">
            Id отзыва: <select name="id_review_delete">';
            foreach ($reviews as $review) {
                echo '<option value="'.$review['review_id'].'">'.$review['review_id'].'</option>';
            } 
            echo '</select><br>
            <input type="submit" name="submit_delete_review"><br>
        </form><br>';
    }

    public function renderUserOrdersPage(array $orders, array $order_details, int $user_id)
    {
        $this->navi();
        echo "<br><br><br><br><br>";
        echo "Заказы пользователя ".$user_id."<br>";
        echo "<table><tr><td>Код заказа</td><td>Адрес заказа</td><td>Сумма заказа</td><td>Статус заказа</td><td>Детали заказа</td></tr>";
        for($i=0; $i<count($orders); $i++) {
            echo "<tr><td>".$orders[$i]['order_id']."</td>";
            echo "<td>".$orders[$i]['address']." </td>";
            echo "<td>".$orders[$i]['price']." BYN </td>";
            echo "<td>".$orders[$i]['status']."</td>";
            echo "<td><table><tr>";
            for ($j=0; $j<count($order_details); $j++) {
                if ($order_details[$j]['order_id']==$orders[$i]['order_id']) {
                    echo "<td>".$order_details[$j]['product_id']."</td><td>".$order_details[$j]['product_name']."</td><td>".$order_details[$j]['product_price']." BYN</td></tr>";
                }
            }
            echo "</table></td></tr>";
        }
        echo "</table>";
    }

    public function renderAdminPage(array $user)
    {
        $this->navi();
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
        $this->navi();
        $i=1;
        foreach ($reviews as $review) {
            echo $i."-ый отзыв<br>";
            echo "Код отзыва: ".$review['review_id']."<br> Пользователь: ".$review['user_name']." ".$review['user_surname']."<br>Текст отзыва: ".$review['review_text']."<br><br>";
            $i++;
        }
    }

    public function renderAdminOrdersPage(array $orders, array $order_details)
    {
        $this->navi();
        echo "<br><br><br><br><br>";
        echo "Все Заказы<br>";
        echo "<table><tr><td>Код заказа</td><td>Фамилия заказчика</td><td>Имя заказчика</td><td>Адрес заказа</td><td>Телефон заказа</td><td>Email заказа</td><td>Сумма заказа</td><td>Статус заказа</td><td>Детали заказа</td></tr>";
        for($i=0; $i<count($orders); $i++) {
            echo "<tr><td>".$orders[$i]['order_id']."</td>";
            echo "<td>".$orders[$i]['user_surname']."</td>";
            echo "<td>".$orders[$i]['user_name']."</td>";
            echo "<td>".$orders[$i]['address']." </td>";
            echo "<td>".$orders[$i]['user_phone']." </td>";
            echo "<td>".$orders[$i]['user_email']."</td>";
            echo "<td>".$orders[$i]['price']." BYN </td>";
            echo "<td>".$orders[$i]['status']."</td>";
            echo "<td><table><tr>";
            for ($j=0; $j<count($order_details); $j++) {
                if ($order_details[$j]['order_id']==$orders[$i]['order_id']) {
                    echo "<td>".$order_details[$j]['product_id']."</td><td>".$order_details[$j]['product_name']."</td><td>".$order_details[$j]['product_price']." BYN</td></tr>";
                }
            }
            echo "</table></td></tr>";
        }
        echo "</table>";
    }
}