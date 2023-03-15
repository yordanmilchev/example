@extends('admin.layout')

@section('title')
    URL-и допуснати за индексиране
@endsection

@section('page_title')
    URL-и допуснати за индексиране
@endsection

@section('body_content')
    <script>
        function deleteUrl(urlId)
        {
            var destroyURL = "{{route('admin.url_metas.destroy', 'url_id')}}";
            var urlTitle = $('#td_'+urlId).text();
            if(confirm('Моля, потвърди изтриването на запис: \n'+urlTitle)) {
                destroyURL = destroyURL.replace("url_id", urlId);
                $("#url_delete_form").attr('action', destroyURL);
                $("#url_delete_form").submit();
            }
        }
    </script>
    <form id="url_delete_form" style="display: none;" method="POST">
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
                            <div class="col-lg-3">
                                <label>Държава:</label>
                                <div class="input-group">
                                    <select name="locale" class="form-control selectpicker" data-show-content="true">
                                    <option value="">-всички-</option>
                                    @foreach(locales() as $locale)
                                        @php
                                            $imgUrl=asset('images/flags/64x64/'.$locale.'.png');
                                        @endphp
                                    <option value="{{$locale}}" {{ old('locale') == $locale ? 'selected' : '' }} data-content='<img src="{{$imgUrl}}" style="width:24px;height:20px;" alt="{{$locale}}"> {{country($locale)}}'>{{$locale}}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>

                            <div class="col-lg-9">
                                <label>URL:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">
                                            <i class="fa fa-tags"></i>
                                        </span></div>

                                    <input id="url_name" name="url_name" value="{{ old('url_name')}}" type="text"
                                           class="form-control">
                                </div>
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
                        {{ $allUrls->appends(request()->query())->links() }}
                    </div>

                    <div class="table-responsive">

                        <table class="table table-bordered table-striped">
                            <thead class="thead-light">
                            <tr>
                                <th class="text-center font-weight-bold">ID</th>
                                <th class="text-center font-weight-bold">URL</th>
                                <th class="text-center font-weight-bold">Meta Title</th>
                                <th class="text-center font-weight-bold">Meta Description</th>
                                <th class="text-center font-weight-bold">Действия</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($allUrls as $url)
                                <tr>
                                    <td class="text-center" style="width: 1% !important;">
                                        {{ $url->id }}
                                    </td>
                                    <td class="text-center text-primary">
                                        <a href="{{ $url->url_name }}" target="_blank">
                                            <strong>{{ $url->url_name }}</strong>
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <span id="td_{{$url->id}}">{{ Str::limit($url->meta_title, 20) }}</span>
                                    </td>
                                    <td class="text-center">
                                        {{ Str::limit($url->meta_description, 20) }}
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.url_metas.edit', ['id' => $url->id]) }}" role="button" class="btn btn-sm btn-outline-brand btn-icon"><i
                                                    class="flaticon-edit"></i></a>
                                        <a href="javascript:deleteUrl({{$url->id}});" role="button" class="btn btn-sm btn-outline-danger btn-icon">
                                            <i class="flaticon-delete"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-danger">Няма резултати</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive">
                        {{ $allUrls->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
            <!--end::Section-->
        </div>
        <!--end::Form-->
    </div>
@endsection

@section('subheader_toolbar')
    <div class="row float-right kt-padding-r-20">
        <a class="btn btn-success" href="{{ route('admin.url_metas.edit') }}">Нов URL</a>
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
            $('.selectpicker').selectpicker();//load bootstrap-select components
        });
    </script>
@endsection

