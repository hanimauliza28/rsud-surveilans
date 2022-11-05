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

class KepatuhanJamVisitDokterController extends Controller
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
            $pasienSimpan = ObjectPasien::updateOrCreate($simpanPasien);

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
                        'score' => 0,
                    ];

                    $simpanHasil = HasilSurveyImutNasional::create($dataHasil);
                } elseif (
                    $data['name'] != 'indikatorMutuId' and
                    $data['name'] != 'hasilSurveyId'
                ) {
                    $cariIdVariabel = VariabelSurvey::where(
                        'nama_variabel',
                        $data['name']
                    )->first();

                    $dataDetailHasil = [
                        'hasil_survey_id' => $simpanHasil->id,
                        'variabel_survey_id' => $cariIdVariabel->id,
                        'sub_variabel' => '',
                        'value' => $data['value'],
                        'point' => 1,
                    ];

                    if (
                        $data['name'] == 'waktuTanggap' &&
                        $data['value'] <= 300
                    ) {
                        $score = 1;
                    } else {
                        $score = 0;
                    }

                    if ($score) {
                        $updateHasil = HasilSurveyImutNasional::where(
                            'id',
                            $simpanHasil->id
                        )->update([
                            'score' => $score,
                        ]);
                    }

                    $simpanDetailHasil = HasilSurveyImutNasionalDetail::create(
                        $dataDetailHasil
                    );
                }
            }

            return $this->helpers->retunJson(
                200,
                'Survey Emergency Respon Time Berhasil di Simpan'
            );
        } catch (exception $e) {
            return $this->helpers->retunJson(
                400,
                'Terjadi Kesalahan Saat Menyimpan Survey Emergency Respon Time Gagal Disimpan'
            );
        }
    }

    public function update(Request $request, $id)
    {
        $denumerator = 0;
        $numerator = 0;
        $sub_numerator = 0;
        $hasilSurveyId = $id;

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
            $pasienSimpan = ObjectPasien::updateOrCreate($simpanPasien);

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
                        'score' => 0,
                    ];

                    $simpanHasil = HasilSurveyImutNasional::where(
                        'id',
                        $hasilSurveyId
                    )->update($dataHasil);
                } elseif (
                    $data['name'] != 'indikatorMutuId' and
                    $data['name'] != 'hasilSurveyId'
                ) {
                    $cariIdVariabel = VariabelSurvey::where(
                        'nama_variabel',
                        $data['name']
                    )->first();

                    $dataDetailHasil = [
                        'hasil_survey_id' => $hasilSurveyId,
                        'variabel_survey_id' => $cariIdVariabel->id,
                        'sub_variabel' => '',
                        'value' => $data['value'],
                        'point' => 1,
                    ];

                    if (
                        $data['name'] == 'waktuTanggap' &&
                        $data['value'] <= 300
                    ) {
                        $score = 1;
                    } else {
                        $score = 0;
                    }

                    if ($score) {
                        $updateHasil = HasilSurveyImutNasional::where(
                            'id',
                            $hasilSurveyId
                        )->update([
                            'score' => $score,
                        ]);
                    }

                    $simpanDetailHasil = HasilSurveyImutNasionalDetail::where(
                        'hasil_survey_id',
                        $hasilSurveyId
                    )
                        ->where('variabel_survey_id', $cariIdVariabel->id)
                        ->update($dataDetailHasil);
                }
            }

            return $this->helpers->retunJson(
                200,
                'Survey Emergency Respon Time Berhasil di Perbarui'
            );
        } catch (exception $e) {
            return $this->helpers->retunJson(
                400,
                'Terjadi Kesalahan Saat Menyimpan Survey Emergency Respon Time Gagal Diperbarui'
            );
        }
    }
}
