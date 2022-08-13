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
<div class="card">
    <div class="card-header align-items-center py-5 gap-2 gap-md-5">

    </div>
    <div class="card-body">
        <!--begin::Table-->
        <table class="table table-hover table-row-dashed">
            <!--begin::Table head-->
            <thead>
                <tr class="fw-bolder text-gray-400 border-bottom-0">
                    <th class="p-0 pb-3 min-w-175px text-center">Check</th>
                    <th class="p-0 pb-3 min-w-100px text-end">Kategori Identifikasi</th>
                    <th class="p-0 pb-3 min-w-100px text-end">Nama</th>
                    <th class="p-0 pb-3 min-w-125px text-end">Tanggal Lahir</th>
                    <th class="p-0 pb-3 min-w-100px text-end">NIK</th>
                    <th class="p-0 pb-3 w-80px text-end">NORM</th>
                </tr>
            </thead>
            <!--end::Table head-->
            <!--begin::Table body-->
            <tbody>
                @foreach ($kategoriVariabelSurvey->variabelSurvey as $variabel)
                <tr>
                    <td class="ps-9 text-center">
                        <!--begin::Checkbox-->
                        <div class="form-check form-check-sm form-check-custom form-check-solid mt-3">
                            <input class="form-check-input" type="checkbox" value="1" />
                        </div>
                        <!--end::Checkbox-->
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
            <!--end::Table body-->
        </table>
        <!--end::Table-->
    </div>
</div>
<!--end::Card-->

@endsection
