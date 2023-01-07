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

class WaktuTungguRawatJalanController extends Controller
{
    public function __construct()
    {
        $this->objectPasien = new ObjectPasien();
        $this->helpers = new Helpers();
    }

    public function store(Request $request)
    {
        $denumerator = 1;
        $numerator = 0;
        $sub_numerator = 0;

        $tanggalSurvey = $request->tanggalSurvey;

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
                        'tgl_survey' => $tanggalSurvey,
                        'indikator_mutu_id' => $indikatorMutuId,
                        'surveyor' => 'Diisi NIP',
                        'numerator' => 0, //waktuTunggu
                        'denumerator' => 1,
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

                    if ($data['name'] == 'waktuTunggu') {
                        $numerator = $data['value'];
                    }

                    if ($numerator) {
                        $updateHasil = HasilSurveyImutNasional::where(
                            'id',
                            $simpanHasil->id
                        )->update([
                            'numerator' => $numerator,
                            'score' => 1
                        ]);
                    }

                    $simpanDetailHasil = HasilSurveyImutNasionalDetail::create(
                        $dataDetailHasil
                    );
                }
            }

            return $this->helpers->retunJson(
                200,
                'Survey Waktu Tunggu Pasien Rawat Jalan Berhasil di Simpan'
            );
        } catch (exception $e) {
            return $this->helpers->retunJson(
                400,
                'Terjadi Kesalahan Saat Menyimpan Survey Waktu Tunggu Pasien Rawat Jalan Gagal Disimpan'
            );
        }
    }

    public function update(Request $request, $id)
    {
        $denumerator = 1;
        $numerator = 0;
        $sub_numerator = 0;
        $hasilSurveyId = $id;

        $tanggalSurvey = $request->tanggalSurvey;

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
                        'tgl_survey' => $tanggalSurvey,
                        'indikator_mutu_id' => $indikatorMutuId,
                        'surveyor' => 'Diisi NIP',
                        'numerator' => 0,
                        'denumerator' => 1,
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

                    if ($data['name'] == 'waktuTunggu') {
                        $numerator = $data['value'];
                    }

                    if ($numerator) {
                        $updateHasil = HasilSurveyImutNasional::where(
                            'id',
                            $hasilSurveyId
                        )->update([
                            'numerator' => $numerator,
                            'score' => 1
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
                'Survey Waktu Tunggu Pasien Rawat Jalan Berhasil di Perbarui'
            );
        } catch (exception $e) {
            return $this->helpers->retunJson(
                400,
                'Terjadi Kesalahan Saat Menyimpan Survey Waktu Tunggu Pasien Rawat Jalan Gagal Diperbarui'
            );
        }
    }
}
