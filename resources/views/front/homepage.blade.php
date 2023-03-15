@extends('front.layout')

@section('title')
    {{ setting_val('TYPE_SITE_NAME') }}
@endsection

@section('head')
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl={{Lang::locale()}}" async="async" defer="defer"></script>
@endsection

@section('main')
    @include('front.components.flash_messages')

    {!! App\Components\LayoutRegionComponent::build(App\Constant\LayoutRegionConstant::HOMEPAGE_CONTENT) !!}

    <ul class="slider slider-main">
        @foreach($sliders as $slider)
            <li class="slide">
                <a href="{{ $slider->link }}">
                    <picture>
                        <source srcset="{{ gallery_image($slider->image, \App\Constant\GalleryFileConstant::TYPE_SLIDER_IMAGE, \App\Constant\GalleryFileConstant::TYPE_1920X490, 1920, 490, null, false, \Spatie\Image\Manipulations::FIT_CROP) }}" media="(min-width: 767px)" 1x />

                        <source srcset="{{ gallery_image($slider->image, \App\Constant\GalleryFileConstant::TYPE_SLIDER_IMAGE, \App\Constant\GalleryFileConstant::TYPE_800X400, 800, 400, null, false, \Spatie\Image\Manipulations::FIT_CROP) }}" 1x />

                        <img src="{{ gallery_image($slider->image, \App\Constant\GalleryFileConstant::TYPE_SLIDER_IMAGE, \App\Constant\GalleryFileConstant::TYPE_1920X490, 1920, 490, null, false, \Spatie\Image\Manipulations::FIT_CROP) }}" alt="">
                    </picture>
                </a>
            </li><!-- /.slide -->
        @endforeach
    </ul><!-- /.slider -->

    <div class="section">
        <div class="container">
            <div class="row slider slider-services slider-services-top">
                @foreach($enabledActivities as $activity)
                    <div class="col-1of5 col-md-4 slide">
                        <a href="{{ route('activity', $activity->slug) }}" class="card card-sm">
                            <div class="card-head border-bottom wow animate__animated animate__fadeInDown"
                                 data-wow-duration=".5s" data-wow-delay=".5s">
                                <div class="text-center">
                                    <object id="" data="{{ asset(\App\Constant\GalleryFileConstant::GALLERY_FILE_DIRECTORIES[\App\Constant\GalleryFileConstant::TYPE_ACTIVITY_IMAGE].$activity->icon) }}" type="image/svg+xml"
                                            class="icon"></object>
                                </div>

                                <h6 class="card-title">{{ $activity->title }}</h6>
                            </div><!-- /.card-head border-bottom -->

                            <div class="card-body wow animate__animated animate__fadeInUp" data-wow-duration=".5s"
                                 data-wow-delay=".5s">
                                <div class="card-text">
                                    {!! $activity->excerpt !!}
                                </div>
                            </div><!-- /.card-body -->
                        </a><!-- /.card card-sm -->
                    </div><!-- /.col-1of5 col-md-4 -->
                @endforeach
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.section -->

    <div class="section section-services bg-primary">
        <div class="container">
            <div class="section-head border-bottom text-white wow animate__animated animate__fadeInDown"
                 data-wow-duration=".5s" data-wow-delay=".5s">
                <h2 class="section-title">Какво предлагаме</h2>
            </div> <!-- /.section-head border-bottom -->

            <div class="section-body">
                <div class="row slider slider-services slider-services-bottom align-items-stretch">
                    @foreach($enabledServices as $service)
                        <div class="col-md-6 slide">
                            <!-- data-wow-delay="" се увеличава с 0,1 -->
                            <div class="card card-horizontal wow animate__animated animate__fadeInDown" data-wow-duration=".5s"
                                 data-wow-delay="{{ 0.5+(0.1*$loop->iteration) }}s">
                                <div class="row g-0 align-items-center">
                                    <div class="col-xxl-6 col-lg-5 text-center">
                                        <a href="{{ route('service', $service->slug) }}">
                                            <img src="{{ gallery_image($service->image, \App\Constant\GalleryFileConstant::TYPE_SERVICE_IMAGE, \App\Constant\GalleryFileConstant::TYPE_TEASER, 385, 290, null, false, \Spatie\Image\Manipulations::FIT_CROP) }}" class="w-100 img-fluid" alt="...">
                                        </a>
                                    </div>

                                    <div class="col-xxl-6 col-lg-7">
                                        <div class="card-body">
                                            <div class="card-head border-bottom-start">
                                                <h6 class="card-title text-danger">{{ $service->title }}</h6>
                                            </div>

                                            <div class="card-text">
                                                {!! $service->excerpt !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.card card-horizontal -->
                        </div><!-- /.col-md-6 -->
                    @endforeach
                </div><!-- /.row slider slider-services -->
            </div><!-- /.section-body -->

            <div class="section-bottom text-center wow animate__animated animate__fadeInDown" data-wow-duration=".5s"
                 data-wow-delay=".5s">
                <a href="{{ route('contacts.index') }}" class="btn btn-primary">Свържи се с нас</a>
            </div><!-- /.section-bottom -->
        </div><!-- /.container -->
    </div><!-- /.section section-services -->

    <div class="section section-statistic bg-danger">
        <div class="container">
            <div class="section-head border-bottom text-white wow animate__animated animate__fadeInDown"
                 data-wow-duration=".5s" data-wow-delay=".5s">
                <p class="h2 section-title">MALEV В ЦИФРИ</p>
            </div>

            <div class="section-body">
                <div class="row justify-content-center">
                    <div class="col-lg-3 col-md-4 col-sm-6 text-center">
                        <object id="" data="{{ asset('themes/custom/css/images/assets/home/repair.svg') }}" type="image/svg+xml"
                                class="icon wow animate__animated animate__fadeInDown" data-wow-duration=".5s"
                                data-wow-delay=".5s"></object>

                        <div class="d-flex justify-content-center">
                            <div class="number number_1"></div><span class="number">+</span>
                        </div>

                        <p class="ff-mb text-white wow animate__animated animate__fadeInUp" data-wow-duration=".5s"
                           data-wow-delay=".5s">Монтирани съоръжения</p>
                    </div><!-- /.col-lg-3 col-md-4 col-sm-6 -->

                    <div class="col-lg-3 col-md-4 col-sm-6 text-center">
                        <object id="" data="{{ asset('themes/custom/css/images/assets/home/complete.svg') }}" type="image/svg+xml"
                                class="icon wow animate__animated animate__fadeInDown" data-wow-duration=".5s"
                                data-wow-delay=".5s"></object>

                        <div class="d-flex justify-content-center">
                            <div class="number number_2"></div><span class="number">+</span>
                        </div>

                        <p class="ff-mb text-white wow animate__animated animate__fadeInUp" data-wow-duration=".5s"
                           data-wow-delay=".5s">Завършени обекта</p>
                    </div><!-- /.col-lg-3 col-md-4 col-sm-6 -->

                    <div class="col-lg-3 col-md-4 col-sm-6 text-center">
                        <object id="" data="{{ asset('themes/custom/css/images/assets/home/pipeline.svg') }}" type="image/svg+xml"
                                class="icon wow animate__animated animate__fadeInDown" data-wow-duration=".5s"
                                data-wow-delay=".5s"></object>

                        <div class="d-flex justify-content-center">
                            <div class="number number_3"></div><span class="number">м.</span>
                        </div>

                        <p class="ff-mb text-white wow animate__animated animate__fadeInUp" data-wow-duration=".5s"
                           data-wow-delay=".5s">Монтирана тръба</p>
                    </div><!-- /.col-lg-3 col-md-4 col-sm-6 -->

                    <div class="col-lg-3 col-md-4 col-sm-6 text-center">
                        <object id="" data="{{ asset('themes/custom/css/images/assets/home/home.svg') }}" type="image/svg+xml"
                                class="icon  wow animate__animated animate__fadeInDown" data-wow-duration=".5s"
                                data-wow-delay=".5s"></object>

                        <div class="d-flex justify-content-center">
                            <div class="number number_4"></div><span class="number">+</span>
                        </div>

                        <p class="ff-mb text-white wow animate__animated animate__fadeInUp" data-wow-duration=".5s"
                           data-wow-delay=".5s">Газифицирани жилища</p>
                    </div><!-- /.col-lg-3 col-md-4 col-sm-6 -->
                </div><!-- /.row -->
            </div><!-- /.section-body -->
        </div><!-- /.container -->
    </div><!-- /.section section-statistic bg-danger -->

    <div class="section section-steps"
         style="background-image: url('{{ asset('themes/custom/css/images/assets/home/bg.png') }}'); background-attachment: fixed; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-8 col-md-10 offset-xl-6 offset-lg-4 offset-md-2">
                    <div class="section-head border-bottom text-center wow animate__animated animate__fadeInLeft"
                         data-wow-duration=".5s" data-wow-delay=".5s">
                        <p class="h2 section-title">СТЪПКИ</p>
                    </div><!-- /.section-head -->

                    <div class="section-body">
                        <!-- data-wow-duration="" data-wow-delay="" се увеличава с 0,1 -->
                        <div class="card card-horizontal card-horizontal-md wow animate__animated animate__fadeInLeft"
                             data-wow-duration=".5s" data-wow-delay=".5s">
                            <div class="card-head border-bottom-start">
                                <h5 class="card-title">1. Запитване</h5>
                            </div><!-- /.card-head -->

                            <div class="card-body">
                                <div class="card-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices
                                        gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
                                </div>
                            </div><!-- /.card-body -->
                        </div><!-- /.card card-horizontal card-horizontal-md -->

                        <div class="card card-horizontal card-horizontal-md wow animate__animated animate__fadeInLeft"
                             data-wow-duration=".6s" data-wow-delay=".6s">
                            <div class="card-head border-bottom-start">
                                <h5 class="card-title">2. Оглед</h5>
                            </div><!-- /.card-head -->

                            <div class="card-body">
                                <div class="card-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices
                                        gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
                                </div>
                            </div><!-- /.card-body -->
                        </div><!-- /.card card-horizontal card-horizontal-md -->

                        <div class="card card-horizontal card-horizontal-md wow animate__animated animate__fadeInLeft"
                             data-wow-duration=".7s" data-wow-delay=".7s">
                            <div class="card-head border-bottom-start">
                                <h5 class="card-title">3. Изготвяне на оферта</h5>
                            </div><!-- /.card-head -->

                            <div class="card-body">
                                <div class="card-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices
                                        gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
                                </div>
                            </div><!-- /.card-body -->
                        </div><!-- /.card card-horizontal card-horizontal-md -->

                        <div class="card card-horizontal card-horizontal-md wow animate__animated animate__fadeInLeft"
                             data-wow-duration=".8s" data-wow-delay=".8s">
                            <div class="card-head border-bottom-start">
                                <h5 class="card-title">4. Доставка и монтаж</h5>
                            </div><!-- /.card-head -->

                            <div class="card-body">
                                <div class="card-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices
                                        gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
                                </div>
                            </div><!-- /.card-body -->
                        </div><!-- /.card card-horizontal card-horizontal-md -->

                        <div class="card card-horizontal card-horizontal-md wow animate__animated animate__fadeInLeft"
                             data-wow-duration=".9s" data-wow-delay=".9s">
                            <div class="card-head border-bottom-start">
                                <h5 class="card-title">5. Поддръжка и сервиз</h5>
                            </div><!-- /.card-head -->

                            <div class="card-body">
                                <div class="card-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices
                                        gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis. </p>
                                </div>
                            </div><!-- /.card-body -->
                        </div><!-- /.card card-horizontal card-horizontal-md -->
                    </div><!-- /.section-body -->
                </div><!-- /.col-md-6 offser-md-6 -->
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /.section section-steps -->

    <div class="section section-contact bg-danger">
        <div class="container">
            <div class="section-head border-bottom text-center text-white wow animate__animated animate__fadeInDown"
                 data-wow-duration=".5s" data-wow-delay=".5s">
                <p class="h2 section-title">СВЪРЖИ СЕ С НАС</p>
            </div><!-- /.section-head border-bottom text-center text-white -->

            <div class="section-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="form form-contact wow animate__animated animate__fadeInUp" data-wow-duration=".5s"
                             data-wow-delay=".5s">
                            <div class="section-head border-bottom text-center">
                                <p class="h2 section-title">Пиши ни</p>
                            </div>

                            <div class="section-body">
                                <form method="POST" action="{{ route('contacts.save') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input name="name" type="text" class="form-control" placeholder="Име" value="{{ old('name') }}" required>

                                            <input name="email" type="email" class="form-control" placeholder="Email адрес" value="{{ old('email') }}" required>

                                            <input name="phone" type="tel" class="form-control" placeholder="Телефон" value="{{ old('phone') }}" required>
                                        </div><!-- /.col-md-6 -->

                                        <div class="col-md-6">
                                            <textarea name="inquiry" class="form-control" id="exampleFormControlTextarea1" rows="3">{{ old('inquiry') }}</textarea>
                                        </div><!-- /.col-md-6 -->
                                    </div><!-- /.row -->

                                    <div class="pt-3 text-center">
                                        <div class="captcha mb-2">
                                            <div class="g-recaptcha" data-sitekey="{{env('G_CAPTCHA_SITE_KEY')}}" data-theme="light" data-type="image" id="g_recaptcha" style="display: inline-block;"></div>
                                            @error('g-recaptcha-response')
                                            <span class="invalid-feedback text-danger d-block" role="alert">
                                                        {{trans('Антибот проверката е задължителна!')}}
                                                    </span>
                                            @enderror
                                        </div>

                                        <button type="submit" class="btn btn-primary box-shadow">Изпрати съобщение</button>
                                    </div><!-- /.section-bottom -->
                                </form>
                            </div><!-- /.section-body -->
                        </div><!-- /.form form-contact -->
                    </div><!-- /.col-lg-8 -->

                    <div class="col-lg-4">
                        <div class="card card-info wow animate__animated animate__fadeInUp" data-wow-duration=".5s"
                             data-wow-delay=".5s">
                            <div class="card-head">
                                <div>
                                    <div class="card-title">
                                        <h5>Малев Инженеринг ВТ ООД</h5>
                                    </div>

                                    <div class="card-text">
                                        <p>гр. Велико Търново</p>
                                    </div>
                                </div>

                                <a href="#" target="_blank"><i class="fab fa-facebook-square"></i></a>
                            </div>

                            <div class="card-body">
                                <div class="card-info-inner">
                                    <i class="far fa-phone"></i>

                                    <div>
                                        <a href="tel:062602050" class="meta">062 60 20 50</a>

                                        <a href="tel:0878243447" class="meta">0878 243 447</a>
                                    </div>
                                </div><!-- /.card-info-inner -->

                                <div class="card-info-inner">
                                    <i class="far fa-envelope"></i>

                                    <div>
                                        <a href="mailto:gercho@malev-bg.com" class="meta">gercho@malev-bg.com</a>

                                        <a href="mailto:magazin@malev-bg.com" class="meta">magazin@malev-bg.com</a>
                                    </div>
                                </div><!-- /.card-info-inner -->

                                <div class="card-info-inner">
                                    <i class="far fa-map-marker-alt"></i>

                                    <div>
                                        <p class="meta mb-0">Велико Търново</p>

                                        <a href="https://goo.gl/maps/D44ycL7PbYpaaq4x6" class="meta" target="_blank">ул.
                                            Момина Крепост 22</a>
                                    </div>
                                </div><!-- /.card-info-inner -->
                            </div><!-- /.card-body -->
                        </div><!-- /.card card-info -->
                    </div><!-- /.col-lg-4 -->
                </div> <!-- /.row -->
            </div><!-- /.section-body -->
        </div><!-- /.container -->
    </div><!-- /.section section-contact bg-danger -->

    @if(count($partners))
        <div class="section section-partners">
            <div class="container">
                <div class="section-head border-bottom wow animate__animated animate__fadeInDown" data-wow-duration=".5s"
                     data-wow-delay=".5s">
                    <p class="h2 section-title text-danger">Партньори</p>
                </div><!-- /.section-head -->

                <div class="section-body">
                    <div class="slider slider-teaser">
                        @foreach($partners as $partner)
                            <div class="slide">
                                <img src="{{ asset(\App\Constant\GalleryFileConstant::GALLERY_FILE_DIRECTORIES[\App\Constant\GalleryFileConstant::TYPE_PARTNER_IMAGE].$partner->name) }}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div><!-- /.section-body -->
            </div><!-- /.container -->
        </div><!-- /.section section-partners -->
    @endif

    <div class="section section-gallery bg-primary">
        <div class="container">
            <div class="section-head border-bottom text-center">
                <h3 class="h2 section-title text-white wow animate__animated animate__fadeInUp" data-wow-duration=".5s"
                    data-wow-delay=".5s">Галерия</h3>
            </div>

            <div class="section-body">
                <div class="slider slider-gallery row g-0">
                    @foreach($imageFiles as $image)
                        <div class="slide col-md-4">
                            <a href="{{ gallery_image($image->name, \App\Constant\GalleryFileConstant::TYPE_GALLERY_IMAGE, \App\Constant\GalleryFileConstant::TYPE_COMPRESSED) }}" data-fancybox="gallery">
                                <img class="fancybox-img" src="{{ gallery_image($image->name, \App\Constant\GalleryFileConstant::TYPE_GALLERY_IMAGE, \App\Constant\GalleryFileConstant::TYPE_TEASER, 500, 365, null, false, \Spatie\Image\Manipulations::FIT_CROP) }}" />
                            </a>
                        </div><!-- /.slide -->
                    @endforeach
                </div><!-- /.slider slider-gallery -->
            </div><!-- /.section-body -->

            <div class="section-bottom text-center wow animate__animated animate__fadeInUp" data-wow-duration=".5s"
                 data-wow-delay=".5s">
                <a href="{{ route('gallery') }}" class="btn btn-primary">Виж повече</a>
            </div><!-- /.section-bottom -->
        </div><!-- /.container -->
    </div><!-- /.section section-gallery -->
@endsection

@section('page_js')
    <script type="text/javascript">
        var onloadCallback = function() {
            grecaptcha.render('g_recaptcha', {
                'sitekey' : '{{env('G_CAPTCHA_SITE_KEY')}}'
            });
        };
    </script>
@endsection
