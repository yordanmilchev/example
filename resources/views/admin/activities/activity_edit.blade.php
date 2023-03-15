@extends('admin.layout')

@section('title')
    {{ $activity->id ? 'Редакция': 'Създаване' }} на дейност {{ $activity->id ?  $activity->title : '' }}
@endsection

@section('page_title')
    {{ $activity->id ? 'Редакция': 'Създаване' }} на дейност {{ $activity->id ?  $activity->title : '' }}
@endsection

@section('body_content')
    <form method="post"
          action="{{ $activity->id ? route('admin.activity.edit', ['id' => $activity]) : route('admin.activity.edit') }}"
          id="product-form" class="kt-form kt-form--label-right" enctype="multipart/form-data" autocomplete="off"
          novalidate>
        {{ csrf_field() }}
        {{ method_field('POST') }}

        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title pl-0">
                        <a href="{{ route('admin.activity.list') }}" title="Назад към списъка" class=""><i
                                class="fas fa-arrow-left"></i></a>
                    </h3>

                    <h3 class="kt-portlet__head-title">
                        Дейност
                    </h3>
                </div>
            </div>

            <div class="kt-portlet__body">
                <!--begin::Section-->
                <div class="kt-section">
                    <div class="kt-section__content">
                        @include('admin.components.flashes')

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Тежест</label>
                                <input name="weight" type="number" class="form-control" value="{{ old('weight',  $activity->weight) }}">
                                <span class="form-text text-muted">Трябва да е число (0, 1, 2, ...). Услуга с тежест 1 се показва преди 5</span>
                            </div>
                        </div>
                        @php $translationsFieldsConfig = [
                            'title' => [
                               'object' => $activity,
                               'label' => 'Име'
                            ],
                            'is_enabled' => [
                                'object' => $activity,
                                'label' => 'Активна дейност?',
                                'type' => 'checkbox'
                            ],
                            'excerpt' => [
                               'object' => $activity,
                               'label' => 'Кратко описание (в началната страница)',
                               'type' => 'rich_text_editor'
                            ],
                            'description' => [
                               'object' => $activity,
                               'label' => 'Дълго описание (в страницата на дейностите)',
                               'type' => 'rich_text_editor'
                            ],
                        ];
                        @endphp
                        {{ \TransWidget::renderFields($translationsFieldsConfig) }}
                    </div>
                </div>

                <div class="kt-section">
                    <div class="kt-section__content">
                        <div class="form-group row">
                            <div class="col-lg-4">
                                @if(!empty($activity->icon))
                                    <a href="{{ asset(\App\Constant\GalleryFileConstant::GALLERY_FILE_DIRECTORIES[\App\Constant\GalleryFileConstant::TYPE_ACTIVITY_IMAGE].$activity->icon) }}" class="image-link">
                                        <img src="{{ asset(\App\Constant\GalleryFileConstant::GALLERY_FILE_DIRECTORIES[\App\Constant\GalleryFileConstant::TYPE_ACTIVITY_IMAGE].$activity->icon) }}" id="preview-on-upload-icon"
                                             style="max-width: 100%;" class="rounded">
                                    </a>
                                @else
                                    <img
                                        src="{{ asset('images/placeholder-image.png') }}" id="preview-on-upload-icon"
                                        style="max-width: 100%;" class="rounded">
                                @endif
                            </div>

                            <div class="col-lg-4">
                                <label for="example-text-input" class="mt-20 mr-20">Икона(svg):</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input onchange="readURLIcon(this);" name="icon" type="file" class="custom-file-input" id="icon">
                                        <label class="custom-file-label text-left" for="icon">
                                            <i class="fa fa-file"></i>{{ ' '.$activity->icon }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="kt-section">
                    <div class="kt-section__content">
                        <div class="form-group row">
                            <div class="col-lg-4">
                                @if(!empty($activity->image))
                                    <a href="{{ gallery_image($activity->image, \App\Constant\GalleryFileConstant::TYPE_ACTIVITY_IMAGE, \App\Constant\GalleryFileConstant::TYPE_COMPRESSED) }}" class="image-link">
                                        <img src="{{ gallery_image($activity->image, \App\Constant\GalleryFileConstant::TYPE_ACTIVITY_IMAGE, \App\Constant\GalleryFileConstant::TYPE_COMPRESSED) }}" id="preview-on-upload"
                                             style="max-width: 100%;" class="rounded">
                                    </a>
                                @else
                                    <img
                                        src="{{ asset('images/placeholder-image.png') }}" id="preview-on-upload"
                                        style="max-width: 100%;" class="rounded">
                                @endif
                            </div>

                            <div class="col-lg-4">
                                <label for="example-text-input" class="mt-20 mr-20">Изображение:</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input onchange="readURL(this);" name="image" type="file" class="custom-file-input" id="image">
                                        <label class="custom-file-label text-left" for="image">
                                            <i class="fa fa-file"></i>{{ ' '.$activity->image }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview-on-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURLIcon(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview-on-upload-icon').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
