@extends('admin.layout')

@section('title')
    Списък с роли
@endsection

@section('page_title')
    Списък с роли
@endsection

@section('body_content')
    @livewire('admin.acl.roles')
@endsection
