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
        $this->helpers = new Helpers;
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
                        'jenis_object' => 'pasien',
                        'tgl_survey' => date('Y-m-d'),
                        'indikator_mutu_id' => $indikatorMutuId,
                        'surveyor' => 'Diisi NIP',
                    ];

                    $simpanHasil = HasilSurveyImutNasional::create($dataHasil);
                } else {
                    $variabelSurveyId = substr($data['name'], -1);
                    $subVariabel = substr($data['name'], 0, -1);

                    $dataDetailHasil = [
                        'hasil_survey_id' => $simpanHasil->id,
                        'variabel_survey_id' => $variabelSurveyId,
                        'sub_variabel' => $subVariabel,
                        'value' => $data['value'],
                        'point' => 1,
                    ];

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
}
