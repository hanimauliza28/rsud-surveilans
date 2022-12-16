
<div class="btn-group mt-2" role="group" aria-label="Basic example">
  <button type="button" class="btn btn-sm py-3 px-4 btn-danger" onclick="setTriage('{{ $antrian->GRUP_ANTRI }}', '{{ $antrian->NO_ANTRI }}', '{{ $antrian->TGL_ANTRI }}', 'R')"></button>
  <button type="button" class="btn btn-sm py-3 px-4 btn-warning" onclick="setTriage('{{ $antrian->GRUP_ANTRI }}', '{{ $antrian->NO_ANTRI }}', '{{ $antrian->TGL_ANTRI }}', 'Y')"></button>
  <button type="button" class="btn btn-sm py-3 px-4 btn-primary" onclick="setTriage('{{ $antrian->GRUP_ANTRI }}', '{{ $antrian->NO_ANTRI }}', '{{ $antrian->TGL_ANTRI }}', 'G')"></button>
  <button type="button" class="btn btn-sm py-3 px-4 btn-dark" onclick="setTriage('{{ $antrian->GRUP_ANTRI }}', '{{ $antrian->NO_ANTRI }}', '{{ $antrian->TGL_ANTRI }}', 'B')"></button>
  <button type="button" class="btn btn-sm py-3 px-4 btn-light border border-gray-200" onclick="setTriage('{{ $antrian->GRUP_ANTRI }}', '{{ $antrian->NO_ANTRI }}', '{{ $antrian->TGL_ANTRI }}', '')"></button>
</div>
