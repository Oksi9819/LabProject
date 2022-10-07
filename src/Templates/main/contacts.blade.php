<!DOCTYPE html>
@extends('basic.basic')

@section('article')
    <div>
        {{$info['topic']}}
    </div>
    <div>
        <p>{{$info['phone_1']}}</p>
        <p>{{$info['phone_2']}}</p>
        <p>{{$info['address']}}</p>
    </div>
    <div>
        @isset($values)
            <b>Форма успешно отправлена:</b><br><br>
            <p>Ваше имя: {{$values['contact_name']}}<br>Ваш email для связи: {{$values['contact_email']}}<br>Ваше сообщение: {{$values['contact_text']}}</p>
        @endisset
        @empty($values)
        <b>Заполните форму для связи: </b><br><br>
        <form method="post" action="{{BASEPATH}}contacts/contact-form">
            Ваше имя: <input type="text" name="contact_name"><br>
            Ваш email для связи: <input type="email" name="contact_email"><br>
            Введите ваше сообщение: <input type="text" name="contact_text"><br><input type="submit" value="Отправить">
        </form>
        @endempty
    </div>
@endsection