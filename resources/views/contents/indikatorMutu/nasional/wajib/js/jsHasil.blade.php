@push('extraScript')
    <script>
    $("#filterTanggal").daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            locale: {
                format: 'YYYY-MM-DD'
            },
            maxYear: parseInt(moment().format("YYYY"), 10)
        });

        const dataHasilSurvey = () => {
            var filterTanggal = $('#filterTanggal').val();
            var filterIndikatorMutu = '{{ $indikatorMutuId }}';

            $('#data-table').DataTable({
                searchDelay: 500,
                destroy: true,
                bProcessing: true,
                bServerSide: true,
                responsive: true,
                ajax: {
                    url: route('indikator-mutu-nasional-hasil.datatable'),
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        filterTanggal: filterTanggal,
                        filterIndikatorMutu: filterIndikatorMutu
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
                    data: 'object.nama_pasien',
                    name: 'object.nama_pasien'
                }, {
                    data: 'object.nama_bagian',
                    name: 'object.nama_bagian'
                }, {
                    data: 'numerator',
                    name: 'numerator'
                }, {
                    data: 'denumerator',
                    name: 'denumerator'
                }, {
                    data: 'score',
                    name: 'score'
                }, {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }]
            });
        }

        dataHasilSurvey();

        const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');

        filterSearch.addEventListener('keyup', function(e) {
            $('#data-table').DataTable().search(e.target.value).draw();
        });

        const cariData = () => {
            dataHasilSurvey();
        }
    </script>
@endpush
