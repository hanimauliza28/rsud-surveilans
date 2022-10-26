{{-- KHUSUS PENUNDAAN OPERASI ELEKTIF KODE POE --}}
<script>

    const cariPasienOperasi = () => {
        var tanggalSurveyAwal = $('#filterTanggalOperasi').val();
        var tanggalSurveyFormat = moment($('#filterTanggalOperasi').val(), 'DD\MM\YYYY').format("YYYY-MM-DD");
        Livewire.emitTo('monitoring.nasional.modul', 'penundaanOperasi', {
            filterImut: 'penundaan-operasi-elektif',
            tanggalSurvey : tanggalSurveyFormat
        });

        $('#filterTanggalOperasi').val(tanggalSurveyAwal);
    }

    const simpanPOE = () => {
        var data = $('#penundaan-operasi-elektif-form').serializeArray();
        var hasilSurveyId = $('#hasilSurveyId').val();

        if (hasilSurveyId <= 0) {
            var method = 'POST';
            var url = route('penundaan-operasi-elektif.store');
        } else {
            var method = 'PUT';
            var url = route('penundaan-operasi-elektif.update', hasilSurveyId);
        }

        $.ajax({
            url: url,
            type: method,
            dataType: 'JSON',
            data: {
                _token: '{{ csrf_token() }}',
                data: data,
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

                cariPasienOperasi();
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
