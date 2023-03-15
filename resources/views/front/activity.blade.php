@extends('front.layout')

@section('title')
    {{ setting_val('TYPE_SITE_NAME') }}
@endsection

@section('main')
    <div class="section section-teaser bg-dark">
        <div class="container">
            <div class="bg-white">
                <ul class="slider slider-main">
                    <li class="slide">
                        <picture>
                            <source srcset="{{ gallery_image($activity->image, \App\Constant\GalleryFileConstant::TYPE_ACTIVITY_IMAGE, \App\Constant\GalleryFileConstant::TYPE_1920X425, 1920, 425, null, false, \Spatie\Image\Manipulations::FIT_CROP) }}" media="(min-width: 767px)" 1x />

                            <source srcset="{{ gallery_image($activity->image, \App\Constant\GalleryFileConstant::TYPE_ACTIVITY_IMAGE, \App\Constant\GalleryFileConstant::TYPE_800X400, 800, 400, null, false, \Spatie\Image\Manipulations::FIT_CROP) }}" 1x />

                            <img src="{{ gallery_image($activity->image, \App\Constant\GalleryFileConstant::TYPE_ACTIVITY_IMAGE, \App\Constant\GalleryFileConstant::TYPE_1920X425, 1920, 425, null, false, \Spatie\Image\Manipulations::FIT_CROP) }}" alt="">
                        </picture>
                    </li><!-- /.slide -->
                </ul><!-- /.slider -->

                <div class="section-head border-bottom">
                    <h1 class="section-title text-danger">{{ $activity->translate(locale())->title }}</h1>
                </div> <!-- /.section-head border-bottom -->

                <div class="section-body">
                    <div class="section-text">
                        {!! $activity->translate(locale())->description !!}
                    </div>
                </div><!-- /.section-body -->

                <div class="section-bottom text-center">
                    <a href="{{ route('contacts.index') }}" class="btn btn-primary box-shadow">Свържи се с нас</a>
                </div><!-- /.section-bottom -->
            </div>
        </div><!-- /.container -->
    </div><!-- /.section section-teaser -->

    <div class="section">
        <div class="container">
            <div class="section-head border-bottom">
                <h2 class="section-title">ВСИЧКИ ДЕЙНОСТИ</h2>
            </div> <!-- /.section-head border-bottom -->

            <div class="section-body">
                <div class="row slider slider-services slider-services-top">
                    @foreach($enabledActivities as $item)
                        @if($item->id == $activity->id)
                            @continue
                        @endif
                        <div class="col-1of5 col-md-4 slide">
                            <a href="{{ route('activity', $item->slug) }}" class="card card-sm">
                                <div class="card-head border-bottom wow animate__animated animate__fadeInDown"
                                     data-wow-duration=".5s" data-wow-delay=".5s">
                                    <div class="text-center">
                                        <object id="" data="{{ asset(\App\Constant\GalleryFileConstant::GALLERY_FILE_DIRECTORIES[\App\Constant\GalleryFileConstant::TYPE_ACTIVITY_IMAGE].$activity->icon) }}" type="image/svg+xml"
                                                class="icon"></object>
                                    </div>

                                    <h6 class="card-title">{{ $item->title }}</h6>
                                </div><!-- /.card-head border-bottom -->

                                <div class="card-body wow animate__animated animate__fadeInUp" data-wow-duration=".5s"
                                     data-wow-delay=".5s">
                                    <div class="card-text">
                                        {!! $item->excerpt !!}
                                    </div>
                                </div><!-- /.card-body -->
                            </a><!-- /.card card-sm -->
                        </div><!-- /.col-1of5 col-md-4 -->
                    @endforeach
                </div><!-- /.row -->
            </div><!-- /.section-body -->
        </div><!-- /.container -->
    </div><!-- /.section -->

    <div class="py-3 bg-dark"></div>
@endsection
