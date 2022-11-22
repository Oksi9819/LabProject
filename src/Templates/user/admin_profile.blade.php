<!DOCTYPE html>
@extends('user.user_profile')

@section('title_1')
    <p>Данные об Администраторе:</p>
@endsection

@section('title_2')
    <p>Удалить текущего администратора:</p>
@endsection

@section('admin_functions')
<div class="set-changes">
    <p>Добавить нового администратора:</p>
    <form id="add_admin" method="post" name="add_admin" action="{{BASEPATH}}addNewAdmin/profile/{{$user['user_id']}}">
        Введите фамилию: <input class="add_admin" type="text" name="admin_surname" required="required"><br>
        Введите фамилию: <input class="add_admin" type="text" name="admin_name" required="required"><br>
        Введите дату рождения: <input class="add_admin" type="date" name="admin_birthday" required="required"><br>
        Введите телефон: <input class="add_admin" type="tel" name="admin_phone" required="required"><br>
        Введите адрес: <input class="add_admin" type="text" name="admin_address" required="required"><br>
        Введите email: <input class="add_admin" type="email" name="admin_email" required="required"><br>
        Введите пароль: <input class="add_admin" type="password" name="admin_password" required="required"><br>
        <input id="submit_reg_admin" type="submit" name="submit_reg_admin" value="Зарегистрировать">
    </form>
</div>
@endsection