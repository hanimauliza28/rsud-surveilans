<div class="modal fade" id="setting-menu-modal" role="dialog" aria-labelledby="Modal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
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
                <form id="setting-menu-form" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="id" value="" name="id">
                    <input type="hidden" name="_method" value="PUT" disabled>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-6 fw-bold">Nama Menu</label>
                        <input type="text" class="form-control" name="namaMenu" placeholder="Nama Menu" />
                        <div class="invalid-feedback" id="namaMenu"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-6 fw-bold">Route</label>
                        <input type="text" class="form-control" onkeyup="nospaces(this)" name="url" placeholder="Example : dashboard.index" />
                        <div class="invalid-feedback" id="url"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-6 fw-bold">Icon</label>
                        <input type="text" class="form-control" name="icon" placeholder="Example : fa fa-home. Fontawesome etc" />
                        <div class="invalid-feedback" id="icon"></div>
                    </div>


                    <div class="form-group">
                        <label class="col-form-label text-left required fs-6 fw-bold">Parent Menu</label>
                        <select name="parentMenu" id="selectParent" data-control="select2" tab-index="89" data-placeholder="Pilih Menu Parent" class="form-select" data-allow-clear="true">
                            <option value=""></option>
                            @foreach ($listMenu as $menu)
                            <option value="{{ $menu->id }}">{{ $menu->nama_menu }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="parentMenu"></div>
                    </div>


                    <div class="form-group">
                        <label class="col-form-label text-left required fs-6 fw-bold">Jenis Menu Section</label>
                        <select name="sectionMenu" id="selectSectionMenu" data-control="select2" tab-index="89" data-placeholder="Jenis menu Section" class="form-select" data-allow-clear="true">
                            <option value=""></option>
                            <option value="Y">Ya</option>
                            <option value="N" selected="selected">Tidak</option>
                        </select>
                        <div class="invalid-feedback" id="sectionMenu"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-6 fw-bold">Status Menu</label>
                        <select name="status" id="selectStatus" data-control="select2" tab-index="89" data-placeholder="Status Menu" class="form-select" data-allow-clear="true">
                            <option value=""></option>
                            <option value="Y">Aktif</option>
                            <option value="N" selected="selected">Tidak Aktif</option>
                        </select>
                        <div class="invalid-feedback" id="status"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-6 fw-bold">No. Urut</label>
                        <input type="text" class="form-control" name="urut" placeholder="No. Urut" />
                        <div class="invalid-feedback" id="urut"></div>
                    </div>

                </form>

                <!--begin::Overlay Layer-->
                <div class="modal-overlay-layer overlay-layer bg-dark bg-opacity-5" style="display: none">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <!--end::Overlay Layer-->
            </div>
            <div class="modal-footer">
                <button type="submit" id="btn-simpan" class="btn btn-primary"><i class="fas fa-save"></i>
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
