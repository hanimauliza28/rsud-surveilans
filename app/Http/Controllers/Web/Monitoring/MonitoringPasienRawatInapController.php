<?php

namespace App\Http\Controllers\Web\Monitoring;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\IndikatorMutuNasional;
use App\Models\Bagian;

use App\Helpers\HelperSurveilans;

class MonitoringPasienRawatInapController extends Controller
{

    public function __construct()
    {
        $this->imutnas = new IndikatorMutuNasional();
        $this->bagian = new Bagian();
        $this->helperSurveilans = new HelperSurveilans();
    }

    public function index()
    {
        $dataFilterBagian = $this->bagian->where('GRPUNIT', '93')->select('KDBAGIAN', 'GRPUNIT', 'NAMABAGIAN')->get();
        $dataRawat = $this->helperSurveilans->filterRawatInap();

        $dataImut = IndikatorMutuNasional::select(
                'id',
                'judul',
                'nama_function'
            )->get();

        $data = [
            'dataImut' => $dataImut,
            'dataFilterBagian' => $dataFilterBagian,
            'dataFilterRawat' => $dataRawat
        ];

        return view('contents.monitoring.monitoringPasienRawatInap.index', $data);
    }
}
