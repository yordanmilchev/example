@extends('admin.layout')

@section('title')
    {{ $user->id ? 'Редакция': 'Създаване' }} на потребител {{ $user->id ? $user->name : '' }}
@endsection

@section('page_title')
    {{ $user->id ? 'Редакция': 'Създаване' }} на потребител {{ $user->id ? $user->name : '' }}
@endsection

@section('body_content')
    <form method="post" action="{{ $user->id ? route('admin.user.list-edit', ['id' => $user]) : route('admin.user.list-edit') }}" id="product-form" class="kt-form kt-form--label-right" novalidate>
    {{ csrf_field() }}
    {{ method_field('POST') }}

        <div id="main-characteristics" class="kt-portlet">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title pl-0">
                        <a href="{{ route('admin.user.list') }}" title="Назад към списъка" class=""><i class="fas fa-arrow-left"></i></a>
                    </h3>

                    <h3 class="kt-portlet__head-title">
                        Потребител
                    </h3>
                </div>
            </div>

            <div class="kt-portlet__body">
                <!--begin::Section-->
                <div class="kt-section">
                    <div class="kt-section__content">

                        @include('admin.components.flashes')

                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">Име</label>
                            <div class="col-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="flaticon-users"></i>
                                        </span>
                                    </div>
                                    <input name="name" type="text" value="{{ old('name', $user->name) }}" class="form-control" />
                                </div>

                                @error('name')
                                <div id="email-error" class="error invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">Фамилия</label>
                            <div class="col-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="flaticon-users"></i>
                                        </span>
                                    </div>
                                    <input name="lastname" type="text" placeholder="Не е задължително" value="{{ old('lastname', $user->lastname) }}" class="form-control" />
                                </div>

                                @error('lastname')
                                <div id="email-error" class="error invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">Имейл</label>
                            <div class="col-10">
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">@</span></div>
                                    <input name="email" type="text" value="{{ old('email', $user->email) }}" class="form-control" />
                                </div>

                                @error('email')
                                <div id="email-error" class="error invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">Телефон</label>
                            <div class="col-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fa fa-phone-alt" style="color: green;"></i>
                                        </span>
                                    </div>
                                    <input name="phone_number" type="text" placeholder="Не е задължително" value="{{ old('phone_number', $user->phone_number) }}" class="form-control" />
                                </div>

                                @error('phone_number')
                                <div id="email-error" class="error invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">Парола</label>
                            <div class="col-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="flaticon-lock"></i>
                                        </span>
                                    </div>
                                    <input name="password" type="password" class="form-control" />
                                </div>

                                @error('password')
                                <div id="email-error" class="error invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-2 col-form-label">Повторение на парола</label>
                            <div class="col-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="flaticon-lock"></i>
                                        </span>
                                    </div>
                                    <input name="password_confirmation" type="password" class="form-control" />
                                </div>

                                @error('password_confirmation')
                                <div id="email-error" class="error invalid-feedback" style="display: block;">{{ $message }}</div>
                                @enderror
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
    </form>
@endsection
