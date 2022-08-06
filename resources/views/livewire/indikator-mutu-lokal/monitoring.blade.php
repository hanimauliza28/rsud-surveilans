<div>
    <div class="w-100 overflow" style="width:100%; overflow:scroll">
        <!--begin::Datatable-->
        @php
        $nomor = 1;
        @endphp

        <table id="data-table" class="table align-middle table-row-dashed fs-7 gy-5">
            <thead>
                <tr class="text-center fw-bolder fs-7 text-uppercase gs-0">
                    <th>No</th>
                    <th>Indikator</th>
                    @for ($x = 1; $x <= $dayInMonth; $x++) <th>{{ $x }}</th>
                        @endfor
                        {{-- <th>Action</th> --}}
                </tr>
            </thead>
            <tbody class="text-gray-600 " style="width:100%; overflow:scroll">

                @foreach($imut as $indikatorMutu)

                <tr>
                    <td>{{ $nomor }}</td>
                    <td><a class="text-success" onclick="detail({{ $indikatorMutu->id }})">{!! $indikatorMutu['judul'] !!}</a></td>
                    @for ($x = 1; $x <= $dayInMonth; $x++) <td class="text-center">

                        @php
                        $tglKolom = date('Y-m-d', strtotime($year.'-'.$month.'-'.$x));
                        $hasilSurvey = $indikatorMutu->survey->where('tanggal_survey', $tglKolom)->first();
                        $numerator = $hasilSurvey['numerator'] ?? 0;
                        $denumerator = $hasilSurvey['denumerator'] ?? 0;
                        if($denumerator == 0)
                        {
                        $score = 0;
                        }else{
                        $score = $numerator/$denumerator;
                        }

                        //$numerator = $indikatorMutu->survey->where('tanggal_survey', $year.'-'.$month.'-'.$x)->numerator;
                        @endphp

                        <a onclick="masukanNilai({{ $indikatorMutu->id.','. $x .','. $month .','. $year }})" class="badge text-hover-white badge-success mb-2">{{ number_format($score, 2) ?? 0 }} %</a>
                        <div class="d-flex content-center text-center">
                            <span class="badge bg-light-success text-gray-500 me-1">{{ $hasilSurvey->numerator ?? 0 }}</span>
                            <span class="badge bg-light-success text-gray-500 me-0">{{ $hasilSurvey->denumerator ?? 0 }}</span>
                        </div>
                        </td>
                        @endfor
                </tr>
                @php
                $nomor ++;
                @endphp
                @endforeach


            </tbody>
        </table>
        <!--end::Datatable-->

                @if($imut->isEmpty())

                <!--begin::Notice-->
                <div class="notice d-flex bg-light-danger rounded border-danger border border-dashed p-6">
                    <!--begin::Icon-->
                    <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                    <span class="svg-icon svg-icon-2tx svg-icon-danger me-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="currentColor" />
                            <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="currentColor" />
                            <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <!--end::Icon-->
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-grow-1">
                        <!--begin::Content-->
                        <div class="fw-bold">
                            <h4 class="text-gray-900 fw-bolder">Mohon Maaf</h4>
                            <div class="fs-6 text-gray-700">Data Indikator Mutu Tidak Ditemukan</div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Notice-->
                @endif
    </div>

</div>

