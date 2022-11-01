<!DOCTYPE html>
@extends('basic.basic')

@section('article')
    <div class="info">
        <p><b>Это Корзина</b><p>
        <p>Добавленные товары:</p>
        <div id="cart_content"></div>
        <button id="clear_cart">ОЧИСТИТЬ КОРЗИНУ</button>
    </div>
@endsection