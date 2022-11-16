<!DOCTYPE html>
@extends('basic.basic')

@section('article')
    <div class="info">
        <p class="bold">Добавленные товары:</p>
        <div id="cart_content"></div>
        <button id="clear_cart">ОЧИСТИТЬ КОРЗИНУ</button>
        <button id="set_order">ОФОРМИТЬ ЗАКАЗ</button>
    </div>
    <div>
        <input type="text" placeholder="Адрес доставки" id="order_addr">
    </div>
@endsection