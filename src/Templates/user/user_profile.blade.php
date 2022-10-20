<!DOCTYPE html>
@extends('basic.basic')

@section('article')
<div class="info">
    @section('title_1')
        <p>Данные о пользователе: <b></p>
    @endsection
    <p>Id: {{$user['user_id']}}</p>
    <p>Имя: {{$user['user_name']}}</p>
    <p>Фамилия: {{$user['user_surname']}}</p>
    <p>День рождения: {{$user['user_birthday']}}</p>
    <p>Номер телефона: {{$user['user_phone']}}</p>
    <p>Адрес: {{$user['user_address']}}</p>
    <p>Email: {{$user['user_email']}}</p><br>
    <p>Перейти в <a href='/profile/{{$user['user_id']}}/orders'>заказы.</a></p>
    <p>Перейти в <a href='/profile/{{$user['user_id']}}/reviews'>отзывы.</a></p><br>
    <p><b>Изменить сведения о пользователе:</b></p>
    <form method="post" name="update_user_info" action="{{BASEPATH}}updateUser/profile/{{$user['user_id']}}">
        Введите фамилию: <input type="text" name="new_surname"><br>
        Введите имя: <input type="text" name="new_name"><br>
        Введите дату рождения: <input type="date" name="new_birthday"><br>
        Введите телефон: <input type="tel" name="new_phone"><br>
        Введите адрес: <input type="text" name="new_address"><br>
        Введите email: <input type="email" name="new_email"><br>
        <input type="submit" name="submit_update_user"><br>
    </form><br>
    <p><b>Изменить пароль:</b></p>
    <form method="post" name="update_user_pass" action="{{BASEPATH}}updateUserPass/profile/{{$user['user_id']}}">
        Введите пароль: <input type="password" name="user_pass"><br>
        Повторите пароль: <input type="password" name="user_pass_check"><br>
        <input type="submit" name="submit_update_pass"><br>
    </form><br>
    @section('title_2')
        <p><b>Удалить пользователя:</b></p>
    @endsection
    <form method="post" name="delete_user_form" action="{{BASEPATH}}deleteUser/profile/{{$user['user_id']}}">
        <input type="submit" name="submit_delete_user" value = DELETE><br>
    </form>
    @yield('admin_functions')
    <p><a href="{{BASEPATH}}exit/profile/{{$user['user_id']}}">Выйти</a></p>
</div>    
@endsection