<!DOCTYPE html>
@extends('basic.basic')

@section('article')
    <b>Заполните пожалуйста форму регистрации: </b><br><br>
    <form method="post">
        Введите фамилию: <input type="text" name="user_surname" required="required"><br>
        Введите имя: <input type="text" name="user_name" required="required"><br>
        Введите дату рождения: <input type="date" name="user_birthday" required="required"><br>
        Введите телефон: <input type="tel" name="user_phone" required="required"><br>
        Введите адрес: <input type="text" name="user_address" required="required"><br>
        Введите email: <input type="email" name="user_email" value="Введите email" required="required"><br>
        Введите пароль: <input type="password" name="user_password" required="required"><br>
        <input type="submit" name="submit_reg_user" value="Зарегистрироваться">
    </form>
@endsection