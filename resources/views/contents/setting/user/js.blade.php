@push('extraScript')
    {{-- Reset --}}
    <script>
        $('#user-modal').on('hidden.bs.modal', function() {
            $('input.form-control').val('');
            $('textarea.form-control').val('');
            $('select').val('').change();
            $('input[name="_method"]').prop('disabled', true);
            $('#id').val('');
            $('#selectIsAktif').val('').change();
            resetValidasiForm();
        });

    </script>

    {{-- Select2 --}}
    <script>
        $('#filterLevel').each(function() {
            $(this).select2({
                placeholder: 'Filter Level',
                dropdownParent: $(this).parent(),
                allowClear: true,
            });
        });

        $('#selectLevel').each(function() {
            $(this).select2({
                placeholder: 'Pilih Level',
                dropdownParent: $(this).parent(),
                allowClear: true,
            });
        });
    </script>

    {{-- JS Datatable --}}
    <script>
        const dataUser = () => {
            var filterLevel = $('#filterLevel').val();

            $('#data-table').DataTable({
                searchDelay: 500,
                destroy: true,
                bProcessing: true,
                bServerSide: true,

                responsive: true,
                ajax: {
                    url: route('user.datatable'),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        filterLevel: filterLevel
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
                    data: 'username',
                    name: 'username'
                }, {
                    data: 'name',
                    name: 'name'
                }, {
                    data: 'level',
                    name: 'level'
                },
                {
                    data: 'status',
                    name: 'status'
                },{
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }]
            });
        }

        dataUser();

        const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');

        filterSearch.addEventListener('keyup', function(e) {
            $('#data-table').DataTable().search(e.target.value).draw();
        });

        const cariData = () => {
            dataUser();
        }
    </script>

    {{-- JS Save Update --}}
    <script>
        $('#btn-tambah').on('click', function() {
            $('#user-modal').modal('show');
            $('.modal-title').text('Tambah Menu');
            resetButton('#btn-simpan', 'Simpan');
        });

        const edit = (id) => {
            $('#user-modal').modal('show');
            $('.modal-title').text('Edit Menu');

            $.ajax({
                url: route('user.edit', id),
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
                    $('input[name="username"]').val(data.response.username);
                    $('input[name="name"]').val(data.response.name);
                    $('input[name="email"]').val(data.response.email);
                    $('select[name="level"]').val(data.response.level).change();
                    $('select[name="status"]').val(data.response.status).change();
                    $('select[name="email"]').val(data.response.email).change();
                }
            })
        }

        $('#btn-simpan').on('click', function(e) {
            e.preventDefault();


            var data = $('#user-form').serialize();
            var id = $('#id').val();
            var url;
            var textBtn;
            if (id === '') {
                url = route('user.store');
                textBtn = 'Simpan';
            } else {
                url = route('user.update', id);
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
                    $('#user-modal').modal('hide');
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
                        url: route('user.destroy', id),
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
