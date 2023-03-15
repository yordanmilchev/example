@php $uniqueIndexForTranslationPanel = \Str::random(5) @endphp
<ul class="nav nav-tabs" role="tablist">
    @foreach($locales as $locale)
        <li class="nav-item">
            <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-toggle="tab" href="#kt_tabs_input_{{ $locale . '_' . $uniqueIndexForTranslationPanel}}">
                <img class="flag-icon" src="{{ asset('images/flags/64x64/' . $locale . '.png') }}" /> {{ $locale }}
            </a>
        </li>
    @endforeach
</ul>
<div class="tab-content">
    @foreach($locales as $locale)
        <div class="tab-pane {{ $loop->first ? 'active' : '' }}" id="kt_tabs_input_{{ $locale . '_' . $uniqueIndexForTranslationPanel }}" role="tabpanel">
            @foreach($fields as $fieldName => $fieldAttributes)
                @php
                    if (isset($fieldAttributes['collection_index_name'])) {
                        $composedFieldName = $fieldAttributes['collection_index_name'] . $fieldsPrefix . $fieldName . ':' . $locale;
                    } else {
                        $composedFieldName = $fieldsPrefix . $fieldName . ':' . $locale;
                    }
                @endphp
                <div class="form-group row">
                    @if (isset($fieldAttributes['type']) && $fieldAttributes['type'] == 'switch_on_off')
                        <label class="col-2 col-form-label text-left">{{ $fieldAttributes['label'] }}</label>
                        <div class="col-10">
                                <span class="kt-switch kt-switch--outline kt-switch--icon">
                                <label>
                                    <input type="hidden" name="{{ $fieldsPrefix . $fieldName }}:{{ $locale }}" value="0">
                                    <input type="checkbox" name="{{ $fieldsPrefix . $fieldName }}:{{ $locale }}" {{ old($fieldsPrefix . $fieldName .':' . $locale, $fieldAttributes['object']->translate($locale)->$fieldName ?? '') ? 'checked="checked"' : '' }}>
                                    <span></span>
                                </label>
                            </span>
                        </div>
                    @else
                        <label class="{{ isset($fieldAttributes['type']) && in_array($fieldAttributes['type'], ['rich_text_editor', 'small_rich_text_editor', 'ace_editor']) ? 'col-12' : 'col-2' }} col-form-label text-left">{{ $fieldAttributes['label'] }}</label>
                        <div class="{{ isset($fieldAttributes['type']) && in_array($fieldAttributes['type'], ['rich_text_editor', 'small_rich_text_editor']) ? 'col-12' : 'col-10' }}">
                            @if (isset($fieldAttributes['type']) && $fieldAttributes['type'] == 'checkbox')
                                <input type="hidden" name="{{ $fieldsPrefix . $fieldName }}:{{ $locale }}" value="0">
                                <input name="{{ $fieldsPrefix . $fieldName }}:{{ $locale }}" type="checkbox" class="form-control align-left" value="1" {{ old($fieldsPrefix . $fieldName .':' . $locale, $fieldAttributes['object']->translate($locale)->$fieldName ?? '') ? 'checked' : '' }} />
                            @elseif (isset($fieldAttributes['type']) && $fieldAttributes['type'] == 'date')
                                <input type="text" name="{{ $fieldsPrefix . $fieldName }}:{{ $locale }}" value="@if(!empty($fieldAttributes['object']->translate($locale))){{$fieldAttributes['object']->translate($locale)->value_by_locale}}@endif" class="form-control kt_datepicker_mysql" readonly="">
                            @elseif (isset($fieldAttributes['type']) && $fieldAttributes['type'] == 'datetime')
                                <input type="text" name="{{ $fieldsPrefix . $fieldName }}:{{ $locale }}" value="@if(!empty($fieldAttributes['object']->translate($locale))){{$fieldAttributes['object']->translate($locale)->value_by_locale}}@endif" class="form-control kt_datetimepicker_mysql" readonly="">
                            @elseif (isset($fieldAttributes['type']) && in_array($fieldAttributes['type'], ['multiple_checkbox']))
                                <input name="{{ $fieldsPrefix . $fieldName }}:{{ $locale }}[]" type="checkbox" class="d-none"
                                       id="{{ $fieldsPrefix . $fieldName }}:{{ $locale }}"  value="" checked>
                                @foreach($fieldAttributes['choices'] as $choiceValue => $choiceLabel)
                                    <div class="form-check">
                                        <input name="{{ $fieldsPrefix . $fieldName }}:{{ $locale }}[]" type="checkbox" class="form-check-input"
                                               id="{{ $choiceValue }}"  value="{{ $choiceValue ?? '' }}" {{ in_array($choiceValue, old($fieldsPrefix . $fieldName . ':' . $locale, [])) ? 'checked' : (strpos($fieldAttributes['object']->translate($locale)->$fieldName ?? '', $choiceValue) !== false ? 'checked' : '') }}>
                                        <label class="form-check-label" for="{{ $choiceValue ?? '' }}">{{ $choiceLabel }}</label>
                                    </div>
                                @endforeach
                            @elseif (isset($fieldAttributes['type']) && in_array($fieldAttributes['type'], ['rich_text_editor', 'small_rich_text_editor']))
                                <div class="{{ $fieldAttributes['type'] }}-wrapper">
                                     <textarea name="{{ $fieldsPrefix . $fieldName }}:{{ $locale }}" class="{{ $fieldAttributes['type'] }}">
                                     @if (isset($fieldAttributes['object']))
                                         {{ old($fieldsPrefix . $fieldName .':' . $locale, $fieldAttributes['object']->translate($locale)->$fieldName ?? '') }}
                                     @endif

                                </textarea>
                                </div>
                            @elseif (isset($fieldAttributes['type']) && $fieldAttributes['type']=='ace_editor')
                                <div class="editor-container">
                                    <div id="ace_editor_{{ $locale }}" class="ace-editor">{{ old($fieldsPrefix . $fieldName .':' . $locale, $fieldAttributes['object']->translate($locale)->$fieldName ?? '') }}</div>
                                </div>
                                <script>
                                    var editor_{{ $locale }} = ace.edit("ace_editor_{{ $locale }}");
                                    editor_{{ $locale }}.setTheme("ace/theme/twilight");
                                    editor_{{ $locale }}.session.setMode("ace/mode/html");
                                    editor_{{ $locale }}.session.on('change', function() {
                                        document.getElementById("{{ $fieldsPrefix . $fieldName }}:{{ $locale }}").value = editor_{{ $locale }}.getValue();
                                    });
                                </script>

                                <textarea name="{{ $fieldsPrefix . $fieldName }}:{{ $locale }}" id="{{ $fieldsPrefix . $fieldName }}:{{ $locale }}" style="display: none;">
                                    @if (isset($fieldAttributes['object']))
                                    {{ old($fieldsPrefix . $fieldName .':' . $locale, $fieldAttributes['object']->translate($locale)->$fieldName ?? '') }}
                                    @endif
                                </textarea>
                            @elseif (isset($fieldAttributes['type']) && in_array($fieldAttributes['type'], ['textarea']))
                                <div class="{{ $fieldAttributes['type'] }}-wrapper">
                                    <textarea rows="6" name="{{ $fieldsPrefix . $fieldName }}:{{ $locale }}"
                                              class="form-control {{ $fieldAttributes['type'] }}">@if (isset($fieldAttributes['object'])){{ old($fieldsPrefix . $fieldName .':' . $locale, $fieldAttributes['object']->translate($locale)->$fieldName ?? '') }}@endif</textarea>
                                </div>
                            @elseif (isset($fieldAttributes['type']) && $fieldAttributes['type']=='num_default_0')
                                <input name="{{ $fieldsPrefix . $fieldName }}:{{ $locale }}"
                                       value="{{ $fieldAttributes['value'] ?? old($composedFieldName, $fieldAttributes['object']->translate($locale)->$fieldName ?? 0) }}" class="form-control"
                                    {{ isset($fieldAttributes['disabled']) ? 'disabled="disabled"' : '' }} {{ isset($fieldAttributes['readonly']) ? 'readonly' : '' }} {{ isset($fieldAttributes['required']) ? $fieldAttributes['required'] : '' }}
                                    {!! isset($fieldAttributes['data_type']) ? 'type="'.$fieldAttributes['data_type'].'"' : 'type="number"' !!}
                                    {!! isset($fieldAttributes['step']) ? 'step="'.$fieldAttributes['step'].'"' : '' !!}
                                />
                            @else
                                <div class="input-group">
                                    @if (isset($fieldAttributes['object']))
                                        <input name="{{ $fieldsPrefix . $fieldName }}:{{ $locale }}" value="{{ $fieldAttributes['value'] ?? old($composedFieldName, $fieldAttributes['object']->translate($locale)->$fieldName ?? '') }}" class="form-control"
                                            {{ isset($fieldAttributes['disabled']) ? 'disabled="disabled"' : '' }} {{ isset($fieldAttributes['readonly']) ? 'readonly' : '' }} {{ isset($fieldAttributes['required']) ? $fieldAttributes['required'] : '' }}
                                            {!! isset($fieldAttributes['data_type']) ? 'type="'.$fieldAttributes['data_type'].'"' : 'type="text"' !!}
                                            {!! isset($fieldAttributes['step']) ? 'step="'.$fieldAttributes['step'].'"' : '' !!}
                                        />
                                    @else
                                        <input name="{{ $fieldsPrefix . $fieldName }}:{{ $locale }}" value="{{ old($fieldsPrefix . $fieldName .':' . $locale) }}" class="form-control"
                                            {{ isset($fieldAttributes['disabled']) ? 'disabled="disabled"' : '' }} {{ isset($fieldAttributes['readonly']) ? 'readonly' : '' }} {{ isset($fieldAttributes['required']) ? $fieldAttributes['required'] : '' }}
                                            {!! isset($fieldAttributes['data_type']) ? 'type="'.$fieldAttributes['data_type'].'"' : 'type="text"' !!}
                                            {!! isset($fieldAttributes['step']) ? 'step="'.$fieldAttributes['step'].'"' : '' !!}
                                        />
                                    @endif

                                </div>
                            @endif
                            @if (isset($fieldAttributes['help']))
                                <span class="form-text text-muted input-hint">{{ $fieldAttributes['help'] }}</span>
                            @endif

                            @error($composedFieldName)
                            <div id="email-error" class="error invalid-feedback" style="display: block;">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endforeach
</div>
