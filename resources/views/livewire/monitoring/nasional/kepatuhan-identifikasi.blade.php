<div>
    <!--begin::Card-->
    <div class="card pt-1">

        <form id="kepatuhan-identifikasi-form">
            <input type="hidden" name="indikatorMutuId" id="indikatorMutuId" value="{{ $indikatorMutu->id }}">
            <input type="hidden" name="hasilSurveyId" id="hasilSurveyId" value="{{ $hasilSurvey->id ?? 0 }}">
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
                                        @if ($detailHasilSurvey)
                                            @if ($detailHasilSurvey->where('sub_variabel', 'identifikasi')->where('variabel_survey_id', $variabel->id)->count() > 0)
                                                <input class="form-check-input checkIndikator ms-6"
                                                    name="identifikasi{{ $variabel->id }}" type="checkbox"
                                                    value="1" checked="checked" />
                                            @else
                                                <input class="form-check-input checkIndikator ms-6"
                                                    name="identifikasi{{ $variabel->id }}" type="checkbox"
                                                    value="1" />
                                            @endif
                                        @else
                                            <input class="form-check-input checkIndikator ms-6"
                                                name="identifikasi{{ $variabel->id }}" type="checkbox" value="1" />
                                        @endif


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
                                        @if ($detailHasilSurvey)
                                            @if ($detailHasilSurvey->where('sub_variabel', 'nama')->where('variabel_survey_id', $variabel->id)->count() > 0)
                                                <input class="form-check-input text-center nama{{ $variabel->id }}"
                                            name="nama{{ $variabel->id }}" type="checkbox" value="1" checked="checked"/>

                                            @else
                                            <input class="form-check-input text-center nama{{ $variabel->id }}"
                                            name="nama{{ $variabel->id }}" type="checkbox" value="1" />
                                            @endif

                                        @else
                                            <input class="form-check-input text-center nama{{ $variabel->id }}"
                                                name="nama{{ $variabel->id }}" type="checkbox" value="1" />
                                        @endif

                                    </div>

                                    <!--end::Checkbox-->
                                </td>
                                <td class="text-center align-items-center">
                                    <div
                                        class="form-check form-check-sm form-check-custom form-check-solid text-center">
                                        @if ($detailHasilSurvey)
                                            @if ($detailHasilSurvey->where('sub_variabel', 'tglLahir')->where('variabel_survey_id', $variabel->id)->count() > 0)
                                                <input class="form-check-input text-center tglLahir{{ $variabel->id }}"
                                            name="tglLahir{{ $variabel->id }}" type="checkbox" value="1" checked="checked"/>

                                            @else
                                            <input class="form-check-input text-center tglLahir{{ $variabel->id }}"
                                            name="tglLahir{{ $variabel->id }}" type="checkbox" value="1" />
                                            @endif

                                        @else
                                            <input class="form-check-input text-center tglLahir{{ $variabel->id }}"
                                                name="tglLahir{{ $variabel->id }}" type="checkbox" value="1" />
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div
                                        class="form-check form-check-sm form-check-custom form-check-solid text-center">
                                        @if ($detailHasilSurvey)
                                            @if ($detailHasilSurvey->where('sub_variabel', 'nik')->where('variabel_survey_id', $variabel->id)->count() > 0)
                                                <input class="form-check-input text-center nik{{ $variabel->id }}"
                                            name="nik{{ $variabel->id }}" type="checkbox" value="1" checked="checked"/>

                                            @else
                                            <input class="form-check-input text-center nik{{ $variabel->id }}"
                                            name="nik{{ $variabel->id }}" type="checkbox" value="1" />
                                            @endif

                                        @else
                                            <input class="form-check-input text-center nik{{ $variabel->id }}"
                                                name="nik{{ $variabel->id }}" type="checkbox" value="1" />
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div
                                        class="form-check form-check-sm form-check-custom form-check-solid text-center">
                                        @if ($detailHasilSurvey)
                                            @if ($detailHasilSurvey->where('sub_variabel', 'norm')->where('variabel_survey_id', $variabel->id)->count() > 0)
                                                <input class="form-check-input text-center norm{{ $variabel->id }}"
                                            name="norm{{ $variabel->id }}" type="checkbox" value="1" checked="checked"/>

                                            @else
                                            <input class="form-check-input text-center norm{{ $variabel->id }}"
                                            name="norm{{ $variabel->id }}" type="checkbox" value="1" />
                                            @endif

                                        @else
                                            <input class="form-check-input text-center norm{{ $variabel->id }}"
                                                name="norm{{ $variabel->id }}" type="checkbox" value="1" />
                                        @endif
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



                <!--begin::Item-->
                <div class="d-flex align-items-center bg-light-warning rounded p-5">
                    <!--begin::Icon-->
                    <span class="svg-icon svg-icon-warning me-5">
                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                        <span class="svg-icon svg-icon-1 svg-icon-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path opacity="0.3"
                                    d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
                                    fill="currentColor" />
                                <path
                                    d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
                                    fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                    <!--end::Icon-->
                    <!--begin::Title-->
                    <div class="flex-grow-1 me-2">
                        <a href="#" class="fw-bolder text-gray-800 text-hover-primary fs-6">Score Survey</a>
                        <span
                            class="text-muted fw-bold d-block">{{ $hasilSurvey ? $hasilSurvey->numerator . '/' . $hasilSurvey->denumerator : 'Belum Diisi' }}</span>
                    </div>
                    <!--end::Title-->
                    <!--begin::Lable-->
                    <span class="fw-bolder text-warning py-1">{{ $hasilSurvey->score ?? '0' }}
                        {{ $indikatorMutu->satuan }}</span>
                    <!--end::Lable-->
                </div>
                <!--end::Item-->

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
