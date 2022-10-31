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


        $('#filterBagian').select2({
            placeholder: 'Pilih Bagian',
            width: 'resolve'
        });


        $('#filterRawat').select2({
            placeholder: 'Pilih Status Rawat',
            width: 'resolve'
        });

        const cariData = () => {
            var filterTanggal = moment($('#filterTanggal').val(), 'DD\MM\YYYY').format("YYYY-MM-DD");
            var filterKeyword = $('#filterKeyword').val();
            var filterBagian = $('#filterBagian').val();

            Livewire.emitTo('monitoring.filter-data-pasien-rawat-jalan', 'cariDataPasien', {
                filterKeyword: filterKeyword,
                filterTanggal: filterTanggal,
                filterBagian: filterBagian,
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

            console.log(noReg, filterImut);

            Livewire.emitTo('monitoring.nasional.modul', 'cariImut', {
                filterImut: filterImut,
                noReg: noReg
            });
        }
    </script>
@endpush
