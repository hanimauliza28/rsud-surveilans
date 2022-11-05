<div>
    <div class="card">
        <div class="card-body">
            <form id="kepatuhan-visit-pasien-form">

                <input type="hidden" name="indikatorMutuId" id="indikatorMutuId" value="{{ $indikatorMutu->id }}">
                <input type="hidden" name="hasilSurveyId" id="hasilSurveyId" value="{{ $hasilSurvey->id ?? 0 }}">

                <table class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr class="text-start fw-bolder fs-7 text-uppercase gs-0">
                            <th>No.</th>
                            <th>Pemeriksaan</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Kepatuhan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($dataVisit)
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($dataVisit as $visit)
                                <tr>
                                    <td>
                                        {{ $no }}
                                    </td>
                                    <td>
                                        [{{ $visit->KDTINDAKAN }}]<br>
                                        {{ $visit->NAMAPMR }}

                                    </td>
                                    <td>
                                        {{ $visit->TANGGAL }}
                                    </td>
                                    <td>
                                        {{ substr($visit->WAKTU, 0, 8) }}
                                    </td>
                                    <td>
                                        @if ($visit->WAKTU < '14:00:00')
                                            1
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>


                                @php
                                    $no = $no++;
                                @endphp
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text text-center">Tidak Ada Data Visit Dokter</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

            </form>

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
                    <span class="text-muted fw-bold d-block">
                        {{-- {{ $detailHasilSurvey ? $detailHasilSurvey['waktuTunggu'] : $dataPelayanan['waktuTunggu'] }} --}}
                        Detik / Pasien</span>
                </div>
                <!--end::Title-->
                <!--begin::Lable-->
                <span class="fw-bolder text-warning py-1"></span>
                <!--end::Lable-->
            </div>
            <!--end::Item-->

        </div>
        <div class="card-footer text-end mt-1 pt-4">
            <button id="btn-simpan" class="btn btn-primary" onclick="ambilDataVisitDokter()">
                <span id="btn-simpan-text" class="indicator-label">
                    <i class="fas fa-save"></i>
                    Ambil Data SIMRS
                </span>
                <span class="indicator-progress">
                    <i class="fas fa-save"></i>
                    Mohon Menunggu... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
        </div>
    </div>
</div>
