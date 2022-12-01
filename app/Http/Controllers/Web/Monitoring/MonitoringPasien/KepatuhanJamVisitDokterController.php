<?php

namespace App\Http\Controllers\Web\Monitoring\MonitoringPasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\Helpers;
use App\Helpers\HelperTime;
use App\Models\MasterWebService;
use App\Models\IndikatorMutuNasional;
use App\Models\DaftarPasien;
use App\Models\ObjectPasien;
use App\Models\RawatInap;
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
        $this->helperTime = new HelperTime();
        $this->daftarPasien = new DaftarPasien();
        $this->rawatInap = new RawatInap();
    }

    public function store(Request $request)
    {
        $tanggal = $request->tanggal;

        $tanggalNew = $this->helperTime->formatTanggalDatabase($tanggal);

        //Sync Data Pasien, Hanya ambil Pasien dalam daftar
        $dataPasien = $this->daftarPasien->pasienRawatInap(
            $tanggal,
            '',
            '',
            ''
        );
        $variabelSurvey = VariabelSurvey::where(
            'nama_variabel',
            'jamVisitDokter'
        )->first();

        foreach ($request->data as $data) {
            if ($data['name'] == 'indikatorMutuId') {
                $indikatorMutuId = $data['value'];
            }
        }

        try {
            foreach ($dataPasien as $pasien) {

                $numerator = 0;
                $denumerator = 0;
                $score = 0;

                //Simpan Data Pasien
                $simpanPasien = [
                    'no_reg' => $pasien->NOREGRS,
                    'nama_pasien' => $pasien->NMPASIEN,
                    'norm' => $pasien->NORMPAS,
                    'kdbagian' => $pasien->KDBAGIAN,
                    'nama_bagian' => $pasien->NAMABAGIAN,
                ];

                //simpan ke data object
                $pasienSimpan = ObjectPasien::firstOrCreate($simpanPasien);

                $dataHasil = [
                    'id_object' => $pasienSimpan->id,
                    'jenis_object' => 'App\Models\ObjectPasien',
                    'tgl_survey' => $tanggalNew,
                    'indikator_mutu_id' => $indikatorMutuId,
                    'surveyor' => session('userLogin')->username,
                    'numerator' => 0,
                    'denumerator' => 0,
                    'score' => 0,
                ];

                $simpanHasil = HasilSurveyImutNasional::firstOrCreate(
                    [
                        'id_object' => $pasienSimpan->id,
                        'indikator_mutu_id' => $indikatorMutuId,
                    ],
                    $dataHasil
                );

                //Ambil data visit pasien dalam daftar
                $dataVisit = $this->rawatInap->dataVisit($pasien->NOREGRS);

                if ($dataVisit != '') {
                    foreach ($dataVisit as $visit) {
                        if ($visit->TANGGAL == $tanggalNew) {

                            $denumerator = $denumerator+1;

                            if ($visit->WAKTU < '14:00:00') {
                                $point = 1;
                                $numerator = $numerator+1;
                                $score = 1;
                            } else {
                                $point = 0;
                                $numerator = $numerator+0;
                                $score = 0;
                            }

                            $jamvisit = substr($visit->WAKTU, 0, 8);

                            $dataDetailHasil = [
                                'hasil_survey_id' => $simpanHasil->id,
                                'variabel_survey_id' => $variabelSurvey->id,
                                'sub_variabel' => '',
                                'value' => $jamvisit,
                                'point' => 1,
                            ];

                            $simpanDetailHasil = HasilSurveyImutNasionalDetail::updateOrCreate(
                                [
                                    'hasil_survey_id' => $simpanHasil->id,
                                    'variabel_survey_id' => $variabelSurvey->id,
                                ],
                                $dataDetailHasil
                            );

                            $dataHasil = [
                                'id_object' => $pasienSimpan->id,
                                'jenis_object' => 'App\Models\ObjectPasien',
                                'tgl_survey' => $tanggalNew,
                                'indikator_mutu_id' => $indikatorMutuId,
                                'surveyor' => session('userLogin')->username,
                                'numerator' => $numerator,
                                'denumerator' => $denumerator,
                                'score' => $score,
                            ];

                            $simpanHasil = HasilSurveyImutNasional::updateOrCreate(
                                [
                                    'tgl_survey' => $tanggalNew,
                                    'id_object' => $pasienSimpan->id,
                                ],
                                $dataHasil
                            );
                        }
                    }
                }
            }

            return $this->helpers->retunJson(
                200,
                'Survey Kepatuhan Jam Visit Dokter Spesialis Berhasil di Simpan'
            );
        } catch (exception $e) {
            return $this->helpers->retunJson(
                400,
                'Terjadi Kesalahan Saat Menyimpan Data, Survey Kepatuhan Jam Visit Dokter Spesialis Gagal Disimpan'
            );
        }
    }
}
