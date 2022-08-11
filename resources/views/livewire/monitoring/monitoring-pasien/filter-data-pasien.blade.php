<div>


    <!--begin::Card body-->
    <!--begin::List-->
    <div class="scroll-y me-n5 pe-5 h-200px h-lg-auto" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_chat_contacts_header" data-kt-scroll-wrappers="#kt_content, #kt_chat_contacts_body" data-kt-scroll-offset="5px">
        @foreach($dataPasien as $pasien)

        <!--begin::User-->
        <div class="d-flex flex-stack py-4">
            <!--begin::Details-->
            <div class="d-flex align-items-center">
                <!--begin::Avatar-->
                <div class="symbol symbol-45px symbol-circle">
                    <span class="symbol-label bg-light-primary text-primary fs-6 fw-bolder">{{ substr($pasien->namaPasien, 0, 1) }}</span>
                </div>
                <!--end::Avatar-->
                <!--begin::Details-->
                <div class="ms-5">
                    <div onclick="survey({{ $pasien->noReg }})" class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">{{ $pasien->namaPasien }}</div>
                    <div class="fw-bold text-muted">{{ $pasien->noReg }}</div>
                </div>
                <!--end::Details-->
            </div>
            <!--end::Details-->
            <!--begin::Lat seen-->
            <div class="d-flex flex-column align-items-end ms-2">
                <span class="text-muted fs-7 mb-1">{{ $pasien->norm }}</span>
            </div>
            <!--end::Lat seen-->
        </div>
        <!--end::User-->
        <!--begin::Separator-->
        <div class="separator separator-dashed d-none"></div>
        <!--end::Separator-->
        @endforeach
    </div>
    <!--end::List-->
    <!--end::Card body-->
</div>
