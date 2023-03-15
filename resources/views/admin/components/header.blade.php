<div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed d-print-none">
    <!-- begin:: Header Menu -->
    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
        <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default ">
            <ul class="kt-menu__nav ">
                <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel">
                    <a href="{{route('admin.dashboard')}}" class="kt-menu__link">
                        <span class="kt-menu__link-text"><i class="fa fa-tachometer-alt"></i> &nbsp; Табло</span>
                    </a>
                </li>

                <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel">
                    <a href="{{route('homepage')}}" class="kt-menu__link" target="_blank">
                        <span class="kt-menu__link-text"><i class="fa fa-box-open"></i> &nbsp; Фронт</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <!-- end:: Header Menu -->

    <div class="kt-header__topbar">
        @can('manage_system')
            <!--begin: Cache control icon -->
            <div class="kt-header__topbar-item kt-header__topbar-item--langs">
                <div class="kt-header__topbar-wrapper" data-offset="10px,0px">
                    <span class="kt-header__topbar-icon">
                        <a href="javascript:$('#kt_modal_cache_control').modal('show');">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M10.5278225,22.5278225 L8.79765312,20.7976531 L9.99546268,18.4463973 L7.35584531,19.3558453 L5.04895282,17.0489528 L8.15438502,11.6366281 L2.74206034,14.7420603 L1.30025253,13.3002525 L9.26548692,8.03126375 C11.3411817,6.65819522 14.1285885,7.15099488 15.6076701,9.15253022 C17.1660799,11.2614147 17.1219524,14.1519817 15.4998952,16.212313 L10.5278225,22.5278225 Z" fill="#000000" opacity="0.3"/>
                                    <path d="M22.4246212,4.91054166 L18.4071175,8.92804534 C17.6260689,9.70909393 16.359739,9.70909393 15.5786904,8.92804534 C14.7976418,8.14699676 14.7976418,6.8806668 15.5786904,6.09961822 L19.6029298,2.0753788 C19.7817428,2.41498256 19.9878937,2.74436937 20.2214305,3.06039796 C20.8190224,3.86907629 21.5791361,4.49033747 22.4246212,4.91054166 Z" fill="#000000" transform="translate(18.708763, 5.794605) rotate(-180.000000) translate(-18.708763, -5.794605) "/>
                                </g>
                            </svg>
                        </a>
                    </span>
                </div>
            </div>
            <!--end: Cache control icon -->
            <div class="kt-header__topbar-item kt-header__topbar-item--langs">
                <div class="kt-header__topbar-wrapper" data-offset="10px,0px">
                <span class="kt-header__topbar-icon">
                    <a href="javascript:$('#kt_modal_impressionate_control').modal('show');">
                        <i class="fa fa-theater-masks"></i>
                    </a>
                </span>
                </div>
            </div>
        @endcan

        <div class="kt-header__topbar-item kt-header__topbar-item--user">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                <div class="kt-header__topbar-user">
                    <span class="kt-header__topbar-welcome kt-hidden-mobile">Здравейте </span>
                    <span class="kt-header__topbar-username kt-hidden-mobile">{{ Auth::user()->name }}</span>

                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                    <span
                        class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">{{ Auth::user()->name[0] }}</span>
                </div>
            </div>
            <div
                class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround">

                <!--begin: Navigation -->
                <div class="kt-notification">
                    <div class="kt-notification__custom kt-space-between">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="btn btn-label btn-label-brand btn-sm btn-bold">Изход</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
                <!--end: Navigation -->
            </div>
        </div>
        <!--end: User Bar -->
    </div>
</div>

@can('manage_system')
    @include('admin.components.cache_module')
    @include('admin.components.impressionate_module')
@endcan
