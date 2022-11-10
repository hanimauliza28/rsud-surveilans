@extends('layouts.app')

@section('title')
Registrasi Antrian IGD
@endsection

@section('childTitle')
Registrasi Antrian IGD dengan No. Registrasi Pasien
@endsection

@section('content')

<div class="card mb-5 pb-5">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative">
                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                    </svg>
                </span>
                <input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Cari Antrian" />
            </div>
            <!--end::Search-->
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            @include('contents.form.registrasiAntrianIgd.filter')
        </div>
        <!-- end::Card toolbar -->
        <!--end::Card header-->
    </div>
</div>
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body pt-2">
            <!--begin::Datatable-->
            <table id="data-table" class="table align-middle table-row-dashed fs-6 gy-1 ">
                <thead>
                    <tr class="text-start fw-bolder fs-6 text-uppercase gs-0">
                        <th>No</th>
                        <th>No. Antri</th>
                        <th>Nama Pasien</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Jam Datang</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Emergency Time <br>(detik)</th>
                        <th>Lama Pelayanan <br>(detik)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600">
                </tbody>
            </table>
            <!--end::Datatable-->
        </div>
        <!--end::Card body-->
    </div>
    @endsection

    @include('contents.form.registrasiAntrianIgd.js')
    @include('contents.form.registrasiAntrianIgd.modal')
    @include('contents.form.registrasiAntrianIgd.modalWaktu')
