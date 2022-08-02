


<!--begin::Toolbar-->
<div class="toolbar d-flex align-items-stretch">
    <!--begin::Toolbar container-->
    <div class="container-fluid py-6 py-lg-0 d-flex flex-column flex-lg-row align-items-lg-stretch justify-content-lg-between">
        <!--begin::Page title-->
        <div class="page-title d-flex justify-content-center flex-column me-5">
            <!--begin::Title-->
            <h1 class="d-flex flex-column text-dark fw-bolder fs-3 mb-0">
                @if (trim($__env->yieldContent('title')))
                    @yield('title')

                    @endif
            </h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    @if (trim($__env->yieldContent('parentTitle')))
                    @yield('parentTitle')

                    @endif
                </li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Action group-->
        <div class="d-flex align-items-stretch overflow-auto pt-3 pt-lg-0">

        </div>
        <!--end::Action group-->
    </div>
    <!--end::Toolbar container-->
</div>
<!--end::Toolbar-->
