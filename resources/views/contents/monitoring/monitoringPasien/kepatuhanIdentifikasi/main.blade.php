@extends('contents.monitoring.monitoringPasien.index')

@push('extraCss')
<style>
    .nav-item {
        margin-top: 10px;
    }
</style>
@endpush

@section('content-main')


<!--begin::Card-->
<form id="kepatuhanIdentifikasiForm">
<div class="card">
    <div class="card-header align-items-center py-5 gap-2 gap-md-5">

    </div>
    <div class="card-body">
        <!--begin::Table-->
        <table class="table table-hover table-row-dashed">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bolder text-gray-400 border-bottom-0">
                    <th class="p-0 pb-3 max-w-175px text-center">
                        <a class="text-success fs-7" onclick="checkAll()">Check</a>
                    </th>
                    <th class="p-0 pb-3 min-w-100px text-center">Kategori Identifikasi</th>
                    <th>Check All</th>
                    <th class="p-0 pb-3 max-w-175px text-center">Nama</th>
                    <th class="p-0 pb-3 max-w-175px text-center">Tgl. Lahir</th>
                    <th class="p-0 pb-3 max-w-175px text-center">NIK</th>
                    <th class="p-0 pb-3 max-w-175px text-center">NORM</th>
                </tr>
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody>
                @foreach ($kategoriVariabelSurvey->variabelSurvey as $variabel)
                <tr>
                    <td>
                        <!--begin::Checkbox-->
                        <div class="form-check form-check-sm form-check-custom form-check-solid m-center">
                            <input class="form-check-input checkIndikator ms-6" type="checkbox" value="1" />
                        </div>
                        <!--end::Checkbox-->
                    </td>
                    <td>{{ $variabel->nama }}</td>
                    <td><a class="text-success fs-7" onclick="checkAllItem({{ $variabel->id }})">Check All</a></td>
                    <td class="text-center">
                        <!--begin::Checkbox-->
                        <div class="form-check form-check-sm form-check-custom form-check-solid text-center">
                            <input class="form-check-input text-center nama{{ $variabel->id }}" type="checkbox" value="1" />
                        </div>
                        <!--end::Checkbox-->
                    </td>
                    <td class="text-center align-items-center">
                        <div class="form-check form-check-sm form-check-custom form-check-solid text-center">
                            <input class="form-check-input text-center tglLahir{{ $variabel->id }}" type="checkbox" value="1" />
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="form-check form-check-sm form-check-custom form-check-solid text-center">
                            <input class="form-check-input text-center nik{{ $variabel->id }}" type="checkbox" value="1" />
                        </div>
                    </td>
                    <td class="text-center">
                        <div class="form-check form-check-sm form-check-custom form-check-solid text-center">
                            <input class="form-check-input text-center norm{{ $variabel->id }}" type="checkbox" value="1" />
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="fw-bolder text-gray-400 border-bottom-0 pt-4">
                    <th class="p-0 pb-3 max-w-175px text-center">
                        <a class="text-success fs-7" onclick="uncheckAll()">Uncheck</a>
                    </th>
                    <th colspan="7"></th>
                </tr>
            </tfoot>
            <!--end::Table body-->
        </table>
        <!--end::Table-->

    </div>

    <div class="card-footer text-end mt-1 pt-4">
        <button type="submit" id="btn-simpan" class="btn btn-primary"><i class="fas fa-save"></i>
            <span id="btn-simpan-text" class="indicator-label">
                Simpan
            </span>
            <span class="indicator-progress">
                Mohon Tunggu... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
            </span>
        </button>
        <button type="reset" id="btn-reset" class="btn btn-danger"><i class="fas fa-save"></i>
            Reset
        </button>
    </div>
</div>
</form>
<!--end::Card-->

@endsection
