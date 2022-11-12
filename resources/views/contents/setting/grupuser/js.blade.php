@push('extraScript')
    {{-- Reset --}}
    <script>

        $('#selectKdGrupBagian').each(function() {
            $(this).select2({
                placeholder: 'Pilih Grup Bagian',
                dropdownParent: $(this).parent(),
                allowClear: true,
            });
        });

        $('#selectKdBagian').each(function() {
            $(this).select2({
                placeholder: 'Pilih Bagian',
                dropdownParent: $(this).parent(),
                allowClear: true,
            });
        });

        $('#grup-user-modal').on('hidden.bs.modal', function() {
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
        const dataGrupUser = () => {
            $('#data-table').DataTable({
                searchDelay: 500,
                destroy: true,
                bProcessing: true,
                bServerSide: true,
                responsive: true,
                ajax: {
                    url: route('grup-user.datatable'),
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
                }, {
                    data: 'nama_grup',
                    name: 'nama_grup'
                }, {
                    data: 'grup_bagian',
                    name: 'grup_bagian'
                }, {
                    data: 'nama_bagian',
                    name: 'nama_bagian'
                }, {
                    data: 'action',
                    name: 'action',
                    'class' : 'text-center center',
                    orderable: false,
                    searchable: false
                }]
            });
        }

        dataGrupUser();

        const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');

        filterSearch.addEventListener('keyup', function(e) {
            $('#data-table').DataTable().search(e.target.value).draw();
        });

        const cariData = () => {
            dataGrupUser();
        }
    </script>

    {{-- JS Save Update --}}
    <script>
        $('#btn-tambah').on('click', function() {
            $('#grup-user-modal').modal('show');
            $('.modal-title').text('Tambah Grup User');
            resetButton('#btn-simpan', 'Simpan');
        });

        const edit = (id) => {
            $('#grup-user-modal').modal('show');
            $('.modal-title').text('Edit Grup User');

            $.ajax({
                url: route('grup-user.edit', id),
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
                    $('input[name="namaGrup"]').val(data.response.nama_grup);
                    $('select[name="kdGrupBagian"]').val(data.response.kd_grup_bagian).change();
                    $('select[name="kdBagian"]').val(data.response.kd_bagian).change();
                }
            })
        }

        $('#btn-simpan').on('click', function(e) {
            e.preventDefault();


            var data = $('#grup-user-form').serialize();
            var id = $('#id').val();
            var url;
            var textBtn;
            if (id === '') {
                url = route('grup-user.store');
                textBtn = 'Simpan';
            } else {
                url = route('grup-user.update', id);
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
                    $('#grup-user-modal').modal('hide');
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
                        url: route('grup-user.destroy', id),
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

        $('#selectKdGrupBagian').on('change', function(e) {
            var kdgrupbagian = this.value;
            $.ajax({
                url: route('grup-user.pilihan-bagian'),
                type: 'POST',
                dataType : 'JSON',
                data: {
                    _method: 'POST',
                    _token: '{!! csrf_token() !!}',
                    kdgrupbagian : kdgrupbagian
                },
                beforeSend: function(){
                    $('#selectKdBagian').find('option')
                        .remove()
                        .end()
                        .append('<option value="">Mencari Bagian...</option>')
                        .val('')
                },
                success: function(data) {
                    let bagian = data.response;
                    $.each(bagian, function (key, entry) {
                        $('#selectKdBagian').append($('<option></option>').attr('value', entry.KDBAGIAN).text(entry.NAMABAGIAN));
                    });
                },
                error : function(data){
                     $('#selectKdBagian').find('option')
                        .remove()
                        .end()
                        .append('<option value="">Tidak Ada Bagian</option>')
                        .val('')
                }

            });
        });
    </script>
@endpush
