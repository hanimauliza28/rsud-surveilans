<?php

namespace App\Http\Controllers\Datatables\Master;

use App\Http\Controllers\Controller;
use App\Models\MasterWebService;
use App\Models\HelperSurveilans;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Yajra\DataTables\Facades\DataTables;

class WebServiceDatatable extends Controller
{

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $filterJenisService = $request->filterJenisService;

        $service = MasterWebService::when($filterJenisService, function($query) use($filterJenisService){
                        $query->where('jenis_service', $filterJenisService);
                    });
                return DataTables::of($service)
                ->addColumn('jenisService', function($service){
                    return $service->nama_jenis_service;
                })
                ->addColumn('action', function ($service) {
                    return view('contents.master.webService.customColumn.action',\compact('service'));
                })
                ->rawColumns(['action'])
                    ->make(true);
    }
}
