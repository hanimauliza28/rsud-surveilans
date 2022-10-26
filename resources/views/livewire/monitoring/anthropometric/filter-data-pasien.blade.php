<div>
    @if (isset($data))
        <!--begin::Notice-->
        <div class="notice d-flex bg-light-danger rounded border-danger border border-dashed mb-9 p-6">
            <!--begin::Svg Icon | path: icons/duotune/art/art006.svg-->
            <span class="svg-icon svg-icon-2tx svg-icon-danger me-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path
                        d="M21.7 18.9L18.6 15.8C17.9 16.9 16.9 17.9 15.8 18.6L18.9 21.7C19.3 22.1 19.9 22.1 20.3 21.7L21.7 20.3C22.1 19.9 22.1 19.3 21.7 18.9Z"
                        fill="currentColor" />
                    <path opacity="0.3"
                        d="M11 20C6 20 2 16 2 11C2 6 6 2 11 2C16 2 20 6 20 11C20 16 16 20 11 20ZM11 4C7.1 4 4 7.1 4 11C4 14.9 7.1 18 11 18C14.9 18 18 14.9 18 11C18 7.1 14.9 4 11 4ZM8 11C8 9.3 9.3 8 11 8C11.6 8 12 7.6 12 7C12 6.4 11.6 6 11 6C8.2 6 6 8.2 6 11C6 11.6 6.4 12 7 12C7.6 12 8 11.6 8 11Z"
                        fill="currentColor" />
                </svg>
            </span>
            <!--end::Svg Icon-->

            <!--begin::Wrapper-->
            <div class="d-flex flex-stack flex-grow-1">
                <!--begin::Content-->
                <div class="fw-bold">
                    <div class="fs-6 text-gray-700">Cari Data Pasien dengan NORM atau Nama Pasien</div>
                </div>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Notice-->
    @else
        <!--begin::List-->
        <div class="scroll-y me-n5 pe-5 h-300px" data-kt-scroll="true"
            data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto"
            data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_chat_contacts_header"
            data-kt-scroll-wrappers="#kt_content, #kt_chat_contacts_body" data-kt-scroll-offset="5px">

            @if ($pasien != '')
                @foreach ($pasien as $pasien)
                    <!--begin::User-->
                    <div class="d-flex flex-stack py-4">
                        <!--begin::Details-->
                        <div class="d-flex align-items-center">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-45px symbol-circle">
                                <span
                                    class="symbol-label bg-light-primary text-primary fs-6 fw-bolder">{{ substr($pasien->NMPASIEN, 0, 1) }}</span>
                            </div>
                            <!--end::Avatar-->
                            <!--begin::Details-->
                            <div class="ms-5">
                                <div onclick="openNorm('{{ $pasien->NORMPAS }}')"
                                    class="fs-5 fw-bolder text-gray-900 text-hover-primary mb-2">{{ $pasien->NMPASIEN }}
                                </div>
                                <div class="fw-bold text-muted">
                                    {{ isset($pasien->NAMABAGIAN) ? $pasien->NOREGRS : $pasien->ALAMATPAS }}</div>
                            </div>
                            <!--end::Details-->
                        </div>
                        <!--end::Details-->
                        <!--begin::Lat seen-->
                        <div class="d-flex flex-column align-items-end ms-2">
                            <span class="text-muted fs-7 mb-1">{{ $pasien->NORMPAS }}</span>
                            <span
                                class="text-muted fs-7 mb-1">{{ isset($pasien->NAMABAGIAN) ? $pasien->NAMABAGIAN : '-' }}</span>
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
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20"
                                rx="10" fill="currentColor" />
                            <rect x="11" y="14" width="7" height="2" rx="1"
                                transform="rotate(-90 11 14)" fill="currentColor" />
                            <rect x="11" y="17" width="2" height="2" rx="1"
                                transform="rotate(-90 11 17)" fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <!--end::Icon-->
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-grow-1">
                        <!--begin::Content-->
                        <div class="fw-bold">
                            <div class="fs-6 text-gray-700">
                                {{ $pasien['error'] ?? 'Tidak ada hasil untuk sumber data pasien yang anda pilih' }}
                            </div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Notice-->
            @endif
        </div>
        <!--end::List-->
    @endif
</div>
