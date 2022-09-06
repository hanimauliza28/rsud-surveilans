<div class="card mb-5">
    <form id="data-pasien-form">
        <div class="card-body row">
            <input type="hidden" name="indikatorMutuNasion" value="indikatorMutuLokal">
            <div class="col-md-6 col-lg-6 col-sm-12">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1 w-100">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1  svg-icon-primary position-absolute ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z"
                                fill="currentColor" />
                            <rect opacity="0.3" x="8" y="3" width="8" height="8"
                                rx="4" fill="currentColor" />
                        </svg>
                    </span>
                    <input type="text" id="dataPasienNama" name="dataPasienNama" class="form-control form-control-solid w-100 ps-15"
                        placeholder="Nama Pasien" readonly/>
                </div>
                <!--end::Search-->

                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1 w-100 mt-2">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1  svg-icon-primary position-absolute ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M20 14H18V10H20C20.6 10 21 10.4 21 11V13C21 13.6 20.6 14 20 14ZM21 19V17C21 16.4 20.6 16 20 16H18V20H20C20.6 20 21 19.6 21 19ZM21 7V5C21 4.4 20.6 4 20 4H18V8H20C20.6 8 21 7.6 21 7Z"
                                fill="currentColor" />
                            <path opacity="0.3"
                                d="M17 22H3C2.4 22 2 21.6 2 21V3C2 2.4 2.4 2 3 2H17C17.6 2 18 2.4 18 3V21C18 21.6 17.6 22 17 22ZM10 7C8.9 7 8 7.9 8 9C8 10.1 8.9 11 10 11C11.1 11 12 10.1 12 9C12 7.9 11.1 7 10 7ZM13.3 16C14 16 14.5 15.3 14.3 14.7C13.7 13.2 12 12 10.1 12C8.10001 12 6.49999 13.1 5.89999 14.7C5.59999 15.3 6.19999 16 7.39999 16H13.3Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <input type="text" id="dataPasienNorm" name="dataPasienNorm" class="form-control form-control-solid w-100 ps-15"
                        placeholder="No. Rekam Medis" readonly/>
                </div>
                <!--end::Search-->
            </div>

            <div class="col-md-6 col-lg-6 col-sm-12">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1 w-100">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1  svg-icon-primary position-absolute ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path opacity="0.3"
                                d="M3 6C2.4 6 2 5.6 2 5V3C2 2.4 2.4 2 3 2H5C5.6 2 6 2.4 6 3C6 3.6 5.6 4 5 4H4V5C4 5.6 3.6 6 3 6ZM22 5V3C22 2.4 21.6 2 21 2H19C18.4 2 18 2.4 18 3C18 3.6 18.4 4 19 4H20V5C20 5.6 20.4 6 21 6C21.6 6 22 5.6 22 5ZM6 21C6 20.4 5.6 20 5 20H4V19C4 18.4 3.6 18 3 18C2.4 18 2 18.4 2 19V21C2 21.6 2.4 22 3 22H5C5.6 22 6 21.6 6 21ZM22 21V19C22 18.4 21.6 18 21 18C20.4 18 20 18.4 20 19V20H19C18.4 20 18 20.4 18 21C18 21.6 18.4 22 19 22H21C21.6 22 22 21.6 22 21Z"
                                fill="currentColor" />
                            <path
                                d="M3 16C2.4 16 2 15.6 2 15V9C2 8.4 2.4 8 3 8C3.6 8 4 8.4 4 9V15C4 15.6 3.6 16 3 16ZM13 15V9C13 8.4 12.6 8 12 8C11.4 8 11 8.4 11 9V15C11 15.6 11.4 16 12 16C12.6 16 13 15.6 13 15ZM17 15V9C17 8.4 16.6 8 16 8C15.4 8 15 8.4 15 9V15C15 15.6 15.4 16 16 16C16.6 16 17 15.6 17 15ZM9 15V9C9 8.4 8.6 8 8 8H7C6.4 8 6 8.4 6 9V15C6 15.6 6.4 16 7 16H8C8.6 16 9 15.6 9 15ZM22 15V9C22 8.4 21.6 8 21 8H20C19.4 8 19 8.4 19 9V15C19 15.6 19.4 16 20 16H21C21.6 16 22 15.6 22 15Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <input type="text" id="dataPasienNoreg" name="dataPasienNoreg" class="form-control form-control-solid w-100 ps-15"
                        placeholder="No. Registrasi" readonly/>
                </div>
                <!--end::Search-->

                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1 w-100 mt-2">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                    <span class="svg-icon svg-icon-1  svg-icon-primary position-absolute ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <path opacity="0.3" d="M18 10V20C18 20.6 18.4 21 19 21C19.6 21 20 20.6 20 20V10H18Z"
                                fill="currentColor" />
                            <path opacity="0.3"
                                d="M11 10V17H6V10H4V20C4 20.6 4.4 21 5 21H12C12.6 21 13 20.6 13 20V10H11Z"
                                fill="currentColor" />
                            <path opacity="0.3" d="M10 10C10 11.1 9.1 12 8 12C6.9 12 6 11.1 6 10H10Z"
                                fill="currentColor" />
                            <path opacity="0.3" d="M18 10C18 11.1 17.1 12 16 12C14.9 12 14 11.1 14 10H18Z"
                                fill="currentColor" />
                            <path opacity="0.3" d="M14 4H10V10H14V4Z" fill="currentColor" />
                            <path opacity="0.3" d="M17 4H20L22 10H18L17 4Z" fill="currentColor" />
                            <path opacity="0.3" d="M7 4H4L2 10H6L7 4Z" fill="currentColor" />
                            <path
                                d="M6 10C6 11.1 5.1 12 4 12C2.9 12 2 11.1 2 10H6ZM10 10C10 11.1 10.9 12 12 12C13.1 12 14 11.1 14 10H10ZM18 10C18 11.1 18.9 12 20 12C21.1 12 22 11.1 22 10H18ZM19 2H5C4.4 2 4 2.4 4 3V4H20V3C20 2.4 19.6 2 19 2ZM12 17C12 16.4 11.6 16 11 16H6C5.4 16 5 16.4 5 17C5 17.6 5.4 18 6 18H11C11.6 18 12 17.6 12 17Z"
                                fill="currentColor" />
                        </svg>
                    </span>
                    <input type="text" id="dataPasienBagian" name="dataPasienBagian" class="form-control form-control-solid w-100 ps-15"
                        placeholder="Poli/Ruang Periksa" readonly/>
                    <input type="hidden" id="dataPasienKdbagian" name="dataPasienKdbagian" class="form-control form-control-solid w-100 ps-15"
                        placeholder="Kode Bagian" />
                </div>
                <!--end::Search-->
            </div>
        </div>
    </form>
</div>
