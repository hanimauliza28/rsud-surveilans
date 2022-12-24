@if ($pengumuman->status == 'Y')
    <span class="badge hoverable badge-dark" onclick="aktif('N', {{ $pengumuman->id }})">Non Aktifkan</span>
@else
    <span class="badge hoverable badge-primary" onclick="aktif('Y', {{ $pengumuman->id }})">Aktifkan</span>
@endif
