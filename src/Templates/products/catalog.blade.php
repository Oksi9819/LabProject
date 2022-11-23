<!DOCTYPE html>
@extends('basic.basic')

@section('article')
    @empty($category_name)
        <p class="bold">ВСЕ ТОВАРЫ</p>
        <div class="set-changes sort">
            <form method="post" name="sort_form" action="{{BASEPATH}}catalog/sort" class="contact">
    @endempty
    @isset($category_name)
        <p class="bold">ТОВАРЫ КАТЕГОРИИ {{$category_name}}</p>
        <div class="set-changes sort">
            <form method="post" name="sort_form" action="{{BASEPATH}}catalog/category/{{$category_name}}/sort" class="category">
    @endisset
                <select name="sort_choice" required class="category-select">
                    <option value="popularity">по популярности</option>
                    <option value="pricelowhigh">по возрастанию цены</option>
                    <option value="pricehighlow">по убыванию цены</option>
                    <option value="az">по названию А-Я</option>
                    <option value="za">по названию Я-А</option>
                </select>
                <input type="submit" class="category-btn">
            </form>
        </div>    
        <div id="catalog" class="catalog">
            @for($i=0; $i<$amount; $i++)
                <div class="catalog product-card">            
                    <div class="inner">{{$products[$i]['product_id']}}</div>
                    <div class="inner">
                        <a href="{{BASEPATH}}catalog/category/VacuumCleaners/id{{$products[$i]['product_id']}}"
                        ><img
                            src="{{BASEPATH}}src/pics/{{$products[$i]['product_image']}}.jpg"  
                            alt="{{$products[$i]['product_name']}}"
                        ></a>
                    </div>
                    <div class="inner">
                        <a class="catalog product-card text" 
                            href="{{BASEPATH}}catalog/category/VacuumCleaners/id{{$products[$i]['product_id']}}"
                        >{{$products[$i]['product_name']}}</a>
                    </div>
                    <div class="inner">
                        <p class="product-card price">{{$products[$i]['product_price']}} BYN</p>
                    </div>
                    <div class="add-to-cart catalog inner" >
                        <div name="add_product_to_cart_form">
                            <input 
                                class="catalog product-card amount"
                                type="number"
                                min="1" 
                                name="product_price" 
                                step="1"
                                value="1"> шт.
                            <button
                                class="add-product" 
                                data-id="{{$products[$i]['product_id']}}"
                            >В КОРЗИНУ</button>    
                        </div>
                    </div>  
                </div>
            @endfor  
        </div>
    @isset($SESSION)
    @if ($SESSION['role'] === "Admin")
        <div class="set-changes">
            <p>Добавить товар</p>
            <form id="add_product" method="post" name="add_product" action="{{BASEPATH}}addProduct/catalog">
                Наименование: <input class="add_product" type="text" name="prod_name" required><br>
                Описание: <input class="add_product" type="text" name="prod_desc" required><br>
                Цена: <input class="add_product" type="number" min="1" name="prod_price" step="0.01" required><br>
                Категория: <select id="id_new_prod_category" name="id_new_prod_category" required>
                @foreach ($categories as $category)
                    <option value="{{$category['category_id']}}">{{$category['category_id']}} - {{$category['category_name']}}</option>
                @endforeach
                </select><br>
                <input id="submit_add_product" type="submit" name="submit_add_product" value = "Добавить">
            </form>
        </div>
        <div class="set-changes">
            <p>Добавить категорию</p>
            <form id="add_category" method="post" name="add_category" action="{{BASEPATH}}addProductCategory/catalog">
                Введите название категории: <input class="add_category" type="text" name="category_name" required><br>
                Введите название категории на английском без пробела и знаков препинания: <input class="add_category" type="text" name="category_eng" required><br>
                <input id="submit_add_category" type="submit" name="submit_add_category" value = "Добавить">
            </form>
        </div>
        <div class="set-changes">
            <p>Изменить категорию</p>
            <form id="update_category" method="post" name="update_category" action="{{BASEPATH}}updateProductCategory/catalog">
                Id категории: <select id="update_id_category" name="update_id_category" required>
                @foreach ($categories as $category)
                    <option value="{{$category['category_id']}}">{{$category['category_id']}} - {{$category['category_name']}}</option>
                @endforeach
                </select><br>
                Новое название категории: <input class="update_category" type="text" name="new_category" required><br>
                Новое название категории на английском без пробела и знаков препинания: <input class="new_category_eng" type="text" name="new_category_eng" required><br>
                <input id="submit_update_category" type="submit" name="submit_update_category" value = "Обновить">
            </form>
        </div>
        <div class="set-changes">
            <p>Удалить категорию</p>
            <form id="delete_category" method="post" name="delete_category" action="{{BASEPATH}}deleteProductCategory/catalog">
                Id категории: <select id="id_del_category" name="id_del_category" required>
                @foreach ($categories as $category)
                    <option value="{{$category['category_id']}}">{{$category['category_id']}} - {{$category['category_name']}}</option>
                @endforeach
                </select><br>
                <input id="submit_delete_category" type="submit" name="submit_delete_category" value = "Удалить">
            </form>
        </div>
    @endif
    @endisset
@endsection



        