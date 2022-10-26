@extends('layouts.app')

@section('title')
    Anthropometric
@endsection

@section('parentTitle')
    Survey Anthropometric Pasien
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-4">
            <div class="card mb-5">
                <!--begin::Card header-->
                <div class="card-header border-0 mt-3">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder text-dark">Filter Data Pasien</span>
                        <span class="text-muted mt-1 fw-bold fs-7">List Pasien yang Akan di Survey</span>
                    </h3>
                    <div class="card-toolbar">
                        <!--begin::Menu-->
                        <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary"
                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z"
                                        fill="currentColor" />
                                    <path opacity="0.3"
                                        d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </button>
                        <!--end::Menu-->
                    </div>
                </div>
                <!--end::Card header-->

                <div class="card-body mt-1 pt-1">
                    <div class="align-items-center position-relative form-group w-100 mt-3">
                        <!--begin::Input-->
                        <select name="filterBagian" id="filterBagian" class="form-select form-select-solid fw-bolder">
                            <option val=""></option>
                            @foreach ($bagian as $bagian)
                                <option value="{{ $bagian->KDBAGIAN }}">{{ $bagian->NAMABAGIAN }}</option>
                            @endforeach
                        </select>
                        <!--end::Input-->
                    </div>

                    <!--begin::Toolbar-->
                    <div class="d-flex mb-1 mt-3">
                        {{-- begin::Date range picker --}}
                        <div class="position-relative d-flex align-items-center w-100">
                            <!--begin::Icon-->
                            <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                            <span class="svg-icon svg-icon-1  svg-icon-primary position-absolute ms-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2"
                                        rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                    <path
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <!--end::Icon-->
                            <!--begin::Datepicker-->
                            <input class="form-control form-control-solid ps-12" placeholder="Cari Nama atau NORM Pasien"
                                name="filterKeyword" id="filterKeyword" />
                            <!--end::Datepicker-->
                        </div>
                        {{-- end::date range picker --}}
                    </div>

                    <span class="text-gray-500 fs-9">* Memilih Bagian Akan Menampilkan Pasien Dalam Perawatan</span>
                    <div class="d-flex mt-3 align-items-end">

                        <!--begin::Filter-->
                        <button type="button" onclick="cariData()" class="btn btn-sm btn-primary me-3">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                            <span class="svg-icon svg-icon-2">
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

                    </div>
                    <!--end::Toolbar-->
                </div>
            </div>
            <div class="card">

                <!--begin::Card body-->
                <div class="card-body">
                    @livewire('monitoring.anthropometric.filter-data-pasien', ['filterCari' => ''])
                </div>
                <!--end::Card body-->
            </div>
        </div>
        <div class="col-sm-8">
            <div class="card">
                @livewire('monitoring.anthropometric.form', ['pasienNorm' => ''])
            </div>
        </div>
    </div>
@endsection

@include('contents.monitoring.anthropometric.js')
