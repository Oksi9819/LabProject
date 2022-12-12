<!DOCTYPE html>
@extends('basic.basic')

@section('article')
<div class="info">
    <div class="users">
        <div class="thead">
            <div class="user-id">ID</div>
            <div class="user-name">Имя</div>
            <div class="user-surname">Фамилия</div>
            <div class="user-bday">День рождения</div>
            <div class="user-address">Адрес</div>
            <div class="user-phone">Телефон</div>
            <div class="user-mail">Почта</div>
            <div class="user-created">Создан</div>
        </div>
    @foreach($users as $user)
        <div class="row">
            <div class="user-id">{{$user['user_id']}}</div>
            <div class="user-name">{{$user['user_name']}}</div>
            <div class="user-surname">{{$user['user_surname']}}</div>
            <div class="user-bday">{{$user['user_birthday']}}</div>
            <div class="user-address">{{$user['user_address']}}</div>
            <div class="user-phone">{{$user['user_phone']}}</div>
            <div class="user-mail">{{$user['user_email']}}</div>
            <div class="user-created">{{$user['created_at']}}</div>
        </div>
    @endforeach
    </div>
</div> 
@endsection