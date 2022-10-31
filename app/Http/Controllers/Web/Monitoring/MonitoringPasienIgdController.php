<?php

namespace App\Http\Controllers\Web\Monitoring;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\IndikatorMutuNasional;

class MonitoringPasienIgdController extends Controller
{
    public function index()
    {
        $data = [
            'dataImut' => IndikatorMutuNasional::select(
                'id',
                'judul',
                'nama_function'
            )->get(),
        ];
        // dd($data['dataImut']);
        return view('contents.monitoring.monitoringPasienIgd.index', $data);
    }
}
