<?php
namespace App\Http\Livewire\Monitoring\Nasional;

use Livewire\Component;
use App\Models\MasterWebService;
use App\Models\IndikatorMutuNasional;
use App\Models\KategoriVariabelSurvey;
use App\Models\HasilSurveyImutNasional;

use Carbon\Carbon;
use App\Models\SumberDataPasien;
use App\Models\SumberDataPelayanan;
use App\Models\RawatInap;
use App\Models\AnamnesaRi;
use App\Models\Anamnesa;

class Modul extends Component
{
    protected $listeners = ['cariImut', 'penundaanOperasi'];

    public $filterImut = null;
    public $noReg = null;
    public $tanggalSurvey = null;

    public function render()
    {
        //Check appakah variabel no registrsi dan filter imut terisi
        if ($this->filterImut != '' && $this->noReg != '') {
            $page = $this->filterImut;
        } else {
            $page = 'modul';
        }

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
            if ($page != 'penundaan-operasi-elektif') {
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
            $pasienEmergency = SumberDataPelayanan::pasienEmergency($noReg);

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

            $waktuTungguRawatJalan = SumberDataPelayanan::waktuTungguRawatJalan(
                $noReg
            );

            if (isset($hasilSurvey->detail)) {
                foreach ($hasilSurvey->detail as $detail) {
                    $dataDetail[$detail['nama_variabel']] = $detail['value'];
                }
            }

            $data = [
                'indikatorMutu' => $indikatorMutu,
                'dataPelayanan' => $waktuTungguRawatJalan[0],
                'hasilSurvey' => $hasilSurvey,
                'detailHasilSurvey' => $dataDetail ?? '',
            ];

        } elseif ($page == 'penundaan-operasi-elektif') {
            $tanggalSurvey = $this->tanggalSurvey ?? date('Y-m-d');
            $hasilSurvey = HasilSurveyImutNasional::where(
                'indikator_mutu_id',
                $indikatorMutu->id
            )
                ->whereDate('tgl_survey', $tanggalSurvey)
                ->with('detail')
                ->first();
            $tanggal = Carbon::parse($tanggalSurvey);
            $tanggalFormat = $tanggal->isoFormat('DD/MM/YYYY');
            $list = SumberDataPasien::listPasienOperasi();

            $data = [
                'indikatorMutu' => $indikatorMutu,
                'hasilSurvey' => $hasilSurvey,
                'hasilSurveyDetail' => $hasilSurvey->detail ?? '',
                'pasienOperasi' => $list,
            ];
        }

        // JAM VISIT DOKTER
        elseif ($page == 'kepatuhan-jam-visit-dokter') {
            $rawatInap = new RawatInap();
            $dataVisit = $rawatInap->dataVisit($noReg);
            $dataRegistrasi = $rawatInap->where('NOREGRS', $noReg)->first();
            $tanggalSurvey = $this->tanggalSurvey ?? date('Y-m-d');
            $hasilSurvey = HasilSurveyImutNasional::where(
                'indikator_mutu_id',
                $indikatorMutu->id
            )
                ->whereDate('tgl_survey', $tanggalSurvey)
                ->with('detail')
                ->first();

            $tanggal = Carbon::parse($tanggalSurvey);
            $tanggalFormat = $tanggal->isoFormat('DD/MM/YYYY');

            $data = [
                'dataRegistrasi' => $dataRegistrasi,
                'indikatorMutu' => $indikatorMutu,
                'hasilSurvey' => $hasilSurvey,
                'hasilSurveyDetail' => $hasilSurvey->detail ?? '',
                'dataVisit' => $dataVisit,
            ];
        }

        // PENCEGAHAN RESIKO CIDERA
        elseif ($page == 'upaya-pencegahan-resiko-cidera') {
            //tgl pulang akan jadi tgl_survey, jika belum pulang akan otomatis mengamil tanggal hari ini
            $anamnesari = AnamnesaRi::where('NOREGRS', $noReg)
                ->select('NOREGRS', 'RESIKOJATUH', 'DATEENTRY')
                ->get();
            $anamnesa = Anamnesa::where('NOREGRS', $noReg)
                ->select('NOREGRS', 'RESIKOJATUH', 'DATEENTRY')
                ->get();

            $rawatInap = new RawatInap();
            $dataRegistrasi = $rawatInap
                ->where('NOREGRS', $noReg)
                ->with('anamnesa', 'anamnesari')
                ->first();

            $tanggalSurvey = $dataRegistrasi->JAMPULANG
                ? date('Y-m-d', strtotime($dataRegistrasi->JAMPULANG))
                : date('Y-m-d');
            $izin = $dataRegistrasi->JAMPULANG != '' ? 'Y' : 'N';
            $value['value13'] = '';
            $value['value14'] = '';
            $value['value15'] = '';

            $hasilSurvey = HasilSurveyImutNasional::where(
                'indikator_mutu_id',
                $indikatorMutu->id
            )
                ->whereDate('tgl_survey', $tanggalSurvey)
                ->with('detail')
                ->first();

            if (isset($hasilSurvey->detail)) {
                $variabel13 = $hasilSurvey->detail
                    ->where('variabel_survey_id', 13)
                    ->first();
                $variabel14 = $hasilSurvey->detail
                    ->where('variabel_survey_id', 14)
                    ->first();
                $variabel15 = $hasilSurvey->detail
                    ->where('variabel_survey_id', 15)
                    ->first();

                $value['value13'] = $variabel13->value ?? '';
                $value['value14'] = $variabel14->value ?? '';
                $value['value15'] = $variabel15->value ?? '';
            }

            $data = [
                'indikatorMutu' => $indikatorMutu,
                'hasilSurvey' => $hasilSurvey,
                'hasilSurveyDetail' => $hasilSurvey->detail ?? '',
                'anamnesari' => $anamnesari,
                'dataRegistrasi' => $dataRegistrasi,
                'anamnesa' => $anamnesa,
                'izin' => $izin,
                'value' => $value ?? [],
            ];
        }

        return view('livewire.monitoring.nasional.' . $page, $data);
    }

    public function cariImut($dataFilter)
    {
        $this->filterImut = $dataFilter['filterImut'];
        $this->noReg = $dataFilter['noReg'];
    }

    public function penundaanOperasi($dataParameter)
    {
        $this->tanggalSurvey = $dataParameter['tanggalSurvey'];
        $this->filterImut = 'penundaan-operasi-elektif';
    }
}
