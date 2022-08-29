@push('extraScript')
{{-- SELECT --}}
<script>

    const checkAllItem = (id) => {
        $('.nama' + id).prop('checked', true)
        $('.tglLahir' + id).prop('checked', true)
        $('.nik' + id).prop('checked', true)
        $('.norm' + id).prop('checked', true)
    }

    const checkAll = () => {
        $('.checkIndikator').prop('checked', true)
    }

    const uncheckAll = () => {
        $('.checkIndikator').prop('checked', false)
    }


</script>

{{-- KHUSUS KEPATUHAN IDENTIFIKASI KODE KI --}}

<script>

</script>
@endpush
