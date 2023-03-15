<div class="kt-subheader kt-grid__item d-print-none" id="kt_subheader" style="height: auto; padding: 10px 0;">
    <div class="kt-container  kt-container--fluid ">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
            <!--begin::Page Heading-->
            <div class="d-flex align-items-baseline mr-5">
                <!--begin::Page Title-->
                <h4 class="kt-subheader__title">
                    @yield('page_title', 'Администрация')
                </h4>
                <!--end::Page Title-->
            </div>
            <!--end::Page Heading-->
        </div>
        <!--end::Info-->

        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            @yield('subheader_toolbar')
        </div>
        <!--end::Toolbar-->
    </div>
</div>
