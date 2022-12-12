<!DOCTYPE html>
@extends('basic.basic')

@section('article')
<div class="info">
    <div>
    <p>Заказы пользователя {{$SESSION['id']}}</p>
    <div class="orders">
        <div class="thead">
            <div class="order-id">Код заказа</div>
            <div class="order-address">Адрес заказа</div>
            <div class="order-address-change"></div>
            <div class="order-sum">Сумма заказа</div>
            <div class="order-status">Статус заказа</div>
            <div class="order-details">Детали заказа</div>
            <div class="order-status-cancel"></div>
        </div>
    @foreach($orders as $order)
        <div class="row">>
            <div class="order-id">{{$order['order_id']}}</div>
            <div class="order-address">{{$order['address']}}</div>
            <div class="order-address-change">
                <form 
                    id="change_order_address"
                    method="post" 
                    class="set-changes orders"
                    name="set_order" 
                    action="{{BASEPATH}}profile/{{$SESSION['id']}}/orders/edit-order-address/{{$order['order_id']}}"
                >
                    <input id="new_order_address" type="text" name="new_order_address">
                    <input id="submit_new_order_address" type="submit" name="submit_new_order_address" value="Изменить адрес">
                </form>
            </div>
            <div class="order-sum">{{$order['price']}} BYN </div>
            <div class="order-status">{{$order['status']}}</div>
            <div class="order-details">
                <div class="orders details">
                    @foreach ($order_details as $order_detail)
                        @if ($order_detail['order_id'] == $order['order_id'])
                            <div class="row_input">
                                <div>{{$order_detail['product_id']}}</div><div>{{$order_detail['product_name']}}</div>
                                <div>{{$order_detail['product_price']}} BYN</div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="order-status-cancel">
                <form 
                    id="cancel_order"
                    method="post" 
                    class="set-changes orders"
                    name="cancel_order" 
                    action="{{BASEPATH}}profile/{{$SESSION['id']}}/orders/cancel-order/{{$order['order_id']}}"
                >
                    <input id="submit_cancel_order" type="submit" name="submit_cancel_order" value="Отменить">
                </form>
            </div>
        </div>
    @endforeach
    </div>
</div>
@endsection