    {{-- <script>
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
    </script> --}}
