@if(isset($ogSource))
    @if (!empty($ogSource->ogTitle()))
        <meta property="og:title" content="{{ $ogSource->ogTitle() }}" />
    @else
        <meta property="og:title" content="{{ setting_val('TYPE_SITE_NAME') }}" />
    @endif

    @if (!empty($ogSource->ogDescription()))
        <meta property="og:description" content="{{ $ogSource->ogDescription() }}" />
    @else
        <meta property="og:description" content="{{ trans('Твоето място в уеб пространството') }}" />
    @endif

    @if (!empty($ogSource->ogImage()))
        <meta property="og:image" content="{{ $ogSource->ogImage() }}" />
    @endif
@else
    <meta property="og:title" content="{{ setting_val('TYPE_SITE_NAME') }}" />
    <meta property="og:description" content="{{ trans('Твоето място в уеб пространството') }}" />
    <meta property="og:image" content="" />
@endif
<meta property="og:url" content="{{ url()->full() }}" />
