@push('extraScript')
    {{-- Reset --}}
    <script>
        $('#pengumuman-modal').on('hidden.bs.modal', function() {
            $('input.form-control').val('');
            $('textarea.form-control').val('');
            $('select').val('').change();
            $('input[name="_method"]').prop('disabled', true);
            $('#id').val('');
            $('#selectIsAktif').val('').change();
            resetValidasiForm();
        });

        /*const resetValidasiForm = () => {
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
        }*/

    </script>

    {{-- JS Datatable --}}
    <script>
        const dataPengumuman = () => {

            $('#data-table').DataTable({
                searchDelay: 500,
                destroy: true,
                bProcessing: true,
                bServerSide: true,
                responsive: true,
                ajax: {
                    url: route('pengumuman.datatable'),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                    }
                },
                "fnCreatedRow": function(row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                },
                columns: [{
                    data: null,
                    orderable: false,
                    searchable: false
                },  {
                    data: 'created_at',
                    name: 'created_at'
                }, {
                    data: 'judul',
                    name: 'judul'
                },{
                    data: 'deskripsi_singkat',
                    name: 'deskripsi_singkat',
                    class: 'center text-center'
                }, {
                    data: 'status',
                    name: 'status',
                    class: 'center text-center'
                }, {
                    data: 'actionAktifkan',
                    name: 'actionAktifkan',
                    class: 'center text-center'
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    class : 'center text-center'
                }]
            });
        }

        dataPengumuman();

        const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');

        filterSearch.addEventListener('keyup', function(e) {
            $('#data-table').DataTable().search(e.target.value).draw();
        });

        const cariData = () => {
            dataPengumuman();
        }
    </script>

    {{-- JS Save Update --}}
    <script>
        $('#btn-tambah').on('click', function() {
            $('#pengumuman-modal').modal('show');
            $('.modal-title').text('Tambah Pengumuman');
            resetButton('#btn-simpan', 'Simpan');
        });

        const edit = (id) => {
            $('#pengumuman-modal').modal('show');
            $('.modal-title').text('Edit Pengumuman');

            $.ajax({
                url: route('pengumuman.edit', id),
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
                    $('input[name="judul"]').val(data.response.judul);
                    $('textarea[name="deskripsiSingkat"]').val(data.response.deskripsi_singkat);
                    $('select[name="status"]').val(data.response.status).change();
                    CKEditorIsi.setData(data.response.isi);
                }
            })
        }

        $('#btn-simpan').on('click', function(e) {
            e.preventDefault();


            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }

            var data = $('#pengumuman-form').serialize();
            var id = $('#id').val();
            var url;
            var textBtn;

            if (id === '') {
                url = route('pengumuman.store');
                textBtn = 'Simpan';
            } else {
                url = route('pengumuman.update', id);
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
                    $('#pengumuman-modal').modal('hide');
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
                        url: route('pengumuman.destroy', id),
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

        const aktif = (status, id) => {
            if(status == 'Y')
            {
                var keterangan = 'di Aktifkan';
            }else{
                var keterangan = 'di Non Aktifkan';
            }
            Swal.fire({
                icon: 'warning',
                title: 'Apakah anda yakin?',
                text: "Hanya diperbolehkan 1 pengumuman aktif",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: route('pengumuman.update-status', id),
                        type: 'PUT',
                        data: {
                            _token: '{!! csrf_token() !!}',
                            id : id,
                            status : status
                        },
                        success: function() {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Pengumuman Berhasil '+keterangan,
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

    <script src="http://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>

    <script>

        var CKEditorIsi = CKEDITOR.replace('CKEditorIsi');

    </script>
@endpush
