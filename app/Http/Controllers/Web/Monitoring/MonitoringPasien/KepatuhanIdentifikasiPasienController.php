<?php

namespace App\Http\Controllers\Web\Monitoring\MonitoringPasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MasterWebService;
use App\Models\IndikatorMutuNasional;

class KepatuhanIdentifikasiPasienController extends Controller
{
    public function index(){
        $data = [
            'dataServicePasien' => MasterWebService::where('jenis_service', 'dataPasien')->get(),
            'dataImut' => IndikatorMutuNasional::select('id', 'judul', 'nama_route')->get()
        ];

        return view('contents.monitoring.monitoringPasien.kepatuhanIdentifikasi.main', $data);
    }
}
