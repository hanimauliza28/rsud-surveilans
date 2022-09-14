{{-- KHUSUS KEPATUHAN IDENTIFIKASI KODE KI --}}

<script>
    const resetERT = () => {
        $('#emergency-respon-time-form').trigger('reset');
        return false;
    }

    const simpanERT = () => {
        //var data = {
         //   'waktuPasienDatang' => $('input[name="waktuPasienDatang"]').val(),
         //   'waktuPasienDilayani' => $('input[name="waktuPasienDilayani"]').val(),
         //   'waktuTanggap' => $('input[name="waktuTanggap"]').val()
        //};

        var data = $('#emergency-respon-time-form').serializeArray();
        var dataPasien = $('#data-pasien-form').serializeArray();
        var hasilSurveyId = $('#hasilSurveyId').val();

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

                reloadForm();
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
