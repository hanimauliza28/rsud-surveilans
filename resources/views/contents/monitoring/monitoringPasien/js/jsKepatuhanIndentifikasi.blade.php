{{-- SELECT --}}
<script>
    const checkAllItem = (id) => {
        $('.nama' + id).prop('checked', true)
        $('.tglLahir' + id).prop('checked', true)
        $('.nik' + id).prop('checked', true)
        $('.norm' + id).prop('checked', true)
    }

    const checkAll = () => {
        $('.checkIndikator').prop('checked', true)
    }

    const uncheckAll = () => {
        $('.checkIndikator').prop('checked', false)
    }
</script>

{{-- KHUSUS KEPATUHAN IDENTIFIKASI KODE KI --}}

<script>
    const resetKI = () => {
        $('#kepatuhan-identifikasi-form').trigger('reset');

        return false;
    }
    const simpanKI = () => {
            var data = $('#kepatuhan-identifikasi-form').serializeArray();
            var dataPasien = $('#data-pasien-form').serializeArray();

            $.ajax({
                    url: route('kepatuhan-identifikasi.store'),
                    type: 'POST',
                    dataType: 'JSON',
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

                        console.log(data);
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
