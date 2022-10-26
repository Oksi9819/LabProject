<!DOCTYPE html>
@extends('basic.basic')

@section('article')
<div class="info">
    <table class="users">
        <thead>
            <tr>
                <td>ID</td>
                <td>Имя</td>
                <td>Фамилия</td>
                <td>День рождения</td>
                <td>Адрес</td>
                <td>Телефон</td>
                <td>Почта</td>
                <td>Создан</td>
            </tr>
        </thead>
    @foreach($users as $user)
        <tr>
            <td>{{$user['user_id']}}</td>
            <td>{{$user['user_name']}}</td>
            <td>{{$user['user_surname']}} BYN </td>
            <td>{{$user['user_birthday']}}</td>
            <td>{{$user['user_address']}}</td>
            <td>{{$user['user_phone']}}</td>
            <td>{{$user['user_email']}}</td>
            <td>{{$user['created_at']}}</td>
        </tr>
    @endforeach
    </table>
</div> 
@endsection