<!DOCTYPE html>
@extends('basic.basic')

@section('article')
<div class="info">
    @section('title_1')
        <p>Данные о пользователе: <b></p>
    @endsection
    <p>Id: {{$user['user_id']}}</p>
    <p>Фамилия: <span class="updated_info" id="updated_info_0">{{$user['user_surname']}}</span></p>
    <p>Имя: <span class="updated_info" id="updated_info_1">{{$user['user_name']}}</span></p>
    <p>День рождения: <span class="updated_info" id="updated_info_2">{{$user['user_birthday']}}</span></p>
    <p>Номер телефона: <span class="updated_info" id="updated_info_3">{{$user['user_phone']}}</span></p>
    <p>Адрес: <span class="updated_info" id="updated_info_4">{{$user['user_address']}}</span></p>
    <p>Email: <span class="updated_info" id="updated_info_5">{{$user['user_email']}}</span></p><br>
    <p>Перейти в <a href='/profile/{{$user['user_id']}}/orders'>заказы.</a></p>
    <p>Перейти в <a href='/profile/{{$user['user_id']}}/reviews'>отзывы.</a></p><br>
    <div class="set-changes">
        <p>Изменить сведения о пользователе:</p>
        <form id="update_user" method="post" name="update_user_info" action="{{BASEPATH}}updateUser/profile/{{$user['user_id']}}">
            Введите фамилию: <input class="update_user" type="text" name="new_surname"><br>
            Введите имя: <input class="update_user" type="text" name="new_name"><br>
            Введите дату рождения: <input class="update_user" type="date" name="new_birthday"><br>
            Введите телефон: <input class="update_user" type="tel" name="new_phone"><br>
            Введите адрес: <input class="update_user" type="text" name="new_address"><br>
            Введите email: <input class="update_user" type="email" name="new_email"><br>
            <input id="submit_update_user" type="submit" name="submit_update_user" value = "Обновить">
        </form>
    </div>
    <div class="set-changes">
        <p>Изменить пароль:</p>
        <form method="post" name="update_user_pass" action="{{BASEPATH}}updateUserPass/profile/{{$user['user_id']}}">
            Введите пароль: <input type="password" name="user_pass" required><br>
            Повторите пароль: <input type="password" name="user_pass_check" required><br>
            <input type="submit" name="submit_update_pass" value = "Изменить">
        </form>
    </div>    
    <div class="set-changes">
        @section('title_2')
            <p>Удалить пользователя:</p>
        @endsection
        <form method="post" name="delete_user_form" action="{{BASEPATH}}deleteUser/profile/{{$user['user_id']}}">
            <input type="submit" name="submit_delete_user" value = "Удалить">
        </form>
    </div>  
    @yield('admin_functions')
    <p><a href="{{BASEPATH}}exit/profile/{{$user['user_id']}}">Выйти</a></p>
</div>    
@endsection