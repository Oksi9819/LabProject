<!DOCTYPE html>
@extends('basic.basic')

@section('article')
<div class="info user">
    
    <p>Все заказы</p>
    <div class="orders">
            <div class="thead">
                <div class="col">Код заказа</div>
                <div class="col">Фамилия заказчика</div>
                <div class="col">Имя заказчика</div>
                <div class="col">Адрес заказа</div>
                <div class="col">Телефон заказа</div>
                <div class="col">Email заказа</div>
                <div class="col">Сумма заказа</div>
                <div class="col">Статус заказа</div>
                <div class="col"></div>
                <div class="col">Детали заказа</div>
            </div>
    @foreach($orders as $order)
        <div class="row">
            <div class="col">{{$order['order_id']}}</div>
            <div class="col">{{$order['user_surname']}}</div>
            <div class="col">{{$order['user_name']}}</div>
            <div class="col">{{$order['address']}}</div>
            <div class="col">{{$order['user_phone']}}</div>
            <div class="col">{{$order['user_email']}}</div>
            <div class="col">{{$order['price']}} BYN </div>
            <div class="order_status">{{$order['status']}}</div>
            <div class="col">
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
        </div>
    @endforeach
    </table>
</div> 
@endsection