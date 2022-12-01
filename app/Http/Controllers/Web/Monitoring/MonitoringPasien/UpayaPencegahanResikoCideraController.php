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
use App\Models\RawatInap;

class UpayaPencegahanResikoCideraController extends Controller
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
        $indikatorMutuId = $request->indikatorMutuId;
        $hasilSurveyId = $request->hasilSurveyId;
        $skriningIgdRajal = $request->skriningIgdRajal;
        $asesmenAwal = $request->asesmenAwal ?? '';
        $asesmenUlang = $request->asesmenUlang ?? '';


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

            //Ambil tgl pulang peserta
            // tanggal survey di isi dengan tanggal pulang pasien. tapi jika pasien belum pulang, tanggal hari ini
            $dataRegistrasi = RawatInap::where('NOREGRS', $dataPasien['dataPasienNoreg'])->first();

            if($dataRegistrasi->JAMPULANG != '')
            {
                $tanggalSurvey = date('Y-m-d', strtotime($dataRegistrasi->JAMPULANG))->first();
            }else{
                $tanggalSurvey = date('Y-m-d');
            }

            //Simpan Hasil Survey
            $dataHasil = [
                'id_object' => $pasienSimpan->id,
                'jenis_object' => 'App\Models\ObjectPasien',
                'tgl_survey' => $tanggalSurvey,
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

            //Simpan Hasil Detail Survey
            $variabelSkriningIgdRajal = VariabelSurvey::where('nama_variabel', 'skriningIgdRajal')->first();
            $variabelAsesmenAwal = VariabelSurvey::where('nama_variabel', 'asesmenAwal')->first();
            $variabelAsesmenUlang = VariabelSurvey::where('nama_variabel', 'asesmenUlang')->first();

            if($skriningIgdRajal != 'Y')
            {
                $pointSkriningIgdRajal = '0';
            }else{
                $pointSkriningIgdRajal = '1';
            }

            if($asesmenAwal != 'Y')
            {
                $pointAsesmenAwal = '0';
            }else{
                $pointAsesmenAwal = '1';
            }

            if($asesmenUlang != 'Y')
            {
                $pointAsesmenUlang = '0';
            }else{
                $pointAsesmenUlang = '1';
            }

            $dataIgdRajal = [
                'hasil_survey_id' => $simpanHasil->id,
                'variabel_survey_id' => $variabelSkriningIgdRajal->id,
                'sub_variabel' => '',
                'value' => $skriningIgdRajal,
                'point' => $pointSkriningIgdRajal,
            ];

            $simpanDetail = HasilSurveyImutNasionalDetail::updateOrCreate(
                [
                    'hasil_survey_id' => $simpanHasil->id,
                    'variabel_survey_id' => $variabelSkriningIgdRajal->id,
                ],
                $dataIgdRajal
            );

            $dataAsesmenAwal = [
                'hasil_survey_id' => $simpanHasil->id,
                'variabel_survey_id' => $variabelAsesmenAwal->id,
                'sub_variabel' => '',
                'value' => $asesmenAwal,
                'point' => $pointAsesmenAwal,
            ];

            $simpanDetail = HasilSurveyImutNasionalDetail::updateOrCreate(
                [
                    'hasil_survey_id' => $simpanHasil->id,
                    'variabel_survey_id' => $variabelAsesmenAwal->id,
                ],
                $dataAsesmenAwal
            );

            $dataAsesmenUlang = [
                'hasil_survey_id' => $simpanHasil->id,
                'variabel_survey_id' => $variabelAsesmenUlang->id,
                'sub_variabel' => '',
                'value' => $asesmenUlang,
                'point' => $pointAsesmenUlang,
            ];

            $simpanDetail = HasilSurveyImutNasionalDetail::updateOrCreate(
                [
                    'hasil_survey_id' => $simpanHasil->id,
                    'variabel_survey_id' => $variabelAsesmenUlang->id,
                ],
                $dataAsesmenUlang
            );

            if(($pointAsesmenAwal == '1' && $pointAsesmenUlang == '1') && $pointSkriningIgdRajal == '1')
            {

                //Simpan Hasil Survey
                $dataHasil = [
                    'numerator' => 3,
                    'denumerator' => 0,
                    'score' => 1,
                ];

                $simpanHasil = HasilSurveyImutNasional::updateOrCreate(
                    [
                        'id_object' => $pasienSimpan->id,
                        'indikator_mutu_id' => $indikatorMutuId,
                    ],
                    $dataHasil
                );
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

}
