<!DOCTYPE html>
@extends('basic.basic')

@section('article')
<div class="info">
    <div class="reviews">
        <div class="thead">
            <div class="col">Код отзыва</div>
            <div class="col">Текст отзыва</div>
        </div>
    @foreach ($reviews as $review)
        <div class="row">
            <div class="col">{{$review['review_id']}}</div>
            <div class="col">{{$review['review_text']}}</div>
        </div>
    @endforeach
    </div>
    <p>Оставить отзыв:</p>
    <form 
        method="post" 
        class="set-changes reviews" 
        name="set_review" 
        action="{{BASEPATH}}profile/{{$SESSION['id']}}/reviews/set-review">
        Ваш отзыв: <input type="text" name="reviewText" maxlength="501"><br>
        <input type="submit" name="submit_set_review">
    </form>
    <p>Изменить текст отзыва:</p>
    <form
        method="post" 
        class="set-changes reviews"
        name="update_review_text" 
        action="{{BASEPATH}}profile/{{$SESSION['id']}}/reviews/update-review-text"
    >
        Id отзыва: <select name="id_review">
        @foreach ($reviews as $review)
            <option value="{{$review['review_id']}}">{{$review['review_id']}}</option>
        @endforeach
        </select><br>
        Новый текст отзыва: <input type="text" name="newReviewText" maxlength="501"><br>
        <input type="submit" name="submit_update_review_text">
    </form>
    <p>Удалить отзыв:</p>
    <form 
        method="post" 
        class="set-changes reviews" 
        name="delete_review" 
        action="{{BASEPATH}}profile/{{$SESSION['id']}}/reviews/delete-review">
        Id отзыва: <select name="id_review_delete">
        @foreach ($reviews as $review)
            <option value="{{$review['review_id']}}">{{$review['review_id']}}</option>
        @endforeach
        </select><br>
        <input type="submit" name="submit_delete_review">
    </form>
</div>
@endsection