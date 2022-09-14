<div class="card mb-5 pb-5">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title">
            <h3 class="m-0 text-gray-900 flex-grow-1">Indikator Mutu Nasional</h3>
        </div>
        <div class="card-toolbar">
            <!--begin::Nav pills-->
            <ul class="nav nav-pills nav-line-pills border rounded p-1 me-2">
                <li class="nav-item me-2">
                    <a class="nav-link btn btn-active-light btn-active-color-gray-700 btn-color-gray-400 py-2 px-5 fs-6 fw-bold active">Wajib</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-active-light btn-active-color-gray-700 btn-color-gray-400 py-2 px-5 fs-6 fw-bold">Manajemen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-active-light btn-active-color-gray-700 btn-color-gray-400 py-2 px-5 fs-6 fw-bold">Klinik</a>
                </li>
            </ul>
            <!--end::Nav pills-->
        </div>
    </div>
    <div class="card-body">
        <!--begin::Input-->
        <select class="form-select form-select-solid" data-control="select2" data-placeholder="Pilihan Indikator Mutu Nasional" name="daftarImutNasional" id="daftarImutNasional">
            <option></option>
            @foreach ($dataImut as $imut)
            <option value="{{ $imut->nama_function ? $imut->nama_function : '' }}"> {!! strip_tags($imut->judul) !!} </option>
            @endforeach
        </select>
        <!--end::Input-->
    </div>
    <!--end::Card header-->
</div>
