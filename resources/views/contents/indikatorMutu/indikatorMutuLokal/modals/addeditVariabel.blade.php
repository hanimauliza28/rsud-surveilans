<div class="modal fade" id="variabel-modal" role="dialog" aria-labelledby="Modal" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
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
                <div class="row">
                    <div class="col-5">
                         <form id="form-variabel" method="POST">
                            {{ csrf_field() }}
                            <input type="hidden" id="variabelId" value="" name="variabelId">
                            <input type="hidden" id="indikatorId" value="" name="indikatorId">
                            <input type="hidden" id="jenis" value="lokal" name="jenis">
                            <input type="hidden" name="_method" value="PUT" disabled>

                            <div class="form-group">
                                <label class="col-form-label text-left required fs-5 fw-bold">Tipe Variabel</label>
                                    <select class="form-select form-select-solid" name="tipeVariabel" id="selectVariabel" data-control="select2" tab-index="101" data-placeholder="Pilih Kategori Indikator" class="form-select" data-allow-clear="true">
                                        <option value=""></option>
                                        @foreach ($tipeVariabel as $tipeVariabel)
                                            <option value="{{ $tipeVariabel['value'] }}">{{ $tipeVariabel['text'] }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback" id="tipeVariabel"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label text-left required fs-5 fw-bold">Indikator</label>
                                <textarea class="form-control form-control-solid " name="indikatorVariabel" placeholder="Indikator" ></textarea>
                                <div class="invalid-feedback" id="indikatorVariabel"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-form-label text-left required fs-5 fw-bold">Satuan</label>
                                <input type="text" class="form-control form-control-solid" name="satuanVariabel" placeholder="Satuan"/>
                                <div class="invalid-feedback" id="satuanVariabel"></div>
                            </div>

                            <button type="submit" id="btn-simpan-variabel" class="btn btn-sm btn-primary mt-5" ><i class="fas fa-save"></i>
                                <span id="btn-simpan-variabel-text" class="indicator-label">
                                    Simpan
                                </span>
                                <span class="indicator-progress">
                                    Mohon Tunggu... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>

                        </form>
                    </div>
                    <div class="col-7 ps-2">

                        <!--begin::Datatable-->
                        <table id="data-variabel-table" class="table align-middle table-row-dashed fs-6 gy-5">
                            <thead>
                                <tr class="text-start fw-bolder fs-7 text-uppercase gs-0">
                                    <th>No</th>
                                    <th>Tipe</th>
                                    <th>Indikator</th>
                                    <th>Satuan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 fw-bold">
                            </tbody>
                        </table>
                        <!--end::Datatable-->

                    </div>
                </div>

                <!--begin::Overlay Layer-->
                <div class="modal-overlay-layer overlay-layer bg-dark bg-opacity-5" style="display: none">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <!--end::Overlay Layer-->
            </div>
            <div class="modal-footer">
                {{-- <button type="submit" id="btn-simpan-variabel" class="btn btn-primary"><i class="fas fa-save"></i>
                    <span id="btn-simpan-variabel-text" class="indicator-label">
                        Simpan
                    </span>
                    <span class="indicator-progress">
                        Mohon Tunggu... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button> --}}
                <button class="btn btn-light me-3" data-bs-dismiss="modal"><i class="fas fa-times"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>
