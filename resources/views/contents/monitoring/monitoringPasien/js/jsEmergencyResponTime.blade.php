{{-- KHUSUS KEPATUHAN IDENTIFIKASI KODE KI --}}
@push('extraScript')
<script>
    const resetERT = () => {
        var dataPasien = $('#data-pasien-form').serializeArray();
         $.ajax({
            url: "{{ route('monitoring-pasien-igd.antrian') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                dataPasien: dataPasien
            },
            beforeSend: function(data) {
                toastr.info("Mengembalikan Isian Sesuai Data Antrian IGD");
            },
            success: function(data) {

            },
            error: function(data) {
                toastr.danger("Gagal Mengambil Data Antrian IGD");
            }
        })


    }

    const simpanERT = () => {

        var data = $('#emergency-respon-time-form').serializeArray();
        var dataPasien = $('#data-pasien-form').serializeArray();
        var hasilSurveyId = $('#hasilSurveyId').val();
        var noReg = $('#dataPasienNoreg').val();

        if (hasilSurveyId <= 0) {
            var method = 'POST';
            var url = route('emergency-respon-time.store');
        } else {
            var method = 'PUT';
            var url = route('emergency-respon-time.update', hasilSurveyId);
        }

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
                data: data,
                dataPasien: dataPasien
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
                    filterImut:'emergency-respon-time',
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
@endpush
