<!DOCTYPE html>
@extends('basic.basic')

@section('article')
<div class="info">
    <table>
    @foreach ($reviews as $review)
        <tr>
            <td>Код отзыва: {{$review['review_id']}}</td>
            <td>Пользователь: {{$review['user_name']}} {{$review['user_surname']}}</td>
            <td>Текст отзыва: {{$review['review_text']}}</td>
        </tr>
    @endforeach
    </table>
</div>    
@endsection