<div>
    <div class="overflow" style="overflow:scroll">
        <!--begin::Datatable-->
        @php
            $nomor = 1;
        @endphp

        <table id="data-table" class="table align-middle table-row-dashed fs-7 gy-3">

            <thead>
                <tr class="text-center fw-bolder fs-7 text-uppercase gs-0">
                    <th>No</th>
                    <th style="min-width:200px">Indikator</th>
                    @for ($x = 1; $x <= $dayInMonth; $x++)
                        <th>{{ $x }}</th>
                    @endfor
                    {{-- <th>Action</th> --}}
                </tr>
            </thead>

            <tbody class="text-gray-600 " style="overflow:scroll">
                @foreach ($imut as $indikatorMutu)
                    <tr>
                        <td>{{ $nomor }}</td>
                        <td><a class="text-success" onclick="detail({{ $indikatorMutu->id }})">{!! $indikatorMutu['judul'] !!}</a>
                            <button class="btn btn-success btn-sm y-0 fs-8"
                                onclick="rekapNilai({{ $indikatorMutu->id }})">
<!--begin::Svg Icon | path: assets/media/icons/duotune/files/fil023.svg-->
<span class="svg-icon svg-icon-muted svg-icon-2"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
<path opacity="0.3" d="M5 15C3.3 15 2 13.7 2 12C2 10.3 3.3 9 5 9H5.10001C5.00001 8.7 5 8.3 5 8C5 5.2 7.2 3 10 3C11.9 3 13.5 4 14.3 5.5C14.8 5.2 15.4 5 16 5C17.7 5 19 6.3 19 8C19 8.4 18.9 8.7 18.8 9C18.9 9 18.9 9 19 9C20.7 9 22 10.3 22 12C22 13.7 20.7 15 19 15H5ZM5 12.6H13L9.7 9.29999C9.3 8.89999 8.7 8.89999 8.3 9.29999L5 12.6Z" fill="currentColor"/>
<path d="M17 17.4V12C17 11.4 16.6 11 16 11C15.4 11 15 11.4 15 12V17.4H17Z" fill="currentColor"/>
<path opacity="0.3" d="M12 17.4H20L16.7 20.7C16.3 21.1 15.7 21.1 15.3 20.7L12 17.4Z" fill="currentColor"/>
<path d="M8 12.6V18C8 18.6 8.4 19 9 19C9.6 19 10 18.6 10 18V12.6H8Z" fill="currentColor"/>
</svg></span>
<!--end::Svg Icon-->
                                Sync</button>
                        </td>
                        @for ($x = 1; $x <= $dayInMonth; $x++)
                            <td class="text-center">

                                @php
                                    $tglKolom = date('Y-m-d', strtotime($year . '-' . $month . '-' . $x));
                                    $hasilSurvey = $indikatorMutu->survey->where('tanggal_survey', $tglKolom)->first();
                                    $numerator = $hasilSurvey['numerator'] ?? 0;
                                    $denumerator = $hasilSurvey['denumerator'] ?? 0;
                                    if ($denumerator == 0) {
                                        $score = 0;
                                    } else {
                                        $score = $numerator / $denumerator;
                                    }

                                    //$numerator = $indikatorMutu->survey->where('tanggal_survey', $year.'-'.$month.'-'.$x)->numerator;

                                @endphp

                                <a onclick="masukanNilai({{ $indikatorMutu->id . ',' . $x . ',' . $month . ',' . $year }})"
                                    class="badge text-hover-white badge-success mb-2 hoverable">{{ number_format($score, 2) ?? 0 }}
                                    %</a>
                                <div class="d-flex content-center text-center">
                                    <span
                                        class="badge bg-light-success text-gray-500 me-1">{{ $hasilSurvey->numerator ?? 0 }}</span>
                                    <span
                                        class="badge bg-light-success text-gray-500 me-0">{{ $hasilSurvey->denumerator ?? 0 }}</span>
                                </div>
                                <a onclick="detailNilai({{ $indikatorMutu->id }})"
                                    class="badge bg-hover-success text-hover-white badge-light-success mt-2">Detail</a>
                            </td>
                        @endfor
                    </tr>
                    @php
                        $nomor++;
                    @endphp
                @endforeach


            </tbody>
        </table>
        <!--end::Datatable-->

        @if ($imut->isEmpty())
            <!--begin::Notice-->
            <div class="notice d-flex bg-light-danger rounded border-danger border border-dashed p-6">
                <!--begin::Icon-->
                <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                <span class="svg-icon svg-icon-2tx svg-icon-danger me-4">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none">
                        <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10"
                            fill="currentColor" />
                        <rect x="11" y="14" width="7" height="2" rx="1"
                            transform="rotate(-90 11 14)" fill="currentColor" />
                        <rect x="11" y="17" width="2" height="2" rx="1"
                            transform="rotate(-90 11 17)" fill="currentColor" />
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
