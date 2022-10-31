<?php

namespace App\Http\Livewire\Monitoring;

use Livewire\Component;
use App\Helpers\Helpers;
use App\Helpers\HelperTime;
use App\Helpers\HelperSurveilans;
use App\Models\SumberDataPasien;
use App\Models\DaftarPasien;
use App\Models\Bagian;

use Carbon\Carbon;

class FilterDataPasienRawatInap extends Component
{
    protected $listeners = ['cariDataPasien'];

    public $filterKeyword = null;
    public $filterTanggal = null;
    public $filterBagian = null;
    public $filterRawat = null;

    public function render()
    {
        $helpers = new Helpers;
        $helperTime = new HelperTime;
        $helperSurveilans = new HelperSurveilans;
        $sumberDataPasien = new SumberDataPasien;
        $daftarPasien = new DaftarPasien;
        $bagian = new Bagian;

        $filterKeyword = $this->filterKeyword;
        $filterBagian = $this->filterBagian;
        $filterRawat = $this->filterRawat;
        $filterTanggal = $this->filterTanggal <> '' ? $this->filterTanggal : date('Y-m-d');
        $dataFilterRawat = $helperSurveilans->filterRawatInap();
        $dataPasien = $daftarPasien->pasienRawatInap($filterTanggal, $filterKeyword, $filterBagian, $filterRawat);

        $data = [
            'filterKeyword' => $filterKeyword,
            'filterTanggal' => $filterTanggal,
            'filterRawat' => $filterRawat,
            'filterBagian' => $filterBagian,
            'dataPasien' => $dataPasien
        ];

        return view('livewire.monitoring.filter-data-pasien-rawat-inap', $data);
    }

    public function cariDataPasien($dataFilter)
    {
        $this->filterKeyword = $dataFilter['filterKeyword'];
        $this->filterTanggal = $dataFilter['filterTanggal'];
        $this->filterBagian = $dataFilter['filterBagian'];
        $this->filterRawat = $dataFilter['filterRawat'];
    }
}
