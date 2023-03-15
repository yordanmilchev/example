@extends('admin.layout')

@section('title')
    Дейности
@endsection

@section('page_title')
    Дейности
@endsection

@section('body_content')
    @livewire('admin.activity.activity-list')
@endsection

@section('subheader_toolbar')
    <a class="btn btn-success" href="{{ route('admin.activity.edit') }}">Нова дейност</a>
@endsection

@section('page_js')
    <script src="{{ asset('js/filters-form.js') }}" type="text/javascript"></script>
@endsection
