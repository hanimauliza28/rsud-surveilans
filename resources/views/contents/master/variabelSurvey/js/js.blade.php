@push('extraScript')
    {{-- Reset --}}
    <script>
        $('#variabel-survey-modal').on('hidden.bs.modal', function() {
            $('input.form-control').val('');
            $('textarea.form-control').val('');
            $('select').val('').change();
            $('input[name="_method"]').prop('disabled', true);
            $('#id').val('');
            $('#selectIsAktif').val('').change();
            resetValidasiForm();
        });

        const resetValidasiForm = () => {
            $('input.form-control').removeClass('is-invalid');
            $('select.form-select').removeClass('is-invalid');
            $('.invalid-feedback').empty();
        }

        const resetButton = (btnId, btnText) => {
            $(btnId).removeAttr("data-kt-indicator");
            $(btnId + '-text').text(btnText);
        }
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
    </script>

    {{-- JS Datatable --}}
    <script>
        const dataVariabelSurvey = () => {
            var filterJenisService = $('#filterJenisService').val();

            $('#data-table').DataTable({
                searchDelay: 500,
                destroy: true,
                bProcessing: true,
                bServerSide: true,
                responsive: true,
                "iDisplayLength": 10,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                ajax: {
                    url: route('variabel-survey.datatable'),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
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
                    data: 'nama_variabel',
                    name: 'nama_variabel'
                }, {
                    data: 'nama',
                    name: 'nama'
                }, {
                    data: 'keterangan',
                    name: 'keterangan'
                }, {
                    data: 'namaKategori',
                    name: 'namaKategori'
                }, {
                    data: 'namaParent',
                    name: 'namaParent'
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }]
            });
        }

        dataVariabelSurvey();

        const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');

        filterSearch.addEventListener('keyup', function(e) {
            $('#data-table').DataTable().search(e.target.value).draw();
        });

        const cariData = () => {
            $('#data-table').DataTable().clear().destroy();
            dataVariabelSurvey();
        }
    </script>

    {{-- JS Save Update --}}
    <script>
        $('#btn-tambah').on('click', function() {
            $('#variabel-survey-modal').modal('show');
            $('.modal-title').text('Tambah Variabel Survey');
            resetButton('#btn-simpan', 'Simpan');
        });

        const edit = (id) => {
            $('#variabel-survey-modal').modal('show');
            $('.modal-title').text('Edit Variabel Survey');

            $.ajax({
                url: route('variabel-survey.edit', id),
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
                    $('input[name="namaVariabel"]').val(data.response.nama_variabel);
                    $('input[name="nama"]').val(data.response.nama);
                    $('input[name="keterangan"]').val(data.response.keterangan);
                    $('select[name="kategoriVariabelSurvey"]').val(data.response
                        .kategori_variabel_survey_id).change();
                    $('select[name="parentId"]').val(data.response.parent_id).change();

                }
            })
        }

        $('#btn-simpan').on('click', function(e) {
            e.preventDefault();


            var data = $('#variabel-survey-form').serialize();
            var id = $('#id').val();
            var url;
            var textBtn;
            if (id === '') {
                url = route('variabel-survey.store');
                textBtn = 'Simpan';
            } else {
                url = route('variabel-survey.update', id);
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
                    $('#variabel-survey-modal').modal('hide');
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
    </script>

    {{-- JS Action --}}
    <script>
        const hapus = (id) => {
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
                        url: route('variabel-survey.destroy', id),
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
                            }).then($('#data-table').DataTable().ajax.reload(null, false))
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
