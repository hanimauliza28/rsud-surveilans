@extends('layouts.app')

@section('title')
    Registrasi Antrian IGD
@endsection

@section('childTitle')
    Registrasi Antrian IGD dengan No. Registrasi Pasien
@endsection

@section('content')

    @include('contents.form.registrasiAntrianIgd.filter')

    <div class="card">
        <!--begin::Card body-->
        <div class="card-body pt-5">
            <!--begin::Datatable-->
            <table id="data-table" class="table table-resposive table-border align-top table-row-dashed fs-7 gy-2 ">
                <thead>
                    <tr class="text-start fw-bolder align-middle fs-7 text-uppercase gs-0">
                        <th>No</th>
                        <th>No. Antri</th>
                        <th>Nama Pasien</th>
                        <th>Jenis</th>
                        <th>Action</th>
                        <th>Jam Datang</th>
                        <th>Jam Mulai</th>
                        <th>Jam Selesai</th>
                        <th>Emergency Time</th>
                        <th>Lama Pelayanan</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600">
                </tbody>
            </table>
            <!--end::Datatable-->
        </div>
        <!--end::Card body-->
    </div>
    @endsection

    @include('contents.form.registrasiAntrianIgd.js')
    @include('contents.form.registrasiAntrianIgd.modal')
    @include('contents.form.registrasiAntrianIgd.modalWaktu')
