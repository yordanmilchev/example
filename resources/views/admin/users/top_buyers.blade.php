@extends('admin.layout')

@section('title')
    Топ купувачи
@endsection

@section('page_title')
    Топ купувачи
@endsection

@section('body_content')
    @livewire('admin.users.top-buyers')
@endsection

@section('page_js')
    <script src="{{ asset('js/filters-form.js') }}" type="text/javascript"></script>
@endsection
