<!-- begin:: Aside -->
<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
    <!-- begin:: Aside -->
    <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
        <div class="kt-aside__brand-logo">
            <a href="{{ route('admin.dashboard') }}" class="js-loader">
                <img alt="Logo" src="{{ setting_val('TYPE_SITE_LOGO_PRIMARY') }}" width="160" />
            </a>
        </div>
        <div class="kt-aside__brand-tools">
            <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
                <span>
                    <i class="flaticon2-fast-back" style="color: #5867dd"></i>
                </span>
                <span>
                    <i class="flaticon2-fast-next" style="color: #5867dd"></i>
                </span>
            </button>
            <button class="kt-aside__brand-aside-toggler kt-aside__brand-aside-toggler--left"
                id="kt_aside_toggler"><span></span></button>
        </div>
    </div>
    <!-- end:: Aside -->

    <!-- begin:: Aside Menu -->
    <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
        <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1"
            data-ktmenu-dropdown-timeout="500">
            <ul class="kt-menu__nav ">
                @can('manage_products')
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="fa fa-bolt"></i>
                            </span><span class="kt-menu__link-text">Бързи връзки</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu " kt-hidden-height="200" style=""><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                @can('view_orders')
                                    <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.orders.') !== false ? 'kt-menu__item--active' : '' }} {{ strpos(Route::current()->getName(), 'admin.speedy.') !== false ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('admin.orders.index') }}" class="kt-menu__link js-loader">
                                            <span class="kt-menu__link-icon">
                                                <i class="fa fa-shopping-cart"></i>
                                            </span><span class="kt-menu__link-text">Поръчки</span></a>
                                    </li>
                                @endcan
                                @can('view_users')
                                    <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.user.') !== false ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('admin.user.list') }}" class="kt-menu__link js-loader">
                                            <span class="kt-menu__link-icon">
                                                <i class="fa fa-user-circle"></i>
                                            </span><span class="kt-menu__link-text">Акаунти</span></a>
                                    </li>
                                @endcan
                                @can('view_products_list')
                                    <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.catalog.product.')  !== false ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('admin.catalog.product.list') }}" class="kt-menu__link js-loader">
                                            <span class="kt-menu__link-icon">
                                                <i class="fa fa-bed"></i>
                                            </span><span class="kt-menu__link-text">Продукти</span></a>
                                    </li>
                                @endcan
                                @can('manage_products')
                                    <li class="kt-menu__item  kt-menu__item {{ in_array(Route::current()->getName(),['admin.catalog.product_categories.list', 'admin.catalog.product_categories.edit']) ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('admin.catalog.product_categories.list') }}" class="kt-menu__link js-loader">
                                            <span class="kt-menu__link-icon">
                                                <i class="fa fa-bezier-curve"></i>
                                            </span><span class="kt-menu__link-text">Категории продукти</span></a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan

                @can('view_orders')
                    <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.orders.') !== false ? 'kt-menu__item--active' : '' }} {{ strpos(Route::current()->getName(), 'admin.speedy.') !== false ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('admin.orders.index') }}" class="kt-menu__link js-loader">
                            <span class="kt-menu__link-icon">
                                <i class="fa fa-shopping-cart"></i>
                            </span><span class="kt-menu__link-text">Поръчки</span></a>
                    </li>
                @endcan

                @can('manage_test_orders')
                    <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.test_orders') !== false ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('admin.test_orders') }}" class="kt-menu__link js-loader">
                        <span class="kt-menu__link-icon">
                            <i class="fa fa-shopping-cart"></i>
                        </span><span class="kt-menu__link-text">Тестови поръчки</span></a>
                    </li>
                @endcan

                @can('view_users')
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="far fa-user"></i>
                            </span><span class="kt-menu__link-text">Потребители</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu " kt-hidden-height="200" style=""><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.user.') !== false ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                    <a href="{{ route('admin.user.list') }}" class="kt-menu__link js-loader">
                                        <span class="kt-menu__link-icon">
                                            <i class="fa fa-user-circle"></i>
                                        </span><span class="kt-menu__link-text">Акаунти</span>
                                    </a>
                                </li>
                                @can("view_financial_information")
                                    <li class="kt-menu__item  kt-menu__item {{ Route::current()->getName() == 'admin.users.top_buyers' ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('admin.users.top_buyers') }}" class="kt-menu__link js-loader">
                                            <span class="kt-menu__link-icon">
                                                <i class="fa fa-user-plus"></i>
                                            </span><span class="kt-menu__link-text">Досиета по оборот</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('manage_acl')
                                    <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.role.') !== false ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('admin.role.list') }}" class="kt-menu__link js-loader">
                                            <span class="kt-menu__link-icon">
                                                <i class="fa fa-user-tag"></i>
                                            </span><span class="kt-menu__link-text">Роли</span></a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan

                @can('view_financial_information')
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="fa fa-chart-bar"></i>
                            </span><span class="kt-menu__link-text">Отчети по</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu " kt-hidden-height="200" style=""><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.report.mypos_transactions') !== false ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                    <a href="{{ route('admin.report.mypos_transactions') }}" class="kt-menu__link js-loader">
                                        <span class="kt-menu__link-icon">
                                            <i class="fas fa-money-check-alt"></i>
                                        </span><span class="kt-menu__link-text">MyPos транзакции</span></a>
                                </li>
                                <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.report.borica_transactions') !== false ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                    <a href="{{ route('admin.report.borica_transactions') }}" class="kt-menu__link js-loader">
                                        <span class="kt-menu__link-icon">
                                            <i class="fa fa-credit-card"></i>
                                        </span><span class="kt-menu__link-text">Борика транзакции</span></a>
                                </li>
                                <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.report.by_source') !== false ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                    <a href="{{ route('admin.report.by_source') }}" class="kt-menu__link js-loader">
                                        <span class="kt-menu__link-icon">
                                            <i class="fa fa-chart-pie"></i>
                                        </span><span class="kt-menu__link-text">Източник и държави</span></a>
                                </li>
                                <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.report.by_day_and_source') !== false ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                    <a href="{{ route('admin.report.by_day_and_source') }}" class="kt-menu__link js-loader">
                                        <span class="kt-menu__link-icon">
                                            <i class="fa fa-chart-bar"></i>
                                        </span><span class="kt-menu__link-text">Източник и дни</span></a>
                                </li>
                                <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.report.by_city_or_region') !== false ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                    <a href="{{ route('admin.report.by_city_or_region') }}" class="kt-menu__link js-loader">
                                        <span class="kt-menu__link-icon">
                                            <i class="fa fa-list-ul"></i>
                                        </span><span class="kt-menu__link-text">Градове и региони</span></a>
                                </li>
                                <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.report.by_region') !== false ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                    <a href="{{ route('admin.report.by_region') }}" class="kt-menu__link js-loader">
                                        <span class="kt-menu__link-icon">
                                            <i class="fa fa-th-list"></i>
                                        </span><span class="kt-menu__link-text">Регион или населено място</span></a>
                                </li>
                                <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.report.by_price_type') !== false ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                    <a href="{{ route('admin.report.by_price_type') }}" class="kt-menu__link js-loader">
                                        <span class="kt-menu__link-icon">
                                            <i class="fa fa-percentage"></i>
                                        </span><span class="kt-menu__link-text">Съотношение регулярна цена, промо</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan

                @can('manage_products')
                    <li class="kt-menu__item  kt-menu__item--submenu " aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="fa fa-box-open"></i>
                            </span><span class="kt-menu__link-text">Магазин</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu " kt-hidden-height="200" style=""><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                @can('view_products_list')
                                    <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.catalog.product.')  !== false ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('admin.catalog.product.list') }}" class="kt-menu__link js-loader">
                                            <span class="kt-menu__link-icon">
                                                <i class="fa fa-bed"></i>
                                            </span><span class="kt-menu__link-text">Продукти</span></a>
                                    </li>
                                @endcan
                                @can('translate')
                                    <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.catalog.products.missing_translations')  !== false ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a
                                            href="{{ route('admin.catalog.products.missing_translations') }}" class="kt-menu__link js-loader">
                                        <span class="kt-menu__link-icon">
                                            <i class="fa fa-minus-circle"></i>
                                        </span><span class="kt-menu__link-text">Продукти с липсващи преводи</span></a>
                                    </li>
                                @endcan
                                <li class="kt-menu__item  kt-menu__item {{ in_array(Route::current()->getName(),['admin.catalog.product_categories.list', 'admin.catalog.product_categories.edit']) ? 'kt-menu__item--active' : '' }}  !== false ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                    <a href="{{ route('admin.catalog.product_categories.list') }}" class="kt-menu__link js-loader">
                                        <span class="kt-menu__link-icon">
                                            <i class="fa fa-bezier-curve"></i>
                                        </span><span class="kt-menu__link-text">Категории продукти</span></a>
                                </li>
                                @can('translate')
                                    <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.catalog.product_categories.missing_translations')  !== false ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('admin.catalog.product_categories.missing_translations') }}" class="kt-menu__link js-loader">
                                            <span class="kt-menu__link-icon">
                                                <i class="fa fa-minus-circle"></i>
                                            </span><span class="kt-menu__link-text">Категории с липсващи преводи</span></a>
                                    </li>
                                @endcan
                                <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.catalog.product_models.') !== false ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                    <a href="{{ route('admin.catalog.product_models.index') }}" class="kt-menu__link js-loader">
                                        <span class="kt-menu__link-icon">
                                            <i class="fa fa-boxes"></i>
                                        </span><span class="kt-menu__link-text">Модели продукти</span></a>
                                </li>
                                @can("translate")
                                    <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.catalog.product_model.missing_translations')  !== false ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('admin.catalog.product_model.missing_translations') }}" class="kt-menu__link js-loader">
                                            <span class="kt-menu__link-icon">
                                                <i class="fa fa-minus-circle"></i>
                                            </span><span class="kt-menu__link-text">Модели продукти с липсващи преводи</span></a>
                                    </li>
                                @endcan
                                <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.catalog.product_weights')  !== false ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                    <a href="{{ route('admin.catalog.product_weights') }}" class="kt-menu__link js-loader">
                                        <span class="kt-menu__link-icon">
                                            <i class="fa fa-arrows-alt"></i>
                                        </span><span class="kt-menu__link-text">Подредба на продукти</span></a>
                                </li>
                                <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.catalog.attributes.')  !== false ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                    <a href="{{ route('admin.catalog.attributes.index') }}" class="kt-menu__link js-loader">
                                        <span class="kt-menu__link-icon">
                                            <i class="fa fa-cogs"></i>
                                        </span><span class="kt-menu__link-text">Атрибути</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan

                @can('manage_products')
                    <li class="kt-menu__item  kt-menu__item--submenu " aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="fa fa-search"></i>
                            </span><span class="kt-menu__link-text">Проверки</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu " kt-hidden-height="200" style=""><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                @can('manage_users')
                                    <li class="kt-menu__item  kt-menu__item {{ Route::current()->getName() == 'admin.data_checks.activity' ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('admin.data_checks.activity') }}" class="kt-menu__link js-loader">
                                            <span class="kt-menu__link-icon">
                                                <i class="fa fa-bolt"></i>
                                            </span><span class="kt-menu__link-text">Активност потребители</span></a>
                                    </li>
                                    @can('manage_system')
                                        <li class="kt-menu__item  kt-menu__item {{ Route::current()->getName() == 'admin.data_checks.many_profiles' ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                            <a href="{{ route('admin.data_checks.many_profiles') }}" class="kt-menu__link js-loader">
                                                <span class="kt-menu__link-icon">
                                                    <i class="fa fa-users"></i>
                                                </span><span class="kt-menu__link-text">Досиета с много профили</span></a>
                                        </li>
                                    @endcan
                                @endcan
                                <li class="kt-menu__item  kt-menu__item {{ Route::current()->getName() == 'admin.data_checks.products_edit_log' ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                    <a href="{{ route('admin.data_checks.products_edit_log') }}" class="kt-menu__link js-loader">
                                        <span class="kt-menu__link-icon">
                                                <i class="fa fa-list-alt"></i>
                                        </span><span class="kt-menu__link-text">Последно редактирани продукти</span></a>
                                </li>
                                <li class="kt-menu__item  kt-menu__item {{ Route::current()->getName() == 'admin.data_checks.duplicated' ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                    <a href="{{ route('admin.data_checks.duplicated') }}" class="kt-menu__link js-loader">
                                        <span class="kt-menu__link-icon">
                                            <i class="fa fa-check-double"></i>
                                        </span><span class="kt-menu__link-text">Дублирани продукти</span></a>
                                </li>
                                <li class="kt-menu__item  kt-menu__item {{ Route::current()->getName() == 'admin.data_checks.unpublished' ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                    <a href="{{ route('admin.data_checks.unpublished') }}" class="kt-menu__link js-loader">
                                        <span class="kt-menu__link-icon">
                                            <i class="fa fa-cube"></i>
                                        </span><span class="kt-menu__link-text">Продукти с наличност, но непубликувани</span></a>
                                </li>
                                <li class="kt-menu__item  kt-menu__item {{ Route::current()->getName() == 'admin.data_checks.product_filters' ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                    <a href="{{ route('admin.data_checks.product_filters') }}" class="kt-menu__link js-loader">
                                        <span class="kt-menu__link-icon">
                                            <i class="fa fa-lightbulb"></i>
                                        </span><span class="kt-menu__link-text">Приложени филтри в/у продукти</span></a>
                                </li>
                                <li class="kt-menu__item  kt-menu__item {{ Route::current()->getName() == 'admin.data_checks.blog_article_edit_log' ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                    <a href="{{ route('admin.data_checks.blog_article_edit_log') }}" class="kt-menu__link js-loader">
                                        <span class="kt-menu__link-icon">
                                                <i class="fa fa-list-alt"></i>
                                        </span><span class="kt-menu__link-text">Последно редактирани статии</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan

                @can('manage_gallery')
                    <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.gallery.')>-1 ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('admin.gallery.index') }}" class="kt-menu__link js-loader">
                            <span class="kt-menu__link-icon">
                                <i class="fa fa-image"></i>
                            </span><span class="kt-menu__link-text">Галерия</span></a>
                    </li>
                @endcan

                @can('view_feedback')
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="fa fa-paper-plane"></i>
                            </span><span class="kt-menu__link-text">Обратна връзка</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu " kt-hidden-height="200" style=""><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item {{ Route::current()->getName() == 'admin.feedback.orders' ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                    <a href="{{ route('admin.feedback.orders') }}" class="kt-menu__link js-loader">
                                        <span class="kt-menu__link-icon">
                                            <i class="fa fa-star"></i>
                                        </span><span class="kt-menu__link-text">Оценки</span>
                                    </a>
                                </li>
                                <li class="kt-menu__item  kt-menu__item {{ Route::current()->getName() == 'admin.feedback.request' ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                    <a href="{{ route('admin.feedback.request') }}" class="kt-menu__link js-loader">
                                    <span class="kt-menu__link-icon">
                                        <i class="fa fa-redo"></i>
                                    </span><span class="kt-menu__link-text">Ръчно изпращане на покани</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan

                @can('manage_pages')
                    <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.pages')>-1 ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('admin.pages.index') }}" class="kt-menu__link js-loader">
                            <span class="kt-menu__link-icon">
                                <i class="fa fa-copy"></i>
                            </span><span class="kt-menu__link-text">Страници</span></a>
                    </li>
                @endcan

                @can('manage_homepage')
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="fas fa-plane-arrival"></i>
                            </span><span class="kt-menu__link-text">Homepage</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu " kt-hidden-height="200" style=""><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.homepage.slider.')>-1 ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                    <a href="{{ route('admin.homepage.slider.list') }}" class="kt-menu__link js-loader">
                                    <span class="kt-menu__link-icon">
                                        <i class="fas fa-step-forward"></i>
                                    </span><span class="kt-menu__link-text">Slider</span></a>
                                </li>
                                <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.homepage.partners')>-1 ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                    <a href="{{ route('admin.homepage.partners') }}" class="kt-menu__link js-loader">
                                    <span class="kt-menu__link-icon">
                                        <i class="fas fa-users"></i>
                                    </span><span class="kt-menu__link-text">Партньори</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan

                @can('manage_activities')
                    <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.activity')>-1 ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('admin.activity.list') }}" class="kt-menu__link js-loader">
                        <span class="kt-menu__link-icon">
                            <i class="fa fa-tasks"></i>
                        </span><span class="kt-menu__link-text">Дейности</span></a>
                    </li>
                @endcan

                @can('manage_services')
                    <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.service')>-1 ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('admin.service.list') }}" class="kt-menu__link js-loader">
                        <span class="kt-menu__link-icon">
                            <i class="fa fa-check"></i>
                        </span><span class="kt-menu__link-text">Услуги</span></a>
                    </li>
                @endcan

                @can('manage_inquiries')
                    <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.message.')>-1 ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                        <a href="{{ route('admin.message.index') }}" class="kt-menu__link js-loader">
                            <span class="kt-menu__link-icon">
                                <i class="fas fa-envelope"></i>
                            </span><span class="kt-menu__link-text">Съобщения</span></a>
                    </li>
                @endcan

                @can('manage_system')
                    <li class="kt-menu__item  kt-menu__item--submenu" aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="fab fa-whmcs"></i>
                            </span><span class="kt-menu__link-text">Система</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu " kt-hidden-height="200" style=""><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.settings.')  !== false ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                    <a href="{{ route('admin.settings.index') }}" class="kt-menu__link js-loader">
                                        <span class="kt-menu__link-icon">
                                            <i class="fa fa-tools"></i>
                                        </span><span class="kt-menu__link-text">Настройки</span></a>
                                </li>
                                @can('manage_layout_blocks')
                                    <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.layout-blocks.')  !== false ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                                        <a href="{{ route('admin.layout-blocks.index') }}" class="kt-menu__link js-loader">
                                            <span class="kt-menu__link-icon">
                                                <i class="flaticon-squares-4"></i>
                                            </span><span class="kt-menu__link-text">Региони и блокове</span></a>
                                    </li>
                                @endcan
                                @can('manage_files')
                                    <li class="kt-menu__item  kt-menu__item" aria-haspopup="true">
                                        <a href="{{ route('unisharp.lfm.show') }}" class="kt-menu__link">
                                            <span class="kt-menu__link-icon">
                                                <i class="fa fa-photo-video"></i>
                                            </span><span class="kt-menu__link-text">Медия</span></a>
                                    </li>
                                @endcan
                                <li class="kt-menu__item  kt-menu__item" aria-haspopup="true">
                                    <a href="{{ route('admin.logs') }}" class="kt-menu__link js-loader">
                                        <span class="kt-menu__link-icon">
                                            <i class="fa fa-list-alt"></i>
                                        </span><span class="kt-menu__link-text">Лог</span></a>
                                </li>
                                @can('translate')
                                    <li class="kt-menu__item  kt-menu__item" aria-haspopup="true">
                                        <a href="/admin/translation-manager" class="kt-menu__link js-loader">
                                            <span class="kt-menu__link-icon">
                                                <i class="fa fa-language"></i>
                                            </span><span class="kt-menu__link-text">Преводи</span></a>
                                    </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan

                @can('manage_cities')
                    <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.stores.')>-1 ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a
                        href="{{ route('admin.stores.list') }}" class="kt-menu__link js-loader">
                        <span class="kt-menu__link-icon">
                            <i class="fa fa-globe-africa"></i>
                        </span><span class="kt-menu__link-text">Мрежа от обекти - магазини</span></a>
                    </li>

                    <li class="kt-menu__item  kt-menu__item--submenu " aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="fa fa-building"></i>
                            </span><span class="kt-menu__link-text">Населени места</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu " kt-hidden-height="200" style=""><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.cities.')>-1 ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a
                                        href="{{ route('admin.cities.list') }}" class="kt-menu__link js-loader">
                                    <span class="kt-menu__link-icon">
                                        <i class="fas fa-vihara"></i>
                                    </span><span class="kt-menu__link-text">Списък</span></a>
                                </li>
                                <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.neighbourhood.')>-1 ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a
                                        href="{{ route('admin.neighbourhood.index') }}" class="kt-menu__link js-loader">
                                    <span class="kt-menu__link-icon">
                                        <i class="fa fa-user-secret"></i>
                                    </span><span class="kt-menu__link-text">Квартали</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan

                @can('manage_blog')
                    <li class="kt-menu__item  kt-menu__item--submenu " aria-haspopup="true">
                        <a href="javascript:;" class="kt-menu__link kt-menu__toggle">
                            <span class="kt-menu__link-icon">
                                <i class="far fa-newspaper"></i>
                            </span><span class="kt-menu__link-text">Блог</span>
                            <i class="kt-menu__ver-arrow la la-angle-right"></i>
                        </a>
                        <div class="kt-menu__submenu " kt-hidden-height="200" style=""><span class="kt-menu__arrow"></span>
                            <ul class="kt-menu__subnav">
                                <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.blog.article.')>-1 ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a
                                        href="{{ route('admin.blog.article.list') }}" class="kt-menu__link js-loader">
                                    <span class="kt-menu__link-icon">
                                        <i class="far fa-file"></i>
                                    </span><span class="kt-menu__link-text">Статии</span></a>
                                </li>
                                <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.blog.categories.')>-1 ? 'kt-menu__item--active' : '' }}" aria-haspopup="true"><a
                                        href="{{ route('admin.blog.categories.list') }}" class="kt-menu__link js-loader">
                                    <span class="kt-menu__link-icon">
                                        <i class="far fa-folder-open"></i>
                                    </span><span class="kt-menu__link-text">Категории статии</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endcan

                <li class="kt-menu__item  kt-menu__item {{ strpos(Route::current()->getName(), 'admin.url_metas.')>-1 ? 'kt-menu__item--active' : '' }}" aria-haspopup="true">
                    <a href="{{ route('admin.url_metas.list') }}" class="kt-menu__link js-loader">
                        <span class="kt-menu__link-icon">
                            <i class="fab fa-google"></i>
                        </span><span class="kt-menu__link-text">SEO/Списък с URL-и</span></a>
                </li>
            </ul>
        </div>
    </div>
    <!-- end:: Aside Menu -->
</div>
<!-- end:: Aside -->

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // open menu if sub link is active
        $('.kt-menu__item.kt-menu__item--active').closest('li.kt-menu__item--submenu').addClass('kt-menu__item--open');
    }, false);
</script>
