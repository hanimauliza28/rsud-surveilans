@push('extraScript')
    <script>
        var start = moment().subtract(29, "days");
        var end = moment();

        function cb(start, end) {
            $("#filterTanggal").html(start.format("D/MMMM/YYYY") + " - " + end.format("D/MMMM/YYYY"));
        }
        $("#filterTanggal").daterangepicker({
            startDate: start,
            endDate: end,
            locale: {
                format: "DD/MM/YYYY"
            },
            ranges: {
                "Today": [moment(), moment()],
                "Yesterday": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [moment().startOf("month"), moment().endOf("month")],
                "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf(
                    "month")]
            }
        }, cb);
        cb(start, end);


        const statistik = () => {
            var filterTanggal = $('#filterTanggal').val();

            $.ajax({
                url: route('registrasi-antrian-igd.statistik'),
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    filterTanggal : filterTanggal
                },
                beforeSend: function(data) {
                    $('#tampilanStatistik').html("<div class='d-flex justify-content-center'>" +
                        "  <div class='spinner-border text-danger' role='status'>" +
                        "   <span class='visually-hidden'>Loading...</span>" +
                        " </div>" +
                        "</div>")
                },
                success: function(data) {
                    $('#tampilanStatistik').html(data);
                },
                error: function(data) {
                    $('#tampilanStatistik').html("Gagal Memuat Statistik ... ");
                }
            })
        }

        statistik();
    </script>
@endpush
