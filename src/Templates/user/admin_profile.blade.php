<!DOCTYPE html>
@extends('user.user_profile')

@section('title_1')
    <p>Данные об Администраторе: <b></p>
@endsection

@section('title_2')
    <p><b>Удалить текущего администратора:</b></p>
@endsection

@section('admin_functions')
    <p><b>Добавить нового администратора:</b></p>
    <form method="post" name="add_admin" action="{{BASEPATH}}addNewAdmin/profile/{{$user['user_id']}}">
        Введите фамилию: <input type="text" name="admin_surname" required="required"><br>
        Введите фамилию: <input type="text" name="admin_name" required="required"><br>
        Введите дату рождения: <input type="date" name="admin_birthday" required="required"><br>
        Введите телефон: <input type="tel" name="admin_phone" required="required"><br>
        Введите адрес: <input type="text" name="admin_address" required="required"><br>
        Введите email: <input type="email" name="admin_email" required="required"><br>
        Введите пароль: <input type="password" name="admin_password" required="required"><br>
        <input type="submit" name="submit_reg_admin" value="Зарегистрировать администратора">
    </form><br>
@endsection