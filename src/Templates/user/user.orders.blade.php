<!DOCTYPE html>
@extends('basic.basic')

@section('article')
    <p>Заказы пользователя {{SESSION['id']}}</p>
    <table>
        <tr>
            <td>Код заказа</td>
            <td>Адрес заказа</td>
            <td>Сумма заказа</td>
            <td>Статус заказа</td>
            <td>Детали заказа</td>
        </tr>
    @foreach($orders as $order)
        <tr>
            <td>{{$order['order_id']}}</td>
            <td>{{$order['address']}}</td>
            <td>{{$order['price']}} BYN </td>
            <td>{{$order['status']}}</td>
            <td>
                <table>
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