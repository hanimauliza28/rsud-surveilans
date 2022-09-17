<?php

namespace App\Http\Controllers\Web\Monitoring\MonitoringPasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\Helpers;
use App\Models\MasterWebService;
use App\Models\IndikatorMutuNasional;
use App\Models\ObjectPasien;
use App\Models\VariabelSurvey;
use App\Models\KategoriVariabelSurvey;
use App\Models\HasilSurveyImutNasional;
use App\Models\HasilSurveyImutNasionalDetail;

class KepatuhanIdentifikasiPasienController extends Controller
{
    public function __construct()
    {
        $this->objectPasien = new ObjectPasien();
        $this->helpers = new Helpers();
    }
    public function index()
    {
        $data = [
            'dataServicePasien' => MasterWebService::where(
                'jenis_service',
                'dataPasien'
            )->get(),
            'dataImut' => IndikatorMutuNasional::select(
                'id',
                'judul',
                'nama_function'
            )->get(),
            'kategoriVariabelSurvey' => KategoriVariabelSurvey::where(
                'nama_kategori',
                'daftarProsesIdentifikasi'
            )
                ->with('variabelSurvey')
                ->first(),
        ];

        return view(
            'contents.monitoring.monitoringPasien.kepatuhanIdentifikasi.main',
            $data
        );
    }

    public function store(Request $request)
    {
        $denumerator = 0;
        $numerator = 0;
        $sub_numerator = 0;

        try {
            foreach ($request->dataPasien as $pasien) {
                $dataPasien[$pasien['name']] = $pasien['value'];
            }

            //Simpan Data Pasien
            $simpanPasien = [
                'no_reg' => $dataPasien['dataPasienNoreg'],
                'nama_pasien' => $dataPasien['dataPasienNama'],
                'norm' => $dataPasien['dataPasienNorm'],
                'kdbagian' => $dataPasien['dataPasienKdbagian'],
                'nama_bagian' => $dataPasien['dataPasienBagian'],
            ];

            //simpan ke data object
            $pasienSimpan = ObjectPasien::create($simpanPasien);

            foreach ($request->data as $data) {
                if ($data['name'] == 'indikatorMutuId') {
                    $indikatorMutuId = $data['value'];
                    $indikatorMutu = IndikatorMutuNasional::where(
                        'id',
                        $indikatorMutuId
                    )->first();

                    //master hasil survey
                    $dataHasil = [
                        'id_object' => $pasienSimpan->id,
                        'jenis_object' => 'App\Models\ObjectPasien',
                        'tgl_survey' => date('Y-m-d'),
                        'indikator_mutu_id' => $indikatorMutuId,
                        'surveyor' => 'Diisi NIP',
                        'numerator' => 0,
                        'denumerator' => 0,
                        'score' => 0
                    ];

                    $simpanHasil = HasilSurveyImutNasional::create($dataHasil);
                } else if ($data['name'] != 'indikatorMutuId' AND $data['name'] != 'hasilSurveyId') {
                    $variabelSurveyId = substr($data['name'], -1);
                    $subVariabel = substr($data['name'], 0, -1);

                    $dataDetailHasil = [
                        'hasil_survey_id' => $simpanHasil->id,
                        'variabel_survey_id' => $variabelSurveyId,
                        'sub_variabel' => $subVariabel,
                        'value' => $data['value'],
                        'point' => 1,
                    ];

                    if($subVariabel == 'identifikasi')
                    {
                        $denumerator = $denumerator+1;
                    }

                    if($subVariabel <> 'identifikasi' )
                    {
                        $sub_numerator = $sub_numerator+1;
                    }else{
                        $sub_numerator = 0;
                    }

                    if($sub_numerator == 2)
                    {
                        $numerator = $numerator+1;
                    }

                    $updateHasil = HasilSurveyImutNasional::where('id', $simpanHasil->id)->update(
                        [
                            'numerator' => $numerator,
                            'denumerator' => $denumerator,
                            'score' => number_format($numerator/$denumerator, 2)
                        ]
                    );

                    $simpanDetailHasil = HasilSurveyImutNasionalDetail::create(
                        $dataDetailHasil
                    );
                }
            }

            return $this->helpers->retunJson(
                200,
                'Survey Kepatuhan Identifikasi Pasien Berhasil di Simpan'
            );
        } catch (exception $e) {
            return $this->helpers->retunJson(
                400,
                'Terjadi Kesalahan Saat Menyimpan Data, Survey Kepatuhan Identifikasi Pasien Gagal Disimpan'
            );
        }
    }

