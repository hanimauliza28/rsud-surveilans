<?php

namespace App\Http\Livewire\Monitoring\MonitoringPasien;

use Livewire\Component;
use App\Helpers\Helpers;
use App\Helpers\HelperTime;
use App\Models\SumberDataPasien;
use App\Models\MasterWebService;

use Carbon\Carbon;

class FilterDataPasien extends Component
{
    protected $listeners = ['cariDataPasien'];

    public $filterKeyword = null;
    public $filterTanggal = null;
    public $filterBagian = null;
    public $filterServicePasien = null;

    public function render()
    {
        $helpers = new Helpers;
        $helperTime = new HelperTime;
        $pasien = new SumberDataPasien;
        $webService = new MasterWebService;

        $filterKeyword = $this->filterKeyword;
        $filterBagian = $this->filterBagian;
        $filterTanggal = $this->filterTanggal <> '' ? $this->filterTanggal : date('Y-m-d');
        $filterServicePasien = $this->filterServicePasien <> "" ? $this->filterServicePasien : 1;

        //Cari Service
        $dataWebService = $webService->where('id', $filterServicePasien)->first();

        $data = [
            'filterKeyword' => $filterKeyword,
            'filterTanggal' => $filterTanggal,
            'filterServicePasien' => $filterServicePasien,
            'filterBagian' => $filterBagian,
            'dataPasien' => $pasien->sumberDataPasien($dataWebService->nama_unik, $dataWebService->url, $dataWebService->type, $filterTanggal, $filterKeyword, $filterBagian)
        ];

        return view('livewire.monitoring.monitoring-pasien.filter-data-pasien', $data);
    }

    public function cariDataPasien($dataFilter)
    {
        $this->filterKeyword = $dataFilter['filterKeyword'];
        $this->filterTanggal = $dataFilter['filterTanggal'];
        $this->filterBagian = $dataFilter['filterBagian'];
        $this->filterServicePasien = $dataFilter['filterServicePasien'];
    }
}
