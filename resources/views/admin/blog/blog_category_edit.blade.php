@extends('admin.layout')

@section('title')
    {{ $blogCategory->id ? 'Редакция': 'Създаване' }} на категория {{ $blogCategory->id ?  $blogCategory->title : '' }}
@endsection

@section('page_title')
    {{ $blogCategory->id ? 'Редакция': 'Създаване' }} на категория {{ $blogCategory->id ?  $blogCategory->title : '' }}
@endsection

@section('body_content')
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title pl-0">
                    <a href="{{ route('admin.blog.categories.list') }}" title="Назад към списъка" class=""><i class="fas fa-arrow-left"></i></a>
                </h3>

                <h3 class="kt-portlet__head-title">
                    {{ $blogCategory->id ? 'Редакция': 'Създаване' }} на категория {{ $blogCategory->id ?  $blogCategory->name : '' }}
                </h3>
            </div>
        </div>
        <form method="post" action="{{ $blogCategory->id ? route('admin.blog.categories.edit', ['id' => $blogCategory]) : route('admin.blog.categories.edit') }}" id="update-product-model-form" class="kt-form kt-form--label-right" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('POST') }}

            <div class="kt-portlet__body">
                <!--begin::Section-->
                <div class="kt-section">
                    <div class="kt-section__content">
                        @include('admin.components.flashes')

                        @php $translationsFieldsConfig = [
                            'title' => [
                               'object' => $blogCategory,
                               'label' => 'Име на категорията'
                            ],
                            'slug' => [
                                'object' => $blogCategory,
                                'label' => 'Slug',
                                'disabled' => true,
                                'help' => 'Автоматично генериран идентификатор'

                            ],
                            'is_enabled' => [
                                'object' => $blogCategory,
                                'label' => 'Активен ?',
                                'type' => 'checkbox'
                            ],
                            'description' => [
                                'object' => $blogCategory,
                                'label' => 'Описание'
                            ],
                        ];
                        @endphp
                        {{ \TransWidget::renderFields($translationsFieldsConfig) }}

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
