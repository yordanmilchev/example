@extends('front.layout')

@section('title')
    {{ Auth::user()->name }} | {{ setting_val('TYPE_SITE_NAME') }}
@endsection


@section('main')
    <script>
        function deletePage() {
            var destroyURL = "{{route('account.anonymize', 'user_id')}}";
            if (confirm('Сигурни ли сте, че желаете вашият акаунт да бъде анонимизиран и деактивиран? След това действие профилът Ви ще бъде недостъпен')) {
                destroyURL = destroyURL.replace("user_id", '');
                $("#user_delete_form").attr('action', destroyURL);
                $("#user_delete_form").submit();
            }
        }
    </script>
    <form id="user_delete_form" style="display: none;" method="POST">
        @method('DELETE')
        @csrf
    </form>

    @include('front.components.breadcrumb')

    <div class="section">
        <div class="container">
            <div class="p-5 bg-f3">
                <h4><strong>{{trans('Редакция на профил')}}</strong></h4>
                <hr>
                <div class="row">
                    <div class="col-md-6 p-3 text-center order-2 order-md-1">
                        <h3>{{ Auth::user()->name }} {{ Auth::user()->lastname }}</h3>
                        <h4>{{ Auth::user()->phone_number }}</h4>
                        <h5>{{trans('Регистриран :date', ['date' => Carbon\Carbon::parse(Auth::user()->created_at)->diffForHumans()])}}</h5>
                        <hr>
                        <div class="p-2">
                            <a href="{{ route('account.orders') }}" role="button" class="btn btn-add-to-cart"
                               id="anonymize" style="padding: 0.25rem 2rem;">
                                <i class="fa fa-history"></i>

                                <span class="pl-3 pr-2">{{ trans('Поръчки') }}</span>
                            </a><!-- /.btn btn-black -->
                        </div>
                        <div class="p-2">
                            <a href="javascript:deletePage();" role="button" class="btn btn-danger" id="anonymize"
                               style="padding: 0.25rem 2rem;">
                                <i class="fa fa-ban"></i>

                                <span class="pl-3 pr-2">{{ trans('Изтриване на профила') }}</span>
                            </a><!-- /.btn btn-black -->
                        </div>
                    </div>

                    <div class="col-md-6 order-1 order-md-2">
                        @include('front.components.flash_messages')

                        <form method="post" action="{{ route('account.profile_update') }}">
                            @csrf
                            {{ method_field('patch') }}
                            <div class="p-2">
                                <label for="email">{{ trans('Имейл адрес') }}</label>

                                <input type="email" name="email" class="form-control"
                                       value="{{ $user->email }}" autocomplete="email"/>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>
                            <div class="p-2">
                                <label for="name">{{ trans('Име') }}</label>

                                <input type="text" name="name" class="form-control"
                                       value="{{ $user->name }}" autocomplete="name"/>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>
                            <div class="p-2">
                                <label for="lastname">{{ trans('Фамилия') }}</label>

                                <input type="text" name="lastname" class="form-control"
                                       value="{{ $user->lastname }}" autocomplete="lastname"/>
                                @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>
                            <div class="p-2">
                                <label for="phone_number">{{ trans('Телефон') }}</label>

                                <input type="text" name="phone_number" class="form-control"
                                       value="{{ $user->phone_number }}"
                                       autocomplete="phone_number"/>
                                @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                @enderror
                            </div>
                            <div class="text-center pt-3">
                                <button type="submit" class="btn btn-secondary">
                                    <i class="far fa-arrow-right px-2"></i>

                                    <span class="pl-3 pr-2">{{ trans('Запазване') }}</span>
                                </button><!-- /.btn btn-black -->
                            </div>
                        </form>
                    </div>
                </div><!-- /.row -->
            </div>
        </div><!-- /.container -->
    </div><!-- /.section -->
@endsection


