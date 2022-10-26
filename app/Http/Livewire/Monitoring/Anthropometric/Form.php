<?php

namespace App\Http\Livewire\Monitoring\Anthropometric;

use Livewire\Component;
use App\Models\Pasien;
use App\Models\Registridr;
use App\Models\AnthropometricResult;

class Form extends Component
{
    protected $listeners = ['cariNorm'];

    public $pasienNorm = null;

    public function render()
    {
        $norm = $this->pasienNorm;
        $date = date('Ymd');

        if($norm)
        {
            $pasien = Pasien::where('NORMPAS', ''.$norm.'')->select('NMPASIEN', 'NORMPAS', 'TGLLAHIR', 'NOKTP', 'JNSKELAMIN', 'ALAMATPAS')->first();

            if($pasien){
                $pasien->TGLLAHIR = date('Y-m-d', strtotime($pasien->TGLLAHIR));

                //Hitung Umur
                $umur = $pasien->usia_bulan;

            }
        }

        $data = [
            'norm' => $norm,
            'pasien' => $pasien ?? null,
            'date' => date('d/m/Y'),
            'umur' => $umur ?? 0
        ];

        return view('livewire.monitoring.anthropometric.form', $data);
    }

    public function cariNorm($data)
    {
        $this->pasienNorm = $data['pasienNorm'];
    }

}
