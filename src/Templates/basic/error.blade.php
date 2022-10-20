<!DOCTYPE html>
@extends('basic.basic')

@section('article')
<div class="info">
    <p class="error_message">Oops! There seems to be an error.</p>
    <p class="error_message">Details: {{$message}}.</p>
</div>
@endsection