@push('extraScript')
    {{-- JS Datatable --}}
    <script>

        const loadingModal = () => {
            $(".modal-body-layer").addClass("overlay overlay-block");
            $('.modal-overlay-layer').show();
            $('.modal-content-layer').hide();
        }
        const resetLoadingModal = () => {
            $(".modal-body-layer").removeClass("overlay overlay-block");
            $('.modal-overlay-layer').hide();
            $('.modal-content-layer').show();
        }

        const loadingCard = () => {
            $(".card-body-layer").addClass("overlay overlay-block");
            $('.card-overlay-layer').show();
            $('.card-content-layer').hide();
        }
        const resetLoadingCard = () => {
            $(".card-body-layer").removeClass("overlay overlay-block");
            $('.card-overlay-layer').hide();
            $('.card-content-layer').show();
        }

        const resetButton = (btnId ,btnText) => {
            $(btnId).removeAttr("data-kt-indicator");
            $(btnId+'-text').text(btnText);
        }

    </script>

    {{-- Detail --}}
    <script>
        const detail = (id) => {
            $('#detail-modal').modal('show');
            $('.modal-title').text('Detail Indikator Mutu');

            $.ajax({
                url : route('indikator-mutu-nasional-manajemen.view', id) ,
                type : 'GET',
                beforeSend : function (data) {
                    loadingModal();
                },
                success     : function (data) {
                    resetLoadingModal();
                    $('#detail-judul').html(data.response.judul);
                    $('#detail-definisi-operasional').html(data.response.definisi_operasional);
                    $('#detail-kriteria-inklusi').html(data.response.kriteria_inklusi);
                    $('#detail-kriteria-eksklusi').html(data.response.kriteria_eksklusi);
                    $('#detail-sumber-data').html(data.response.sumber_data);
                    $('#detail-area-monitoring').html(data.response.area_monitoring);
                    $('#detail-standar').html(data.response.standar);
                    $('#detail-faktor-pengali').html(data.response.faktor_pengali);
                    $('#detail-satuan').html(data.response.satuan);
                    $('#detail-kategori').html(data.response.kategori.nama_kategori);
                    $('#detail-tipe').html(data.response.tipe.nama_tipe);
                    $('#detail-frekuensi').html(data.response.frekuensi.nama_frekuensi);
                    $('#detail-kode-frekuensi').html(data.response.frekuensi.kode_frekuensi);
                },
                error : function (data) {
                    Swal.fire({
                        title : 'Gagal!',
                        text : data.responseJSON.message,
                        icon : 'error',
                        padding : '2em',
                        timer : 3000
                    })
                }
            })
        }
    </script>

    {{-- MENILAI --}}
    <script>
        const masukanNilai = (imutId, hari, bulan, tahun) => {
            $('input[name="numerator"]').val('');
            $('input[name="denumerator"]').val('');

            $.ajax({
                url : route('indikator-mutu-nasional-manajemen.variabel', imutId),
                type : 'POST',
                data : {
                    _token : '{!! csrf_token() !!}',
                    tanggal : tahun+'-'+bulan+'-'+hari
                },
                beforeSend : function (data) {
                    loadingModal();
                },
                success     : function (data) {
                    resetLoadingModal();
                    $('#nilai-modal').modal('show');
                    $('.modal-title').text('Nilai Indikator Mutu');

                    $('input[name="nilaiImutId"]').val(imutId);
                    $('input[name="nilaiHari"]').val(hari);
                    $('input[name="nilaiBulan"]').val(bulan);
                    $('input[name="nilaiTahun"]').val(tahun);

                    $('input[name="numerator"]').val(data.response.nilaiNumerator);
                    $('input[name="denumerator"]').val(data.response.nilaiDenumerator);

                    $('#nilaiIndikatorNumerator').html(data.response.numerator.indikator)
                    $('#nilaiIndikatorDenumerator').html(data.response.denumerator.indikator)
                    $('#nilaiSatuanNumerator').html(data.response.numerator.satuan)
                    $('#nilaiSatuanDenumerator').html(data.response.denumerator.satuan)
                },
                error : function (data) {
                    Swal.fire({
                        title : 'Gagal!',
                        text : data.responseJSON.message,
                        icon : 'error',
                        padding : '2em',
                        timer : 3000
                    })
                }
            })
        }

        $('#btn-simpan-nilai').on('click', function(e) {
            e.preventDefault();

            var dataNilai = $('#form-nilai').serialize();
            var id = $('#nilaiImutId').val();
            var url = route('indikator-mutu-nasional-manajemen.storeNilai');
            var textBtn = 'Simpan';

            $.ajax({
                url : url,
                type : 'POST',
                data    : dataNilai,
                beforeSend : function (data) {
                    $('#btn-simpan-nilai').attr("data-kt-indicator", "on");
                },
                success : function (data) {
                    resetButton('#btn-simpan-nilai', textBtn);
                    Swal.fire({
                        icon : "success",
                        title : "Selamat!",
                        text : data.message,
                        padding : '2em',
                        timer : 3000
                    })
                },
                error : function (data) {
                    resetButton('#btn-simpan-nilai', textBtn);

                    if (data.status === 400) {
                        Swal.fire({
                            title : 'Gagal!',
                            text : data.responseJSON.message,
                            icon : 'error',
                            padding : '2em',
                            timer : 3000
                        })
                    }

                    if (data.status === 500) {
                        Swal.fire({
                            title : 'Gagal!',
                            text : 'Terjadi Kesalahan pada server, pastikan sudah di isi dengan benar',
                            icon : 'error',
                            padding : '2em',
                            timer : 3000
                        })
                    }else{
                        Swal.fire({
                            title : 'Gagal!',
                            text : data.responseJSON.message,
                            icon : 'error',
                            padding : '2em',
                            timer : 3000
                        })
                    }
                }
            })
        });

        $('#nilai-modal').on('hidden.bs.modal', function() {
            cariDataFilter();
        });
    </script>

@endpush
