<!DOCTYPE html>
@extends('basic.basic')

@section('article')
<div class="info">
    <table class="reviews">
        <thead>
            <tr>
                <td>Код отзыва</td>
                <td>Текст отзыва</td>
            </tr>
        </thead>
    @foreach ($reviews as $review)
        <tr>
            <td>{{$review['review_id']}}</td>
            <td>{{$review['review_text']}}</td>
        </tr>
    @endforeach
    </table>
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