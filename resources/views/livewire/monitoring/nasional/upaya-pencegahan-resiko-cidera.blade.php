<div>

    <div class="row fs-6">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header py-3 mb-0 text-center center">
                    <div class="card-title fs-6 alert bg-light fw-bold text-center">
                        Upaya Pencegahan Jatuh Pada Pasien Berisiko
                    </div>
                </div>
                <div class="card-body">

                    @if ($izin == 'Y')
                        <form id="form-upaya-pencegahan-jatuh">

                            <input type="hidden" id="daftarImutNasional" name="daftarImutNasional"
                                value="upaya-pencegahan-resiko-cidera">
                            <input type="hidden" name="indikatorMutuId" id="indikatorMutuId"
                                value="{{ $indikatorMutu->id }}">
                            <input type="hidden" name="hasilSurveyId" id="hasilSurveyId"
                                value="{{ $hasilSurvey->id ?? 0 }}">

                            <!--begin::Item-->
                            <div class="d-flex align-items-center mb-8">
                                <!--begin::Bullet-->
                                <span class="bullet bullet-vertical h-70px bg-primary"></span>
                                <!--end::Bullet-->

                                <!--begin::Description-->
                                <div class="flex-grow-1 ms-5">
                                    <span class="text-gray-800 text-hover-primary fw-bolder fs-6">Skrining Awal
                                        IGD/Rawat Jalan</span>

                                    <!--begin::Checkbox-->
                                    <div
                                        class="form-group d-flex form-check form-check-custom form-check-solid pt-2 checkAsesmenUlang">
                                        <input class="form-check-input form-sm" type="radio" name="skriningIgdRajal"
                                            value="Y" id="skriningIgdRajalY"
                                            {{ $value['value13'] == 'Y' ? 'checked' : '' }} />
                                        <label class="form-check-label ms-3 text-muted" for="skriningIgdRajalY">Berisiko
                                            {{ $value['value13'] }}</label>
                                    </div>
                                    <!--end::Checkbox-->


                                    <!--begin::Checkbox-->
                                    <div
                                        class="form-group d-flex form-check form-check-custom form-check-solid pt-2 checkAsesmenUlang">
                                        <input class="form-check-input form-sm" type="radio" name="skriningIgdRajal"
                                            value="N" id="skriningIgdRajalN"
                                            {{ $value['value13'] == 'N' ? 'checked' : '' }} />
                                        <label class="form-check-label ms-3 text-muted" for="skriningIgdRajalN">Tidak
                                            Berisiko</label>
                                    </div>
                                    <!--end::Checkbox-->

                                </div>
                                <!--end::Description-->
                            </div>
                            <!--end:Item-->

                            <!--begin::Item-->
                            <div class="d-flex align-items-center mb-8">
                                <!--begin::Bullet-->
                                <span class="bullet bullet-vertical h-70px bg-primary"></span>
                                <!--end::Bullet-->

                                <!--begin::Description-->
                                <div class="flex-grow-1 ms-5">
                                    <span class="text-gray-800 text-hover-primary fw-bolder fs-6">Asesmen Awal
                                        Resiko Jatuh</span>

                                    <!--begin::Checkbox-->
                                    <div
                                        class="form-group d-flex form-check form-check-custom form-check-solid pt-2 checkAsesmenUlang">
                                        <input class="form-check-input" type="radio" name="asesmenAwal" value="Y"
                                            id="asesmenAwalY" {{ $value['value14'] == 'Y' ? 'checked' : '' }} />
                                        <label class="form-check-label ms-3 text-muted"
                                            for="asesmenAwalY">Berisiko</label>
                                    </div>
                                    <!--end::Checkbox-->


                                    <!--begin::Checkbox-->
                                    <div
                                        class="form-group d-flex form-check form-check-custom form-check-solid pt-2 checkAsesmenUlang">
                                        <input class="form-check-input" type="radio" name="asesmenAwal" value="N"
                                            id="asesmenAwalN" {{ $value['value14'] == 'N' ? 'checked' : '' }} />
                                        <label class="form-check-label ms-3 text-muted" for="asesmenAwalN">Tidak
                                            Berisiko</label>
                                    </div>
                                    <!--end::Checkbox-->

                                </div>
                                <!--end::Description-->
                            </div>
                            <!--end:Item-->

                            <div id="formAsesmenUlang">

                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-8">
                                    <!--begin::Bullet-->
                                    <span class="bullet bullet-vertical h-70px bg-primary"></span>
                                    <!--end::Bullet-->

                                    <!--begin::Description-->
                                    <div class="flex-grow-1 ms-5">
                                        <span class="text-gray-800 text-hover-primary fw-bolder fs-6">Asesmen Ulang
                                            Resiko Jatuh</span>

                                        <!--begin::Checkbox-->
                                        <div
                                            class="form-group d-flex form-check form-check-custom form-check-solid pt-2">
                                            <input class="form-check-input" type="radio" name="asesmenUlang"
                                                value="Y" id="asesmenUlangY"
                                                {{ $value['value15'] == 'Y' ? 'checked' : '' }} />
                                            <label class="form-check-label ms-3 text-muted"
                                                for="asesmenUlangY">Dilakukan</label>
                                        </div>
                                        <!--end::Checkbox-->

                                        <!--begin::Checkbox-->
                                        <div
                                            class="form-group d-flex form-check form-check-custom form-check-solid pt-2">
                                            <input class="form-check-input" type="radio" name="asesmenUlang"
                                                value="N" id="asesmenUlangN"
                                                {{ $value['value15'] == 'N' ? 'checked' : '' }} />
                                            <label class="form-check-label ms-3 text-muted" for="asesmenUlangN">Tidak
                                                Dilakukan</label>
                                        </div>
                                        <!--end::Checkbox-->

                                    </div>
                                    <!--end::Description-->
                                </div>
                                <!--end:Item-->
                            </div>
                        </form>

                        <!--begin::Item-->
                        <div class="d-flex align-items-center bg-light-warning rounded p-5">
                            <!--begin::Icon-->
                            <span class="svg-icon svg-icon-warning me-5">
                                <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                                <span class="svg-icon svg-icon-1 svg-icon-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none">
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
                                <a href="#" class="fw-bolder text-gray-800 text-hover-primary fs-6">Score
                                    Survey</a>
                                <span class="text-muted fw-bold d-block" id="keteranganUpayaPencegahan">

                                    @if(isset($hasilSurvey->score) == '1.00')
                                        Terpenuhi
                                    @else
                                        Tidak Terpenuhi
                                    @endif
                                </span>
                            </div>
                            <!--end::Title-->
                            <!--begin::Lable-->
                            <span class="fw-bolder text-warning py-1">

                                <span id="scoreUpayaPencegahan">{{ $hasilSurvey->score ?? '0' }}</span>
                                Pasien
                            </span>
                            <!--end::Lable-->
                        </div>
                        <!--end::Item-->
                    @else
                        <!--begin::Notice-->
                        <div class="notice d-flex bg-light-danger rounded border-danger border border-dashed mb-9 p-6">
                            <!--begin::Icon-->
                            <!--begin::Svg Icon | path: icons/duotune/art/art006.svg-->
                            <span class="svg-icon svg-icon-2tx svg-icon-danger me-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3"
                                        d="M12.025 4.725C9.725 2.425 6.025 2.425 3.725 4.725C1.425 7.025 1.425 10.725 3.725 13.025L11.325 20.625C11.725 21.025 12.325 21.025 12.725 20.625L20.325 13.025C22.625 10.725 22.625 7.025 20.325 4.725C18.025 2.425 14.325 2.425 12.025 4.725Z"
                                        fill="currentColor" />
                                    <path
                                        d="M14.025 17.125H13.925C13.525 17.025 13.125 16.725 13.025 16.325L11.925 11.125L11.025 14.325C10.925 14.725 10.625 15.025 10.225 15.025C9.825 15.125 9.425 14.925 9.225 14.625L7.725 12.325L6.525 12.925C6.425 13.025 6.225 13.025 6.125 13.025H3.125C2.525 13.025 2.125 12.625 2.125 12.025C2.125 11.425 2.525 11.025 3.125 11.025H5.925L7.725 10.125C8.225 9.925 8.725 10.025 9.025 10.425L9.825 11.625L11.225 6.72498C11.325 6.32498 11.725 6.02502 12.225 6.02502C12.725 6.02502 13.025 6.32495 13.125 6.82495L14.525 13.025L15.225 11.525C15.425 11.225 15.725 10.925 16.125 10.925H21.125C21.725 10.925 22.125 11.325 22.125 11.925C22.125 12.525 21.725 12.925 21.125 12.925H16.725L15.025 16.325C14.725 16.925 14.425 17.125 14.025 17.125Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <!--end::Icon-->


                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-grow-1">
                                <!--begin::Content-->
                                <div class="fw-bold">
                                    <div class="fs-6 text-gray-700">Pasien Belum Pulang, Survey Kepatuhan Upaya
                                        Pencegahan Pada Pasien Resiko Jatuh dilakukan setelah pasien pulang.
                                        Pada Filter pilih status Pasien Pulang</div>
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Notice-->
                    @endif

                </div>

                @if ($izin == 'Y')

                <div class="card-footer text-end mt-1 pt-4">
                    <button class="btn btn-primary simpanUPRC">
                        <span id="btn-simpan-text" class="indicator-label">
                            <i class="fas fa-save"></i>
                            Simpan
                        </span>
                        <span class="indicator-progress">
                            <i class="fas fa-save"></i>
                            Mohon Menunggu... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                    </button>
                </div>

                @endif

            </div>
        </div>

        <div class="col-sm-6">

            <div class="card">
                <div class="card-body">
                    <div class="alert bg-light fw-bold text-center">Anamnesa</div>

                    <div class="table-responsive">
                        <table class="table table-dashed fs-6">
                            @php
                                $no = 1;
                            @endphp

                            @if($anamnesa->isEmpty() && $anamnesari->isEmpty())
                                <tr>
                                    <th class="fw-bold center text-center">
                                        <div class="alert alert-danger">
                                            Data Anamnesa Tidak Ditemukan
                                        </div>
                                    </th>
                                </tr>
                            @else
                                @foreach ($anamnesa as $anamnesa)
                                <tr>
                                    <td class="w-25px">
                                        <label class="form-check-label badge badge-light">{{ $no }}</label>
                                    </td>
                                    <td>

                                        No. Registrasi {{ $anamnesa->NOREGRS }}<br>


                                        @if ($anamnesa->RESIKOJATUH == 'Tidak Ada Resiko')
                                            @php $color = "primary"; @endphp
                                        @elseif ($anamnesa->RESIKOJATUH == 'Resiko Rendah')
                                            @php $color = "info"; @endphp
                                        @elseif ($anamnesa->RESIKOJATUH == 'Resiko Sedang')
                                            @php $color = "warning"; @endphp
                                        @elseif ($anamnesa->RESIKOJATUH == 'Resiko Tinggi')
                                            @php $color = "danger"; @endphp
                                        @else
                                            @php $color = ""; @endphp
                                        @endif
                                        <label
                                            class="badge badge-light-{{ $color }} outline outline-warning">Resiko
                                            Jatuh : {{ $anamnesa->RESIKOJATUH }}</label><br>

                                        <span class="fs-8 text-gray-500 ms-1">Rawat
                                            Jalan/IGD</span><br>
                                        <span class="fs-8 text-gray-500 ms-1">
                                            {{ date('Y-m-d H:i:s', strtotime($anamnesa->DATEENTRY)) }}</span>
                                    </td>
                                </tr>
                                @php
                                    $no = $no + 1;
                                @endphp
                            @endforeach


                            @foreach ($anamnesari as $anamnesari)
                                <tr>
                                    <td class="w-25px">
                                        <label class="form-check-label badge badge-light">{{ $no }}</label>
                                    </td>
                                    <td>

                                        No. Registrasi {{ $anamnesari->NOREGRS }}<br>


                                        @if ($anamnesari->RESIKOJATUH == 'Tidak Ada Resiko')
                                            @php $color = "primary"; @endphp
                                        @elseif ($anamnesari->RESIKOJATUH == 'Resiko Rendah')
                                            @php $color = "info"; @endphp
                                        @elseif ($anamnesari->RESIKOJATUH == 'Resiko Sedang')
                                            @php $color = "warning"; @endphp
                                        @elseif ($anamnesari->RESIKOJATUH == 'Resiko Tinggi')
                                            @php $color = "danger"; @endphp
                                        @else
                                            @php $color = ""; @endphp
                                        @endif
                                        <label
                                            class="badge badge-light-{{ $color }} outline outline-warning">Resiko
                                            Jatuh : {{ $anamnesari->RESIKOJATUH }}</label><br>

                                        <span class="fs-8 text-gray-500 ms-1">Rawat
                                            Jalan/IGD</span><br>
                                        <span class="fs-8 text-gray-500 ms-1">
                                            {{ date('Y-m-d H:i:s', strtotime($anamnesari->DATEENTRY)) }}</span>
                                    </td>
                                </tr>
                                @php
                                    $no = $no + 1;
                                @endphp
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer pt-0 end">

                    <span class="fw-normal fs-7 text-center center mt-0 pt-0"><br>Tanggal Pulang :
                        {{ $dataRegistrasi->JAMPULANG ?? '-' }}</span>
                </div>
            </div>

        </div>
    </div>

    <script>
        $('#formAsesmenUlang').hide();

        const resetAsesmenUlang = () => {

            var skriningIgdRajal = $('input[name="skriningIgdRajal"]:checked').val();
            var asesmenAwal = $('input[name="asesmenAwal"]:checked').val();
            var defaultValue15 = "{{ $value['value15'] ?? '' }}";

            if (skriningIgdRajal == 'Y' && asesmenAwal == 'Y') {
                $('input[name="asesmenUlang"]').prop("checked", false);
                $('input[name="asesmenUlang"][value="' + defaultValue15 + '"]').prop("checked", true);
                $('#formAsesmenUlang').show();
            } else {
                $('#formAsesmenUlang').hide();
            }
        }

        $('.checkAsesmenUlang').on('click', function() {
            resetAsesmenUlang();
        });


        resetAsesmenUlang();

        const simpanUPRC = () => {

            var dataPasien = $('#data-pasien-form').serializeArray();
            var hasilSurveyId = $('#hasilSurveyId').val();
            var noReg = $('#dataPasienNoreg').val();
            var daftarImutNasional = $('#daftarImutNasional').val();
            var indikatorMutuId = $('#indikatorMutuId').val();
            var hasilSurveyId = $('#hasilSurveyId').val();
            var skriningIgdRajal = $('input[name="skriningIgdRajal"]:checked').val();
            var asesmenAwal = $('input[name="asesmenAwal"]:checked').val();
            var asesmenUlang = $('input[name="asesmenUlang"]:checked').val();

            var method = 'POST';
            var url = route('upaya-pencegahan-resiko-cidera.store');

            var checkPasien = checkDataPasien();

            if (checkPasien == 0) {
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Data Pasien Belum Diisi, Pilih Pasien yang akan di Survey',
                    icon: 'error',
                    padding: '2em',
                    timer: 3000
                });

                $('.indicator-label').show();
                $('.indicator-progress').hide();
                return false;
            }

            $.ajax({
                url: url,
                type: method,
                data: {
                    _token: '{{ csrf_token() }}',
                    dataPasien: dataPasien,
                    daftarImutNasional: daftarImutNasional,
                    indikatorMutuId: indikatorMutuId,
                    hasilSurveyId: hasilSurveyId,
                    skriningIgdRajal: skriningIgdRajal,
                    asesmenAwal: asesmenAwal,
                    asesmenUlang: asesmenUlang,
                },

                beforeSend: function(data) {
                    $('.indicator-label').hide();
                    $('.indicator-progress').show();
                },

                success: function(data) {
                    $('.indicator-label').show();
                    $('.indicator-progress').hide();

                    Swal.fire({
                        icon: "success",
                        title: "Berhasil",
                        text: data.message,
                        padding: '2em',
                        timer: 3000
                    });

                    $('#keteranganUpayaPencegahan').html(data.response.keterangan);
                    $('#scoreUpayaPencegahan').html(data.response.score);
                },

                error: function(data) {
                    $('.indicator-label').show();
                    $('.indicator-progress').hide();

                    if (data.status === 400) {
                        Swal.fire({
                            title: 'Gagal!',
                            text: data.responseJSON.message,
                            icon: 'error',
                            padding: '2em',
                            timer: 3000
                        })
                    }

                    if (data.status === 500) {
                        Swal.fire({
                            title: 'Gagal!',
                            text: 'Terjadi Kesalahan pada server, pastikan sudah di isi dengan benar',
                            icon: 'error',
                            padding: '2em',
                            timer: 3000
                        })
                    }
                }
            })
        }

        $('.simpanUPRC').on('click', function() {
            simpanUPRC();
        });
    </script>

</div>
