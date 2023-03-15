<div class="container wow bounceInUp" data-wow-duration="0.5s">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('homepage')}}" class="link-hover">{{trans('frontend.homepage')}}</a>
            </li>
            @if(isset($breadcrumbItems))
                @foreach($breadcrumbItems[0] as $item)
                    @if(isset($item['url']))
                        <li class="breadcrumb-item">
                            <a href="{{$item['url']}}" class="link-hover">{!! $item['content'] !!}</a>
                        </li>
                    @else
                        <li  class="breadcrumb-item  active" aria-current="page">
                            <span itemprop="name">{!! $item['content'] !!}</span>
                        </li>
                    @endif
                @endforeach
            @endif
        </ol>
    </nav>
</div>

