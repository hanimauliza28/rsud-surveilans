@push('extraScript')
    {{-- Reset --}}
    <script>
        $('#indikator-mutu-lokal-modal').on('hidden.bs.modal', function() {
            $('input.form-control').val('');
            $('#jenis').val('lokal');
            $('textarea.form-control').val('');
            $('select.form-select').val('').change();
            $('input[name="_method"]').prop('disabled', true);
            $('#id').val('');
            $('#selectIsAktif').val('').change();
            resetValidasiForm();
            CKEditorJudulIndikator.setData('');
            CKEditorDefinisiOperasional.setData('');
        });

        const resetValidasiForm = () => {
            $('input.form-control').removeClass('is-invalid');
            $('select.form-select').removeClass('is-invalid');
            $('.invalid-feedback').empty();
        }

        const resetButton = (btnId ,btnText) => {
            $(btnId).removeAttr("data-kt-indicator");
            $(btnId+'-text').text(btnText);
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
        const dataImutLokal = () => {
            $('#data-table').DataTable({
                searchDelay : 500,
                destroy: true,
                bProcessing: true,
                bServerSide: true,
                responsive: true,
                ajax: {
                    url     : route('indikator-mutu-lokal.datatable'),
                    type    : 'POST',
                    data    : {
                        _token  : '{{ csrf_token() }}'
                    }
                },
                "fnCreatedRow": function (row, data, index) {
                    $('td', row).eq(0).html(index + 1);
                },
                columns: [
                    { data: null, orderable: false, searchable: false},
                    { data: 'kategori.nama_kategori', name: 'kategori.nama_kategori' },
                    { data: 'judul', name: 'judul' },
                    { data: 'sumber_data', name: 'sumber_data' },
                    { data: 'tipe.nama_tipe', name: 'tipe.nama_tipe' },
                    { data: 'area_monitoring', name: 'area_monitoring' },
                    { data: 'frekuensi.nama_frekuensi', name: 'frekuensi.nama_frekuensi' },
                    { data: 'standar', name: 'standar' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, class:'text-center'}
                ]
            });
        }

        dataImutLokal();

        const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');

        filterSearch.addEventListener('keyup', function (e) {
            delay(function(){
                $('#data-table').DataTable().search(e.target.value).draw();
            },500);
        });
    </script>

    {{-- JS Save Update --}}
    <script>
        $('#btn-tambah').on('click',function(){
            $('#indikator-mutu-lokal-modal').modal('show');
            $('.modal-title').text('Tambah Indikator Mutu');
            resetButton('#btn-simpan', 'Simpan');
        });

        const edit = (id) => {
            $('#indikator-mutu-lokal-modal').modal('show');
            $('.modal-title').text('Edit Indikator Mutu');

            $.ajax({
                url : route('indikator-mutu-lokal.edit', id),
                type : 'GET',
                dataType : 'JSON',
                beforeSend : function (data) {
                    loadingModal();
                    $('#btn-simpan').attr("data-kt-indicator", "on");
                },
                success     : function (data) {
                    resetButton('#btn-simpan', 'Ubah');
                    resetLoadingModal();

                    $('#id').val(id);
                    $('input[name="_method"]').prop('disabled', false);
                    $('select[name="kategoriIndikator"]').val(data.response.kategori_indikator_id).change();
                    //$('textarea[name="judulIndikator"]').val(data.response.judul);
                    //$('textarea[name="definisiOperasional"]').val(data.response.definisi_operasional);
                    $('textarea[name="kriteriaInklusi"]').val(data.response.kriteria_inklusi);
                    $('textarea[name="kriteriaEksklusi"]').val(data.response.kriteria_eksklusi);
                    $('input[name="sumberData"]').val(data.response.sumber_data);
                    $('input[name="areaMonitoring"]').val(data.response.area_monitoring);
                    $('select[name="tipeIndikator"]').val(data.response.tipe_indikator_id).change();
                    $('select[name="frekuensi"]').val(data.response.frekuensi_id).change();
                    $('input[name="standar"]').val(data.response.standar);
                    $('input[name="faktorPengali"]').val(data.response.faktor_pengali);
                    $('input[name="satuan"]').val(data.response.satuan);
                    //CKEditorFunc('edit', data.response.judul, data.response.definisi_operasional);
                    CKEditorJudulIndikator.setData(data.response.judul);
                    CKEditorDefinisiOperasional.setData(data.response.definisi_operasional);

                }
            })
        }

        $('#btn-simpan').on('click', function(e) {
            e.preventDefault();

            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }

            //var judulIndikator = CKEditorJudulIndikator.getData();
            //var definisiOperasional = CKEditorDefinisiOperasional.getData();
            var data = $('#form-indikator-mutu-lokal').serialize();
            var id = $('#id').val();
            var url;
            var textBtn;
            if (id === '') {
                url = route('indikator-mutu-lokal.store');
                textBtn = 'Simpan';
            } else {
                url = route('indikator-mutu-lokal.update', id);
                textBtn = 'Ubah';
            }

            $.ajax({
                url : url,
                type : 'POST',
                data : data,
                beforeSend : function (data) {
                    $('#btn-simpan').attr("data-kt-indicator", "on");
                },
                success : function (data) {
                    $('#indikator-mutu-lokal-modal').modal('hide');
                    resetButton('#btn-simpan', textBtn);
                    Swal.fire({
                        icon : "success",
                        title : "Selamat!",
                        text : data.message,
                        padding : '2em',
                        timer : 3000
                    }).then($('#data-table').DataTable().ajax.reload(null, false))
                },
                error : function (data) {
                    resetValidasiForm();
                    resetButton('#btn-simpan', textBtn);
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
        const hapus = (id) => {
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
                        url : route('indikator-mutu-lokal.destroy', id) ,
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
                            }).then($('#data-table').DataTable().ajax.reload(null, false))
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

    <script>
        const detail = (id) => {
            $('#detail-modal').modal('show');
            $('.modal-title').text('Detail Indikator Mutu');

            $.ajax({
                url : route('indikator-mutu-lokal.view', id) ,
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
                    $('#detail-kode-frekuensi').html(data.response-frekuensi.kode_frekuensi);
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

        {{-- SELECT2 --}}
    <script>
        $('#selectKategori').each(function () {
            $(this).select2({
                placeholder :'Pilih Kategori Indikator',
                dropdownParent:  $(this).parent(),
                allowClear: true,
            });
        });

        $('#selectTipe').each(function () {
            $(this).select2({
                placeholder :'Pilih Tipe Indikator',
                dropdownParent:  $(this).parent(),
                allowClear: true,
            });
        });

        $('#selectFrekuensi').each(function () {
            $(this).select2({
                placeholder :'Pilih Frekuensi',
                dropdownParent:  $(this).parent(),
                allowClear: true,
            });
        });
    </script>

    <script src="http://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>

    <script>

        var CKEditorJudulIndikator = CKEDITOR.replace('CKEditorJudulIndikator');
        var CKEditorDefinisiOperasional = CKEDITOR.replace('CKEditorDefinisiOperasional');

    </script>
@endpush
