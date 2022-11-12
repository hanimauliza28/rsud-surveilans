<div class="modal fade" id="user-modal" role="dialog" aria-labelledby="Modal" aria-hidden="true">
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
                <form id="user-form" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" id="id" value="" name="id">
                    <input type="hidden" name="_method" value="PUT" disabled>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-6 fw-bold">Nama User</label>
                        <input type="text" class="form-control" name="name" placeholder="Nama User" />
                        <div class="invalid-feedback" id="name"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-6 fw-bold">Username</label>
                        <input type="text" class="form-control" onkeyup="nospaces(this)" name="username" placeholder="Username" />
                        <div class="invalid-feedback" id="username"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-left requiresd fs-6 fw-bold">Email</label>
                        <input type="text" class="form-control" name="email" placeholder="E-mail" />
                        <div class="invalid-feedback" id="email"></div>
                    </div>

                    <div class="form-group row formPassword">
                        <label
                            class="col-form-label text-left col-lg-4 col-sm-12 required fs-5 fw-bold">Password</label>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <input type="password" class="form-control form-control-solid" name="password"
                                placeholder="Masukkan Password" />
                            <div class="invalid-feedback" id="password"></div>
                        </div>
                    </div>


                    <div class="form-group row formPassword">
                        <label class="col-form-label text-left col-lg-4 col-sm-12 required fs-5 fw-bold">Password
                            Confirmation</label>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <input type="password" class="form-control form-control-solid" name="password_confirmation"
                                placeholder="Masukkan Password" />
                            <div class="invalid-feedback" id="password_confirmation"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-6 fw-bold">Grup User</label>
                        <select name="grupUserId" id="selectGrupUserId" data-placeholder="Pilih Grup User" class="form-select">
                            <option value=""></option>
                            @foreach ($grupUser as $grupUser)
                            <option value="{{ $grupUser->id }}">{{ $grupUser->nama_grup }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="grupUserId"></div>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label text-left required fs-6 fw-bold">Status</label>
                        <select name="status" id="selectStatus" data-placeholder="Pilih Status" class="form-select">
                            <option value=""></option>
                            @foreach ($statusUser as $status)
                            <option value="{{ $status->value }}">{{ $status->text }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="status"></div>
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
