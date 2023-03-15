@extends('admin.layout')

@section('title')
    {{ $url->id ? 'Редакция:': 'Създаване на индексируем URL' }} {{ $url->id ?  $url->url_name : '' }}
@endsection

@section('page_title')
    {{ $url->id ? 'Редакция:': 'Създаване на индексируем URL' }} {{ $url->id ?  $url->url_name : '' }}
@endsection

@section('body_content')
    <form method="post" action="{{ $url->id ? route('admin.url_metas.edit', ['id' => $url]) : route('admin.url_metas.edit') }}" id="update-product-model-form" class="kt-form kt-form--label-right" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field('POST') }}
        <div class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title pl-0">
                        <a href="{{ route('admin.url_metas.list') }}" title="Назад към списъка" class=""><i class="fas fa-arrow-left"></i></a>
                    </h3>

                    <h3 class="kt-portlet__head-title">
                        Назад
                    </h3>
                </div>
            </div>

            <div class="kt-portlet__body">
                <!--begin::Section-->
                <div class="kt-section">
                    <div class="kt-section__content">
                        @include('admin.components.flashes')
                        <div class="form-group row">
                            <div class="input-group ">
                                <div class="col-2 mt-20 mr-20">
                                    <label for="example-text-input" class="mt-20 mr-20">URL</label>
                                </div>
                                <div class="col-10">
                                    <input name="url_name" type="text" value="{{ old('sku' , $url->url_name ?? '') }}" class="form-control" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="input-group ">
                                <div class="col-2 mt-20 mr-20">
                                    <label for="example-text-input" class="mt-20 mr-20">Мета Заглавие</label>
                                </div>
                                <div class="col-10">
                                    <textarea name="meta_title" class="form-control" rows="5">{{ old('sku' , $url->meta_title ?? '') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="input-group ">
                                <div class="col-2 mt-20 mr-20">
                                    <label for="example-text-input" class="mt-20 mr-20">Мета Описание</label>
                                </div>
                                <div class="col-10">
                                    <textarea name="meta_description" class="form-control" rows="5">{{ old('sku' , $url->meta_description ?? '') }}</textarea>
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
                            <input type="submit" class="btn btn-success" value="Запазване" />
                            <button type="reset" class="btn btn-secondary go-back-btn">Обратно</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection




