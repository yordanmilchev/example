@extends('front.layout')

@section('title')
    {{ trans('Галерия') }}
@endsection

@section('main')
    <div class="section section-gallery bg-dark">
        <div class="container">
            <div class="section-head border-bottom text-center">
                <h2 class="h2 section-title text-white wow animate__animated animate__fadeInUp" data-wow-duration=".5s"
                    data-wow-delay=".5s">Галерия</h2>
            </div>

            <div class="section-body">
                <div class="slider slider-gallery-inner row g-0">
                    <!-- Max 38 slides -->
                    @foreach($imageFiles as $image)
                        <div class="slide col-md-4">
                            <div>
                                <a href="{{ gallery_image($image->name, \App\Constant\GalleryFileConstant::TYPE_GALLERY_IMAGE, \App\Constant\GalleryFileConstant::TYPE_COMPRESSED) }}" data-fancybox="gallery">
                                    <img class="img-gallery" src="{{ gallery_image($image->name, \App\Constant\GalleryFileConstant::TYPE_GALLERY_IMAGE, \App\Constant\GalleryFileConstant::TYPE_TEASER, 500, 365, null, false, \Spatie\Image\Manipulations::FIT_CROP) }}" />
                                </a>
                            </div>
                        </div><!-- /.slide -->
                    @endforeach
                </div><!-- /.slider slider-gallery-inner -->
            </div><!-- /.section-body -->

            <div class="section-bottom text-center wow animate__animated animate__fadeInUp" data-wow-duration=".5s"
                 data-wow-delay=".5s">
                <a href="{{ route('contacts.index') }}" class="btn btn-primary">Свържи се с нас</a>
            </div><!-- /.section-bottom -->
        </div><!-- /.container -->
    </div><!-- /.section section-gallery -->


    @include('front.components.pagination', [
                'paginationItems' => $imageFiles
            ])
@endsection
