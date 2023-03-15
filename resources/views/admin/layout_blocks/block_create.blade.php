@extends('admin.layout')

@section('title')
    Create New Layout Block
@endsection

@section('page_title')
    Create New Layout Block
@endsection

@section('body_content')
    <!--begin::Portlet-->
    <div class="kt-portlet">
        <div class="kt-portlet__head">
            <div class="kt-portlet__head-label">
                <h3 class="kt-portlet__head-title pl-0">
                    <a href="{{ route('admin.layout-blocks.index') }}" title="Назад към списъка" class=""><i
                            class="fas fa-arrow-left"></i></a>
                </h3>

                <h3 class="kt-portlet__head-title">
                    New Layout Block
                </h3>
            </div>
        </div>

        <!--begin::Form-->
        <form class="kt-form" action="{{route('admin.layout-blocks.store')}}" method="POST">
            @csrf
            <div class="kt-portlet__body">
                <div class="form-group form-group-last">
                    <div class="alert alert-secondary" role="alert">
                        <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                        <div class="alert-text">
                            Ще бъде създаден празен блок, който няма да е активен и няма да се показва никъде.
                            След като бъде създаден блок, той трябва да се редактира, за да се му се попълни съдържание
                            и др. параметри.
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <label>Name</label>
                        <input name="name" type="text" class="form-control" required>
                        <span class="form-text text-muted">Example: New Year 2022 discount</span>
                    </div>
                </div>
            </div>
            <div class="kt-portlet__foot">
                <div class="kt-form__actions">
                    <button type="submit" class="btn btn-success">Create</button>
                </div>
            </div>
        </form>
        <!--end::Form-->
    </div>
    <!--end::Portlet-->
@endsection
