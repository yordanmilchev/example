<div class="header fixed-top ">
    <nav class="navbar navbar-main navbar-expand-lg bg-primary">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                <i class="far fa-bars"></i>
            </button>

            <a class="navbar-brand" href="{{ route('homepage') }}">
                <img src="{{ asset('themes/custom/css/images/logo.png') }}" class="d-sm-block d-none" alt="">

                <img src="{{ asset('themes/custom/css/images/logo-m.png') }}" class="d-sm-none logo-m" alt="">
            </a>

            <div class="collapse navbar-collapse navbar-collapse-c" id="navbarSupportedContent">
                <button class="navbar-toggler navbar-toggler-m" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <i class="far fa-times"></i>
                </button>

                <ul class="navbar-nav navbar-center ms-auto">
                    @auth
                        @can('access_administration_pages')
                            <li class="nav-item">
                                <a class="nav-link text-danger" href="{{ route('admin.dashboard') }}">Admin</a>
                            </li>
                        @endcan

                        <li class="nav-item">
                            <a class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Изход</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endauth

                    <li class="nav-item">
                        <a class="nav-link {{ \Route::is('homepage') ? 'active' : '' }}" aria-current="page" href="{{ route('homepage') }}">НАЧАЛО</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ \Route::is('page') ? 'active' : '' }}" href="{{ page_url('about_us') }}">ЗА НАС</a>
                    </li>

                    @if(count($enabledServices))
                        <li class="nav-item dropdown">
                            <a class="nav-link nav-link-dropdown" href="{{ route('service', $enabledServices[0]->slug ?? '') }}">
                                УСЛУГИ
                            </a>

                            <a class="text-white dropdown-toggle" id="navbarDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="far fa-chevron-down"></i></a>

                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach($enabledServices as $service)
                                    <li><a class="dropdown-item" href="{{ route('service', $service->slug) }}">{{ $service->title }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endif

                    @if(count($enabledActivities))
                        <li class="nav-item dropdown">
                            <a class="nav-link nav-link-dropdown" href="{{ route('activity', $enabledActivities[0]->slug ?? '') }}">
                                ДЕЙНОСТИ
                            </a>

                            <a class="text-white dropdown-toggle" id="navbarDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="far fa-chevron-down"></i></a>

                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach($enabledActivities as $activity)
                                    <li><a class="dropdown-item" href="{{ route('activity', $activity->slug) }}">{{ $activity->title }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link {{ \Route::is('gallery') ? 'active' : '' }}" href="{{ route('gallery') }}">ГАЛЕРИЯ</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ \Route::is('contacts.index') ? 'active' : '' }}" href="{{ route('contacts.index') }}">КОНТАКТИ</a>
                    </li>
                </ul>

                <div class="navbar-nav navbar-end ms-auto">
                    <i class="far fa-phone text-blue"></i>

                    <div class="nav-items">
                        <a class="nav-link" aria-current="page" href="tel:062602050">062 60 20 50</a>

                        <a class="nav-link" href="tel:0878243447">0878 243 447</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div><!-- /.header -->
