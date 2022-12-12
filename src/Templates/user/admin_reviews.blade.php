<!DOCTYPE html>
@extends('basic.basic')

@section('article')
<div class="info">
    <div class="reviews">
        <div class="thead">
            <div class="review-id">Код отзыва</div>
            <div class="review-user">Пользователь</div>
            <div class="review-text">Текст отзыва</div>
        </div>
    @foreach ($reviews as $review)
        <div class="row">
            <div class="review-id">{{$review['review_id']}}</div>
            <div class="review-user">{{$review['user_name']}} {{$review['user_surname']}}</div>
            <div class="review-text">{{$review['review_text']}}</div>
        </div>
    @endforeach
    </div>
</div>    
@endsection