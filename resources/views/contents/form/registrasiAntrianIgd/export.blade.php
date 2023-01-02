<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>No. Antri</th>
            <th>No. RM</th>
            <th>Nama Pasien</th>
            <th>No. Registrasi</th>
            <th>Jenis</th>
            <th>Jam Datang</th>
            <th>Jam Mulai Pelayanan</th>
            <th>Jam Selesai Pelayanan</th>
            <th title="Emergency Respon Time">ERT</th>
            <th>Lama Pelayanan</th>
            <th>ERT (detik)</th>
            <th>Lama Pelayanan (detik)</th>
        </tr>
    </thead>
    <tbody>
    @php
        $no = 1;
    @endphp
    @foreach($antrian as $antrian)
        <tr>
            <td>{{ $no }}</td>
            <td>{{ date('Y-m-d', strtotime($antrian->TGL_INPUT)) }}</td>
            <td>{{ $antrian->NO_ANTRI }}</td>
            <td>{{ $antrian->NORMPAS }}</td>
            <td>{{ $antrian->NAMAPAS }}</td>
            <td>{{ $antrian->NOREGRS }}</td>
            <th>{{ $antrian->JENIS }}</th>
            <td>{{ $antrian->TGL_INPUT }}</td>
            <td>{{ $antrian->JAM_DILAYANI }}</td>
            <td>{{ $antrian->JAM_SELESAI }}</td>
            <td>{{ gmdate('H:i:s', $antrian->ERT) }}</td>
            <td>{{ gmdate('H:i:s', $antrian->LAMA_PELAYANAN) }}</td>
            <th>{{ $antrian->ERT }}</th>
            <th>{{ $antrian->LAMA_PELAYANAN }}</th>
        </tr>
    @php
        $no = $no+1;
    @endphp
    @endforeach
    </tbody>
</table>
