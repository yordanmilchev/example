@extends('admin.layout')

@section('title')
    Редактиране на страница
@endsection

@section('page_title')
    Редактиране на страница
@endsection

@section('body_content')
    <style>
        .rich_text_editor-wrapper > .tox-tinymce {
            height: 800px !important;
        }
    </style>

    <div class="row">
        <div class="col-12">

            <!--begin::Portlet-->
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title pl-0">
                            <a href="{{ route('admin.pages.index') }}" title="Назад към списъка" class=""><i
                                    class="fas fa-arrow-left"></i></a>
                        </h3>

                        <h3 class="kt-portlet__head-title">
                            Редактиране на страница
                        </h3>
                    </div>
                </div>

                <!--begin::Form-->
                <form class="kt-form" action="{{route('admin.pages.update', $page->id)}}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                @php
                                    $translationsFieldsConfig = [
                                        'title' => [
                                           'object' => $page,
                                           'label' => 'Заглавие*'
                                        ]
                                    ];
                                @endphp
                                {{ \TransWidget::renderFields($translationsFieldsConfig) }}
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-1 col-form-label">Активна страница?</label>
                            <div class="col-3">
                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                    <label>
                                        <input type="checkbox" @if($page->is_enabled==1) checked="checked"
                                               @endif name="is_enabled">
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <label>Route key* <a href="#" role="button"
                                                     class="btn btn-sm btn-outline-brand btn-icon js-add-key"><i
                                            class="flaticon-web"></i></a></label>
                                <select name="route_key" class="form-control" id="select_route_key">
                                    <option value=""></option>
                                    @foreach($routeKeys as $routeKey)
                                        <option value="{{$routeKey->route_key}}"
                                                @if($page->route_key==$routeKey->route_key) selected @endif>{{$routeKey->route_key}}</option>
                                    @endforeach
                                </select>
                                <span class="form-text text-muted">Това са ключове на хардкоднати в сорс кода линкове, които ще сочат към страницата, за която бъдат избрани. Всеки ключ може да се избере само за една страница.</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <label for="dynamicContentSelect">Темплейт</label>
                                <select name="template" class="form-control" id="dynamicContentSelect">
                                    @foreach(\App\Constant\PageConstant::templateList() as $template)
                                        <option value="{{$template}}">{{$template}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">

                                @php
                                    $translationsFieldsConfig = [
                                        'content' => [
                                           'object' => $page,
                                           'label' => 'Съдържание*',
                                           'type' => 'rich_text_editor'
                                        ]
                                    ];
                                @endphp
                                {!! \TransWidget::renderFields($translationsFieldsConfig) !!}
                            </div>
                        </div>

                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Portlet-->

        </div>
    </div>

    @include('admin.pages._route_key_modal_prototype')

@endsection

@section('page_js')
    @parent
    <script src="{{ asset('themes/metronic/assets/plugins/custom/tinymce/tinymce.bundle.js') }}"
            type="text/javascript"></script>
    <script>
        $(document).ready(function (e) {
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

            $('#add-key-btn').on('click', function (e) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('admin.add_key') }}',
                    data: $('#add-key-form').serialize(),
                }).done(function (data) {
                    $('#add-key-modal').modal('hide');
                    $('#select_route_key').append($('<option>',
                        {
                            value: data.route_key,
                            text: data.route_key
                        }));
                    Swal.fire('Успех', 'route_key беше добавен успешно', 'success');
                });
            });


            $('.js-add-key').on('click', function (e) {
                $('#route_key_content').val('');
                $('#add-key-modal').modal('show');
            })
        });
    </script>
@endsection

