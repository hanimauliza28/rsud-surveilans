<?php

namespace App\Http\Livewire\Monitoring\Nasional;

use Livewire\Component;
use App\Models\MasterWebService;
use App\Models\IndikatorMutuNasional;
use App\Models\KategoriVariabelSurvey;

class Modul extends Component
{
    protected $listeners = ['cariImut'];

    public $filterImut = null;
    public $noReg = null;

    public function render()
    {
        $page = $this->filterImut <> '' ? $this->filterImut :  'modul';
        $data = [
            'filterImut' => $this->filterImut,
            'noReg' => $this->noReg
        ];

        //Kepatuhan Identifikasi Pasien
        if($page == 'kepatuhan-identifikasi')
        {
            $data = [
                'dataServicePasien' => MasterWebService::where('jenis_service', 'dataPasien')->get(),
                'dataImut' => IndikatorMutuNasional::select('id', 'judul', 'nama_function')->get(),
                'kategoriVariabelSurvey' => KategoriVariabelSurvey::where('nama_kategori', 'daftarProsesIdentifikasi')->with('variabelSurvey')->first()
            ];
        }elseif($page == 'emergency-respon-time')
        {
            $data = [

            ];
        }

        return view('livewire.monitoring.nasional.'.$page ,$data);
    }

    public function cariImut($dataFilter)
    {
        $this->filterImut = $dataFilter['filterImut'];
        $this->noReg = $dataFilter['noReg'];
    }
}
