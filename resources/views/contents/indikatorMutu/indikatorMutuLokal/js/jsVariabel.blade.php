@push('extraScript')
    <script>

    </script>

    {{-- Reset --}}
    <script>
        $('#variabel-modal').on('hidden.bs.modal', function() {
            resetFormVariabel();
            resetValidasiFormVariabel();
        });

        const resetFormVariabel = () => {
            $('input.form-control').val('');
            $('textarea.form-control').val('');
            $('select').val('').change();
            $('input[name="_method"]').prop('disabled', true);
            $('#id').val('');
        }

        const resetValidasiFormVariabel = () => {
            $('input.form-control').removeClass('is-invalid');
            $('select.form-select').removeClass('is-invalid');
            $('.invalid-feedback').empty();
        }

        const resetButtonVariabel = (btnId ,btnText) => {
            $(btnId).removeAttr("data-kt-indicator");
            $(btnId+'-text').text(btnText);
        }
        const loadingModalVariabel = () => {
            $(".modal-body-layer").addClass("overlay overlay-block");
            $('.modal-overlay-layer').show();
            $('.modal-content-layer').hide();
        }
        const resetLoadingModalVariabel = () => {
            $(".modal-body-layer").removeClass("overlay overlay-block");
            $('.modal-overlay-layer').hide();
            $('.modal-content-layer').show();
        }
    </script>

    {{-- JS Datatable --}}
    <script>
        const dataImutLokalVariabel = (indikatorId) => {
            $('#data-variabel-table').DataTable({
                searchDelay : 500,
                destroy: true,
                bProcessing: true,
                bServerSide: true,
                responsive: true,
                ajax: {
                    url     : route('variabel.datatable'),
                    type    : 'POST',
                    data    : {
                        _token  : '{{ csrf_token() }}',
                        indikatorId : indikatorId
                    }
                },
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                },
                columns: [
                    { data: null, orderable: false, searchable: false},
                    { data: 'tipeVariabelIndikator', name: 'tipeVariabelIndikator' },
                    { data: 'indikator', name: 'indikator' },
                    { data: 'satuan', name: 'satuan' },
                    { data: 'action', name: 'action' },
                ]
            });
        }

    </script>

    {{-- JS Save Update --}}
    <script>
        const variabel = (indikatorId, id) => {
            $('#variabel-modal').modal('show');
            $('.modal-title').text('Tambah Variabel');
            $('input[name="indikatorId"]').val(indikatorId);
            resetButtonVariabel('#btn-simpan-variabel', 'Simpan');
            dataImutLokalVariabel(indikatorId);

        }

        const editVariabel = (id) => {
            $.ajax({
                url : route('variabel.edit', id),
                type : 'GET',
                dataType : 'JSON',
                beforeSend : function (data) {
                    loadingModalVariabel();
                    $('#btn-simpan-variabel').attr("data-kt-indicator", "on");
                },
                success     : function (data) {
                    resetButtonVariabel('#btn-simpan-variabel', 'Ubah');
                    resetLoadingModalVariabel();

                    $('#variabelId').val(id);
                    $('#indikatorId').val(data.response.indikator_mutu_id);
                    $('input[name="_method"]').prop('disabled', false);
                    $('select[name="tipeVariabel"]').val(data.response.tipe_variabel).change();
                    $('textarea[name="indikatorVariabel"]').val(data.response.indikator);
                    $('input[name="satuanVariabel"]').val(data.response.satuan);

                }
            })
        }

        $('#btn-simpan-variabel').on('click', function(e) {
            e.preventDefault();

            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }

            //var judulIndikator = CKEditorJudulIndikator.getData();
            //var definisiOperasional = CKEditorDefinisiOperasional.getData();
            var data = $('#form-variabel').serialize();
            var id = $('#variabelId').val();
            var url;
            var textBtn;
            if (id === '') {
                url = route('variabel.store');
                textBtn = 'Simpan';
            } else {
                url = route('variabel.update', id);
                textBtn = 'Ubah';
            }

            $.ajax({
                url : url,
                type : 'POST',
                data : data,
                beforeSend : function (data) {
                    $('#btn-simpan-variabel').attr("data-kt-indicator", "on");
                },
                success : function (data) {
                    //$('#variabel-modal').modal('hide');
                    resetFormVariabel();
                    resetButtonVariabel('#btn-simpan-variabel', textBtn);
                    Swal.fire({
                        icon : "success",
                        title : "Selamat!",
                        text : data.message,
                        padding : '2em',
                        timer : 3000
                    }).then($('#data-variabel-table').DataTable().ajax.reload(null, false))
                },
                error : function (data) {
                    resetValidasiFormVariabel();
                    resetButtonVariabel('#btn-simpan-variabel', textBtn);
                    if (data.status === 422) {
                        for(const [key, value] of Object.entries(data.responseJSON.response)){
                            $('input[name="'+key+'"]').addClass('is-invalid');
                            $('select[name="'+key+'"]').addClass('is-invalid');
                            $('#'+key).append(value);
                        }
                    }
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
                    }
                }
            })
        });
    </script>

    {{-- JS Action --}}
    <script>
        const hapusVariabel = (id) => {
            Swal.fire({
                icon : 'warning',
                title : 'Apakah anda yakin?',
                text : "Setelah dihapus, Anda tidak akan dapat memulihkan data ini!",
                showCancelButton: true,
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url : route('variabel.destroy', id) ,
                        type : 'POST',
                        data : {
                            _method : 'DELETE',
                            _token : '{!! csrf_token() !!}'
                        },
                        success : function () {
                            Swal.fire({
                                title : 'Berhasil!',
                                text : 'Data berhasil dihapus',
                                icon : 'success',
                                padding : '2em',
                                timer : 1500,
                            }).then($('#data-variabel-table').DataTable().ajax.reload(null, false))
                        },
                        error : function (data) {
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
                            }
                        }
                    })
                }
            });
        }
    </script>
@endpush
