<!DOCTYPE html>
@extends('basic.basic')

@section('article')
    <div class="info">
        <p>Артикул : {{$product['product_id']}}</p>
        <img src="{{BASEPATH}}src/pics/{{$product['product_image']}}.jpg" width="300" height="300" alt="{{$product['product_name']}}">
        <div style="display:inline-block">
            <p>Наименование товара: {{$product['product_name']}}</p>
            <p>Описание товара: {{$product['product_desc']}}</p>
            <p>Цена: {{$product['product_price']}} BYN</p>
        </div>
    </div>
    <div>
        @isset($response['updated_product'])
            <p>Информация о товаре {{$response['updated_product']}} была успешно изменена.</p>
        @endisset
    </div>
    @if ($SESSION['role'] === "Admin")
        <div>
            <p><b>Изменить данные о товаре</b></p>
            <form method="post" name="update_product_form" action="{{BASEPATH}}catalog/updateProduct/id{{$product['product_id']}}">
                Новое наименование: <input type="text" name="product_name"><br>
                Новое описание: <input type="text" name="product_desc"><br>
                Новая цена: <input type="number" min="1" name="product_price" step="0.01"><br>
                <input type="submit" name="submit_update_product"><br>
            </form><br>
        </div>
        <div>
            <p><b>Удалить товар</b></p>
            <form method="post" name="delete_product_form" action="'.BASEPATH.'catalog/deleteProduct/id{{$product['product_id']}}">
                <input type="submit" name="submit_delete_product" value = DELETE><br>
            </form>
        </div>
    @endif
@endsection