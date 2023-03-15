@extends('admin.layout')

@section('title')
    Списък галерии
@endsection

@section('page_title')
    Списък галерии
@endsection

@section('body_content')
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Portlet-->
            <div class="kt-portlet kt-portlet--tab">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            Галерии
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <div class="dd">
                        <ol class="dd-list">
                            @foreach($categoriesTree as $category)
                                <li class="dd-item dd3-item" data-id="{{ $category['id'] }}" data-weight="{{ $category['weight'] }}">
                                    <div class="dd-handle dd3-handle"></div>
                                    <div class="dd3-content">
                                        <div class="flex-with-spaced">
                                            {{ $category['title'] }}
                                            <div>
                                                <a href="{{ route('gallery', $category['slug']) }}" target="_blank" role="button"
                                                   class="btn btn-sm btn-outline-success btn-icon extra-small-btn">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.gallery.edit', ['id' => $category['id']]) }}" role="button"
                                                   class="btn btn-sm btn-outline-brand btn-icon extra-small-btn">
                                                    <i class="flaticon-edit"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @if(isset($category['children']) && count($category['children']))
                                        @include('admin.gallery._sub_gallery_categories', [
                                           'children' => $category['children']
                                       ])
                                    @endif
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
        <a class="btn btn-success" href="{{ route('admin.gallery.edit') }}">Нова галерия</a>
    </div>
@endsection

@section('page_js')
    @parent
    <script src="{{ asset('js/jquery-nestable.js') }}" type="text/javascript"></script>
    <script>
        $(window).ready(function(e) {
            $('.dd').nestable({ group: 1, maxDepth: 5 });
            $('.dd').on('change', function() {
                var serializedCategories = $('.dd').nestable('serialize');
                $.ajax({
                    type: "POST",
                    url: '{{ route('admin.gallery.gallery_categories.save') }}',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'category_tree': serializedCategories
                    }
                });
            });
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
