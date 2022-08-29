<?php

namespace App\Http\Controllers\Web\Monitoring;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\Helpers;
use App\Models\MasterWebService;
use App\Models\IndikatorMutuNasional;
use App\Models\SumberDataPasien;
use App\Models\Bagian;

class MonitoringPasienController extends Controller
{
    public function __construct()
    {
        $this->sumberDataPasien = new SumberDataPasien();
        $this->masterWebService = new MasterWebService();
        $this->indikatorMutuNasional = new IndikatorMutuNasional();
        $this->bagian = new Bagian();

        $this->helpers = new Helpers();
    }

    public function index()
    {
        $data = [
            'dataServicePasien' => MasterWebService::where(
                'jenis_service',
                'dataPasien'
            )->get(),
            'dataBagian' => $this->sumberDataPasien->bagian('91'),
            'dataImut' => IndikatorMutuNasional::select(
                'id',
                'judul',
                'nama_function'
            )->get(),
        ];

        return view('contents.monitoring.monitoringPasien.noImut.main', $data);
    }

    public function filterBagian(Request $request)
    {
        $webservice = MasterWebService::where('id', $request->id)->first();

        if ($webservice->jenis_filter == 'ranap') {
            $bagian = $this->sumberDataPasien->bagian('93');
        } else {
            $bagian = $this->sumberDataPasien->bagian('91');
        }

        $bagian
            ? ($response = $this->helpers->retunJson(200, 'Sukses', $bagian))
            : ($response = $this->helpers->retunJson(
                404,
                'Data Filter Bagian Tidak Ditemukan'
            ));

        return $response;
    }
}
