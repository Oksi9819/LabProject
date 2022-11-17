<!DOCTYPE html>
@extends('basic.basic')

@section('article')
    <div class="info">
        <p class="bold">Добавленные товары:</p>
        <div id="cart_content"></div>
        <div class="set-order">
            <button id="clear_cart">ОЧИСТИТЬ КОРЗИНУ</button>
            <div class="set-order inner">
                <input type="text" placeholder="Адрес доставки" id="order_addr" maxlength="50">
                <button id="set_order">ОФОРМИТЬ ЗАКАЗ</button>
            </div>
        </div>
    </div>
@endsection