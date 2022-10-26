<!DOCTYPE html>
@extends('basic.basic')

@section('article')
<div class="info">
    <table class="reviews">
        <thead>
            <tr>
                <td>Код отзыва</td>
                <td>Пользователь</td>
                <td>Текст отзыва</td>
            </tr>
        </thead>
    @foreach ($reviews as $review)
        <tr>
            <td>{{$review['review_id']}}</td>
            <td>{{$review['user_name']}} {{$review['user_surname']}}</td>
            <td>{{$review['review_text']}}</td>
        </tr>
    @endforeach
    </table>
</div>    
@endsection