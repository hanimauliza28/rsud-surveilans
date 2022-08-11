<div class="modal fade" id="indikator-mutu-lokal-modal" role="dialog" aria-labelledby="Modal" aria-hidden="true">
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
                <form id="form-indikator-mutu-lokal" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="id" value="" name="id">
                    <input type="hidden" name="_method" value="PUT" disabled>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-5 fw-bold">Kategori</label>
                        <select name="kategoriIndikator" id="selectKategori" class="form-select">
                            <option value=""></option>
                            @foreach ($kategoriIndikator as $kategoriIndikator)
                                <option value="{{ $kategoriIndikator->id }}">{{ $kategoriIndikator->nama_kategori }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="kategoriIndikator"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-5 fw-bold">Judul Indikator</label>
                        <textarea class="form-control" name="judulIndikator" id="CKEditorJudulIndikator" placeholder="Judul Indikator" ></textarea>
                        <div class="invalid-feedback" id="judulIndikator"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-5 fw-bold">Definisi Operasional</label>
                        {{-- <input type="text" class="form-control" name="definisiOperasional" placeholder="Definisi Operasional" /> --}}
                        <textarea class="form-control" name="definisiOperasional" id="CKEditorDefinisiOperasional" placeholder="Definisi Operasional"></textarea>
                        <div class="invalid-feedback" id="definisiOperasional"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-5 fw-bold">Nama Function</label>
                        <input type="text" class="form-control" name="namaRoute" placeholder="Nama Function" />
                        <small class="mt-2">Disarankan untuk tidak mengubah Nama Function</small>
                        <div class="invalid-feedback" id="namaRoute"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-5 fw-bold">Kriteria Inklusi</label>
                        <textarea class="form-control" name="kriteriaInklusi" placeholder="Kriteria Inklusi"></textarea>
                        <div class="invalid-feedback" id="kriteriaInklusi"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-5 fw-bold">Kriteria Eksklusi</label>
                        <textarea class="form-control" name="kriteriaEksklusi" placeholder="Kriteria Eksklusi"></textarea>
                        <div class="invalid-feedback" id="kriteriaEksklusi"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-5 fw-bold">Sumber Data</label>
                        <input type="text" class="form-control" name="sumberData" placeholder="Sumber Data" />
                        <div class="invalid-feedback" id="sumberData"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-5 fw-bold">Tipe Indikator</label>
                        <select name="tipeIndikator" id="selectTipe" class="form-select">
                            <option value=""></option>
                            @foreach ($tipeIndikator as $tipeIndikator)
                                <option value="{{ $tipeIndikator->id }}">{{ $tipeIndikator->nama_tipe }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="tipeIndikator"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-5 fw-bold">Area Monitoring</label>
                        <input type="text" class="form-control" name="areaMonitoring" placeholder="Area Monitoring" />
                        <div class="invalid-feedback" id="areaMonitoring"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-5 fw-bold">Frekuensi</label>
                        <select name="frekuensi" id="selectFrekuensi" class="form-select">
                            <option value=""></option>
                            @foreach ($frekuensi as $frekuensi)
                                <option value="{{ $frekuensi->id }}">{{ $frekuensi->nama_frekuensi }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="frekuensi"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-5 fw-bold">Standar</label>
                        <input type="text" class="form-control" name="standar" placeholder="Standar"/>
                        <div class="invalid-feedback" id="standar"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-5 fw-bold">Faktor Pengali</label>
                        <input type="text" class="form-control" name="faktorPengali" placeholder="Faktor Pengali"/>
                        <div class="invalid-feedback" id="faktorPengali"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-5 fw-bold">Satuan</label>
                        <input type="text" class="form-control" name="satuan" placeholder="Satuan"/>
                        <div class="invalid-feedback" id="satuan"></div>
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
                <button type="submit" id="btn-simpan" class="btn btn-primary" ><i class="fas fa-save"></i>
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
