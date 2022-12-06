<table>
    <thead>
        <tr>
            <th>No.</th>
            <th>Tanggal</th>
            <th>No. Antri</th>
            <th>No. RM</th>
            <th>Nama Pasien</th>
            <th>No. Registrasi</th>
            <th>Jam Datang</th>
            <th>Jam Mulai Pelayanan</th>
            <th>Jam Selesai Pelayanan</th>
            <th title="Emergency Respon Time">ERT (DETIK)</th>
            <th>LAMA(DETIK)</th>
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
            <td>{{ $antrian->NO_ANTRIAN }}</td>
            <td>{{ $antrian->NORMPAS }}</td>
            <td>{{ $antrian->NAMAPAS }}</td>
            <td>{{ $antrian->NOREGRS }}</td>
            <td>{{ $antrian->TGL_INPUT }}</td>
            <td>{{ $antrian->JAM_DILAYANI }}</td>
            <td>{{ $antrian->JAM_SELESAI }}</td>
            <td>{{ $antrian->ERT }}</td>
            <td>{{ $antrian->LAMA_PELAYANAN }}</td>
        </tr>
    @php
        $no = $no+1;
    @endphp
    @endforeach
    </tbody>
</table>