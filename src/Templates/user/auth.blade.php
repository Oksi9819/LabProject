<!DOCTYPE html>
@extends('basic.basic')

@section('article')
    <p><b>Заполните пожалуйста поля авторизации: </b></p><br>
    <form method="post" action="{{BASEPATH}}authorization-form">
        Введите email: <input type="email" name="user_email"><br>
        Введите пароль: <input type="password" name="user_password"><br>
        <input type="submit" value="Зарегистрироваться">
    </form>
@endsection