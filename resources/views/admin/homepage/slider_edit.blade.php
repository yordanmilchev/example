@extends('admin.layout')

@section('title')
    {{ $slider->id ? 'Редакция': 'Създаване' }} на слайдър за заглавната страница {{ $slider->id ?  $slider->title : '' }}
@endsection

@section('page_title')
    {{ $slider->id ? 'Редакция': 'Създаване' }} на слайдър за заглавната страница {{ $slider->id ?  $slider->title : '' }}
@endsection

@section('body_content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title pl-0">
                    <a href="{{ route('admin.homepage.slider.list') }}" title="Назад към списъка" class=""><i class="fas fa-arrow-left"></i></a>
                </h3>

                <h3 class="kt-portlet__head-title">
                    Основни характеритики
                </h3>
            </div>
        </div>
        <form method="post" action="{{ $slider->id ? route('admin.homepage.slider.edit', ['id' => $slider->id]) : route('admin.homepage.slider.edit') }}" id="update-homepage-form" class="kt-form kt-form--label-right" enctype="multipart/form-data" autocomplete="off" novalidate>
            {{ csrf_field() }}

        <div class="kt-portlet__body">
            <!--begin::Section-->
            <div class="kt-section">
                <div class="kt-section__content">
                    @include('admin.components.flashes')
                    <div class="form-group row">
                        <div class="col-lg-6">
                            <label>Тежест</label>
                            <input name="weight" type="number" class="form-control" value="{{ old('weight',  $slider->weight) }}">
                            <span class="form-text text-muted">Трябва да е число (0, 1, 2, ...). Елемент с тежест 1 се показва преди 5</span>
                        </div>
                        <div class="col-lg-6">
                            <label>Активен?</label>
                            <input type="hidden" name="is_enabled" value="0">
                            <input name="is_enabled" type="checkbox" id="is_enabled" class="form-control align-left" value="1" {{ old('is_enabled', $slider->is_enabled ? 'checked' : '') }} />
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="input-group">
                            <div class="col-lg-12">
                                <label>Линк</label>
                                <input name="weight" type="text" class="form-control" value="{{ old('link',  $slider->link) }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-4 mt-5">
                            @if(!empty($slider->image))
                                <a href="{{ gallery_image($slider->image, \App\Constant\GalleryFileConstant::TYPE_SLIDER_IMAGE, \App\Constant\GalleryFileConstant::TYPE_COMPRESSED) }}"
                                   class="image-link">
                                    <img src="{{ gallery_image($slider->image, \App\Constant\GalleryFileConstant::TYPE_SLIDER_IMAGE, \App\Constant\GalleryFileConstant::TYPE_COMPRESSED) }}"
                                        id="preview-on-upload"
                                        style="max-width: 100%;" class="rounded">
                                </a>
                            @else
                                <img
                                    src="{{ asset('images/placeholder-image.png') }}"
                                    id="preview-on-upload" style="max-width: 100%;" class="rounded">
                            @endif
                        </div>

                        <div class="col-4 mt-5">
                            <label for="example-text-input" class="mt-20 mr-20">Десктоп изображение(1920x490):</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input onchange="readURL(this);" name="image" type="file"
                                           class="custom-file-input" id="image">
                                    <label class="custom-file-label text-left" for="image">
                                        <i class="fa fa-file"></i> {{ $slider->image }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-4 mt-5">
                            @if(!empty($slider->mobile_image))
                                <a href="{{ gallery_image($slider->mobile_image, \App\Constant\GalleryFileConstant::TYPE_SLIDER_IMAGE, \App\Constant\GalleryFileConstant::TYPE_COMPRESSED) }}"
                                   class="image-link">
                                    <img src="{{ gallery_image($slider->mobile_image, \App\Constant\GalleryFileConstant::TYPE_SLIDER_IMAGE, \App\Constant\GalleryFileConstant::TYPE_COMPRESSED) }}"
                                        id="preview-on-upload-mobile"
                                        style="max-width: 100%;" class="rounded">
                                </a>
                            @else
                                <img
                                    src="{{ asset('images/placeholder-image.png') }}"
                                    id="preview-on-upload-mobile" style="max-width: 100%;" class="rounded">
                            @endif
                        </div>

                        <div class="col-4 mt-5">
                            <label for="example-text-input" class="mt-20 mr-20">Мобилно изображение(800x400):</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input onchange="readMobileURL(this);" name="mobile_image" type="file"
                                           class="custom-file-input" id="mobile_image">
                                    <label class="custom-file-label text-left" for="mobile_image">
                                        <i class="fa fa-file"></i> {{ $slider->mobile_image }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Section-->
        </div>
        <div class="kt-portlet__foot  mt-20 mr-20">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-4">
                    </div>
                    <div class="col-8">
                        <input type="submit" class="btn btn-success" value="Запазване" />
                        <button type="reset" class="btn btn-secondary go-back-btn">Обратно</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('page_css')
    <link href="{{ asset('css/custom/typeahead.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('vendor/Magnific-Popup-master/dist/magnific-popup.css') }}" rel="stylesheet" type="text/css" />
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
    <script src="{{ asset('vendor/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') }}" type="text/javascript"></script>

    @parent
    <script>
        $(document).ready(function(e){
            $('.image-link').magnificPopup({type:'image'});
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

        function readMobileURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#preview-on-upload-mobile').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
