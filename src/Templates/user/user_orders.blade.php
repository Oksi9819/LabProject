<!DOCTYPE html>
@extends('basic.basic')

@section('article')
<div class="info">
    <div>
    <p>Заказы пользователя {{$SESSION['id']}}</p>
    <div class="orders">
        <div class="thead">
            <div class="col">Код заказа</div>
            <div class="col">Адрес заказа</div>
            <div class="col"></div>
            <div class="col">Сумма заказа</div>
            <div class="col">Статус заказа</div>
            <div class="col">Детали заказа</div>
            <div class="col"></div>
        </div>
    @foreach($orders as $order)
        <div class="row">>
            <div class="col">{{$order['order_id']}}</div>
            <div class="order-address">{{$order['address']}}</div>
            <div class="col">
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
            <div class="col">{{$order['price']}} BYN </div>
            <div class="order_status">{{$order['status']}}</div>
            <div class="col">
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
            <div class="col">
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