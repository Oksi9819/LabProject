<!DOCTYPE html>
@extends('basic.basic')

@section('article')
    <div class="info">
        <p class="bold">Телефоны:</p>
        <p>{{$info['phone_1']}}</p>
        <p>{{$info['phone_2']}}</p>
        <p class="bold">Адрес:</p>
        <p class="bold">{{$info['address']}}</p>
    </div>
    <div class="contact">
        @isset($values)
            <p>Форма успешно отправлена:</p>
            <p>Ваше имя: {{$values['contact_name']}}</p>
            <p>Ваш email для связи: {{$values['contact_email']}}</p>
            <p>Ваше сообщение: {{$values['contact_text']}}</p>
        @endisset
        @empty($values)
            <p>Заполните форму для связи: </p>
            <form id="contact_form" method="post" action="{{BASEPATH}}contacts/contact-form" class="contact">
                <input type="text" name="contact_name" placeholder="Введите Ваше Имя" required class="contact-input contact-name">
                <input type="email" name="contact_email" placeholder="Введите Ваш Email" required class="contact-input contact-mail">
                <br><input type="text" name="contact_text" placeholder="Введите сообщение" required class="contact-input contact-msg"><br>
                <input id="submit_contact_form" type="submit" value="Отправить" class="contact-btn">
            </form>
        @endempty
    </div>
@endsection