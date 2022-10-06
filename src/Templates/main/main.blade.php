<!DOCTYPE html>
@extends('basic.basic')

@section('article')
    <div>
        {{$info['topic']}}
    </div>
    <div>
        {{$info['desc']}}
    </div>
@endsection