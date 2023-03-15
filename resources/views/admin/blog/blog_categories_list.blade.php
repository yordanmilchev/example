@extends('admin.layout')

@section('title')
    Списък категории статии
@endsection

@section('page_title')
    Списък категории статии
@endsection

@section('body_content')
<div class="row">
    <div class="col-lg-12">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--tab">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Категории
                    </h3>
                </div>
            </div>

            <div class="kt-portlet__body">
                <div class="dd">
                    <ol class="dd-list">
                        @foreach($blogCategories as $blogCategory)
                        <li class="dd-item dd3-item">
                            <div class="dd-handle dd3-handle"></div>
                            <div class="dd3-content">
                                <div class="flex-with-spaced">
                                    {{ $blogCategory->title }}
                                    <div>
                                        <a href="{{ route('admin.blog.categories.edit', ['id' => $blogCategory]) }}" role="button" class="btn btn-sm btn-outline-brand btn-icon extra-small-btn"><i
                                                class="flaticon-edit"></i></a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        </div>
        <!--end::Portlet-->
    </div>
</div>
@endsection

@section('subheader_toolbar')
    <div class="row float-right kt-padding-r-20">
        <a class="btn btn-success" href="{{ route('admin.blog.categories.edit') }}">Нова блог категория</a>
    </div>
@endsection

@section('page_js')
    <script src="{{ asset('js/jquery-nestable.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
    $(window).ready(function(e) {
        $('.dd').nestable({ group: 1, maxDepth: 5 });
    });
</script>
@endsection

@section('page_css')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('css/nestable.css') }}">

    <style>
        .flex-with-spaced {
            display: flex;
            justify-content: space-between;
        }
        .extra-small-btn {
            height: 20px !important;
        }
    </style>
@endsection
