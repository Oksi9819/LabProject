<!DOCTYPE html>
@extends('basic.basic')

@section('article')
<div class="info">
    <p><b>Заполните пожалуйста форму регистрации: </b></p><br>
    <form method="post" id="registration_form">
        Введите фамилию: <input type="text" name="user_surname" required="required"><br>
        Введите имя: <input type="text" name="user_name" required="required"><br>
        Введите дату рождения: <input type="date" name="user_birthday" required="required"><br>
        Введите телефон: <input type="tel" name="user_phone" value="+375(__)___-__-__" required="required"><br>
        Введите адрес: <input type="text" name="user_address" required="required"><br>
        Введите email: <input type="email" name="user_email" required="required"><br>
        Введите пароль: <input type="password" name="user_password" required="required"><br>
        <input id="submit_reg_user" type="submit" name="submit_reg_user" value="Зарегистрироваться">
    </form>
<div class="info">    
@endsection