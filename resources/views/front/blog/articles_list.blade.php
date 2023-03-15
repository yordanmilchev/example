@extends('front.layout')

@section('title')
    {{ trans('Блог') }} | {{ setting_val('TYPE_SITE_NAME') }}
@endsection

@section('main')
    @include('front.components.breadcrumb')

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 order-2 order-md-1">
                    <div class="sidebar">
                        <div class="widgets">
                            <div class="widget widget-blog wow bounceInUp" data-wow-duration="0.5s" data-wow-delay="0.3s">
                                <div class="widget-title text-center">
                                    <h1>{{ trans('Блог') }}</h1>
                                </div><!-- /.widget-title -->

                                <div class="border-wrapper p-4">
                                    <div class="border-black"></div><!-- /.border-black -->
                                </div><!-- /.border-wrapper -->

                                <div class="widget-inner">
                                    <div class="widget-subtitle">
                                        <a href="{{ route('blog.all_articles') }}">{{ trans('Категории') }}</a>
                                    </div>
                                    <!-- /.widget-subtitle -->

                                    <ul>
                                        @forelse($categories as $category)
                                            <li>
                                                <i><a href="{{ route('blog.articles_list', $category->slug) }}">{{ $category->title }}</a></i>
                                            </li>
                                        @empty
                                            <li>
                                                <i>{{ trans('Няма категории') }}</i>
                                            </li>
                                        @endforelse
                                    </ul>

                                    <div class="widget-subtitle mt-4">
                                        <a href="{{ route('blog.all_articles') }}">{{ trans('Архив') }}</a>
                                    </div>

                                    <ul>
                                        @forelse($years as $year)
                                            <li>
                                                <i><a href="{{ route('blog.article.date', $year) }}">{{ \Carbon\Carbon::parse($year)->format('d.m.Y') }}</a></i>
                                            </li>
                                        @empty
                                            <li>
                                                <i>{{ trans('Няма статии') }}</i>
                                            </li>
                                        @endforelse
                                    </ul>
                                </div><!-- /.widget-inner -->
                            </div><!-- /.widget -->

                            <div class="widget widget-articles mt-5 p-0 wow bounceInUp" data-wow-duration="0.5s" data-wow-delay="0.4s">
                                <div class="widget-title mb-3">
                                    <h5>{{ trans('Последни статии') }}</h5>
                                </div><!-- /.widget-title -->

                                <div class="widget-inner p-0">
                                    <div class="row">
                                        @forelse($latestArticles as $latestArticle)
                                            @php
                                                $latestArticleTranslation = $latestArticle->translate(locale());
                                            @endphp
                                            <div class="col-sm-6 col-md-12 mb-3">
                                                <div class="card card-basic">
                                                    <a href="{{ route('blog.article', $latestArticleTranslation->slug) }}">
                                                        @if(!empty($latestArticle->image))
                                                            <img
                                                                src="{{ gallery_image($latestArticle->image, \App\Constant\GalleryFileConstant::TYPE_BLOG_IMAGE, \App\Constant\GalleryFileConstant::TYPE_COMPRESSED) }}" class="card-img-top">
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
                                            </div>
                                        @empty
                                            <div class="col-sm-6 col-md-12 mb-3">
                                                <div class="card card-basic">
                                                    <i class="card-title text-center p-3">{{ trans('Няма статии') }}</i>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div><!-- /.row -->
                                </div><!-- /.widget-inner -->
                            </div><!-- /.widget -->
                        </div>
                    </div>
                </div>

                <div class="col-md-9 order-1 order-md-2">
                    <div class="row">
                        @forelse($blogArticles as $article)
                            @php
                                $articleTranslation = $article->translate(locale());
                                $delay = 0.5+(0.1*$loop->iteration);
                            @endphp
                            <div class="col-sm-6 wow bounceInDown" data-wow-duration="0.5s" data-wow-delay="{{ $delay }}s">
                                <div class="card card-basic mb-5">
                                    <a href="{{ route('blog.article', $articleTranslation->slug) }}">
                                        @if(!empty($article->image))
                                            <img src="{{ gallery_image($article->image, \App\Constant\GalleryFileConstant::TYPE_BLOG_IMAGE, \App\Constant\GalleryFileConstant::TYPE_COMPRESSED) }}"
                                                 class="card-img-top">
                                        @else
                                            <p class="text-center p-3">{{ trans('Няма изображение') }}</p>
                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title mb-0">{{ $articleTranslation->title }}</h5>

                                            <p class="card-text">{{ Str::limit($articleTranslation->excerpt, 200) }}</p>

                                            <div class="card-meta">
                                                <i class="fa fa-calendar"></i> {{ \Carbon\Carbon::parse($article->blog_date)->format('d.m.Y') }}
                                            </div><!-- /.card-meta -->
                                        </div>
                                    </a>
                                </div>
                            </div><!-- /.col-sm-6 -->
                        @empty
                            <div class="col-sm-12">
                                <h2 class="text-center pt-2"><i>{{ trans('Няма статии') }}</i></h2>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('front.components.pagination', [
        'paginationItems' => $blogArticles
    ])
@endsection
