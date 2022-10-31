@push('extraScript')
    <script>
        const checkDataPasien = () => {
            var pasienNama = $('#dataPasienNama').val() ? 1 : 0;
            var pasienNorm = $('#dataPasienNorm').val() ? 1 : 0;
            var pasienBagian = $('#dataPasienBagian').val() ? 1 : 0;
            var pasienKdbagian = $('#dataPasienKdbagian').val() ? 1 : 0;
            var pasienNoreg = $('#dataPasienNoreg').val() ? 1 : 0;

            var hasil = pasienNama + pasienNorm + pasienBagian + pasienKdbagian + pasienNoreg;

            return hasil;
        }

        const reloadForm = () => {
            var noReg = $('#dataPasienNoreg').val();
            var filterImut = $('#daftarImutNasional').val();

            Livewire.emitTo('monitoring.nasional.modul', 'cariImut', {
                filterImut: filterImut,
                noReg: noReg
            });
        }
    </script>
@endpush
