@extends('front.layout')

@section('title')
    {{ trans('Блог') }} | {{ setting_val('TYPE_SITE_NAME') }}
@endsection

@section('main')
    @can('manage_blog')
        <div class="section">
            <div class="container">
                <div class="p-5 bg-f3">
                    <div class="row">
                        <div class="col-6 col-sm-4 col-md-3">
                            <b>Заглавие на статията:</b>
                        </div><!-- /.col-sm-3 -->
                        <div class="col-6 col-sm-4 col-md-3">
                            {{ $article->title }}
                        </div><!-- /.col-sm-3 -->
                        <div class="col-6 col-sm-4 col-md-3">
                            <b>Действия:</b>
                        </div><!-- /.col-sm-3 -->
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="{{ route('admin.blog.article.edit', ['id' => $article]) }}"
                               class="btn btn-primary" target="_blank">Редакция</a>
                        </div><!-- /.col-sm-3 -->
                    </div><!-- /.row -->
                </div>
            </div>
        </div><!-- /.section -->
    @endcan

    @include('front.components.breadcrumb')

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card card-basic mb-5 wow bounceInUp" data-wow-duration="0.5s" data-wow-delay="0.4s">
                                @if(!empty($article->image))
                                    <img src="{{ gallery_image($article->image, \App\Constant\GalleryFileConstant::TYPE_BLOG_IMAGE, \App\Constant\GalleryFileConstant::TYPE_COMPRESSED) }}" class="card-img-top" alt="...">
                                @else
                                    <p class="text-center p-3">{{ trans('Няма изображение') }}</p>
                                @endif
                                <div class="card-body">
                                    <h3 class="card-title text-center">{{ $articleTranslation->title }}</h3>

                                    <div class="border-wrapper p-3">
                                        <div class="border-black"></div><!-- /.border-black -->
                                    </div><!-- /.border-wrapper -->

                                    <div class="card-meta px-md-5"><i
                                            class="fa fa-calendar"></i> {{ \Carbon\Carbon::parse($article->blog_date)->format('d.m.Y') }}
                                    </div><!-- /.card-meta -->

                                    <p class="card-text px-md-5">
                                        {!! $articleTranslation->body !!}
                                    </p>
                                </div>
                            </div>
                        </div><!-- /.col-sm-12 -->
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="sidebar">
                        <div class="widgets">
                            <div class="widget widget-articles p-0">
                                <div class="widget-title mb-3 wow bounceInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                                    <h5>{{ trans('Последни статии') }}</h5>
                                </div><!-- /.widget-title -->

                                <div class="widget-inner p-0">
                                    <div class="row">
                                        @foreach($latestArticles as $latestArticle)
                                            @php
                                                $latestArticleTranslation = $latestArticle->translate(locale());
                                                $delay = 0.5+(0.1*$loop->iteration);
                                            @endphp
                                            <div class="col-sm-6 col-md-12 mb-3 wow bounceInUp" data-wow-duration="0.5s" data-wow-delay="{{ $delay }}s">
                                                <div class="card card-basic">
                                                    <a href="{{ route('blog.article', $latestArticleTranslation->slug) }}">
                                                        @if(!empty($latestArticle->image))
                                                            <img
                                                                src="{{ gallery_image($latestArticle->image, \App\Constant\GalleryFileConstant::TYPE_BLOG_IMAGE, \App\Constant\GalleryFileConstant::TYPE_COMPRESSED) }}"
                                                                class="card-img-top">
                                                        @else
                                                            <p class="text-center p-3">{{ trans('Няма изображение') }}</p>
                                                        @endif

                                                        <div class="card-body">
                                                            <h5 class="card-title">{{ $latestArticleTranslation->title }}</h5>

                                                            <p class="card-meta p-0"><i
                                                                    class="fa fa-calendar"></i> {{ \Carbon\Carbon::parse($latestArticle->blog_date)->format('d.m.Y') }}
                                                            </p>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div><!-- /.col-sm-6 col-md-12 -->
                                        @endforeach
                                    </div><!-- /.widget-inner -->
                                </div><!-- /.widget -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
