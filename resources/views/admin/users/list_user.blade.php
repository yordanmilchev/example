@extends('admin.layout')

@section('title')
    Потребителски профили
@endsection

@section('page_title')
    Потребителски профили
@endsection

@section('body_content')
    @livewire('admin.users.list-user')
@endsection

@section('subheader_toolbar')
    <a class="btn btn-success" href="{{ route('admin.user.list-edit') }}">Нов потребиетел</a>
@endsection

@section('page_js')
    <script src="{{ asset('js/filters-form.js') }}" type="text/javascript"></script>
@endsection
