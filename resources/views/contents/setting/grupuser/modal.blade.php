<div class="modal fade" id="grup-user-modal" role="dialog" aria-labelledby="Modal" aria-hidden="true">
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
                <form id="grup-user-form" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="id" value="" name="id">
                    <input type="hidden" name="_method" value="PUT" disabled>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-6 fw-bold">Nama Grup User</label>
                        <input type="text" class="form-control" name="namaGrup" placeholder="Nama Grup User" />
                        <div class="invalid-feedback" id="namaGrup"></div>
                    </div>


                    <div class="form-group">
                        <label class="col-form-label text-left required fs-6 fw-bold">Grup Bagian</label>
                        <select name="kdGrupBagian" id="selectKdGrupBagian" data-placeholder="Pilih Grup Bagian" class="form-select">
                            <option value=""></option>
                            @foreach ($grupBagian as $grup)
                            <option value="{{ $grup->GRPUNIT }}">{{ $grup->NMGUNIT }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="kdGrupBagian"></div>
                    </div>


                    <div class="form-group">
                        <label class="col-form-label text-left required fs-6 fw-bold">Pilih Bagian</label>
                        <select name="kdBagian" id="selectKdBagian" data-placeholder="Pilih Bagian" class="form-select">
                            <option value=""></option>

                        </select>
                        <div class="invalid-feedback" id="kdBagian"></div>
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
