<!DOCTYPE html>
@extends('basic.basic')

@section('article')
    @foreach ($reviews as $review)
        <p>Код отзыва: {{$review['review_id']}}</p>
        <p>Текст отзыва: {{$review['review_text']}}</p><br>
    @endforeach
    <p><b>Оставить отзыв:</b></p>
    <form method="post" name="set_review" action="{{BASEPATH}}profile/{{SESSION['id']}}/reviews/set-review">
        Ваш отзыв: <input type="text" name="reviewText" maxlength="501"><br>
        <input type="submit" name="submit_set_review"><br>
    </form><br><br>
    <p><b>Изменить текст отзыва:</b></p>
    <form method="post" name="update_review_text" action="{{BASEPATH}}profile/{{SESSION['id']}}/reviews/update-review-text">
        Id отзыва: <select name="id_review">
        @foreach ($reviews as $review)
            <option value="{{$review['review_id']}}">{{$review['review_id']}}</option>
        @endforeach
        </select><br>
        Новый текст отзыва: <input type="text" name="newReviewText" maxlength="501"><br>
        <input type="submit" name="submit_update_review_text"><br>
    </form><br>
    <p><b>Удалить отзыв:</b></p>
    <form method="post" name="delete_review" action="{{BASEPATH}}profile/{{SESSION['id']}}/reviews/delete-review">
        Id отзыва: <select name="id_review_delete">
        @foreach ($reviews as $review)
            <option value="{{$review['review_id']}}">{{$review['review_id']}}</option>
        @endforeach
        </select><br>
        <input type="submit" name="submit_delete_review"><br>
    </form><br>
@endsection