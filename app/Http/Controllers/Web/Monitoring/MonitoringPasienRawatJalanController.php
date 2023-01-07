<?php

namespace App\Http\Controllers\Web\Monitoring;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Bagian;

class MonitoringPasienRawatJalanController extends Controller
{

    public function __construct()
    {
        $this->bagian = new Bagian();
    }

    public function index()
    {
        $dataFilterBagian = $this->bagian->where('GRPUNIT', '91')->select('KDBAGIAN', 'GRPUNIT', 'NAMABAGIAN')->get();

        $data = [
            'dataFilterBagian' => $dataFilterBagian
        ];

        return view('contents.monitoring.monitoringPasienRawatJalan.index', $data);
    }
}
