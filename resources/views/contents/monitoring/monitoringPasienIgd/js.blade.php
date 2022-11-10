@push('extraScript')
    <script>
        $("#filterTanggal").daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            minYear: 1901,
            locale: {
                format: 'DD/MM/YYYY'
            },
            maxYear: parseInt(moment().format("YYYY"), 10)
        });

        const cariData = () => {
            var filterTanggal = moment($('#filterTanggal').val(), 'DD\MM\YYYY').format("YYYY-MM-DD");
            var filterKeyword = $('#filterKeyword').val();

            Livewire.emitTo('monitoring.filter-data-pasien-igd', 'cariDataPasien', {
                filterKeyword: filterKeyword,
                filterTanggal: filterTanggal,
            })
        }

         const survey = (noreg, filterImut) => {
            var namapasien = $('#' + noreg + '').data('namapasien');
            var norm = $('#' + noreg + '').data('norm');
            var bagian = $('#' + noreg + '').data('bagian');
            var kdbagian = $('#' + noreg + '').data('kdbagian');

            $('#dataPasienNama').val(namapasien);
            $('#dataPasienNorm').val(norm);
            $('#dataPasienBagian').val(bagian);
            $('#dataPasienKdbagian').val(kdbagian);
            $('#dataPasienNoreg').val(noreg);

            var noReg = $('#dataPasienNoreg').val();
            var filterImut = filterImut ?? "kepatuhan-identifikasi";

            //delete active class
            $('.nav-link').removeClass('active');
            $('.'+filterImut).addClass('active');


            Livewire.emitTo('monitoring.nasional.modul', 'cariImut', {
                filterImut: filterImut,
                noReg: noReg
            });

        }

        const tab = (filterImut) => {
            var noReg = $('#dataPasienNoreg').val();

            //delete active class
            $('.nav-link').removeClass('active');
            $('.'+filterImut).addClass('active');
            Livewire.emitTo('monitoring.nasional.modul', 'cariImut', {
                filterImut: filterImut,
                noReg: noReg
            });
        }

    </script>
@endpush
