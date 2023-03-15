@extends('admin.layout')

@section('title')
    Редакция на партньори на началната страница
@endsection

@section('page_title')
    Редакция на партньори на началната страница
@endsection

@section('body_content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title">
                    Изображения
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body">
            <!--begin::Section-->
            <form class="kt-section" action="{{ route('admin.homepage.partners.save') }}" method="POST">
                @csrf
                <div class="kt-section__content">
                    @include('admin.components.flashes')
                    @php $partnerfilesIndex = 0 @endphp
                    <div class="kt-portlet__body">
                        <!--begin::Section-->
                        <div class="kt-section">
                            <div class="kt-section__content">
                                <div id="partner_images_panel" class="images-panel">
                                    <div class="form-group form-group-last row" id="partner_images_panel">
                                        <div id="sortable" data-repeater-list="partner_images" class="col-lg-12">
                                            @include('admin.homepage._partner_file_prototype')

                                            @foreach($partners as $partnerImage)
                                                @php $partnerfilesIndex++ @endphp
                                                <div data-repeater-item class="form-group row align-items-center image-wrapper"
                                                     data-image-id="{{ $partnerImage->id }}">
                                                    <div class="col-md-3">
                                                        <div class="kt-form__group--inline">
                                                            <a href="{{ asset(\App\Constant\GalleryFileConstant::GALLERY_FILE_DIRECTORIES[\App\Constant\GalleryFileConstant::TYPE_PARTNER_IMAGE].$partnerImage->name) }}"
                                                               class="image-link">
                                                                <img
                                                                    src="{{ asset(\App\Constant\GalleryFileConstant::GALLERY_FILE_DIRECTORIES[\App\Constant\GalleryFileConstant::TYPE_PARTNER_IMAGE].$partnerImage->name) }}"
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
                                                                <input name="id" type="hidden" value="{{ $partnerImage->id }}"
                                                                       class="image-id"
                                                                       data-type="{{ \App\Constant\GalleryFileConstant::TYPE_PARTNER_IMAGE }}"/>
                                                                <input name="filename" type="file" class="custom-file-input"
                                                                       id="customFile{{$partnerfilesIndex}}">
                                                                <label class="custom-file-label text-left"
                                                                       for="customFile{{$partnerfilesIndex}}">{{ $partnerImage->name }}</label>
                                                                <input id="position_for_{{ $partnerImage->id }}" name="position"
                                                                       type="hidden" value="{{ $partnerImage->position }}" readonly
                                                                       class="js-position-holder readonly"/>
                                                            </div>
                                                        </div>
                                                        <div class="d-md-none kt-margin-b-10"></div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="kt-form__group--inline">
                                                            <div class="kt-form__label">
                                                                <label>Линк:</label>
                                                            </div>
                                                            <div class="kt-form__control">
                                                                <input type="text" name="link" class="form-control"
                                                                       placeholder="Напишете линк"
                                                                       value="{{ $partnerImage->link }}">
                                                            </div>
                                                        </div>
                                                        <div class="d-md-none kt-margin-b-10"></div>
                                                    </div>
                                                    <div class="col-md-1 pt-4">
                                                        <a href="javascript:;" data-repeater-delete="" class="btn-sm btn btn-label-danger btn-bold">
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
                                        <div class="col-lg-4">
                                            <a href="javascript:;" data-repeater-create="" class="btn btn-bold btn-sm btn-label-brand">
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
                                <input type="submit" class="btn btn-success" value="Запис" />
                                <button type="reset" class="btn btn-secondary go-back-btn">Обратно</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--end::Section-->
    </div>
@endsection

@section('page_css')
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
    <script src="{{ asset('js/jquery-ui.js') }}"></script>

    @parent
    <script>
        $(document).ready(function(e){
            $('.image-link').magnificPopup({type:'image'});

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
                $fileType = $imageIdInput.data('type');

                var formData = new FormData();
                formData.append('imagefile', file);
                formData.append('file_type', $fileType);
                if ($fileId) {
                    formData.append('file_id', $fileId);
                }

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url : '{{ route('admin.homepage.file.upload') }}',
                    data : formData,
                    type : 'POST',
                    processData: false,
                    contentType: false,
                    cache: false,
                    success : function(data){
                        if (data.partner_id) {
                            $imageIdInput.val(data.partner_id);
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

            $('#partner_images_panel').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': 'foo'
                },

                show: function () {
                    $(this).slideDown();
                    $('.image-link').magnificPopup({type:'image'});
                    $('.image-wrapper').each(function (index) {
                        var currentIndex = index;
                        var positionInput = $(this).find('.js-position-holder');
                        positionInput.val(currentIndex);
                    });
                },

                hide: function (deleteElement) {
                    if(confirm('Наистина ли искате да изтриете снимката?')) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });
        });
    </script>
@endsection
