<div>
    <!--begin::Card body-->
    <!--begin::List-->
    <div class="scroll-y me-n5 pe-5 h-200px h-lg-auto" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_chat_contacts_header" data-kt-scroll-wrappers="#kt_content, #kt_chat_contacts_body" data-kt-scroll-offset="5px">

        @if(collect($dataPasien)->count() > 0)
        @foreach($dataPasien as $pasien)

        <!--begin::User-->
        <div class="d-flex flex-stack py-4">
            <!--begin::Details-->
            <div class="d-flex align-items-center">
                <!--begin::Avatar-->
                <div class="symbol symbol-45px symbol-circle">
                    <span class="symbol-label bg-light-primary text-primary fs-6 fw-bolder">{{ substr($pasien->NMPASIEN, 0, 1) }}</span>
                </div>
                <!--end::Avatar-->
                <!--begin::Details-->
                <div class="ms-5">
                    <div onclick="survey({{ $pasien->NOREGRS }})" id="{{ $pasien->NOREGRS }}" data-namapasien="{{ $pasien->NMPASIEN }}" data-norm="{{ $pasien->NORMPAS }}" data-bagian="{{ $pasien->NAMABAGIAN }}" data-kdbagian="{{ $pasien->REGBAGIAN }}" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">{{ $pasien->NMPASIEN }}</div>
                    <div class="fw-bold text-muted">{{ $pasien->NOREGRS }}</div>
                </div>
                <!--end::Details-->
            </div>
            <!--end::Details-->
            <!--begin::Lat seen-->
            <div class="d-flex flex-column align-items-end ms-2">
                <span class="text-muted fs-7 mb-1">{{ $pasien->NORMPAS }}</span>
                <span class="text-muted fs-7 mb-1">{{ $pasien->NAMABAGIAN }}</span>
            </div>
            <!--end::Lat seen-->
        </div>
        <!--end::User-->
        <!--begin::Separator-->
        <div class="separator separator-dashed d-none"></div>
        <!--end::Separator-->
        @endforeach
        @else
        <!--begin::Notice-->
        <div class="notice d-flex bg-light-danger rounded border-danger border border-dashed mb-9 p-6">
            <!--begin::Icon-->
            <!--begin::Svg Icon | path: icons/duotune/art/art006.svg-->
            <span class="svg-icon svg-icon-2tx svg-icon-danger me-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                    <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor" />
                    <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor" />
                </svg>
            </span>
            <!--end::Svg Icon-->
            <!--end::Icon-->
            <!--begin::Wrapper-->
            <div class="d-flex flex-stack flex-grow-1">
                <!--begin::Content-->
                <div class="fw-bold">
                    <div class="fs-6 text-gray-700">{{ $dataPasien['error'] ?? 'Tidak ada hasil untuk sumber data pasien yang anda pilih' }}</div>
                </div>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Notice-->
        @endif
    </div>
    <!--end::List-->
    <!--end::Card body-->
</div>
