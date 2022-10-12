<!DOCTYPE html>
@extends('basic.basic')

@section('article')
    <div>
        @isset($response)
            @isset($response['deleted_product'])
                <p>Товар с id: {{$response['deleted_product']}} был удален.</p>
            @endisset
            @isset($response['new_product'])
                <p>Добавлен новый товар : {{$response['new_product']}}.</p>
            @endisset
            @isset($response['new_category'])
                <p>Добавлена новая категория: {{$response['new_category']}}.</p>
            @endisset
            @isset($response['updated_category'])
                <p>Изменена категория id: {{$response['updated_category']}}.</p>
            @endisset
            @isset($response['deleted_category'])
                <p>Удалена категория id: {{$response['deleted_category']}}.</p>
            @endisset
        @endisset
    </div>
    @empty($category_name)
        <p><b>ВСЕ ТОВАРЫ</b><br></p>
        <div>
            <form method="post" name="sort_form" action="{{BASEPATH}}catalog/sort">
    @endempty
    @isset($category_name)
        <p><b>ТОВАРЫ КАТЕГОРИИ {{$category_name}}</b><br></p>
        <div>
            <form method="post" name="sort_form" action="{{BASEPATH}}catalog/category/{{$category_name}}/sort">
    @endisset
                <select name="sort_choice">
                    <option value="popularity">по популярности</option>
                    <option value="pricelowhigh">по возрастанию цены</option>
                    <option value="pricehighlow">по убыванию цены</option>
                    <option value="az">по названию А-Я</option>
                    <option value="za">по названию Я-А</option>
                </select>
                <input type="submit">
            </form><br>
            <table style="border: 5px solid black" cols="5">
                <tr>
                    @for ($i=0; $i<$amount; $i++)
                        @if (($i+1) % 5 == 1)
                            </tr>
                            <tr>
                        @endif
                        <td style="border: 1px solid red">
                            <table>
                                <tr><td>{{$products[$i]['product_id']}}</td></tr>
                                <tr>
                                    <td>
                                        <img 
                                        src="{{BASEPATH}}src/pics/{{$products[$i]['product_image']}}.jpg" 
                                        width="200" 
                                        height="200" 
                                        alt="{{$products[$i]['product_name']}}"
                                        >
                                    </td>
                                </tr>
                                <tr><td>{{$products[$i]['product_name']}}</td></tr>
                                <tr><td>{{$products[$i]['product_desc']}}</td></tr>
                                <tr><td>{{$products[$i]['product_price']}} BYN</td></tr>
                            </table>
                        </td>
                    @endfor
                </tr>
            </table><br>     
        </div>
    @isset($SESSION)
    @if ($SESSION['role'] === "Admin")
        <div>
            <b>Добавить товар</b><br>
            <form method="post" name="add_product" action="{{BASEPATH}}addProduct/catalog">
                Наименование: <input type="text" name="prod_name" required><br>
                Описание: <input type="text" name="prod_desc" required><br>
                Цена: <input type="number" min="1" name="prod_price" step="0.01" required><br>
                Категория: <select name="id_new_prod_category" required>
                @foreach ($categories as $category)
                    <option value="{{$category['category_id']}}">{{$category['category_id']}} - {{$category['category_name']}}</option>
                @endforeach
                </select><br>
                <input type="submit" name="submit_add_product"><br>
            </form><br>
        </div>
        <div>
            <b>Добавить категорию</b><br>
            <form method="post" name="add_category" action="{{BASEPATH}}addProductCategory/catalog">
                Введите название категории: <input type="text" name="category_name" required><br>
                Введите название категории на английском без пробела и знаков препинания: <input type="text" name="category_eng" required><br>
                <input type="submit" name="submit_add_category"><br>
            </form><br>
        </div>
        <div>
            <b>Изменить категорию</b><br>
            <form method="post" name="update_category" action="{{BASEPATH}}updateProductCategory/catalog">
                Id категории: <select name="update_id_category" required>
                @foreach ($categories as $category)
                    <option value="{{$category['category_id']}}">{{$category['category_id']}} - {{$category['category_name']}}</option>
                @endforeach
                </select><br>
                Новое название категории: <input type="text" name="new_category" required><br>
                Новое название категории на английском без пробела и знаков препинания: <input type="text" name="new_category_eng" required><br>
                <input type="submit" name="submit_update_category"><br>
            </form><br>
        </div>
        <div>
            <b>Удалить категорию</b><br>
            <form method="post" name="delete_category" action="{{BASEPATH}}deleteProductCategory/catalog">
                Id категории: <select name="id_del_category" required>';
                @foreach ($categories as $category)
                    <option value="{{$category['category_id']}}">{{$category['category_id']}} - {{$category['category_name']}}</option>
                @endforeach
                </select><br>
                <input type="submit" name="submit_delete_category"><br>
            </form><br>
        </div>
    @endif
    @endisset
@endsection



        