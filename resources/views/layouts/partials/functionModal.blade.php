
@push('extraScript')

    <script>
        const resetValidasiForm = () => {
            $('input.form-control').removeClass('is-invalid');
            $('select.form-select').removeClass('is-invalid');
            $('textarea.form-control').removeClass('is-invalid');
            $('.invalid-feedback').empty();
        }

        const resetForm = () => {
            $('select.form-select').val('').change();
            $('input.form-control').val('');
            $('textarea.form-control').val('');
        }

        const resetButton = (btnId, btnText) => {
            $(btnId).removeAttr("data-kt-indicator");
            $(btnId + '-text').text(btnText);
        }

        const loadingModal = () => {
            $(".modal-body-layer").addClass("overlay overlay-block");
            $('.modal-overlay-layer').show();
            $('.modal-content-layer').hide();
        }
        const resetLoadingModal = () => {
            $(".modal-body-layer").removeClass("overlay overlay-block");
            $('.modal-overlay-layer').hide();
            $('.modal-content-layer').show();
        }

        openModal = (namaModal, titleModal) => {
            loadingModal();
            $('.modal-title').text(titleModal);
            $('#' + namaModal).modal('show');
        }

        closeModal = (namaModal, titleModal) => {
            $('.modal-title').text(titleModal);
            $('#' + namaModal).modal('hide');
            resetValidasiForm();
            $('.notifyPack').hide()
        }

    </script>

@endpush
