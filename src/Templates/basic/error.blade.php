<!DOCTYPE html>
@extends('basic.basic')

@section('article')
    <p class="error_message">Oops! There seems to be an error.</p>
    <p class="error_message">Details: {{$message}}.</p>
@endsection