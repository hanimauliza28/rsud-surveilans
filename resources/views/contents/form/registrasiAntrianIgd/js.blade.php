@push('extraScript')
    {{-- Reset --}}
    <script>
        $('#filterPanggil').each(function() {
            $(this).select2({
                placeholder: 'Filter Panggil',
                dropdownParent: $(this).parent(),
                allowClear: true,
                width: 'element'
            });
        });
        $('#filterDilayani').each(function() {
            $(this).select2({
                placeholder: 'Filter Dilayani',
                dropdownParent: $(this).parent(),
                allowClear: true,
                width: 'element'
            });
        });

        $("#filterTanggal").daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            locale: {
                format: 'DD/MM/YYYY'
            },
            maxYear: parseInt(moment().format("YYYY"), 10)
        });


        $("#tanggal").daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            showDropdowns: true,
            timePickerSeconds:true,
            timePicker24Hour: true,
            minYear: 1901,
            locale: {
                format: 'YYYY-MM-DD'
            },
            maxYear: parseInt(moment().format("YYYY"), 10)
        });


        Inputmask({
            "mask" : "99:99:99"
        }).mask("#jam");


        $('#registrasi-antrian-igd-modal').on('hidden.bs.modal', function() {
            var filterTanggal = $('#filterTanggal').val();
            $('#filterTanggal').val(filterTanggal);

            $('input.form-control').val('');
            $('textarea.form-control').val('');
            $('select').val('').change();
            $('input[name="_method"]').prop('disabled', true);
            $('#id').val('');
            $('#selectIsAktif').val('').change();
            resetValidasiForm();
        });

    </script>

    {{-- JS Datatable --}}
    <script>
        const dataRegistrasiAntrianIgd = () => {
            var filterTanggal = moment($('#filterTanggal').val(), 'DD\MM\YYYY').format("YYYY-MM-DD");
            var filterPanggil = $('#filterPanggil').val();
            var filterDilayani = $('#filterDilayani').val();

            $('#data-table').DataTable({
                searchDelay: 500,
                destroy: true,
                bProcessing: true,
                bServerSide: true,
                responsive: true,
                ajax: {
                    url: route('registrasi-antrian-igd.datatable'),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        filterTanggal : filterTanggal,
                        filterPanggil : filterPanggil,
                        filterDilayani : filterDilayani
                    }
                },
                "fnCreatedRow": function(row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                },

                columns: [{
                    data: null,
                    orderable: false,
                    searchable: false
                }, {
                    data: 'NO_ANTRI',
                    name: 'NO_ANTRI'
                }, {
                    data: 'NAMAPAS',
                    name: 'NAMAPAS',
                    class: 'text-center center'
                }, {
                    data: 'STATUS_PANGGIL',
                    name: 'STATUS_PANGGIL',
                    class: 'text-center center'
                },  {
                    data: 'STATUS_DILAYANI',
                    name: 'STATUS_DILAYANI',
                    class: 'text-center center'
                },{
                    data: 'TGL_INPUT',
                    name: 'TGL_INPUT',
                    class: 'text-center center'
                }, {
                    data: 'JAM_DILAYANI',
                    name: 'JAM_DILAYANI',
                    class: 'text-center center'
                }, {
                    data: 'JAM_SELESAI',
                    name: 'JAM_SELESAI',
                    class: 'text-center center'
                },

                 {
                    data: 'EMERGENCYTIME',
                    name: 'EMERGENCYTIME',
                    class: 'text-center center'
                }, {
                    data: 'action',
                    name: 'action',
                    class: 'text-center center',
                    orderable: false,
                    searchable: false
                }]
            });
        }

        dataRegistrasiAntrianIgd();

        const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');

        filterSearch.addEventListener('keyup', function(e) {
            $('#data-table').DataTable().search(e.target.value).draw();
        });

        const cariData = () => {
            dataRegistrasiAntrianIgd();
        }
    </script>

    {{-- JS Save Update --}}
    <script>

        $('#btn-tambah').on('click', function() {
            $('#registrasi-antrian-igd-modal').modal('show');
            $('.modal-title').text('Tambah Variabel Survey');
            resetButton('#btn-simpan', 'Simpan');
        });

        const registrasiNoreg = (grupAntri, noAntri, tglAntri) => {
            $('#registrasi-antrian-igd-modal').modal('show');
            $('.modal-title').text('Masukkan Registrasi Pasien');
            $('#grupAntri').val(grupAntri);
            $('#noAntri').val(noAntri);
            $('#tglAntri').val(tglAntri);

            $.ajax({
                url: "{{ route('registrasi-antrian-igd.edit-waktu') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    grupAntri : grupAntri,
                    noAntri : noAntri,
                    tglAntri : tglAntri
                },
                success: function(data) {
                    $('#dataPasienNama').val(data.response.antrian.NAMAPAS);
                    $('#dataPasienNorm').val(data.response.antrian.NORMPAS);
                    $('#dataPasienBagian').val('IGD');
                    $('#dataPasienKdbagian').val('9501S');
                    $('#dataPasienNoreg').val(data.response.antrian.NOREGRS);
                },
                error: function(data) {
                    Swal.fire({
                            title: 'Gagal!',
                            text: 'Gagal Mengambil Data Antrian',
                            icon: 'error',
                            padding: '2em',
                            timer: 3000
                        })
                }
            });

        }

        const mulaiLayanan = (grupAntri, noAntri, tglAntri) => {

            $.ajax({
                url: "{{ route('registrasi-antrian-igd.edit-waktu') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    grupAntri : grupAntri,
                    noAntri : noAntri,
                    tglAntri : tglAntri,
                    parameterIsian : 'JAM_DILAYANI'
                },
                success: function(data) {

                    console.log(data);

                    $('#waktu-modal').modal('show');
                    $('.modal-title').text('Mulai Layanan IGD');
                    $('#titleTanggal').text('Tanggal Mulai Layanan');
                    $('#titleJam').text('Jam Mulai Layanan');
                    $('#parameterIsian').val('JAM_DILAYANI');
                    $('#grupAntriWaktu').val(grupAntri);
                    $('#noAntriWaktu').val(noAntri);
                    $('#tglAntriWaktu').val(tglAntri);

                    $('#tanggal').val(data.response.tanggal);
                    $('#jam').val(data.response.jam);
                },
                error: function(data) {
                    Swal.fire({
                            title: 'Gagal!',
                            text: 'Gagal Mengambil Data Antrian',
                            icon: 'error',
                            padding: '2em',
                            timer: 3000
                        })
                }
            });
        }

        const selesaiLayanan = (grupAntri, noAntri, tglAntri) => {
            $.ajax({
                url: "{{ route('registrasi-antrian-igd.edit-waktu') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    grupAntri : grupAntri,
                    noAntri : noAntri,
                    tglAntri : tglAntri,
                    parameterIsian : 'JAM_SELESAI'
                },
                success: function(data) {

                    console.log(data);

                    $('#waktu-modal').modal('show');
                    $('.modal-title').text('Mulai Layanan IGD');
                    $('#titleTanggal').text('Tanggal Mulai Layanan');
                    $('#titleJam').text('Jam Mulai Layanan');
                    $('#parameterIsian').val('JAM_SELESAI');
                    $('#grupAntriWaktu').val(grupAntri);
                    $('#noAntriWaktu').val(noAntri);
                    $('#tglAntriWaktu').val(tglAntri);

                    $('#tanggal').val(data.response.tanggal);
                    $('#jam').val(data.response.jam);
                },
                error: function(data) {
                    Swal.fire({
                            title: 'Gagal!',
                            text: 'Gagal Mengambil Data Antrian',
                            icon: 'error',
                            padding: '2em',
                            timer: 3000
                        })
                }
            });
        }

        const cariRegistrasiIgd = () => {
            var filterTanggalBefore = $('#filterTanggal').val();
            var filterTanggal = moment($('#filterTanggal').val(), 'DD\MM\YYYY').format("YYYY-MM-DD");
            var filterKeyword = $('#namapasien').val();
            Livewire.emitTo('monitoring.cari-pasien-igd', 'cariDataPasien', {
                filterKeyword: filterKeyword,
                filterTanggal: filterTanggal
            });

        }

        const survey = (noreg, filterImut) =>
        {
            var namapasien = $('#' + noreg + '').data('namapasien');
            var norm = $('#' + noreg + '').data('norm');
            var bagian = $('#' + noreg + '').data('bagian');
            var kdbagian = $('#' + noreg + '').data('kdbagian');

            $('#dataPasienNama').val(namapasien);
            $('#dataPasienNorm').val(norm);
            $('#dataPasienBagian').val(bagian);
            $('#dataPasienKdbagian').val(kdbagian);
            $('#dataPasienNoreg').val(noreg);

            $('.accordion-button').click();
        }

        $('#btn-simpan').on('click', function(e) {
            e.preventDefault();
            var data = $('#registrasi-antrian-igd-form').serialize();
            var url;
            var textBtn;

            url = route('registrasi-antrian-igd.store')
            textBtn = 'Ubah';

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                beforeSend: function(data) {
                    $('#btn-simpan').attr("data-kt-indicator", "on");
                },
                success: function(data) {
                    $('#registrasi-antrian-igd-modal').modal('hide');
                    resetButton('#btn-simpan', textBtn);
                    Swal.fire({
                        icon: "success",
                        title: "Selamat!",
                        text: data.message,
                        padding: '2em',
                        timer: 3000
                    }).then($('#data-table').DataTable().ajax.reload(null, false))
                },
                error: function(data) {
                    resetValidasiForm();
                    resetButton('#btn-simpan', textBtn);
                    if (data.status === 422) {
                        for (const [key, value] of Object.entries(data.responseJSON.response)) {
                            $('input[name="' + key + '"]').addClass('is-invalid');
                            $('select[name="' + key + '"]').addClass('is-invalid');
                            $('#' + key).append(value);
                        }
                    }
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
        });


        $('#btn-simpan-waktu').on('click', function(e) {
            e.preventDefault();

            var data = $('#waktu-form').serialize();
            var url;
            var textBtn;

            url = route('registrasi-antrian-igd.store-waktu')
            textBtn = 'Ubah';

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                beforeSend: function(data) {
                    $('#btn-simpan-waktu').attr("data-kt-indicator", "on");
                },
                success: function(data) {
                    $('#waktu-modal').modal('hide');
                    resetButton('#btn-simpan-waktu', textBtn);
                    Swal.fire({
                        icon: "success",
                        title: "Selamat!",
                        text: data.message,
                        padding: '2em',
                        timer: 3000
                    }).then($('#data-table').DataTable().ajax.reload(null, false))
                },
                error: function(data) {
                    resetValidasiForm();
                    resetButton('#btn-simpan-waktu', textBtn);
                    if (data.status === 422) {
                        for (const [key, value] of Object.entries(data.responseJSON.response)) {
                            $('input[name="' + key + '"]').addClass('is-invalid');
                            $('#' + key).append(value);
                        }
                    }
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
        });
    </script>
@endpush
