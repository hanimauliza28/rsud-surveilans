<?php

namespace App\Http\Controllers\Web\Monitoring\MonitoringPasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MasterWebService;
use App\Models\IndikatorMutuNasional;
use App\Models\VariabelSurvey;
use App\Models\KategoriVariabelSurvey;

class KepatuhanIdentifikasiPasienController extends Controller
{
    public function index(){
        $data = [
            'dataServicePasien' => MasterWebService::where('jenis_service', 'dataPasien')->get(),
            'dataImut' => IndikatorMutuNasional::select('id', 'judul', 'nama_function')->get(),
            'kategoriVariabelSurvey' => KategoriVariabelSurvey::where('nama_kategori', 'daftarProsesIdentifikasi')->with('variabelSurvey')->first()
        ];

        return view('contents.monitoring.monitoringPasien.kepatuhanIdentifikasi.main', $data);
    }
}
