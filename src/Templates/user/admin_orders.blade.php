<!DOCTYPE html>
@extends('basic.basic')

@section('article')
    <div>
        @isset($response)
            @isset($response['new_status']['order_id'])
                <p>Обновлен статус заказа id: {{$response['new_status']['order_id']}}.</p>
            @endisset
        @endisset
    </div>
    <p>Все заказы</p>
    <table style="border: 3px solid black">
        <tr>
            <td>Код заказа</td>
            <td>Фамилия заказчика</td>
            <td>Имя заказчика</td>
            <td>Адрес заказа</td>
            <td>Телефон заказа</td>
            <td>Email заказа</td>
            <td>Сумма заказа</td>
            <td>Статус заказа</td>
            <td></td>
            <td>Детали заказа</td>
        </tr>
    @foreach($orders as $order)
        <tr>
            <td>{{$order['order_id']}}</td>
            <td>{{$order['user_surname']}}</td>
            <td>{{$order['user_name']}}</td>
            <td>{{$order['address']}}</td>
            <td>{{$order['user_phone']}}</td>
            <td>{{$order['user_email']}}</td>
            <td>{{$order['price']}} BYN </td>
            <td>{{$order['status']}}</td>
            <td>
                <form method="post" name="set_order_{{$order['order_id']}}" action="{{BASEPATH}}profile/{{$SESSION['id']}}/orders/edit-order-status/{{$order['order_id']}}">
                    <select name="new_order_status" required>
                    @foreach ($order_statuses as $order_status)
                        <option value="{{$order_status['status_id']}}">{{$order_status['status_id']}} - {{$order_status['status_name']}}</option>
                    @endforeach
                    </select>
                    <input type="submit" name="submit_new_order_status" value="Изменить статус">
                </form>
            </td>
            <td>
                <table style="border: 1px solid black">
                    @foreach ($order_details as $order_detail)
                        @if ($order_detail['order_id'] == $order['order_id'])
                            <tr>
                                <td>{{$order_detail['product_id']}}</td><td>{{$order_detail['product_name']}}</td>
                                <td>{{$order_detail['product_price']}} BYN</td>
                            </tr>
                        @endif
                    @endforeach
                </table>
            </td>
        </tr>
    @endforeach
    </table>
@endsection