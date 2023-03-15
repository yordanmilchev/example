@extends('front.layout')

@section('title')
    {{ setting_val('TYPE_SITE_NAME') }}
@endsection

@section('main')
    <div class="section section-services section-services-inner">
        <div class="container">
            <ul class="slider slider-main">
                <li class="slide">
                    <picture>
                        <source srcset="{{ gallery_image($service->image, \App\Constant\GalleryFileConstant::TYPE_SERVICE_IMAGE, \App\Constant\GalleryFileConstant::TYPE_1920X425, 1920, 425, null, false, \Spatie\Image\Manipulations::FIT_CROP) }}" media="(min-width: 767px)" 1x />

                        <source srcset="{{ gallery_image($service->image, \App\Constant\GalleryFileConstant::TYPE_SERVICE_IMAGE, \App\Constant\GalleryFileConstant::TYPE_800X400, 800, 400, null, false, \Spatie\Image\Manipulations::FIT_CROP) }}" 1x />

                        <img src="{{ gallery_image($service->image, \App\Constant\GalleryFileConstant::TYPE_SERVICE_IMAGE, \App\Constant\GalleryFileConstant::TYPE_1920X425, 1920, 425, null, false, \Spatie\Image\Manipulations::FIT_CROP) }}" alt="">
                    </picture>
                </li><!-- /.slide -->
            </ul><!-- /.slider -->

            <div class="section-head border-bottom text-danger">
                <h1 class="section-title">{{ $service->translate(locale())->title }}</h1>
            </div>

            <div class="section-body">
                <div class="section-text">
                    {!! $service->translate(locale())->description !!}
                </div><!-- /.section-text -->

                <div class="mt-5 text-center">
                    <a href="{{ route('contacts.index') }}" class="btn btn-primary box-shadow">Свържи се с нас</a>
                </div><!-- /.mt-5 text-center -->
            </div><!-- /.section-body -->
        </div><!-- /.container -->

        <div class="section bg-danger">
            <div class="container">
                <div class="section-head border-bottom text-white wow animate__animated animate__fadeInDown"
                     data-wow-duration=".5s" data-wow-delay=".5s">
                    <h2 class="section-title">УСЛУГИ</h2>
                </div>

                <div class="slider slider-services-inner row">
                    @foreach($enabledServices as $item)
                        @if($item->id == $service->id)
                            @continue
                        @endif
                        <div class="slide col-md-4" style="text-decoration: none;">
                            <div class="card card-services">
                                <div class="overflow-hidden">
                                    <a href="{{ route('service', $item->slug) }}">
                                        <img src="{{ gallery_image($item->image, \App\Constant\GalleryFileConstant::TYPE_SERVICE_IMAGE, \App\Constant\GalleryFileConstant::TYPE_TEASER, 385, 290, null, false, \Spatie\Image\Manipulations::FIT_CROP) }}" alt="" class="w-100 img-zoom">
                                    </a>
                                </div>

                                <div class="card-body">
                                    <div class="card-head border-bottom-start">
                                        <h5 class="card-title text-danger">{{ $item->title }}</h5>
                                    </div>

                                    <div class="card-text">
                                        {!! $item->excerpt !!}
                                    </div>
                                </div>
                            </div><!-- /.card card-services -->
                        </div>
                    @endforeach
                </div><!-- /.slider slider-services -->
            </div><!-- /.container -->
        </div><!-- /.section -->
    </div><!-- /.section section-services section-services-inner -->
@endsection
