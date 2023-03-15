@extends('admin.layout')

@section('title')
    Edit Layout Block
@endsection

@section('page_title')
    Edit Layout Block
@endsection

@section('body_content')
    <script src="{{ asset('/js/url.js') }}"></script>
    <script>
        var previewWindow;
        function updateAndPreviewBlock()
        {
            var actionURL=$('#update_block_form').attr('action');
            var previewURL = new URL("{{app()->url->to('/')}}"+document.getElementById("region_url").value);
            previewURL.searchParams.set('block_debug', 1);
            previewURL.searchParams.set('locale', document.getElementById("localeSelect").value);
            $.post(actionURL, $('#update_block_form').serialize())
            .done(function(data) {
                    alert(data.message);
                    if(previewWindow) {
                        if(previewWindow.closed) {
                            previewWindow = window.open(previewURL);
                        }
                        else {
                            previewWindow.location.reload();
                        }
                    }
                    else {
                        previewWindow = window.open(previewURL);
                    }
                    previewWindow.focus();
                })
            .fail(function(xhr, status, error) {
                    alert(error);
            });
        }
    </script>
    <div class="row">
        <div class="col-12">

            <!--begin::Portlet-->
            <div class="kt-portlet">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title pl-0">
                            <a href="{{ route('admin.layout-blocks.index') }}" title="Назад към списъка" class=""><i class="fas fa-arrow-left"></i></a>
                        </h3>

                        <h3 class="kt-portlet__head-title">
                            Edit Layout Block
                        </h3>
                    </div>
                </div>

                <!--begin::Form-->
                <form id="update_block_form" class="kt-form" action="{{route('admin.layout-blocks.update', $block->id)}}" method="POST">

                    @method('PUT')
                    @csrf
                    <div class="kt-portlet__body">
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <label>Name</label>
                                <input name="name" value="{{$block->name}}" type="text" class="form-control" required>
                                <span class="form-text text-muted">Example: New Year 2022 discount</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-1 col-form-label">Is enabled</label>
                            <div class="col-3">
                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                    <label>
                                        <input type="checkbox" @if($block->is_enabled==1) checked="checked" @endif name="is_enabled">
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <label for="regionNameSelect">Region name</label>
                                <select onchange="$('#region_url').val(this.options[this.selectedIndex].getAttribute('data-url'))" name="region_name" class="form-control" id="regionNameSelect" required>
                                    <option value=""></option>
                                    @foreach(App\Constant\LayoutRegionConstant::ALL as $layoutRegion)
                                    <option value="{{$layoutRegion}}" data-url="{{App\Constant\LayoutRegionConstant::REGION_URL[$layoutRegion]}}" @if($block->region_name==$layoutRegion) selected @endif>{{$layoutRegion}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <label>Region URL</label>
                                <input id="region_url" type="text" class="form-control" value="@if(!empty($block->region_name)){{App\Constant\LayoutRegionConstant::REGION_URL[$block->region_name]}}@endif">
                                <span class="form-text text-muted">This is a URL where the region is shown.</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <label for="localeSelect">Country</label>
                                <select name="location" class="form-control" id="localeSelect" required>
                                    <option value=""></option>
                                    @foreach(config('app.locales') as $localeKey=>$localeVal)
                                    <option value="{{$localeKey}}" @if($block->locale==$localeKey) selected @endif>{{$localeVal}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <label>Weight</label>
                                <input name="weight" type="number" class="form-control" value="{{$block->weight}}">
                                <span class="form-text text-muted">Must be integer (0, 1, 2, ...). Block with weight 1 is shown before 5</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <label for="url_filter_operator">URL filter operator (optional)</label>
                                <select name="url_filter_operator" class="form-control">
                                    <option value=""></option>
                                    <option value="hide_if_contains" @if($block->url_filter_operator=="hide_if_contains") selected @endif>Hide block if path contains:</option>
                                    <option value="hide_if_matches" @if($block->url_filter_operator=="hide_if_matches") selected @endif>Hide block if path matches:</option>
                                    <option value="show_if_contains" @if($block->url_filter_operator=="show_if_contains") selected @endif>Show block if path contains:</option>
                                    <option value="show_if_matches" @if($block->url_filter_operator=="show_if_matches") selected @endif>Show block if path matches:</option>
                                    <option value="show_if_matches_full" @if($block->url_filter_operator=="show_if_matches_full") selected @endif>Show block if full url matches:</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <label for="url_filter_values">URL filter values (optional)</label>
                                <select class="form-control select2" name="url_filter_values[]" id="url_filter_values" multiple="multiple">
                                    @if(!empty($block->url_filter_values))
                                        @foreach(json_decode($block->url_filter_values) as $URLfilterVal)
                                        <option value="{{$URLfilterVal}}" selected>{{$URLfilterVal}}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <span class="form-text text-muted">Examples: divan-katrin-komfort, products/ednolitsevi</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12 col-md-6 col-lg-4">
                                <label for="dynamicContentSelect">Dynamic content</label>
                                <select name="dynamic_content" class="form-control" id="dynamicContentSelect">
                                    <option value=""></option>
                                    @foreach(App\Constant\DynamicLayoutBlockConstant::ALL as $classKey=>$class)
                                    <option value="{{$classKey}}" @if($block->dynamic_content==$classKey) selected @endif>{{$class}}</option>
                                    @endforeach
                                </select>
                                <span class="form-text text-muted">It overrides the Static content value.</span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <label for="staticContentSelect">Static content</label>

                                <style type="text/css" media="screen">
                                    #editorContainer {
                                        width: 100%;
                                        height: 500px;
                                        position: relative;
                                        background-color: gray;
                                    }
                                    #AceEditor {
                                        position: absolute;
                                        top: 0;
                                        right: 0;
                                        bottom: 0;
                                        left: 0;
                                    }
                                </style>
                                <div id="editorContainer">
                                    <div id="AceEditor">{{$block->static_content}}</div>
                                </div>
                                <script src="{{ asset('vendor/ace-editor/ace.js') }}" type="text/javascript"></script>
                                <script>
                                    var editor = ace.edit("AceEditor");
                                    editor.setTheme("ace/theme/twilight");
                                    editor.session.setMode("ace/mode/html");
                                    editor.session.on('change', function() {
                                        document.getElementById("static_content").value = editor.getValue();
                                    });
                                </script>
                                <textarea name="static_content" id="static_content" style="display: none;">{{$block->static_content}}</textarea>
                            </div>
                        </div>

                        <div class="form-group form-group-last">
                            <div class="alert alert-secondary" role="alert">
                                <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                                <div class="alert-text">
                                    За да тестваш блока, използвай бутона "AJAX save & preview". Ще се отвори стойността на полето Region URL в нов прозорец с параметри <b>block_debug={block_id}</b> и <b>locale={locale}</b>,
                                    като по този начин блока ще бъде видим дори да не е <b>enabled</b>.
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <button onclick="updateAndPreviewBlock();" type="button" class="btn btn-warning">AJAX save &amp; preview</button>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Portlet-->

        </div>
    </div>
@endsection

@section('page_js')
    @parent
    <script>
        $(document).ready(function(e) {
            $('#url_filter_values').select2({
                tags: true
            });
        });
    </script>
@endsection
