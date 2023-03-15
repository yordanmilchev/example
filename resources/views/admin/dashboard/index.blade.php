@extends('admin.layout')

@section('header')
    @include('admin.components.header')
@overwrite

@section('body_content')
    <div class="text-center">
        {{ setting_val('TYPE_SITE_NAME') }}
    </div>
@endsection
