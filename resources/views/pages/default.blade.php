@extends('front.layout')

@section('title')
   {!! $content->title !!}  | {{ setting_val('TYPE_SITE_NAME') }}
@endsection

@section('main')
        {!! $content->content !!}
@endsection
