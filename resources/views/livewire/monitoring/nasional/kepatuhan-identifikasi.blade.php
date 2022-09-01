<div>
    <!--begin::Card-->
    <div class="card pt-1">

        <form id="kepatuhan-identifikasi-form">
            <input type="hidden" name="indikatorMutuId" id="indikatorMutuId" value="{{ $indikatorMutu->id }}">
            <div class="card-body">
                <!--begin::Table-->
                <table class="table table-hover table-row-dashed fs-6">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bolder text-gray-400 border-bottom-0">
                            <th class="p-0 pb-3 max-w-175px text-center">
                                <a class="text-success fs-7" onclick="checkAll()">Check</a>
                            </th>
                            <th class="p-0 pb-3 min-w-100px text-center">Kategori Identifikasi</th>
                            <th>Check All</th>
                            <th class="p-0 pb-3 max-w-175px text-center">Nama</th>
                            <th class="p-0 pb-3 max-w-175px text-center">Tgl. Lahir</th>
                            <th class="p-0 pb-3 max-w-175px text-center">NIK</th>
                            <th class="p-0 pb-3 max-w-175px text-center">NORM</th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @foreach ($kategoriVariabelSurvey->variabelSurvey as $variabel)
                            <tr>
                                <td>
                                    <!--begin::Checkbox-->
                                    <div class="form-check form-check-sm form-check-custom form-check-solid m-center">
                                        <input class="form-check-input checkIndikator ms-6"
                                            name="identifikasi{{ $variabel->id }}" type="checkbox" value="1" />
                                    </div>
                                    <!--end::Checkbox-->
                                </td>
                                <td>{{ $variabel->nama }}</td>
                                <td><a class="text-success fs-7" onclick="checkAllItem({{ $variabel->id }})">Check
                                        All</a></td>
                                <td class="text-center">
                                    <!--begin::Checkbox-->
                                    <div
                                        class="form-check form-check-sm form-check-custom form-check-solid text-center">
                                        <input class="form-check-input text-center nama{{ $variabel->id }}"
                                            name="nama{{ $variabel->id }}" type="checkbox" value="1" />
                                    </div>
                                    <!--end::Checkbox-->
                                </td>
                                <td class="text-center align-items-center">
                                    <div
                                        class="form-check form-check-sm form-check-custom form-check-solid text-center">
                                        <input class="form-check-input text-center tglLahir{{ $variabel->id }}"
                                            name="tglLahir{{ $variabel->id }}" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div
                                        class="form-check form-check-sm form-check-custom form-check-solid text-center">
                                        <input class="form-check-input text-center nik{{ $variabel->id }}"
                                            name="nik{{ $variabel->id }}" type="checkbox" value="1" />
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div
                                        class="form-check form-check-sm form-check-custom form-check-solid text-center">
                                        <input class="form-check-input text-center norm{{ $variabel->id }}"
                                            name="norm{{ $variabel->id }}" type="checkbox" value="1" />
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="fw-bolder text-gray-400 border-bottom-0 pt-4">
                            <th class="p-0 pb-3 max-w-175px text-center">
                                <a class="text-success fs-7" onclick="uncheckAll()">Uncheck</a>
                            </th>
                            <th colspan="7"></th>
                        </tr>
                    </tfoot>
                    <!--end::Table body-->
                </table>
                <!--end::Table-->

            </div>

        </form>
        <div class="card-footer text-end mt-1 pt-4">
            <button id="btn-simpan-kepatuhan-identifikasi" class="btn btn-primary" onclick="simpanKI()">
                <span id="btn-simpan-text" class="indicator-label">
                    <i class="fas fa-save"></i>
                    Simpan
                </span>
                <span class="indicator-progress">
                    <i class="fas fa-save"></i>
                    Mohon Menunggu... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
            <button id="btn-reset" onclick="resetKI()" class="btn btn-danger"><i class="fas fa-save"></i>
                Reset
            </button>
        </div>

    </div>
    <!--end::Card-->

</div>

<!-- Your component's view here -->

@push('scripts')
    @include('contents.monitoring.monitoringPasien.js.jsKepatuhanIndentifikasi')
@endpush
