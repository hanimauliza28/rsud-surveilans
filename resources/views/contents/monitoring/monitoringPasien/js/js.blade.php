@push('extraScript')
{{-- SELECT --}}
<script>
    $('#filterServicePasien').select2({
        placeholder: 'Pilih Service Pasien'
        , width: 'resolve'
    });


    $('#daftarImutNasional').select2({
        placeholder: 'Pilih Indikator Mutu Nasional'
        , width: 'resolve'
    });

    $("#daftarImutNasional").on("select2:select", function(e) {
        Livewire.emitTo('monitoring.nasional.modul', 'cariImut', {
            filterImut: e.params.data.id,
            noReg : ''
        });
    });

</script>

{{-- Filter Tanggal --}}
<script>

    $("#filterTanggal").daterangepicker({
        singleDatePicker: true
        , showDropdowns: true
        , minYear: 1901
        , locale: {
            format: 'DD/MM/YYYY'
        }
        , maxYear: parseInt(moment().format("YYYY"), 10)
    });

    const cariData = () => {
        var filterTanggal = moment($('#filterTanggal').val(), 'DD\MM\YYYY').format("YYYY-MM-DD");
        var filterServicePasien = $('#filterServicePasien').val();
        var filterKeyword = $('#filterKeyword').val();

        Livewire.emitTo('monitoring.monitoring-pasien.filter-data-pasien', 'cariDataPasien', {
            filterServicePasien: filterServicePasien
            , filterKeyword: filterKeyword
            , filterTanggal: filterTanggal
        })
    }

    const survey = (noreg) =>
    {
        var namapasien = $('#'+noreg+'').data('namapasien');
        var norm = $('#'+noreg+'').data('norm');
        var poli = $('#'+noreg+'').data('poli');

        $('#dataPasienNama').val(namapasien)
        $('#dataPasienNorm').val(norm)
        $('#dataPasienPoli').val(poli)
        $('#dataPasienNoreg').val(noreg)

    }
</script>


@endpush
