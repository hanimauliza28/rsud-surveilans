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

class PenundaanOperasiElektifController extends Controller
{
    public function __construct()
    {
        $this->objectPasien = new ObjectPasien();
        $this->helpers = new Helpers();
    }

    public function store(Request $request)
    {
        $denumerator = 0;
        $numerator = 0;
        $sub_numerator = 0;

        try {
            foreach ($request->data as $data) {
                if ($data['name'] == 'indikatorMutuId') {
                    $indikatorMutuId = $data['value'];
                    $indikatorMutu = IndikatorMutuNasional::where(
                        'id',
                        $indikatorMutuId
                    )->first();

                    //master hasil survey
                    $dataHasil = [
                        'id_object' => '0',
                        'jenis_object' => '',
                        'tgl_survey' => date('Y-m-d'),
                        'indikator_mutu_id' => $indikatorMutuId,
                        'surveyor' => 'Diisi NIP',
                        'numerator' => 0,
                        'denumerator' => 0,
                        'score' => 0,
                    ];

                    $simpanHasil = HasilSurveyImutNasional::create($dataHasil);
                } elseif ($data['name'] == 'tanggalSurvey') {
                    $tanggalSurvey = $data['value'];
                } elseif ($data['name'] == 'jumlahPasienOperasi') {
                    $denumerator = $data['value'];
                } elseif (
                    $data['name'] != 'indikatorMutuId' AND
                    $data['name'] != 'hasilSurveyId' AND
                    $data['name'] != 'jumlahPasienOperasi' AND
                    $data['name'] != 'tanggaSurvey'
                ) {
                    $cariIdVariabel = VariabelSurvey::where(
                        'nama_variabel',
                        $data['name']
                    )->first();

                    $numerator = $numerator + 1;
                    $dataDetailHasil = [
                        'hasil_survey_id' => $simpanHasil->id,
                        'variabel_survey_id' => $cariIdVariabel->id,
                        'sub_variabel' => '',
                        'value' => $data['value'],
                        'point' => 1,
                    ];

                    $simpanDetailHasil = HasilSurveyImutNasionalDetail::create(
                        $dataDetailHasil
                    );
                }
            }

            $score = $numerator/$denumerator;
            $dataUpdateHasil = [
                'numerator' => $numerator,
                'denumerator' => $denumerator,
                'score' => $score
            ];

            $updateHasil = HasilSurveyImutNasional::where('id', $simpanHasil->id)->update($dataUpdateHasil);

            return $this->helpers->retunJson(
                200,
                'Survey Penundaan Operasi Elektif Berhasil di Simpan'
            );
        } catch (exception $e) {
            return $this->helpers->retunJson(
                400,
                'Terjadi Kesalahan Saat Menyimpan Survey Penundaan Operasi Elektif Gagal Disimpan'
            );
        }
    }

    public function update(Request $request, $id)
    {
        $denumerator = 0;
        $numerator = 0;
        $whereInNoreg = [];
        $hasilSurveyId = $id;
        try {
            foreach ($request->data as $data) {
                if ($data['name'] == 'indikatorMutuId') {
                    $indikatorMutuId = $data['value'];
                    $indikatorMutu = IndikatorMutuNasional::where(
                        'id',
                        $indikatorMutuId
                    )->first();

                    //master hasil survey
                    $dataHasil = [
                        'id_object' => '0',
                        'jenis_object' => '',
                        'indikator_mutu_id' => $indikatorMutuId,
                        'surveyor' => 'Diisi NIP',
                        'numerator' => 0,
                        'denumerator' => 0,
                        'score' => 0,
                    ];

                    $simpanHasil = HasilSurveyImutNasional::where('id', $id)->update($dataHasil);

                } elseif ($data['name'] == 'tanggalSurvey') {
                    $tanggalSurvey = $data['value'];
                } elseif ($data['name'] == 'jumlahPasienOperasi') {
                    $denumerator = $data['value'];
                } elseif (
                    $data['name'] != 'indikatorMutuId' AND
                    $data['name'] != 'hasilSurveyId' AND
                    $data['name'] != 'jumlahPasienOperasi' AND
                    $data['name'] != 'tanggaSurvey'
                ) {
                    $cariIdVariabel = VariabelSurvey::where(
                        'nama_variabel',
                        $data['name']
                    )->first();

                    $numerator = $numerator + 1;
                    $dataDetailHasil = [
                        'hasil_survey_id' => $hasilSurveyId,
                        'variabel_survey_id' => $cariIdVariabel->id,
                        'sub_variabel' => '',
                        'value' => $data['value'],
                        'point' => 1,
                    ];

                    $whereInNoreg[] = $data['value'];

                    $simpanDetailHasil = HasilSurveyImutNasionalDetail::updateOrCreate(
                        $dataDetailHasil
                    );
                }
            }

            $score = $numerator/$denumerator;
            $dataUpdateHasil = [
                'numerator' => $numerator,
                'denumerator' => $denumerator,
                'score' => $score
            ];

            $updateHasil = HasilSurveyImutNasional::where('id', $hasilSurveyId)->update($dataUpdateHasil);

            //Hapus yang Noregnya tidak disitu

            $delete = HasilSurveyImutNasionalDetail::where('hasil_survey_id', $hasilSurveyId)->whereNotIn('value', $whereInNoreg)->delete();



            return $this->helpers->retunJson(
                200,
                'Survey Penundaan Operasi Elektif Berhasil di Simpan'
            );
        } catch (exception $e) {
            return $this->helpers->retunJson(
                400,
                'Terjadi Kesalahan Saat Menyimpan Survey Penundaan Operasi Elektif Gagal Disimpan'
            );
        }
    }
}
