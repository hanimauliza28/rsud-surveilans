<?php

namespace App\Http\Livewire\Monitoring;

use Livewire\Component;
use App\Helpers\Helpers;
use App\Helpers\HelperTime;
use App\Models\SumberDataPasien;
use App\Models\DaftarPasien;
use App\Models\AntrianIgd;

use Carbon\Carbon;

class CariPasienIgd extends Component
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
        $antrianIgd = new AntrianIgd;

        $filterKeyword = $this->filterKeyword;
        // dd($this->filterTanggal);
        $filterTanggal = $this->filterTanggal <> '' ? $this->filterTanggal : date('Y-m-d');
        $dataPasien = $daftarPasien->pasienIgd($filterTanggal, $filterKeyword);

        $dataAntrian = $antrianIgd->whereDate('TGL_ANTRI', $filterTanggal)->get();
        if($dataPasien)
        {
            foreach($dataAntrian as $antrian)
            {
                $dataPasien = collect($dataPasien)->filter(function ($value, $key) use($antrian) {
                    return $value->NOREGRS != $antrian->NOREGRS;
                });
            }
        }


        $data = [
            'filterKeyword' => $filterKeyword,
            'filterTanggal' => $filterTanggal,
            'dataPasien' => $dataPasien
        ];

        return view('livewire.monitoring.cari-pasien-igd', $data);
    }

    public function cariDataPasien($dataFilter)
    {
        $this->filterKeyword = $dataFilter['filterKeyword'];
        $this->filterTanggal = $dataFilter['filterTanggal'];
    }
}
