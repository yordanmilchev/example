@extends('admin.layout')

@section('title')
    Редактиране на {{ $mainSetting->group ?  'група настройки: ' . $mainSetting->group : \App\Constant\SettingConstant::TYPES_WITH_LABEL[$mainSetting->setting_type] }}
@endsection

@section('page_title')
    Редактиране на {{ $mainSetting->group ?  'група настройки: ' . $mainSetting->group : \App\Constant\SettingConstant::TYPES_WITH_LABEL[$mainSetting->setting_type] }}
@endsection

@section('body_content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title pl-0">
                    <a href="{{ route('admin.settings.index') }}" title="Назад към списъка" class=""><i class="fas fa-arrow-left"></i></a>
                </h3>

                <h3 class="kt-portlet__head-title">
                    Редактиране на стойности
                </h3>
            </div>
        </div>
        <form name="setting_edit" method="post" action="{{ route('admin.settings.update', ['setting' => $mainSetting]) }}" id="update-product-model-form" class="kt-form kt-form--label-right" novalidate>
            {{ csrf_field() }}
            {{ method_field('patch') }}

            <div class="kt-portlet__body">
                <!--begin::Section-->
                <div class="kt-section">
                    <div class="kt-section__content">
                        @include('admin.components.flashes')

                        @foreach($settingsToBeEditted as $settingToBeEdited)
                            @php $fieldsPrefix = $settingToBeEdited->setting_type @endphp
                            {!! !$loop->first ? '<br/>' : '' !!}
                            <div class="alert-info">&nbsp; Полета за настройка: <strong>{{ \App\Constant\SettingConstant::TYPES_WITH_LABEL[$settingToBeEdited->setting_type] }}</strong> </div>
                            <br/>
                            <div class="form-group row">
                                <div class="input-group ">
                                    <div class="col-12 mt-20 mr-20">
                                        <label for="example-text-input" class="mt-20 mr-20">Стойност на настройката независеща от езикова версия</label>
                                    </div>
                                    <div class="col-12">
                                    @if($settingToBeEdited->data_type==\App\Constant\SettingConstant::DATA_TYPE_DATE)
                                        <input name="{{ $fieldsPrefix . '_' .'setting_value' }}" type="text" value="{{ old($fieldsPrefix . '_' .'setting_value' , $settingToBeEdited->setting_value ?? '') }}" class="form-control kt_datepicker_mysql" readonly="">
                                    @elseif($settingToBeEdited->data_type==\App\Constant\SettingConstant::DATA_TYPE_DATETIME)
                                        <input name="{{ $fieldsPrefix . '_' .'setting_value' }}" type="text" value="{{ old($fieldsPrefix . '_' .'setting_value' , $settingToBeEdited->setting_value ?? '') }}" class="form-control kt_datetimepicker_mysql" readonly="">
                                    @elseif($settingToBeEdited->data_type==\App\Constant\SettingConstant::DATA_TYPE_TEXT)
                                        <textarea name="{{ $fieldsPrefix . '_' .'setting_value' }}" class="form-control" style="min-height: 300px;">{{ old($fieldsPrefix . '_' .'setting_value' , $settingToBeEdited->setting_value ?? '') }}</textarea>
                                    @else
                                        <input name="{{ $fieldsPrefix . '_' .'setting_value' }}" type="text" value="{{ old($fieldsPrefix . '_' .'setting_value' , $settingToBeEdited->setting_value ?? '') }}" class="form-control">
                                    @endif
                                    </div>
                                </div>
                            </div>
                            @if (!in_array( $settingToBeEdited->setting_type, [\App\Constant\SettingConstant::TYPE_KIT_SKUS, \App\Constant\SettingConstant::TYPE_UNLIMITED_SKUS]))
                               @php
                               $translationsFieldsConfig = [
                                   'value_by_locale' => [
                                      'object' => $settingToBeEdited,
                                      'label' => 'Стойност по езикова версия',
                                      'type' => $settingToBeEdited->data_type,
                                   ]
                               ];
                               @endphp
                               {{ \TransWidget::renderFields($translationsFieldsConfig, $fieldsPrefix) }}
                               <hr/>
                            @endif
                       @endforeach
                </div>
           </div>
        <!--end::Section-->
        </div>
        <div class="kt-portlet__foot">
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



