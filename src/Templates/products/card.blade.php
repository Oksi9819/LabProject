<!DOCTYPE html>
@extends('basic.basic')

@section('article')
    <div class="info">
        <p>Артикул : {{$product['product_id']}}</p>
        <img src="{{BASEPATH}}src/pics/{{$product['product_image']}}.jpg" alt="{{$product['product_name']}}">
        <div class="description">
            <span class="info-title">Наименование товара: </span>
            <p id="0" class="catalog product-card text">{{$product['product_name']}}</p>
            <span class="info-title">Описание товара: </span>
            <p id="1">{{$product['product_desc']}}</p>
            <span class="info-title">Цена: </span>
            <p class="product-card price"><span id="2">{{$product['product_price']}}</span> BYN</p>
        </div>
        <div class="add-to-cart" name="add_product_to_cart_form">
            <div>
                <p>Количество: <input 
                    class="catalog product-card amount"
                    type="number"
                    min="1" 
                    name="product_price" 
                    step="1"
                    value="1"
                > шт.</p>
                <button class="add-product" data-id="{{$product['product_id']}}">ДОБАВИТЬ В КОРЗИНУ</button>
            </div>
        </div>
    </div>
    <div>
        @isset($response['updated_product'])
            <p>Информация о товаре {{$response['updated_product']}} была успешно изменена.</p>
        @endisset
    </div>
    @isset($SESSION)
    @if ($SESSION['role'] === "Admin")
        <div class="set-changes">
            <p>Изменить данные о товаре</p>
            <form 
                id="update_product_form" 
                method="post" 
                name="update_product_form" 
                action="{{BASEPATH}}catalog/updateProduct/id{{$product['product_id']}}">
                Новое наименование: <input class="update_product" type="text" name="product_name"><br>
                Новое описание: <input class="update_product" type="text" name="product_desc"><br>
                Новая цена: <input class="update_product" type="number" min="1" name="product_price" step="0.01"><br>
                <input id="submit_update_product" type="submit" name="submit_update_product" value="Обновить">
            </form>
        </div>
        <div class="set-changes">
            <p>Удалить товар</p>
            <form 
                id="delete_product_form" 
                method="post" 
                name="delete_product_form" 
                action="{{BASEPATH}}catalog/deleteProduct/id{{$product['product_id']}}">
                <input id="submit_delete_product" type="submit" name="submit_delete_product" value="Удалить">
            </form>
        </div>
    @endif
    @endisset
@endsection