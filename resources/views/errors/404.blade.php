@extends('front.layout')

@section('main')
    <ul class="slider slider-main">
        <li class="slide">
            <picture>
                <source srcset="{{ asset('themes/custom/css/images/assets/404/1920x425.png') }}" media="(min-width: 767px)" 1x />

                <source srcset="{{ asset('themes/custom/css/images/assets/404/800x400.png') }}" 1x />

                <img src="{{ asset('themes/custom/css/images/assets/404/1920x425.png') }}" alt="">
            </picture>
        </li><!-- /.slide -->
    </ul><!-- /.slider -->

    <div class="section section-error">
        <div class="container">
            <div class="section-head border-bottom">
                <h1 class="section-title">ГРЕШКА 404</h1>
            </div> <!-- /.section-head border-bottom -->

            <div class="section-body">
                <div class="section-text">
                    <p>За съжаление страницата, която търсите, не беше открита. Най-вероятно съдържанието, което се опитвате
                        да видите, не съществува или е преместено. Моля да ни извините за причиненото неудобство!
                    </p>
                </div>
            </div>

            <div class="sestion-bottom text-center">
                <a href="{{ route('homepage') }}" class="btn btn-primary box-shadow">Към началната страница</a>
            </div>
        </div>
    </div><!-- /.section section-error -->
@endsection
