<button onclick="pilih({{ $imut->id }}, 'nasional')" class="btn btn-sm btn-light-primary">
    Pilih
</button>
<input type="hidden" name="pilihanImut{{ $imut->id }}" value="{{ strip_tags($imut->judul) }}">
