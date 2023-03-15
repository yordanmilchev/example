@extends('admin.layout')

@section('title')
    Списък настройки
@endsection

@section('page_title')
    Списък настройки
@endsection

@section('body_content')
    <script>
        function deleteSetting(settingId)
        {
            var destroyURL = "{{route('admin.settings.destroy', 'setting_id')}}";
            var settingTitle = $('#td_'+settingId).text();
            if(confirm('Моля, потвърди изтриването на настройката: \n'+settingTitle)) {
                destroyURL = destroyURL.replace("setting_id", settingId);
                $("#setting_delete_form").attr('action', destroyURL);
                $("#setting_delete_form").submit();
            }
        }
    </script>
    <form id="setting_delete_form" style="display: none;" method="POST">
        @method('DELETE')
        @csrf
    </form>
    <div class="row">
        <div class="col-lg-12">

            <!--begin::Portlet-->
            <div class="kt-portlet" id="kt_portlet_filters_form">
                <div class="kt-portlet__head kt-ribbon kt-ribbon--success">
                    <div class="kt-ribbon__target" style="top: 15px; left: -14px;"><i class="fa fa-search"></i></div>
                    <div class="kt-portlet__head-label" onclick="document.getElementById('searchOptionsToggleBtn').click();"
                         style="min-width:70%">
                        <h3 class="kt-portlet__head-title">
                            Филтри
                        </h3>
                    </div>
                    <div class="kt-portlet__head-toolbar">
                        <div class="kt-portlet__head-group">
                            <a href="javascript:;" data-ktportlet-tool="toggle" id="searchOptionsToggleBtn"
                               class="btn btn-sm btn-icon btn-outline-brand btn-icon-md"><i
                                    class="la la-angle-down"></i></a>
                            <a href="javascript:;" data-ktportlet-tool="reload"
                               class="btn btn-sm btn-icon btn-outline-success btn-icon-md"><i
                                    class="la la-refresh"></i></a>
                            <a href="javascript:;" data-ktportlet-tool="remove"
                               class="btn btn-sm btn-icon btn-outline-danger btn-icon-md"><i class="la la-close"></i></a>
                        </div>
                    </div>
                </div>
                <!--begin::Form-->
                <form id="filters_form" name="filters_form" class="kt-form kt-form--label-right" method="GET" action="">
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Тип:</label>
                                <select name="setting_type" class="form-control kt-select2">
                                    <option value="">Изберете</option>
                                    @foreach(\App\Constant\SettingConstant::TYPES_WITH_LABEL as $type => $label)
                                        <option value="{{ $type }}" {{ old('setting_type') == $type ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <div class="row">
                                <div class="col-lg-12">
                                    <button id="submit-form" type="submit" class="btn btn-primary js-loader">Търсене</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Portlet-->
        </div>
    </div>

    <div class="kt-portlet">
        <div class="kt-portlet__body">

            <!--begin::Section-->
            <div class="kt-section">
                <div class="kt-section__content">
                    @include('admin.components.flashes')
                    <div class="table-responsive">
                        {{ $settings->appends(request()->query())->links() }}
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-light">
                            <tr>
                                <th class="text-center font-weight-bold">ID</th>
                                <th class="text-center font-weight-bold">Група</th>
                                <th class="text-center font-weight-bold">Тип</th>
                                <th class="text-center font-weight-bold">Описание</th>
                                <th class="text-center font-weight-bold">Стойност</th>
                                <th class="text-center font-weight-bold">Ст-ст по език</th>
                                <th class="text-center font-weight-bold">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($settings as $setting)
                                <tr>
                                    <td class="text-center" style="width: 1% !important;">{{ $setting->id }}</td>
                                    <td>{{ $setting->group ?? '- без група -' }}</td>
                                    <td class="text-left"><strong>{{ \App\Constant\SettingConstant::TYPES_WITH_LABEL[$setting->setting_type] }}</strong></td>
                                    <td><span id="td_{{ $setting->id }}">{{ $setting->description }}</span></td>
                                    <td class="text-right">
                                        <b>{{ \Str::limit($setting->setting_value, 40) }}</b>
                                    </td>
                                    <td class="text-left">
                                        @if (count($setting->getTranslationsArray()))
                                            <div class="table-responsive">
                                                <table class="table">
                                                    @foreach($setting->getTranslationsArray() as $locale => $translation)
                                                        <tr>
                                                            <td><strong>{{ $locale }}</strong>: </td>
                                                            <td class="text-right">{{ $translation['value_by_locale'] }}</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if (!$setting->is_system)
                                            <a href="{{ route('admin.settings.edit', ['setting' => $setting]) }}" role="button" class="btn btn-sm btn-outline-brand btn-icon"><i
                                                    class="flaticon-edit"></i></a>
                                            <a href="javascript:deleteSetting({{$setting->id}});" role="button" class="btn btn-sm btn-outline-danger btn-icon">
                                                <i class="flaticon-delete"></i></a>
                                        @else
                                            - системна -
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-danger">Няма резултати</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        {{ $settings->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>

            <!--end::Section-->
        </div>

        <!--end::Form-->
    </div>
@endsection


@section('page_js')
    <script src="{{ asset('js/filters-form.js') }}" type="text/javascript"></script>
    @parent
    <script>
        $(document).ready(function(e) {
            $('#filters_form').disableAutoFill();
            $('input').keypress(function (e) {
                if (e.which == 13) {
                    $('#submit-form').trigger('click');
                }
            });
            $('.kt-select2').select2({
                placeholder: "Изберете"
            });

        });
    </script>
@endsection

