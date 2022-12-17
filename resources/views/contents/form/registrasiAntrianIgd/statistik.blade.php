<div class="row">
    <div class="col-sm-6 row">
        {{-- Box --}}
        <div class="col-md-6">
            <!--begin::Statistics Widget 5-->
            <div href="#" class="card bg-warning mb-xl-8 row me-1">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                    <span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path opacity="0.3"
                                d="M12.025 4.725C9.725 2.425 6.025 2.425 3.725 4.725C1.425 7.025 1.425 10.725 3.725 13.025L11.325 20.625C11.725 21.025 12.325 21.025 12.725 20.625L20.325 13.025C22.625 10.725 22.625 7.025 20.325 4.725C18.025 2.425 14.325 2.425 12.025 4.725Z"
                                fill="currentColor" />
                            <path
                                d="M14.025 17.125H13.925C13.525 17.025 13.125 16.725 13.025 16.325L11.925 11.125L11.025 14.325C10.925 14.725 10.625 15.025 10.225 15.025C9.825 15.125 9.425 14.925 9.225 14.625L7.725 12.325L6.525 12.925C6.425 13.025 6.225 13.025 6.125 13.025H3.125C2.525 13.025 2.125 12.625 2.125 12.025C2.125 11.425 2.525 11.025 3.125 11.025H5.925L7.725 10.125C8.225 9.925 8.725 10.025 9.025 10.425L9.825 11.625L11.225 6.72498C11.325 6.32498 11.725 6.02502 12.225 6.02502C12.725 6.02502 13.025 6.32495 13.125 6.82495L14.525 13.025L15.225 11.525C15.425 11.225 15.725 10.925 16.125 10.925H21.125C21.725 10.925 22.125 11.325 22.125 11.925C22.125 12.525 21.725 12.925 21.125 12.925H16.725L15.025 16.325C14.725 16.925 14.425 17.125 14.025 17.125Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5"><?= gmdate('H:i:s', round($jumlahrata->ert)) ?>
                    </div>
                    <div class="fw-bold text-gray-100">Rata-rata</div>
                </div>
                <!--end::Body-->
                <div class="card-footer bg-light-warning py-3">
                    <div class="fw-bold text-gray-800">Emergency Respon Time (Detik)</div>
                </div>
            </div>
            <!--end::Statistics Widget 5-->
        </div>

        <div class="col-md-6">
            <!--begin::Statistics Widget 5-->
            <div href="#" class="card bg-warning mb-xl-8 row me-1">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                    <span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path opacity="0.3"
                                d="M20.9 12.9C20.3 12.9 19.9 12.5 19.9 11.9C19.9 11.3 20.3 10.9 20.9 10.9H21.8C21.3 6.2 17.6 2.4 12.9 2V2.9C12.9 3.5 12.5 3.9 11.9 3.9C11.3 3.9 10.9 3.5 10.9 2.9V2C6.19999 2.5 2.4 6.2 2 10.9H2.89999C3.49999 10.9 3.89999 11.3 3.89999 11.9C3.89999 12.5 3.49999 12.9 2.89999 12.9H2C2.5 17.6 6.19999 21.4 10.9 21.8V20.9C10.9 20.3 11.3 19.9 11.9 19.9C12.5 19.9 12.9 20.3 12.9 20.9V21.8C17.6 21.3 21.4 17.6 21.8 12.9H20.9Z"
                                fill="currentColor" />
                            <path
                                d="M16.9 10.9H13.6C13.4 10.6 13.2 10.4 12.9 10.2V5.90002C12.9 5.30002 12.5 4.90002 11.9 4.90002C11.3 4.90002 10.9 5.30002 10.9 5.90002V10.2C10.6 10.4 10.4 10.6 10.2 10.9H9.89999C9.29999 10.9 8.89999 11.3 8.89999 11.9C8.89999 12.5 9.29999 12.9 9.89999 12.9H10.2C10.4 13.2 10.6 13.4 10.9 13.6V13.9C10.9 14.5 11.3 14.9 11.9 14.9C12.5 14.9 12.9 14.5 12.9 13.9V13.6C13.2 13.4 13.4 13.2 13.6 12.9H16.9C17.5 12.9 17.9 12.5 17.9 11.9C17.9 11.3 17.5 10.9 16.9 10.9Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">
                        <?= gmdate('H:i:s', round($jumlahrata->lamapelayanan)) ?>
                    </div>
                    <div class="fw-bold text-gray-100">Rata-rata</div>
                </div>
                <!--end::Body-->
                <div class="card-footer bg-light-warning py-3">
                    <div class="fw-bold text-gray-800">Total Waktu Pelayanan
                        <?= round($jumlahrata->totallamapelayanan) ?></div>
                </div>
            </div>
            <!--end::Statistics Widget 5-->
        </div>

        <div class="col-md-4 col-sm-6">
            <!--begin::Statistics Widget 5-->
            <div href="#" class="card bg-primary mb-xl-8 row me-1">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                    <span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path opacity="0.3"
                                d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z"
                                fill="currentColor" />
                            <path
                                d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5"><?= round($jumlahrata->jumlahpasien) ?></div>
                    <div class="fw-bold text-gray-100">Jumlah Antrian</div>
                </div>
                <!--end::Body-->
            </div>
            <!--end::Statistics Widget 5-->
        </div>

        <div class="col-md-4 col-sm-6">
            <!--begin::Statistics Widget 5-->
            <div href="#" class="card bg-primary mb-xl-8 row me-1">
                <!--begin::Body-->
                <div class="card-body d-flex px-5">

                    <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr066.svg-->
                    <span class="svg-icon svg-icon-light svg-icon-2 me-3"><svg xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="13" y="6" width="13" height="2"
                                rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                            <path
                                d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                fill="currentColor" />
                        </svg></span>
                    <!--end::Svg Icon-->
                    <div class="">
                        <div class="text-gray-100 fw-bolder fs-6"><?= gmdate('H:i:s', $jumlahrata->ertmax) ?></div>
                        <div class="fw-bold fs-8 text-gray-100">Max. ERT</div>
                    </div>
                </div>
                <!--end::Body-->

                <div class="card-footer bg-light-primary py-5 d-flex px-5">
                    <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr066.svg-->
                    <span class="svg-icon svg-icon-dark svg-icon-2 me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <rect opacity="0.5" x="11" y="18" width="13" height="2"
                                rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
                            <path
                                d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <div class="">
                        <div class="text-gray-800 fw-bolder fs-6"><?= gmdate('H:i:s', $jumlahrata->ertmin) ?></div>
                        <div class="fw-bold  fs-8 text-gray-800">Min. ERT</div>
                    </div>
                </div>
            </div>
            <!--end::Statistics Widget 5-->
        </div>

        <div class="col-md-4 col-sm-6">
            <!--begin::Statistics Widget 5-->
            <div href="#" class="card bg-primary mb-xl-8 row me-1">
                <!--begin::Body-->
                <div class="card-body d-flex px-5">

                    <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr066.svg-->
                    <span class="svg-icon svg-icon-light svg-icon-2 me-3"><svg xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="13" y="6" width="13" height="2"
                                rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                            <path
                                d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                fill="currentColor" />
                        </svg></span>
                    <!--end::Svg Icon-->
                    <div class="">
                        <div class="text-gray-100 fw-bolder fs-6"><?= gmdate('H:i:s', $jumlahrata->lamapelayananmax) ?>
                        </div>
                        <div class="fw-bold fs-8 text-gray-100">Max. Pelayanan</div>
                    </div>
                </div>
                <!--end::Body-->

                <div class="card-footer bg-light-primary py-5 d-flex px-5">
                    <!--begin::Svg Icon | path: assets/media/icons/duotune/arrows/arr066.svg-->
                    <span class="svg-icon svg-icon-dark svg-icon-2 me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <rect opacity="0.5" x="11" y="18" width="13" height="2"
                                rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
                            <path
                                d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <div class="">
                        <div class="text-gray-800 fw-bolder fs-6"><?= gmdate('H:i:s', $jumlahrata->lamapelayananmin) ?>
                        </div>
                        <div class="fw-bold fs-8 text-gray-800">Min. Pelayanan</div>
                    </div>

                </div>
            </div>
            <!--end::Statistics Widget 5-->
        </div>


        <div class="col-12">
            <div class="card card-flush h-xl-100">
                <!--begin::Heading-->
                <div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-100px"
                    style="background-image:url('assets/media/svg/shapes/top-green.png')">
                    <!--begin::Title-->
                    <h3 class="card-title align-items-start flex-column text-white pt-7">
                        <span class="fw-bolder fs-1 mb-3">Triage IGD</span>
                        <span class="fw-bolder fs-3"></span>
                    </h3>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
                <!--begin::Body-->
                <div class="card-body mt-n25">
                    <!--begin::Stats-->
                    <div class="mt-n20 position-relative">
                        <!--begin::Row-->
                        <div class="row g-3 g-lg-6">
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="bg-light-danger bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span
                                            class="text-danger fw-boldest d-block fs-1 lh-1 ls-n1 mb-4">{{ $triage['R'] ?? '0' }}</span>
                                        <!--end::Number-->
                                        <!--begin::Desc-->
                                        <span class="text-danger fw-bold fs-6">(I) Gawat Darurat</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="bg-light-warning bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span
                                            class="text-warning fw-boldest d-block fs-1 lh-1 ls-n1 mb-4">{{ $triage['Y'] ?? '0' }}</span>
                                        <!--end::Number-->
                                        <!--begin::Desc-->
                                        <span class="text-warning fw-bold fs-6">(II) Gawat Tidak Darurat</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="bg-light-primary bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span
                                            class="text-primary fw-boldest d-block fs-1 lh-1 ls-n1 mb-4">{{ $triage['G'] ?? '0' }}</span>
                                        <!--end::Number-->
                                        <!--begin::Desc-->
                                        <span class="text-primary fw-bold fs-6">(III) Darurat Tidak Gawat</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-6">
                                <!--begin::Items-->
                                <div class="bg-light-dark bg-opacity-70 rounded-2 px-6 py-5">
                                    <!--begin::Stats-->
                                    <div class="m-0">
                                        <!--begin::Number-->
                                        <span
                                            class="text-dark fw-boldest d-block fs-1 lh-1 ls-n1 mb-4">{{ $triage['B'] ?? '0' }}</span>
                                        <!--end::Number-->
                                        <!--begin::Desc-->
                                        <span class="text-dark fw-bold fs-8">(IV) Tidak Gawat Tidak Darurat</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Items-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Body-->
            </div>
        </div>


        <div class="alert m-0 border border-danger mb-5 mr-15">
            <span class="fw-bold">Catatan : </span>
            <ul class="">
                <li>Antrian IGD dihitung dari antrian yang sudah di masukkan Nomor Registrasi pasiennya.</li>
            </ul>
        </div>


    </div>

    <div class="col-sm-6 top">

        {{-- Chart --}}
        <div class="col-12">
            <canvas id="chartAntrianIgd" class="mh-300px"></canvas>
        </div>
        <hr class="text-grey-100 fw-normal">
        <div class="col-md-12 row mx-10 mt-10 top">
            <div class="col-md-4 col-sm-6">
                <!--begin::Statistics Widget 5-->
                <div href="#" class="card bg-light-primary mb-xl-8 row me-1">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                        <span class="svg-icon svg-icon-gray-800 svg-icon-3x ms-n1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3"
                                    d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z"
                                    fill="currentColor" />
                                <path
                                    d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <div class="text-gray-800 fw-bolder fs-2 mb-2 mt-5"><?= round($jumlahPasienIgd->igd) ?></div>
                        <div class="fw-bold text-gray-800">Jumlah Pasien</div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Statistics Widget 5-->
            </div>

            <div class="col-md-4 col-sm-6">
                <!--begin::Statistics Widget 5-->
                <div href="#" class="card bg-primary row me-1">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                        <span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3"
                                    d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z"
                                    fill="currentColor" />
                                <path
                                    d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5"><?= round($jumlahPasienIgd->igdrajal) ?>
                        </div>
                        <div class="fw-bold text-gray-100">IGD Rawat Jalan</div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Statistics Widget 5-->
            </div>

            <div class="col-md-4 col-sm-6">
                <!--begin::Statistics Widget 5-->
                <div href="#" class="card bg-warning mb-xl-8 row me-1">
                    <!--begin::Body-->
                    <div class="card-body">
                        <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                        <span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3"
                                    d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z"
                                    fill="currentColor" />
                                <path
                                    d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                        <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5"><?= round($jumlahPasienIgd->igdranap) ?>
                        </div>
                        <div class="fw-bold text-gray-100">IGD Rawat Inap</div>
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Statistics Widget 5-->
            </div>
        </div>

    </div>
</div>


<script>
    var barChartData = {
        labels: [
            "Jenis Pasien IGD",
        ],

        datasets: [{
                label: "Rawat Jalan",
                backgroundColor: "#E8FFF3",
                borderColor: "#34AA58",
                borderWidth: 1,
                //data: [3, 5]
                data: [{{ $jumlahPasienIgd->igdrajal }}]
            },
            {
                label: "Rawat Inap",
                backgroundColor: "#FFF8DD",
                borderColor: "#FFC700",
                borderWidth: 1,
                data: [{{ $jumlahPasienIgd->igdranap }}]
            },
        ]
    };

    var chartOptions = {
        responsive: true,
        legend: {
            position: "top"
        },
        title: {
            display: true,
            text: "Chart.js Bar Chart"
        },
        scales: {}
    }

    var ctx = document.getElementById("chartAntrianIgd").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: "bar",
        data: barChartData,
        options: chartOptions
    });
</script>
