@extends('admin.layout')

@section('title')
    {{ $article->id ? 'Редакция': 'Създаване' }} на статия {{ $article->id ?  $article->title : '' }}
@endsection

@section('page_title')
    {{ $article->id ? 'Редакция': 'Създаване' }} на статия {{ $article->id ?  $article->title : '' }}
@endsection

@section('body_content')
    <form method="post"
          action="{{ $article->id ? route('admin.blog.article.edit', ['id' => $article]) : route('admin.blog.article.edit') }}"
          id="product-form" class="kt-form kt-form--label-right" enctype="multipart/form-data" autocomplete="off"
          novalidate>
        {{ csrf_field() }}
        {{ method_field('POST') }}

        @include('admin.blog._article_edit_main_characteristics', [
           'article' => $article,
        ])

        @include('admin.blog._article_edit_categories', [
           'article' => $article,
        ])

        @include('admin.blog._article_edit_main_image', [
           'article' => $article,
        ])

        @include('admin.blog._article_edit_users_edited_article', [
           'article' => $article,
        ])

        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-4">
                    </div>
                    <div class="col-8">
                        <input type="submit" class="btn btn-success" value="Запазване"/>
                        <button type="reset" class="btn btn-secondary go-back-btn">Обратно</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('page_css')
    <link href="{{ asset('vendor/Magnific-Popup-master/dist/magnific-popup.css') }}" rel="stylesheet"
          type="text/css"/>

    <style>
        .form-group label {
            font-weight: 600 !important;
            font-size: 1.2rem !important;
        }

        label.custom-file-label {
            font-weight: 400 !important;
            font-size: 1.0rem !important;
        }

        h4.kt-portlet__head-title {
            font-size: 1.5rem !important;
            font-weight: 700 !important;
        }
    </style>
@endsection

@section('page_js')
    <script src="{{ asset('themes/metronic/assets/plugins/custom/tinymce/tinymce.bundle.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('vendor/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') }}"
            type="text/javascript"></script>


    <script>
        $('.image-link').magnificPopup({type: 'image'});

        tinymce.init({
            selector: '.rich_text_editor',
            menubar: false,
            toolbar: ['styleselect fontselect fontsizeselect',
                'undo redo | cut copy paste | bold italic | link image | alignleft aligncenter alignright alignjustify',
                'bullist numlist | outdent indent | blockquote subscript superscript | advlist | autolink | lists charmap | print preview |  code'],
            plugins : 'advlist autolink link image lists charmap print preview code',
            branding: false,
            file_picker_callback : function(callback, value, meta) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = '/filemanager?editor=tinyMCE&type=Files';

                tinyMCE.activeEditor.windowManager.openUrl({
                    url : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            }
        });
    </script>

    <script>
        $(function () {
            var dateOptions = {
                format: "yyyy-mm-dd",
                autoclose: true,
                todayHighlight: true,
                language: '{{ Lang::locale() }}',
                todayBtn: true,
                weekStart: 1
            };

            $('#blog_date').datepicker(dateOptions);
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview-on-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection

@if($article->id)
    @section('subheader_toolbar')
        <a href="{{ route('blog.article', $article->slug) }}" target="_blank" role="button"
           class="btn btn-sm btn-outline-success btn-icon" style="margin-right: 15px;">
            <i class="far fa-eye"></i></a>
    @endsection
@endif
