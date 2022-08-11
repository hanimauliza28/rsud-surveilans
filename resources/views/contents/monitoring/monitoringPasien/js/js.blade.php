@push('extraScript')
{{-- SELECT --}}
<script>
    $('#filterServicePasien').select2({
        placeholder: 'Pilih Service Pasien'
        , width: 'resolve'
    });


    $('#daftarImutNasioanal').select2({
        placeholder: 'Pilih Indikator Mutu Nasional'
        , width: 'resolve'
    });

</script>

{{-- Filter Tanggal --}}
<script>
    var start = moment().subtract(29, "days");
    var end = moment();

    function cb(start, end) {
        $("#filterTanggal").html(start.format("D/MMMM/YYYY") + " - " + end.format("D/MMMM/YYYY"));
    }

    $("#filterTanggal").daterangepicker({
        startDate: start
        , endDate: end
        , locale: {
            format: "DD/MM/YYYY"
        }
        , ranges: {
            "Today": [moment(), moment()]
            , "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")]
            , "Last 7 Days": [moment().subtract(6, "days"), moment()]
            , "Last 30 Days": [moment().subtract(29, "days"), moment()]
            , "This Month": [moment().startOf("month"), moment().endOf("month")]
            , "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
        }
    }, cb);
    cb(start, end);

    const cariData = () => {
        var filterTanggal = $('#filterTanggal').val();
        var filterServicePasien = $('#filterServicePasien').val();
        var filterKeyword = $('#filterKeyword').val();

        Livewire.emitTo('monitoring.monitoring-pasien.filter-data-pasien', 'cariDataPasien', {filterServicePasien : filterServicePasien, filterKeyword : filterKeyword, filterTanggal : filterTanggal })
    }

    const survey = (noreg) => {
        alert(noreg);
    }

</script>


@endpush
