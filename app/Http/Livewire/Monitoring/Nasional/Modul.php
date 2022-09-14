<?php

namespace App\Http\Livewire\Monitoring\Nasional;

use Livewire\Component;
use App\Models\MasterWebService;
use App\Models\IndikatorMutuNasional;
use App\Models\KategoriVariabelSurvey;
use App\Models\HasilSurveyImutNasional;

use App\Models\SumberDataPelayanan;

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

        //Ambil Data Indikator Mutu
        $indikatorMutu = IndikatorMutuNasional::where(
            'nama_function',
            $page
        )->first();

        if ($indikatorMutu) {
            $hasilSurvey = HasilSurveyImutNasional::whereHas(
                'object',
                function ($query) use ($noReg) {
                    $query->where('no_reg', $noReg);
                }
            )
                ->where('indikator_mutu_id', $indikatorMutu->id)
                ->with([
                    'detail' => function ($query) {
                        return $query
                            ->join(
                                'variabel_survey',
                                'variabel_survey.id',
                                '=',
                                'hasil_survey_imut_nasional_detail.variabel_survey_id'
                            )
                            ->select(
                                'hasil_survey_imut_nasional_detail.hasil_survey_id',
                                'hasil_survey_imut_nasional_detail.variabel_survey_id',
                                'hasil_survey_imut_nasional_detail.sub_variabel',
                                'hasil_survey_imut_nasional_detail.value',
                                'hasil_survey_imut_nasional_detail.point',
                                'variabel_survey.nama_variabel'
                            );
                    },
                ])
                ->first();
        }

        //Kepatuhan Identifikasi Pasien
        if ($page == 'kepatuhan-identifikasi') {
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
                'detailHasilSurvey' => $hasilSurvey
                    ? collect($hasilSurvey['detail'])
                    : [],
            ];
        } elseif ($page == 'emergency-respon-time') {
            $pasienEmergency = SumberDataPelayanan::pasienEmergency();

            if (isset($hasilSurvey->detail)) {
                foreach ($hasilSurvey->detail as $detail) {
                    $dataDetail[$detail['nama_variabel']] = $detail['value'];
                }
            }

            $data = [
                'indikatorMutu' => $indikatorMutu,
                'dataPelayanan' => $pasienEmergency,
                'hasilSurvey' => $hasilSurvey,
                'detailHasilSurvey' => $dataDetail ?? '',
            ];
        } elseif ($page == 'waktu-tunggu-rawat-jalan') {
            $waktuTungguRawatJalan = SumberDataPelayanan::waktuTungguRawatJalan();

            if (isset($hasilSurvey->detail)) {
                foreach ($hasilSurvey->detail as $detail) {
                    $dataDetail[$detail['nama_variabel']] = $detail['value'];
                }
            }

            $data = [
                'indikatorMutu' => $indikatorMutu,
                'dataPelayanan' => $waktuTungguRawatJalan,
                'hasilSurvey' => $hasilSurvey,
                'detailHasilSurvey' => $dataDetail ?? '',
            ];
        }

        return view('livewire.monitoring.nasional.' . $page, $data);
    }

    public function cariImut($dataFilter)
    {
        $this->filterImut = $dataFilter['filterImut'];
        $this->noReg = $dataFilter['noReg'];
    }
}
