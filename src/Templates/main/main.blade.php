<!DOCTYPE html>
@extends('basic.basic')

@section('article')
    <div>
        <p>{{$info['topic']}}</p>
    </div>
    <div>
        <p>{{$info['desc']}}</p>
    </div>
@endsection