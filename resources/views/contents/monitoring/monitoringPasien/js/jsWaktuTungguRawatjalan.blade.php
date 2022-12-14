{{-- KHUSUS KEPATUHAN IDENTIFIKASI KODE KI --}}
@push('extraScript')
<script>
    const resetWTRJ = () => {
        $('#waktu-tunggu-rawat-jalan-form').trigger('reset');
        return false;
    }

    const simpanWTRJ = () => {

        var data = $('#waktu-tunggu-rawat-jalan-form').serializeArray();
        var dataPasien = $('#data-pasien-form').serializeArray();
        var hasilSurveyId = $('#hasilSurveyId').val();
        var noReg = $('#dataPasienNoreg').val();
        var filterTanggal = moment($('#filterTanggal').val(), 'DD\MM\YYYY').format("YYYY-MM-DD");

        if (hasilSurveyId <= 0) {
            var method = 'POST';
            var url = route('waktu-tunggu-rawat-jalan.store');
        } else {
            var method = 'PUT';
            var url = route('waktu-tunggu-rawat-jalan.update', hasilSurveyId);
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
                dataPasien: dataPasien,
                tanggalSurvey : filterTanggal
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
                    filterImut:'waktu-tunggu-rawat-jalan',
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
        });

    }
</script>
@endpush
