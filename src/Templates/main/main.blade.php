<!DOCTYPE html>
@extends('basic.basic')

@section('article')
    <div class="response">
        @isset($response)
            @isset($response['deleted_user'])
                <p>Пользователь с id: {{$response['deleted_user']}} был удален.</p>
            @endisset
        @endisset
    </div>
    </div>
    <div>
        <p>{{$info['desc']}}</p>
    </div>
@endsection