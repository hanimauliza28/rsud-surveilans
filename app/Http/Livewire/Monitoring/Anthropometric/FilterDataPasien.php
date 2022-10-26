<?php

namespace App\Http\Livewire\Monitoring\Anthropometric;

use Livewire\Component;

use App\Models\Pasien;

class FilterDataPasien extends Component
{
    protected $listeners = ['cariPasien'];

    public $filterKeyword = null;
    public $filterBagian = null;

    public function render()
    {
        $filterKeyword = $this->filterKeyword;
        $filterBagian = $this->filterBagian;

        $pasien = Pasien::cariByNormNamapas($filterKeyword, $filterBagian);

        $data = [
            'pasien' => $pasien,
        ];

        return view('livewire.monitoring.anthropometric.filter-data-pasien', $data);
    }

    public function cariPasien($data)
    {
        $this->filterKeyword = $data['filterKeyword'];
        $this->filterBagian = $data['filterBagian'];
    }
}
