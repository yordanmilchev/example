@extends('admin.layout')

@section('title')
    Съобщения
@endsection

@section('page_title')
    Съобщения
@endsection

@section('body_content')
    @livewire('admin.inquiries.messages')
@endsection

@section('page_js')
    <script src="{{ asset('js/filters-form.js') }}" type="text/javascript"></script>
@endsection
