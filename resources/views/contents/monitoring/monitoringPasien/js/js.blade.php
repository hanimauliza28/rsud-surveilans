@push('extraScript')
    {{-- SELECT --}}
    <script>
        $('#filterServicePasien').select2({
            placeholder: 'Pilih Service Pasien',
            width: 'resolve'
        });

        $('#filterBagian').select2({
            placeholder: 'Pilih Bagian',
            width: 'resolve'
        });


        $('#daftarImutNasional').select2({
            placeholder: 'Pilih Indikator Mutu Nasional',
            width: 'resolve'
        });

        $("#daftarImutNasional").on("select2:select", function(e) {
            var noReg = $('#dataPasienNoreg').val();

            Livewire.emitTo('monitoring.nasional.modul', 'cariImut', {
                filterImut: e.params.data.id,
                noReg: noReg
            });

        });

        $("#filterServicePasien").on("select2:select", function(e) {
            var filterServicePasien = $('#filterServicePasien').val();

            $.ajax({
                url: '{{ route('monitoring-pasien.filter-bagian') }}',
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: filterServicePasien
                },
                success: function(response) {
                    $('#filterBagian').html('<option val=""></option>');

                    $.each(response.response, function(key, value) {
                        $("#filterBagian").append('<option value=' + value.KDBAGIAN + '>' +
                            value.NAMABAGIAN + '</option>');
                    });
                }
            });
        });
    </script>

    {{-- Filter Tanggal --}}
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
            var filterServicePasien = $('#filterServicePasien').val();
            var filterKeyword = $('#filterKeyword').val();
            var filterBagian = $('#filterBagian').val();


            Livewire.emitTo('monitoring.monitoring-pasien.filter-data-pasien', 'cariDataPasien', {
                filterServicePasien: filterServicePasien,
                filterKeyword: filterKeyword,
                filterTanggal: filterTanggal,
                filterBagian: filterBagian
            })
        }

        const survey = (noreg) => {
            var namapasien = $('#' + noreg + '').data('namapasien');
            var norm = $('#' + noreg + '').data('norm');
            var bagian = $('#' + noreg + '').data('bagian');
            var kdbagian = $('#' + noreg + '').data('kdbagian');
            var imut = $('#daftarImutNasional').val();

            $('#dataPasienNama').val(namapasien);
            $('#dataPasienNorm').val(norm);
            $('#dataPasienBagian').val(bagian);
            $('#dataPasienKdbagian').val(kdbagian);
            $('#dataPasienNoreg').val(noreg);

            var noReg = $('#dataPasienNoreg').val();
            var filterImut = $('#daftarImutNasional').val();

            Livewire.emitTo('monitoring.nasional.modul', 'cariImut', {
                filterImut: filterImut,
                noReg: noReg
            });

        }

        const reloadForm = () => {
            var noReg = $('#dataPasienNoreg').val();
            var filterImut = $('#daftarImutNasional').val();

            Livewire.emitTo('monitoring.nasional.modul', 'cariImut', {
                filterImut: filterImut,
                noReg: noReg
            });
        }

        const checkDataPasien = () => {
            var pasienNama = $('#dataPasienNama').val() ? 1 : 0;
            var pasienNorm = $('#dataPasienNorm').val() ? 1 : 0;
            var pasienBagian = $('#dataPasienBagian').val() ? 1 : 0;
            var pasienKdbagian = $('#dataPasienKdbagian').val() ? 1 : 0;
            var pasienNoreg = $('#dataPasienNoreg').val() ? 1 : 0;

            var hasil = pasienNama + pasienNorm + pasienBagian + pasienKdbagian + pasienNoreg;

            return hasil;

        }
    </script>
@endpush
