@push('extraScript')
    <script>
        $("#pilihTanggalSurvey").daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            locale: {
                format: 'YYYY-MM-DD'
            },
            maxYear: parseInt(moment().format("YYYY"), 10)
        });

        /*const cariData = () => {
            var filterTanggal = moment($('#filterTanggal').val(), 'DD\MM\YYYY').format("YYYY-MM-DD");
            var filterServicePasien = $('#filterServicePasien').val();
            var filterKeyword = $('#filterKeyword').val();
            var filterBagian = $('#filterBagian').val();

            Livewire.emitTo('monitoring.monitoring-pasien.filter-data-pasien', 'cariDataPasien', {
                filterServicePasien: filterServicePasien,
                filterKeyword: filterKeyword,
                filterTanggal: filterTanggal,
                filterBagian: filterBagian
            })
        }*/

        /*const dataAnthropometric = (norm) => {

            $('#data-table').DataTable({
                searchDelay: 500,
                destroy: true,
                bProcessing: true,
                bServerSide: true,
                responsive: true,
                ajax: {
                    url: route('anthropometric.datatable'),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        norm: norm
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
                    data: 'tgl_survey',
                    name: 'tgl_survey'
                }, {
                    data: 'noreg',
                    name: 'noreg'
                }, {
                    data: 'umur',
                    name: 'umur'
                }, {
                    data: 'bb',
                    name: 'bb'
                }, {
                    data: 'tb',
                    name: 'tb'
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }]
            });
        }*/

        const cariData = () => {
            var filterBagian = $('#filterBagian').val();
            var filterKeyword = $('#filterKeyword').val();

            Livewire.emitTo('monitoring.anthropometric.filter-data-pasien', 'cariPasien', {
                filterBagian: filterBagian,
                filterKeyword: filterKeyword
            });
        }

        $('#filterBagian').select2({
            placeholder: 'Pilih Bagian',
            width: 'resolve',
            allowClear: true,
        });

        const openNorm = (norm) => {
            Livewire.emitTo('monitoring.anthropometric.form', 'cariNorm', {
                pasienNorm: norm,
            });

            loadDatatableHasil(norm);
        }

        const tambah = (norm) => {
            $('#survey-anthropometric-modal').modal('show');
            $('.modal-title').text('Tambah Survey Anthropometric');
            $('#pilihTanggalSurvey').val('{{ date("Y-m-d") }}');
            $('#norm').val(norm);
            resetValidasiForm();
            resetButton('#btn-simpan', 'Simpan');
        }


        const edit = (id) => {
            $('#survey-anthropometric-modal').modal('show');
            $('.modal-title').text('Edit Survey Anthropometric Pasien');
            resetValidasiForm();
            resetForm();

            $.ajax({
                url: route('anthropometric.edit', id),
                type: 'GET',
                dataType: 'JSON',
                beforeSend: function(data) {
                    loadingModal();
                    $('#btn-simpan').attr("data-kt-indicator", "on");
                },
                success: function(data) {
                    resetButton('#btn-simpan', 'Ubah');
                    resetLoadingModal();

                    $('#id').val(id);
                    $('input[name="_method"]').prop('disabled', false);
                    $('input[name="tanggalSurvey"]').val(data.response.tgl_survey);
                    $('input[name="no_reg"]').val(data.response.no_reg);
                    $('input[name="norm"]').val(data.response.norm);
                    $('input[name="umur"]').val(data.response.umur);
                    $('input[name="bb"]').val(data.response.bb);
                    $('input[name="tb"]').val(data.response.tb);

                }
            })
        }

        const simpan = () => {
            var data = $('#survey-anthropometric-form').serialize();
            var id = $('#id').val();
            var norm = $('input[name="norm"]').val();
            var url;
            var textBtn;
            if (id === '') {
                url = route('anthropometric.store');
                textBtn = 'Simpan';
            } else {
                url = route('anthropometric.update', id);
                textBtn = 'Ubah';
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                beforeSend: function(data) {
                    $('#btn-simpan').attr("data-kt-indicator", "on");
                },
                success: function(data) {
                    $('#survey-anthropometric-modal').modal('hide');
                    resetButton('#btn-simpan', textBtn);

                    Swal.fire({
                        icon: "success",
                        title: "Selamat!",
                        text: data.message,
                        padding: '2em',
                        timer: 3000
                    });

                    loadDatatableHasil(norm)
                },
                error: function(data) {
                    resetValidasiForm();
                    resetForm();
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
        }

        const loadDatatableHasil = (norm) => {
            Livewire.emitTo('monitoring.anthropometric.datatable', 'cariNorm', {
                norm: norm,
            });
        }

        const hapus = (id) => {
            var norm = $('#norm').val();
            Swal.fire({
                icon: 'warning',
                title: 'Apakah anda yakin?',
                text: "Setelah dihapus, Anda tidak akan dapat memulihkan data ini!",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: route('anthropometric.destroy', id),
                        type: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: '{!! csrf_token() !!}'
                        },
                        success: function() {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Data berhasil dihapus',
                                icon: 'success',
                                padding: '2em',
                                timer: 1500,
                            });
                            loadDatatableHasil(norm);
                        },
                        error: function(data) {
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
            });
        }
    </script>
@endpush
