<div class="modal fade" id="variabel-survey-modal" role="dialog" aria-labelledby="Modal" aria-hidden="true">
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
                <form id="variabel-survey-form" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="id" value="" name="id">
                    <input type="hidden" name="_method" value="PUT" disabled>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-5 fw-bold">Nama Variabel</label>
                        <input type="text" class="form-control" onkeyup="nospaces(this)" name="namaVariabel" placeholder="Nama Variabel" />
                        <small class="mt-3">Tulis Menggunaan Camel Case Tanpa Spasi dan Simbol</small>
                        <div class="invalid-feedback" id="namaVariabel"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-5 fw-bold">Nama</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama" />
                        <div class="invalid-feedback" id="nama"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-5 fw-bold">Keterangan</label>
                        <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" />
                        <div class="invalid-feedback" id="keterangan"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-left fs-5 fw-bold">Kategori Variabel Survey</label>
                        <select name="kategoriVariabelSurvey" id="selectKategoriVariabelSurvey" data-control="select2" tab-index="89" data-placeholder="Pilih Variabel Survey" class="form-select" data-allow-clear="true">
                            <option value=""></option>
                            @foreach ($kategoriVariabelSurvey as $kategori)
                            <option value="{{ $kategori->id }}">{{ $kategori->keterangan }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="kategoriVariabelSurvey"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-left fs-5 fw-bold">Variabel Survey Induk</label>
                        <select name="parentId" id="selectParentid" data-control="select2" tab-index="89" data-placeholder="Pilih Variabel Survey Induk" class="form-select" data-allow-clear="true">
                            <option value=""></option>
                            @foreach ($variabelSurveyParent as $parent)
                            <option value="{{ $parent->id }}">{{ $parent->nama }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="parentId"></div>
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
