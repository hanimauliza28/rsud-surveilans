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
        $page = $this->filterImut != '' ? $this->filterImut : 'modul';
        $data = [
            'filterImut' => $this->filterImut,
            'noReg' => $this->noReg,
        ];
        $noReg = $data['noReg'];

        //Kepatuhan Identifikasi Pasien
        if ($page == 'kepatuhan-identifikasi') {
            $indikatorMutu = IndikatorMutuNasional::where(
                'nama_function',
                $page
            )->first();

            $hasilSurvey = HasilSurveyImutNasional::whereHas(
                'object',
                function ($query) use ($noReg) {
                    $query->where('no_reg', $noReg);
                }
            )
                ->with([
                    'detail' => function ($query) {
                        return $query->select(
                            'hasil_survey_id',
                            'variabel_survey_id',
                            'sub_variabel',
                            'value',
                            'point'
                        );
                    },
                ])
                ->first();

            $data = [
                'indikatorMutu' => $indikatorMutu,
                'dataServicePasien' => MasterWebService::where(
                    'jenis_service',
                    'dataPasien'
                )->get(),
                'dataImut' => IndikatorMutuNasional::select(
                    'id',
                    'judul',
                    'nama_function',
                    'satuan'
                )->get(),
                'kategoriVariabelSurvey' => KategoriVariabelSurvey::where(
                    'nama_kategori',
                    'daftarProsesIdentifikasi'
                )
                    ->with('variabelSurvey')
                    ->first(),
                'hasilSurvey' => $hasilSurvey,
                'detailHasilSurvey' => $hasilSurvey ? collect($hasilSurvey['detail']) : []
            ];
            // dd($data);


        } elseif ($page == 'emergency-respon-time') {
            $data = [];
        }

        return view('livewire.monitoring.nasional.' . $page, $data);
    }

    public function cariImut($dataFilter)
    {
        $this->filterImut = $dataFilter['filterImut'];
        $this->noReg = $dataFilter['noReg'];
    }
}
