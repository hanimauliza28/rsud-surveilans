@extends('contents.monitoring.monitoringPasienIgd.tampilanIgd')

@section('content-main')
    <div class="card mt-3">
        <div class="card-body">
            <!--begin::Notice-->
            <div class="notice d-flex bg-light-danger rounded border-danger border border-dashed mb-9 p-6">
                <!--begin::Icon-->
                <!--begin::Svg Icon | path: icons/duotune/art/art006.svg-->
                <span class="svg-icon svg-icon-2tx svg-icon-danger me-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.3"
                            d="M22 19V17C22 16.4 21.6 16 21 16H8V3C8 2.4 7.6 2 7 2H5C4.4 2 4 2.4 4 3V19C4 19.6 4.4 20 5 20H21C21.6 20 22 19.6 22 19Z"
                            fill="currentColor" />
                        <path
                            d="M20 5V21C20 21.6 19.6 22 19 22H17C16.4 22 16 21.6 16 21V8H8V4H19C19.6 4 20 4.4 20 5ZM3 8H4V4H3C2.4 4 2 4.4 2 5V7C2 7.6 2.4 8 3 8Z"
                            fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->
                <!--end::Icon-->
                <!--begin::Wrapper-->
                <div class="d-flex flex-stack flex-grow-1">
                    <!--begin::Content-->
                    <div class="fw-bold">
                        <div class="fs-6 text-gray-700">Pilih Nama Pasien dan Indikator Mutu yang Akan di Isi</div>
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Notice-->
        </div>
    </div>
@endsection

@include('contents.monitoring.monitoringPasienIgd.js')
@include('contents.monitoring.jsMonitoring')
@include('contents.monitoring.monitoringPasien.js.jsKepatuhanIndentifikasi')
@include('contents.monitoring.monitoringPasien.js.jsEmergencyResponTime')