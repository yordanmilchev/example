<!DOCTYPE html>
<html lang="en">
<head>
    @if(!is_admin())
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            //dataLayer = [];
            dataLayer.push({
                'ecommerce': {
                    'impressions': []
                }
            });
        </script>
        @yield('dataLayer')

        <!-- Google Tag Manager -->
        <script async>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','{{setting_val('TYPE_GOOGLE_ANALYTICS_ID')}}');</script>

        @section('fb_pixel_initialization')
            <!-- Facebook Pixel Code -->
            <script>
                !function(f,b,e,v,n,t,s)
                {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                    n.queue=[];t=b.createElement(e);t.async=!0;
                    t.src=v;s=b.getElementsByTagName(e)[0];
                    s.parentNode.insertBefore(t,s)}(window, document,'script',
                    'https://connect.facebook.net/en_US/fbevents.js');
                fbq('init', '{{setting_val('TYPE_FB_PIXEL_ID')}}');
                fbq('track', 'PageView');
            </script>
            <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id={{setting_val('TYPE_FB_PIXEL_ID')}}&ev=PageView&noscript=1"/></noscript>

            <!-- End Facebook Pixel Code -->
        @show

        @yield('facebook_pixel')
    @endif

    <meta charset="utf-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Start Meta title -->
    @if(isset($metaData->meta_title))<title>{{ $metaData->meta_title }}</title>
    @else <title>@yield('title', setting_val('TYPE_SITE_NAME'))</title>@endif<!-- End Meta title -->

    <!-- Start Meta description -->
    @if(isset($metaData->meta_description))<meta name="description" content="{{ $metaData->meta_description }}">
    @else<meta name="description" content="@yield('meta_description')">@endif<!-- End Meta description -->

    @section('og_tags')
        @include('front.components._og_tags')
    @show

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('themes/custom/css/images/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('themes/custom/css/images/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('themes/custom/css/images/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('themes/custom/css/images/favicon-16x16.png') }}">

    @php $js_version = strtotime('today'); @endphp

    <!-- Vendor Styles -->
    <link rel="stylesheet" href="{{ asset('vendor/cookieconsent/dist/cookieconsent.css') }}" />

    <link rel="stylesheet" href="{{ asset('themes/custom/vendor/bootstrap-5.2.1/dist/css/bootstrap.css') }}" />
    <link rel="stylesheet" href="{{ asset('themes/custom/vendor/fontawesome-pro-5.7.2-web/css/all.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('themes/custom/vendor/animate.css-main/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/custom/vendor/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/custom/vendor/slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('themes/custom/vendor/fancybox/dist/jquery.fancybox.min.css') }}">

    <!-- App Styles -->
    <link rel="stylesheet" href="{{ asset('themes/custom/css/style.css') }}" />

    <!-- Vendor JS -->
    <script src="{{ asset('themes/custom/vendor/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('themes/custom/vendor/bootstrap-5.2.1/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('themes/custom/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('themes/custom/vendor/fancybox/dist/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('themes/custom/vendor/WOW-master/dist/wow.min.js') }}"></script>
    <script src="{{ asset('themes/custom/vendor/purecounterjs-main/dist/purecounter.js') }}"></script>

    @yield('head') {{-- to yield js, css, etc. --}}

    <script src="{{ asset('themes/custom/js/functions.js') }}"></script>

    @yield('tracking_scripts')

</head>

<body>
    <div class="wrapper">
        @section('header')
            @include('front.components.header')
        @show

        @yield('main')

        @section('footer')
            @include('front.components.footer')
        @show
    </div><!-- /.wrapper -->

    <!--begin::Page Scripts(used by this page) -->
    @yield('page_js')
    <!--end::Page Scripts -->
    <script>
        (function () {
            window.onpageshow = function(event) {
                if (event.persisted) {
                    window.location.reload(); // if it is cached - reload. (Refreshes data when using browser nav buttons(back, forward)
                }
            };
        })();
    </script>

    <script src="{{ asset('vendor/cookieconsent/dist/cookieconsent.js') }}" defer></script>
    <script src="{{ asset('vendor/cookieconsent/consent-init.js') }}" defer></script>

    <script src="{{ asset('js/jquery.cookie.js') }}"></script>

</body>
</html>
