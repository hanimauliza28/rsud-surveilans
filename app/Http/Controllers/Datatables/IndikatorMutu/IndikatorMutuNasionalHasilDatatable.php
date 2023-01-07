<?php

namespace App\Http\Controllers\Datatables\IndikatorMutu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HasilSurveyImutNasional;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class IndikatorMutuNasionalHasilDatatable extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->hasilSurveyImutNasional = new HasilSurveyImutNasional;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $filterIndikatorMutu = $request->filterIndikatorMutu;
        $filterTanggal = $request->filterTanggal;

        $hasil       = HasilSurveyImutNasional::where('indikator_mutu_id', $filterIndikatorMutu)
        ->whereDate('tgl_survey', $filterTanggal)
        ->with('object');
        return DataTables::of($hasil)

            ->editColumn('numerator', function ($hasil) {
                return gmdate('H:i:s', $hasil->numerator);
            })
            ->addColumn('action', function ($hasil) {
                return view('contents.indikatorMutu.nasional.wajib.actionHasil',\compact('hasil'));
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
