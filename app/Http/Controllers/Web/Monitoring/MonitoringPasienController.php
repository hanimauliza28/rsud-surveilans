<?php

namespace App\Http\Controllers\Web\Monitoring;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\MasterWebService;

class MonitoringPasienController extends Controller
{
    public function index(){
        $data = [
            'dataServicePasien' => MasterWebService::where('jenis_service', 'dataPasien')->get()
        ];

        return view('contents.monitoring.monitoringPasien.index', $data);
    }
}
