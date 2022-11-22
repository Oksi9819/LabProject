<!DOCTYPE html>
@extends('basic.basic')

@section('article')
<div class="info">
    <div>
        @isset($response)
            @isset($response['new_order'])
                <p>Новый заказ с id: {{$response['new_order'][0]['order_id']}} отправлен на обработку.</p>
                <p>Подробности заказа {{$response['new_order'][0]['order_id']}}:</p>
                <table>
                    <tr>
                        <td>Артикул</td>
                        <td>Наименование товара</td>
                        <td>Цена</td>
                        <td>Количество</td>
                    </tr>
                    @foreach ($response['new_order'] as $ordered_product)
                        <tr>
                            <td>{{$ordered_product['product_id']}}</td>
                            <td>{{$ordered_product['product_name']}}</td>
                            <td>{{$ordered_product['product_price']}} BYN</td>
                            <td>{{$ordered_product['amount']}} шт.</td>
                        </tr>
                    @endforeach
                </table>
            @endisset
            @isset($response['new_order_address'])
                <p>Адрес доставки для заказа id: {{$response['new_order_address']['order_id']}} обновлен.</p>
                <p>Новый адрес доставки заказа id: {{$response['new_order_address']['new_address']}}: .</p>
            @endisset
            @isset($response['canceled_order'])
                <p>Заказ id: {{$response['canceled_order']}} отменен.</p>
            @endisset
        @endisset
    </div>
    <div>
    <p>Заказы пользователя {{$SESSION['id']}}</p>
    <table class="orders">
        <thead>
            <tr>
                <td>Код заказа</td>
                <td>Адрес заказа</td>
                <td></td>
                <td>Сумма заказа</td>
                <td>Статус заказа</td>
                <td>Детали заказа</td>
                <td></td>
            </tr>
        </thead>
    @foreach($orders as $order)
        <tr>
            <td>{{$order['order_id']}}</td>
            <td class="order-address">{{$order['address']}}</td>
            <td>
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
            </td>
            <td>{{$order['price']}} BYN </td>
            <td class="order-status">{{$order['status']}}</td>
            <td>
                <table class="orders details">
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
            <td>
                <form 
                    id="cancel_order"
                    method="post" 
                    class="set-changes orders"
                    name="cancel_order" 
                    action="{{BASEPATH}}profile/{{$SESSION['id']}}/orders/cancel-order/{{$order['order_id']}}"
                >
                    <input id="submit_cancel_order" type="submit" name="submit_cancel_order" value="Отменить">
                </form>
            </td>
        </tr>
    @endforeach
    </table>
</div>
@endsection