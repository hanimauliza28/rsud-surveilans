@push('extraScript')

    {{-- JS Filter --}}
    <script>
        $(function() {
            $("#filterTanggal").datepicker({
                    "setDate": new Date(),
                    "format" : "yyyy-mm-dd",
                    "autoclose": true
            });
        });

        const filterSearch = document.querySelector('[data-kt-docs-table-filter="search"]');

        filterSearch.addEventListener('keyup', function (e) {
            cariDataFilter();
        });


        const cariDataFilter = () => {
            var filterTanggal = $('#filterTanggal').val() ?? '';
            var filterKeyword = $('#filterKeyword').val() ?? '';

            Livewire.emitTo('indikator-mutu-nasional.manajemen', 'cariHasilImut', {filterKeyword : filterKeyword, filterTanggal : filterTanggal })

        }

    </script>
@endpush
