<!--begin::Datatable-->
@php
$nomor = 1;
@endphp
<table id="data-table" class="table align-middle table-row-dashed fs-7 gy-5">
    <thead>
        <tr class="text-start fw-bolder fs-7 text-uppercase gs-0">
            <th>No</th>
            <th>Indikator</th>
            @for ($x = 1; $x <= $dayInMonth; $x++) <th>{{ $x }}</th>
                @endfor
                {{-- <th>Action</th> --}}
        </tr>
    </thead>
    <tbody class="text-gray-600 fw-bold" style="width:100%; overflow:scroll">
        @foreach($imut as $imut)
        <tr>
            <td>{{ $nomor }}</td>
            <td><a class="text-success" onclick="detail({{ $imut->id }})">{!! $imut['judul'] !!}</a></td>
            @for ($x = 1; $x <= $dayInMonth; $x++)
                <td class="text-center">
                    <span onclick="masukanNilai($imut->id, $x)" class="text-success text-bold text-center">0</span>
                    <div class="d-flex">
                        <span>0</span>
                        <span>0</span>
                    </div>
                </td>
                @endfor
        </tr>
        @php
        $nomor ++;
        @endphp
        @endforeach
    </tbody>
</table>
<!--end::Datatable-->
