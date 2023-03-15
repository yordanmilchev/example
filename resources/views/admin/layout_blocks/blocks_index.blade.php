@extends('admin.layout')

@section('title')
    Layout blocks
@endsection

@section('page_title')
    Layout blocks
@endsection

@section('body_content')
    @livewire('admin.layout-blocks.blocks-index')
@endsection

@section('page_js')
    <script src="{{ asset('js/filters-form.js') }}" type="text/javascript"></script>
@endsection

@section('subheader_toolbar')
    <a href="{{ route('admin.layout-blocks.create') }}" role="button" class="btn btn-success"><i class="flaticon2-plus"></i> Създай нов блок</a>
@endsection
