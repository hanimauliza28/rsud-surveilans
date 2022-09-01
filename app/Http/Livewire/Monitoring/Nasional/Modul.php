<?php

namespace App\Http\Livewire\Monitoring\Nasional;

use Livewire\Component;
use App\Models\MasterWebService;
use App\Models\IndikatorMutuNasional;
use App\Models\KategoriVariabelSurvey;
use App\Models\HasilSurveyImutNasional;

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
            $indikatorMutu = IndikatorMutuNasional::where('nama_function', $page)->first();
            $data = [
                'indikatorMutu' => $indikatorMutu,
                'dataServicePasien' => MasterWebService::where('jenis_service', 'dataPasien')->get(),
                'dataImut' => IndikatorMutuNasional::select('id', 'judul', 'nama_function')->get(),
                'kategoriVariabelSurvey' => KategoriVariabelSurvey::where('nama_kategori', 'daftarProsesIdentifikasi')->with('variabelSurvey')->first(),
                'hasilSurvey' => HasilSurveyImutNasional::where('id_object', $this->noReg)->where('indikator_mutu_id', $indikatorMutu->id)->get()
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
