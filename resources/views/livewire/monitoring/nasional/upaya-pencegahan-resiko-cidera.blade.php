<div>
    <div class="row fs-6">
        <div class="col-sm-6">
            <div class="card">

                <div class="card-header py-3 mb-0">
                    <div class="card-title fs-6 alert bg-light fw-bold text-center">
                        Upaya Pencegahan Jatuh Pada Pasien Berisiko
                    </div>
                </div>
                <div class="card-body">
                    <form id="form-upaya-pencegahan-jatuh">

                        <input type="hidden" id="daftarImutNasional" name="daftarImutNasional" value="upaya-pencegahan-resiko-cidera">
                        <input type="hidden" name="indikatorMutuId" id="indikatorMutuId" value="{{ $indikatorMutu->id }}">
                        <input type="hidden" name="hasilSurveyId" id="hasilSurveyId" value="{{ $hasilSurvey->id ?? 0 }}">

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
                                        value="Y" id="skriningIgdRajalY" />
                                    <label class="form-check-label ms-3 text-muted"
                                        for="skriningIgdRajalY">Berisiko</label>
                                </div>
                                <!--end::Checkbox-->


                                <!--begin::Checkbox-->
                                <div
                                    class="form-group d-flex form-check form-check-custom form-check-solid pt-2 checkAsesmenUlang">
                                    <input class="form-check-input form-sm" type="radio" name="skriningIgdRajal"
                                        value="N" id="skriningIgdRajalN" />
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
                                        id="asesmenAwalY" />
                                    <label class="form-check-label ms-3 text-muted" for="asesmenAwalY">Berisiko</label>
                                </div>
                                <!--end::Checkbox-->


                                <!--begin::Checkbox-->
                                <div
                                    class="form-group d-flex form-check form-check-custom form-check-solid pt-2 checkAsesmenUlang">
                                    <input class="form-check-input" type="radio" name="asesmenAwal" value="N"
                                        id="asesmenAwalN" />
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
                                    <div class="form-group d-flex form-check form-check-custom form-check-solid pt-2">
                                        <input class="form-check-input" type="radio" name="asesmenUlang"
                                            value="Y" id="asesmenUlangY" />
                                        <label class="form-check-label ms-3 text-muted"
                                            for="asesmenUlangY">Berisiko</label>
                                    </div>
                                    <!--end::Checkbox-->

                                    <!--begin::Checkbox-->
                                    <div class="form-group d-flex form-check form-check-custom form-check-solid pt-2">
                                        <input class="form-check-input" type="radio" name="asesmenUlang"
                                            value="N" id="asesmenUlangN" />
                                        <label class="form-check-label ms-3 text-muted" for="asesmenUlangN">Tidak
                                            Berisiko</label>
                                    </div>
                                    <!--end::Checkbox-->

                                </div>
                                <!--end::Description-->
                            </div>
                            <!--end:Item-->
                        </div>
                    </form>

                </div>

                <div class="card-footer text-end mt-1 pt-4">
                    <button id="btn-simpan-kepatuhan-identifikasi" class="btn btn-primary simpanUPRC">
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

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        $('#formAsesmenUlang').hide();

        const resetAsesmenUlang = () => {

            var skriningIgdRajal = $('input[name="skriningIgdRajal"]:checked').val();
            var asesmenAwal = $('input[name="asesmenAwal"]:checked').val();

            if (skriningIgdRajal == 'Y' && asesmenAwal == 'Y') {
                $('input[name="asesmenUlang"]').prop("checked", false);
                $('#formAsesmenUlang').show();
            } else {
                $('#formAsesmenUlang').hide();
            }

        }

        $('.checkAsesmenUlang').on('click', function() {
            resetAsesmenUlang();
        });


        $('.simpanUPRC').on('click', function() {
            simpanUPRC();
        })

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
                    daftarImutNasional : daftarImutNasional,
                    indikatorMutuId : indikatorMutuId,
                    hasilSurveyId : hasilSurveyId,
                    skriningIgdRajal : skriningIgdRajal,
                    asesmenAwal : asesmenAwal,
                    asesmenUlang : asesmenUlang,
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


                    Livewire.emitTo('monitoring.nasional.modul', 'cariImut', {
                        filterImut: 'upaya-pencegahan-resiko-cidera',
                        noReg: noReg
                    });
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
    </script>
</div>
