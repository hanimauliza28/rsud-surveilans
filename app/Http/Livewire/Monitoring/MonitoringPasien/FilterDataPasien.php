<?php

namespace App\Http\Livewire\Monitoring\MonitoringPasien;

use Livewire\Component;
use App\Helpers\Helpers;
use App\Helpers\HelperTime;
use App\Models\WebServicePasien;

class FilterDataPasien extends Component
{
    protected $listeners = ['cariDataPasien'];

    public $filterKeyword = null;
    public $filterTanggal = null;
    public $filterServicePasien = null;

    public function render()
    {
        $helpers = new Helpers;
        $helperTime = new HelperTime;
        $pasien = new WebServicePasien;

        $filterKeyword = $this->filterKeyword;
        $filterTanggal = $this->filterTanggal;
        $filterServicePasien = $this->filterServicePasien;

        $data = [
            'filterKeyword' => $filterKeyword,
            'filterTanggal' => $filterTanggal,
            'filterServicePasien' => $filterServicePasien,
            'dataPasien' => $pasien->allPasien()
        ];

        return view('livewire.monitoring.monitoring-pasien.filter-data-pasien', $data);
    }

    public function cariDataPasien($dataFilter)
    {
        $this->filterKeyword = $dataFilter['filterKeyword'];
        $this->filterTanggal = $dataFilter['filterTanggal'];
        $this->filterServicePasien = $dataFilter['filterServicePasien'];
    }
}
