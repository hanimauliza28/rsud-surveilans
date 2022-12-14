@extends('layouts.app')

@section('title')
Setting Menu
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
                <input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Cari Menu" />
            </div>
            <!--end::Search-->
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-subscription-table-toolbar="base">
                <div class="d-flex" data-kt-user-table-toolbar="base">


                <!--begin::Menu-->
                <button type="button" class="btn btn-color-primary btn-active-light-primary me-3"
                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="5" y="5" width="5" height="5" rx="1"
                                    fill="currentColor" />
                                <rect x="14" y="5" width="5" height="5" rx="1"
                                    fill="currentColor" opacity="0.3" />
                                <rect x="5" y="14" width="5" height="5" rx="1"
                                    fill="currentColor" opacity="0.3" />
                                <rect x="14" y="14" width="5" height="5" rx="1"
                                    fill="currentColor" opacity="0.3" />
                            </g>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    Filter
                </button>
                {{-- end::Menu --}}
                <!--begin::Menu 1-->
                <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                    id="kt_menu_62445deeea475">
                    <!--begin::Header-->
                    <div class="px-7 py-5">
                        <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Menu separator-->
                    <div class="separator border-gray-200"></div>
                    <!--end::Menu separator-->
                    <!--begin::Form-->
                    <div class="px-7 py-5">
                        <!--begin::Input group-->
                        <div class="mb-4">
                            <!--begin::Label-->
                            <label class="form-label fw-bold">Jenis Menu :</label>
                            <!--end::Label-->
                            <!--begin::Options-->
                            <!--begin::Input wrapper-->
                            <div class="position-relative d-flex w-100 fs-6">

                                <select class="form-select form-select-solid w-100" name="filterJenisMenu"
                                    id="filterJenisMenu">
                                    <option></option>
                                    @foreach ($jenisMenu as $jenismenu)
                                        <option value="{{ $jenismenu->value }}">
                                            {{ $jenismenu->text }}</option>
                                    @endforeach

                                </select>

                            </div>
                            <!--end::Input wrapper-->
                            <!--end::Options-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-6">
                            <!--begin::Label-->
                            <label class="form-label fw-bold">Grup Section :</label>
                            <!--end::Label-->
                            <!--begin::Switch-->
                            <!--begin::Input wrapper-->
                            <div class="position-relative d-flex w-100 fs-6">

                                <select class="form-select form-select-solid" name="filterSection"
                                    id="filterSection">
                                    <option></option>
                                    @foreach ($sectionMenu as $section)
                                        <option value="{{ $section->id }}">
                                            {{ $section->nama_menu}}</option>
                                    @endforeach

                                </select>

                            </div>
                            <!--end::Input wrapper-->
                            <!--end::Switch-->
                        </div>
                        <!--end::Input group-->

                    </div>
                    <!--end::Form-->
                </div>
                <!--end::Menu 1-->

                <!--begin::Filter-->
                <button type="button" onclick="cariData()" class="btn btn-light-primary me-3">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                    <span class="svg-icon svg-icon-2 svg-icon-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->Cari
                </button>
                <!--end::Filter-->


                    <!--end::Add subscription-->
                    <button id="btn-tambah" type="button" class="btn btn-sm btn-primary" title="Tambah Menu">
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
                            </svg>
                        </span>
                        Tambah Menu
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
                        <th>Nama Menu</th>
                        <th>Status</th>
                        <th>Urut</th>
                        <th>URL</th>
                        <th>Icon</th>
                        <th>Parent</th>
                        <th>Section</th>
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

    @include('contents.setting.menu.js')
    @include('contents.setting.menu.modal')