    public function update(Request $request, $id)
    {
        $denumerator = 0;
        $numerator = 0;
        $sub_numerator = 0;
        $hasilSurveyId = $id;
        $dataDetail = [];
        $baseHasilSurvey = HasilSurveyImutNasional::where('id', $hasilSurveyId)->first();

        try {
            foreach ($request->dataPasien as $pasien) {
                $dataPasien[$pasien['name']] = $pasien['value'];
            }

            //Simpan Data Pasien
            $simpanPasien = [
                'no_reg' => $dataPasien['dataPasienNoreg'],
                'nama_pasien' => $dataPasien['dataPasienNama'],
                'norm' => $dataPasien['dataPasienNorm'],
                'kdbagian' => $dataPasien['dataPasienKdbagian'],
                'nama_bagian' => $dataPasien['dataPasienBagian'],
            ];

            //simpan ke data object
            $pasienSimpan = ObjectPasien::where('id', $baseHasilSurvey->id_object)->update($simpanPasien);

            foreach ($request->data as $data) {
                if ($data['name'] == 'indikatorMutuId') {
                    $indikatorMutuId = $data['value'];
                    $indikatorMutu = IndikatorMutuNasional::where(
                        'id',
                        $indikatorMutuId
                    )->first();

                    //master hasil survey
                    $dataHasil = [
                        'id_object' => $baseHasilSurvey->id_object,
                        'jenis_object' => 'App\Models\ObjectPasien',
                        'tgl_survey' => date('Y-m-d'),
                        'indikator_mutu_id' => $indikatorMutuId,
                        'surveyor' => 'Diisi NIP',
                        'numerator' => 0,
                        'denumerator' => 0,
                        'score' => 0
                    ];

                    $simpanHasil = HasilSurveyImutNasional::where('id', $hasilSurveyId)->update($dataHasil);
                }  else if ($data['name'] != 'indikatorMutuId' AND $data['name'] != 'hasilSurveyId') {
                    $variabelSurveyId = substr($data['name'], -1);
                    $subVariabel = substr($data['name'], 0, -1);

                    $dataDetailHasil = [
                        'hasil_survey_id' => $hasilSurveyId,
                        'variabel_survey_id' => $variabelSurveyId,
                        'sub_variabel' => $subVariabel,
                        'value' => $data['value'],
                        'point' => 1,
                    ];

                    if($subVariabel == 'identifikasi')
                    {
                        $denumerator = $denumerator+1;
                    }

                    if($subVariabel <> 'identifikasi' )
                    {
                        $sub_numerator = $sub_numerator+1;
                    }else{
                        $sub_numerator = 0;
                    }

                    if($sub_numerator == 2)
                    {
                        $numerator = $numerator+1;
                    }

                    $updateHasil = HasilSurveyImutNasional::where('id', $hasilSurveyId)->update(
                        [
                            'numerator' => $numerator,
                            'denumerator' => $denumerator,
                            'score' => number_format($numerator/$denumerator, 2)
                        ]
                    );

                    $simpanDetailHasil = HasilSurveyImutNasionalDetail::updateOrCreate(
                        $dataDetailHasil
                    );

                    if($simpanDetailHasil)
                    {
                        $dataDetail[] = $simpanDetailHasil->id;
                    }
                }


            }

            //Hapus Detail yang tidak ada dalam daftar
            $delete = HasilSurveyImutNasionalDetail::where('hasil_survey_id', $hasilSurveyId)->whereNotIn('id', $dataDetail)->delete();

            return $this->helpers->retunJson(
                200,
                'Survey Kepatuhan Identifikasi Pasien Berhasil di Simpan'
            );
        } catch (exception $e) {
            return $this->helpers->retunJson(
                400,
                'Terjadi Kesalahan Saat Menyimpan Data, Survey Kepatuhan Identifikasi Pasien Gagal Disimpan'
            );
        }
    }
}
