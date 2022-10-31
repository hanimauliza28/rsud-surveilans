<?php

namespace App\Http\Livewire\Monitoring;

use Livewire\Component;
use App\Helpers\Helpers;
use App\Helpers\HelperTime;
use App\Models\SumberDataPasien;
use App\Models\DaftarPasien;
use App\Models\Bagian;

use Carbon\Carbon;

class FilterDataPasienRawatJalan extends Component
{
    protected $listeners = ['cariDataPasien'];

    public $filterKeyword = null;
    public $filterTanggal = null;
    public $filterBagian = null;

    public function render()
    {
        $helpers = new Helpers;
        $helperTime = new HelperTime;
        $sumberDataPasien = new SumberDataPasien;
        $daftarPasien = new DaftarPasien;
        $bagian = new Bagian;

        $filterKeyword = $this->filterKeyword;
        $filterBagian = $this->filterBagian;
        $filterTanggal = $this->filterTanggal <> '' ? $this->filterTanggal : date('Y-m-d');
        $dataPasien = $daftarPasien->pasienRawatJalan($filterTanggal, $filterKeyword, $filterBagian);

        $data = [
            'filterKeyword' => $filterKeyword,
            'filterTanggal' => $filterTanggal,
            'filterBagian' => $filterBagian,
            'dataPasien' => $dataPasien
        ];

        return view('livewire.monitoring.filter-data-pasien-rawat-jalan', $data);
    }

    public function cariDataPasien($dataFilter)
    {
        $this->filterKeyword = $dataFilter['filterKeyword'];
        $this->filterTanggal = $dataFilter['filterTanggal'];
        $this->filterBagian = $dataFilter['filterBagian'];
    }
}
