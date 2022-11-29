<!DOCTYPE html>
@extends('basic.basic')

@section('article')
<div class="info">
    <div class="reviews">
        <div class="thead">
            <div class="col">Код отзыва</div>
            <div class="col">Пользователь</div>
            <div class="col">Текст отзыва</div>
        </div>
    @foreach ($reviews as $review)
        <div class="row">
            <div class="col">{{$review['review_id']}}</div>
            <div class="col">{{$review['user_name']}} {{$review['user_surname']}}</div>
            <div class="col">{{$review['review_text']}}</div>
        </div>
    @endforeach
    </div>
</div>    
@endsection