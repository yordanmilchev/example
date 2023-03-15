@extends('admin.layout')

@section('title')
    Списък блог статии
@endsection

@section('page_title')
    Списък блог статии
@endsection

@section('body_content')
    @livewire('admin.blog.articles-list')
@endsection

@section('subheader_toolbar')
    <div class="row float-right kt-padding-r-20">
        <a class="btn btn-success" href="{{ route('admin.blog.article.edit') }}">Нова статия</a>
    </div>
@endsection

@section('page_js')
    <script src="{{ asset('js/filters-form.js') }}" type="text/javascript"></script>
@endsection
