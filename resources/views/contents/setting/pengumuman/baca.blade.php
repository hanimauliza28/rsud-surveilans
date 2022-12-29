@extends('layouts.app')

@section('title')
    {{ $pengumuman->judul }}
@endsection


@section('childTitle')
    Info Aplikasi Surveilans
@endsection

@section('content')
    <!--begin::Feeds Widget 2-->
    <div class="card mb-5 mb-xxl-8">
        <!--begin::Body-->
        <div class="card-body pb-0">
            <!--begin::Header-->
            <div class="d-flex align-items-center mb-5">
                <!--begin::User-->
                <div class="d-flex align-items-center flex-grow-1">
                    <!--begin::Avatar-->
                    <div class="symbol symbol-45px me-5">
                        <img src="{{ asset('assets/media/icons/customerservice/4406 - Global Information.png') }}" alt="" />
                    </div>
                    <!--end::Avatar-->
                    <!--begin::Info-->
                    <div class="d-flex flex-column">
                        <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bolder">{{ $pengumuman->judul }}</a>
                        <span class="text-gray-400 fw-bold">Created at {{ $pengumuman->created_at }}</span>
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::User-->

            </div>
            <!--end::Header-->
            <!--begin::Post-->
            <div class="mb-7 ms-19">
                <!--begin::Text-->
                <p class="text-gray-800 fw-normal mb-5">{!! $pengumuman->isi !!}</p>
                <!--end::Text-->
                <!--begin::Toolbar-->
                <div class="d-flex align-items-center mb-5">
                    <a href="#" class="btn btn-sm btn-color-muted btn-active-light-success px-4 py-2 me-4">
                        <!--begin::Svg Icon | path: icons/duotune/communication/com012.svg-->
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path opacity="0.3"
                                    d="M20 3H4C2.89543 3 2 3.89543 2 5V16C2 17.1046 2.89543 18 4 18H4.5C5.05228 18 5.5 18.4477 5.5 19V21.5052C5.5 22.1441 6.21212 22.5253 6.74376 22.1708L11.4885 19.0077C12.4741 18.3506 13.6321 18 14.8167 18H20C21.1046 18 22 17.1046 22 16V5C22 3.89543 21.1046 3 20 3Z"
                                    fill="currentColor" />
                                <rect x="6" y="12" width="7" height="2" rx="1"
                                    fill="currentColor" />
                                <rect x="6" y="7" width="12" height="2" rx="1"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->Updated at {{ $pengumuman->updated_at }}
                    </a>

                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Post-->
            <!--edit::Reply input-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Feeds Widget 2-->
@endsection
