<!--begin::Aside-->
<div id="kt_aside" class="aside pe-5" data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    <!--begin::Aside Toolbarl-->
    <div class="aside-toolbar flex-column-auto" id="kt_aside_toolbar">
        <!--begin::Aside user-->
        <!--begin::User-->
        <div class="aside-user d-flex align-items-sm-center justify-content-center py-5">
            <!--begin::Symbol-->
            <div class="symbol symbol-50px">
                <img src="{{ asset('assets/media/icons/medical/doctor.png') }}" alt="" />
            </div>
            <!--end::Symbol-->
            @include('layouts.partials.profilUserLogin')
        </div>
        <!--end::User-->
        <!--end::Aside user-->
    </div>
    <!--end::Aside Toolbarl-->
    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y px-2 my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
            data-kt-scroll-height="auto"
            data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}"
            data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="5px">
            <!--begin::Menu-->
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                id="#kt_aside_menu" data-kt-menu="true">

                {{-- Monitoring --}}

                @foreach ($menuSidebar as $section)
                    <div class="menu-item">
                        <div class="menu-content pb-2">
                            <span
                                class="menu-section text-muted text-uppercase fs-8 ls-1">{{ $section->nama_menu }}</span>
                        </div>
                    </div>
                    @if($section->children)

                    @foreach ($section->children as $menuutama)
                        <div class="menu-item">
                            <a class="menu-link" href="{{ route($menuutama->url) }}" title="{{ $menuutama->nama_menu }}"
                                data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click"
                                data-bs-placement="right">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                    <i class="{{ $menuutama->icon }} fs-6"></i>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">{{ $menuutama->nama_menu }}</span>
                            </a>
                        </div>
                    @endforeach
                    @endif
                @endforeach

            </div>
            <!--end::Menu-->
        </div>
        <!--end::Aside Menu-->
    </div>
    <!--end::Aside menu-->


</div>
<!--end::Aside-->
