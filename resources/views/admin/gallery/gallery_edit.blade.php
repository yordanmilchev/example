@extends('admin.layout')

@section('title')
    {{ $gallery->id ? 'Редакция': 'Създаване' }} на галерия {{ $gallery->id ?  $gallery->title : '' }}
@endsection

@section('page_title')
    {{ $gallery->id ? 'Редакция': 'Създаване' }} на галерия {{ $gallery->id ?  $gallery->title : '' }}
@endsection

@section('body_content')
    <form method="post"
          action="{{ $gallery->id ? route('admin.gallery.edit', ['id' => $gallery]) : route('admin.gallery.edit') }}"
          id="product-form" class="kt-form kt-form--label-right" enctype="multipart/form-data" autocomplete="off"
          novalidate>
        {{ csrf_field() }}
        {{ method_field('POST') }}

        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title pl-0">
                        <a href="{{ route('admin.gallery.index') }}" title="Назад към списъка" class=""><i class="fas fa-arrow-left"></i></a>
                    </h3>

                    <h3 class="kt-portlet__head-title">
                        Основни характеристики
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body">
                <!--begin::Section-->
                <div class="kt-section">
                    <div class="kt-section__content">
                        @include('admin.components.flashes')

                        @php $translationsFieldsConfig = [
                                'title' => [
                                   'object' => $gallery,
                                   'label' => 'Заглавие на галерията'
                                ],
                                'slug' => [
                                    'object' => $gallery,
                                    'label' => 'Slug',
                                    'disabled' => true,
                                    'help' => 'Автоматично генериран идентификатор за галерията'
                                ],
                                'is_enabled' => [
                                    'object' => $gallery,
                                    'label' => 'Активна галерия?',
                                    'type' => 'checkbox',
                                ]
                            ];
                        @endphp
                        {{ \TransWidget::renderFields($translationsFieldsConfig) }}

                    </div>
                </div>
            </div>
        </div>

        <div id="gallery-images" class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title pl-0">
                        <a href="{{ route('admin.gallery.index') }}" title="Назад към списъка" class=""><i class="fas fa-arrow-left"></i></a>
                    </h3>

                    <h3 class="kt-portlet__head-title">
                        Изображения
                    </h3>
                </div>
            </div>

            @php $galleryfilesIndex = 0 @endphp
            <div class="kt-portlet__body">
                <!--begin::Section-->
                <div class="kt-section">
                    <div class="kt-section__content">
                        <div id="gallery_images_panel" class="images-panel">
                            <div class="form-group form-group-last row" id="gallery_images_panel">
                                <div id="sortable" data-repeater-list="gallery_images" class="col-lg-12">
                                    @include('admin.gallery._gallery_file_prototype')

                                    @php $iterableImages = old('gallery_images') ? old('gallery_images') : $gallery->getGalleryFiles() @endphp

                                    @foreach($iterableImages as $galleryImage)
                                        @php
                                            if (is_array($galleryImage)) {
                                                if (!empty($galleryImage['id'])) {
                                                    $oldImageData = $galleryImage;
                                                    $galleryImage = \App\Models\Gallery\GalleryImage::find($galleryImage['id']);
                                                } else {
                                                    continue;
                                                }
                                            }
                                        @endphp
                                        @php $galleryfilesIndex++ @endphp
                                        <div data-repeater-item class="form-group row align-items-center image-wrapper"
                                             data-image-id="{{ $galleryImage->id }}">
                                            <div class="col-md-3">
                                                <div class="kt-form__group--inline">
                                                    <a href="{{ gallery_image($galleryImage->name, \App\Constant\GalleryFileConstant::TYPE_GALLERY_IMAGE, \App\Constant\GalleryFileConstant::TYPE_COMPRESSED) }}"
                                                       class="image-link">
                                                        <img
                                                            src="{{ gallery_image($galleryImage->name, \App\Constant\GalleryFileConstant::TYPE_GALLERY_IMAGE, \App\Constant\GalleryFileConstant::TYPE_COMPRESSED) }}"
                                                            style="max-width: 100%;" class="rounded">
                                                    </a>
                                                </div>
                                                <div class="d-md-none kt-margin-b-10"></div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="kt-form__group--inline">
                                                    <div class="kt-form__label">
                                                        <label>Име на файл:</label>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input name="id" type="hidden" value="{{ $galleryImage->id }}"
                                                               class="image-id"
                                                               data-type=""/>
                                                        <input name="filename" type="file" class="custom-file-input"
                                                               id="customFile{{$galleryfilesIndex}}">
                                                        <label class="custom-file-label text-left"
                                                               for="customFile{{$galleryfilesIndex}}">{{ $galleryImage->name }}</label>
                                                        <input id="position_for_{{ $galleryImage->id }}" name="position"
                                                               type="hidden" value="{{ $galleryImage->position }}"
                                                               readonly
                                                               class="js-position-holder readonly"/>
                                                    </div>
                                                </div>
                                                <div class="d-md-none kt-margin-b-10"></div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="kt-form__group--inline">
                                                    <div class="kt-form__label">
                                                        <label>Заглавие:</label>
                                                    </div>
                                                    <div class="kt-form__control">
                                                        <input type="text" name="title" class="form-control"
                                                               placeholder="Напишете заглавие"
                                                               value="{{ is_array($galleryImage) ? ($oldImageData['title'] ?? '') : $galleryImage->title }}">
                                                    </div>
                                                </div>
                                                <div class="d-md-none kt-margin-b-10"></div>
                                            </div>
                                            <div class="col-md-1 pt-4">
                                                <a href="javascript:;" data-repeater-delete=""
                                                   class="btn-sm btn btn-label-danger btn-bold">
                                                    <i class="la la-trash-o"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <hr/>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group form-group-last row">
                                <label class="col-lg-2 col-form-label"></label>
                                <div class="col-lg-4 ">
                                    <a href="javascript:;" data-repeater-create=""
                                       class="btn btn-bold btn-sm btn-label-brand">
                                        <i class="la la-plus"></i> Ново изображение
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Section-->
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
    <script src="{{ asset('vendor/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') }}"
            type="text/javascript"></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>

    @parent
    <script>
        $(document).ready(function (e) {
            $('.image-link').magnificPopup({type: 'image'});

            $("#sortable").sortable({
                stop: function( event, ui ) {
                    $('.image-wrapper').each(function (index) {
                        var currentIndex = index;
                        var positionInput = $(this).find('.js-position-holder');
                        positionInput.val(currentIndex);
                    });
                }
            });

            $('.images-panel').on('change', '.custom-file-input', function() {
                $this = $(this);
                var fileName = $(this).val();
                var file = $(this).prop('files')[0];

                if (file.size > 8388608 || file.fileSize > 8388608) {
                    swal.fire("Качването не може да бъде осъществено", 'Размерът на файла не трябва да надвишава 8 MB', "error");
                }
                var reader = new FileReader();
                $imageIdInput = $(this).closest('.form-group').find('.image-id');

                $fileId = $imageIdInput.val();

                var formData = new FormData();
                formData.append('imagefile', file);
                formData.append('gallery_id', '{{ $gallery->id }}');
                if ($fileId) {
                    formData.append('gallery_file_id', $fileId);
                }

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url : '{{ route('admin.gallery.file.upload') }}',
                    data : formData,
                    type : 'POST',
                    processData: false,
                    contentType: false,
                    cache: false,
                    success : function(data){
                        if (data.gallery_id) {
                            $imageIdInput.val(data.gallery_id);
                            $this.next('.custom-file-label').addClass("selected").html(fileName);
                            $imagePreview = $this.closest('.form-group').find('img');

                            reader.onloadend = function () {
                                $imagePreview.attr('src', reader.result);
                                $imagePreview.parent('a').attr('href', reader.result);
                            }
                            if (file) {
                                reader.readAsDataURL(file);
                            } else {
                                $imagePreview.src = "";
                            }
                        } else {
                            if (data.error) {
                                swal.fire("Качването не може да бъде осъществено", data.error, "error");
                            }
                        }

                    }
                });
            });

            $('#gallery_images_panel').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': 'foo'
                },

                show: function () {
                    $(this).slideDown();
                    $('.image-link').magnificPopup({type: 'image'});
                    $('.image-wrapper').each(function (index) {
                        var currentIndex = index;
                        var positionInput = $(this).find('.js-position-holder');
                        positionInput.val(currentIndex);
                    });
                },

                hide: function (deleteElement) {
                    if (confirm('Наистина ли искате да изтриете снимката?')) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });
        });
    </script>
@endsection

@section('subheader_toolbar')
    <a href="{{ $gallery->id ? route('gallery', $gallery->slug) : '' }}" target="_blank" role="button"
       class="btn btn-sm btn-outline-success btn-icon" style="margin-right: 15px;">
        <i class="far fa-eye"></i>
    </a>
@endsection
