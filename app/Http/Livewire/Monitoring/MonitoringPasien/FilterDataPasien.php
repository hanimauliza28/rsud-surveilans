<?php

namespace App\Http\Livewire\Monitoring\MonitoringPasien;

use Livewire\Component;
use App\Helpers\Helpers;
use App\Helpers\HelperTime;
use App\Models\SumberDataPasien;
use App\Models\WebServicePasien;

use Carbon\Carbon;

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
        $pasien = new SumberDataPasien;
        $webService = new WebServicePasien;

        $filterKeyword = $this->filterKeyword;
        $filterTanggal = $this->filterTanggal <> '' ? $this->filterTanggal : date('Y-m-d');
        $filterServicePasien = $this->filterServicePasien <> "" ? $this->filterServicePasien : 1;

        //cari service
        $dataWebService = $webService->where('id', $filterServicePasien)->first();

        $data = [
            'filterKeyword' => $filterKeyword,
            'filterTanggal' => $filterTanggal,
            'filterServicePasien' => $filterServicePasien,
            'dataPasien' => $pasien->sumberDataPasien($dataWebService->nama_unik, $dataWebService->url, $dataWebService->type, $filterTanggal, $filterKeyword, null)
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
