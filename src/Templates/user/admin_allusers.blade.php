<!DOCTYPE html>
@extends('basic.basic')

@section('article')
<div class="info">
    <div class="users">
        <div class="thead">
            <div class="col">ID</div>
            <div class="col">Имя</div>
            <div class="col">Фамилия</div>
            <div class="col">День рождения</div>
            <div class="col">Адрес</div>
            <div class="col">Телефон</div>
            <div class="col">Почта</div>
            <div class="col">Создан</div>
        </div>
    @foreach($users as $user)
        <div class="row">
            <div class="col">{{$user['user_id']}}</div>
            <div class="col">{{$user['user_name']}}</div>
            <div class="col">{{$user['user_surname']}}</div>
            <div class="col">{{$user['user_birthday']}}</div>
            <div class="col">{{$user['user_address']}}</div>
            <div class="col">{{$user['user_phone']}}</div>
            <div class="col">{{$user['user_email']}}</div>
            <div class="col">{{$user['created_at']}}</div>
        </div>
    @endforeach
    </div>
</div> 
@endsection