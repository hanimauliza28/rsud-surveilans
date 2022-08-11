@extends('contents.monitoring.monitoringPasien.index')

@push('extraCss')
    <style>
        .nav-item {
            margin-top : 10px;
        }
    </style>
@endpush

@section('content-main')
<div class="card">
    <!--begin::Card head-->
    <div class="card-header card-header-stretch">

        <!--begin::Toolbar-->
        <div class="card-toolbar mt-2">
            <!--begin::Tab nav-->
            <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bolder" role="tablist">
                <li class="nav-item" role="presentation">
                    <a id="pemberian_obat_tab" class="nav-link justify-content-center text-active-gray-800 active" data-bs-toggle="tab" role="tab" href="#pemberian_obat">Pemberian Obat</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a id="pengobatan_tab" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#pengobatan">Pemberian Pengobatan Nutrisi</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a id="pemberian_darah_tab" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#pemberian_darah">Pemberian Darah dan Produk Darah</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a id="pengambilan_spesimen_tab" class="nav-link justify-content-center text-active-gray-800 text-hover-gray-800" data-bs-toggle="tab" role="tab" href="#pengambilan_spesimen">Pengambilan Spesimen</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a id="tindakan_tab" class="nav-link justify-content-center text-active-gray-800 text-hover-gray-800" data-bs-toggle="tab" role="tab" href="#tindakan">Tindakan Diagnostik Lainnya</a>
                </li>
            </ul>
            <!--end::Tab nav-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Card head-->

    <div class="card-body">

    </div>
</div>
@endsection
