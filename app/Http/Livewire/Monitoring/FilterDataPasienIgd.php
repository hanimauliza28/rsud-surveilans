<?php

namespace App\Http\Livewire\Monitoring;

use Livewire\Component;
use App\Helpers\Helpers;
use App\Helpers\HelperTime;
use App\Models\SumberDataPasien;
use App\Models\DaftarPasien;

use Carbon\Carbon;

class FilterDataPasienIgd extends Component
{
    protected $listeners = ['cariDataPasien'];

    public $filterKeyword = null;
    public $filterTanggal = null;

    public function render()
    {
        $helpers = new Helpers;
        $helperTime = new HelperTime;
        $sumberDataPasien = new SumberDataPasien;
        $daftarPasien = new DaftarPasien;

        $filterKeyword = $this->filterKeyword;
        $filterTanggal = $this->filterTanggal <> '' ? $this->filterTanggal : date('Y-m-d');
        $dataPasien = $daftarPasien->pasienIgd($filterTanggal, $filterKeyword);

        $data = [
            'filterKeyword' => $filterKeyword,
            'filterTanggal' => $filterTanggal,
            'dataPasien' => $dataPasien
        ];

        return view('livewire.monitoring.filter-data-pasien-igd', $data);
    }

    public function cariDataPasien($dataFilter)
    {
        $this->filterKeyword = $dataFilter['filterKeyword'];
        $this->filterTanggal = $dataFilter['filterTanggal'];
    }
}
