@extends('layouts.app')

@section('title')
Grup User
@endsection

@section('content')

<div class="card mb-5 pb-5">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                    </svg>
                </span>
                <input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Cari Grup" />
            </div>
            <!--end::Search-->
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-subscription-table-toolbar="base">
                <div class="d-flex" data-kt-user-table-toolbar="base">

                    <!--end::Add subscription-->
                    <button id="btn-tambah" type="button" class="btn btn-sm btn-primary" title="Tambah Grup">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
                            </svg>
                        </span>
                        Tambah Grup
                    </button>
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card toolbar-->
        </div>
        <!-- end::Card toolbar -->
        <!--end::Card header-->
    </div>
</div>
    <div class="card">
        <!--begin::Card body-->
        <div class="card-body pt-2">
            <!--begin::Datatable-->
            <table id="data-table" class="table align-middle table-row-dashed fs-6 gy-2">
                <thead class="h-40px">
                    <tr class="text-center fw-bolder fs-7 text-uppercase">
                        <th>No</th>
                        <th>Nama Grup</th>
                        <th>Grup Bagian</th>
                        <th>Bagian</th>
                        <th>Hak Akses</th>
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

    @include('contents.setting.grupuser.js')
    @include('contents.setting.grupuser.modal')
    @include('contents.setting.grupuser.modalHakAkses')
