<div class="modal fade" id="nilai-modal" role="dialog" aria-labelledby="Modal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header py-4">
                <h3 class="fw-bolder modal-title" id="modal-title">Modal Title</h3>
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <span class="svg-icon svg-icon-2x">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                        </svg>
                    </span>
                </div>
                <!--end::Close-->
            </div>
            <div class="modal-body-layer modal-body py-4 px-10">
                <form name="form-nilai" id="form-nilai" class="form-group" method="POST">
                {{ csrf_field() }}
                    <input type="hidden" name="nilaiImutId" value="">
                    <input type="hidden" name="nilaiHari" value="">
                    <input type="hidden" name="nilaiBulan" value="">
                    <input type="hidden" name="nilaiTahun" value="">

                    <table id="kt_datatable_example_2" class="table table-striped table-row-bordered gy-5 gs-7 fs-7 border rounded w-100">
                        <thead>
                            <tr class="fw-bolder fs-6 text-gray-800 px-7">
                                <th class="border-bottom">Indikator</th>
                                <th class="border-bottom">Nilai</th>
                                <th class="border-bottom">Satuan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="nilaiIndikatorNumerator"></td>
                                <td id="nilaiNumerator">
                                    <input type="text" class="form-control" name="numerator">
                                </td>
                                <td>Satuan</td>
                            </tr>
                            <tr>
                                <td id="nilaiIndikatorDenumerator"></td>
                                <td id="nilaiDenumerator">
                                    <input type="text" class="form-control" name="denumerator">
                                </td>
                                <td>Satuan</td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>

            <div class="modal-footer">
                <button type="submit" id="btn-simpan-nilai" class="btn btn-primary" ><i class="fas fa-save"></i>
                    <span id="btn-simpan-text" class="indicator-label">
                        Simpan
                    </span>
                    <span class="indicator-progress">
                        Mohon Tunggu... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
                <button class="btn btn-light me-3" data-bs-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>
