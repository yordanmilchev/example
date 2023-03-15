@extends('admin.layout')

@section('title')
    Слайдър на началната страница
@endsection

@section('page_title')
    Слайдър на началната страница
@endsection

@section('body_content')
    @livewire('admin.homepage.sliders-list')
@endsection

@section('page_js')
    <script src="{{ asset('js/filters-form.js') }}" type="text/javascript"></script>
@endsection

@section('subheader_toolbar')
    <a href="{{ route('admin.homepage.slider.edit') }}" class="btn btn-success">Нов елемент</a>
@endsection
