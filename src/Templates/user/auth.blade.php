<!DOCTYPE html>
@extends('basic.basic')

@section('article')
<div class="info">
    <p><b>Заполните пожалуйста поля авторизации: </b></p><br>
    <form method="post" id="auth_form">
        Введите email: <input type="email" name="user_email" required="required"><br>
        Введите пароль: <input type="password" name="user_password" required="required"><br>
        <input id="submit_auth_user" type="submit" value="Авторизоваться">
    </form>
</div>    
@endsection