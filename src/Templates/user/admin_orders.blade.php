<!DOCTYPE html>
@extends('basic.basic')

@section('article')
<div class="info user">
    
    <p>Все заказы</p>
    <div class="orders">
            <div class="thead">
                <div class="order-id">Код заказа</div>
                <div class="order-surname">Фамилия заказчика</div>
                <div class="order-name">Имя заказчика</div>
                <div class="order-address">Адрес заказа</div>
                <div class="order-phone">Телефон заказа</div>
                <div class="order-email">Email заказа</div>
                <div class="order-sum">Сумма заказа</div>
                <div class="order-status">Статус заказа</div>
                <div class="order-status-change"></div>
                <div class="order-details">Детали заказа</div>
            </div>
    @foreach($orders as $order)
        <div class="row">
            <div class="order-id">{{$order['order_id']}}</div>
            <div class="order-surname">{{$order['user_surname']}}</div>
            <div class="order-name">{{$order['user_name']}}</div>
            <div class="order-address">{{$order['address']}}</div>
            <div class="order-phone">{{$order['user_phone']}}</div>
            <div class="order-email">{{$order['user_email']}}</div>
            <div class="order-sum">{{$order['price']}} BYN </div>
            <div class="order-status">{{$order['status']}}</div>
            <div class="order-status-change">
                <form 
                    id="change_order_status"
                    method="post" 
                    class="set-changes orders"
                    name="set_order_{{$order['order_id']}}" 
                    action="{{BASEPATH}}profile/{{$SESSION['id']}}/orders/edit-order-status/{{$order['order_id']}}">
                    <select name="new_order_status" required>
                    @foreach ($order_statuses as $order_status)
                        <option value="{{$order_status['status_id']}}">{{$order_status['status_id']}} - {{$order_status['status_name']}}</option>
                    @endforeach
                    </select>
                    <input id="submit_new_order_status" type="submit" name="submit_new_order_status" value="Изменить статус">
                </form>
            </div>
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
        </div>
    @endforeach
    </table>
</div> 
@endsection