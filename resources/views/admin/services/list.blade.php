@extends('admin.layout')

@section('title')
    Услуги
@endsection

@section('page_title')
    Услуги
@endsection

@section('body_content')
    @livewire('admin.service.service-list')
@endsection

@section('subheader_toolbar')
    <a class="btn btn-success" href="{{ route('admin.service.edit') }}">Нова услуга</a>
@endsection

@section('page_js')
    <script src="{{ asset('js/filters-form.js') }}" type="text/javascript"></script>
@endsection
