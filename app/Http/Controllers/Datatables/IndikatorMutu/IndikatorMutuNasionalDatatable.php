<?php

namespace App\Http\Controllers\Datatables\IndikatorMutu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IndikatorMutuNasional;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class IndikatorMutuNasionalDatatable extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->indikatorMutuNasional = new indikatorMutuNasional;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $imut       = IndikatorMutuNasional::with('frekuensi', 'kategori', 'tipe');
        return DataTables::of($imut)
            //hanya judul
            ->editColumn('hanyaJudul', function($imut)use($request){
                return $imut->judul;
            })
            ->editColumn('judul', function($imut)use($request){
                return view('contents.indikatorMutu.indikatorMutuNasional.customColumn.actionVariabel',\compact('imut'));
            })
            ->addColumn('action', function ($imut) {
                return view('contents.indikatorMutu.indikatorMutuNasional.customColumn.action',\compact('imut'));
            })
            ->addColumn('actionPilih', function ($imut) {
                return view('contents.indikatorMutu.indikatorMutuNasional.customColumn.actionPilih',\compact('imut'));
            })
            ->rawColumns(['judul', 'definisi_operasional', 'action', 'hanyaJudul',' actionPilih'])
            ->make(true);
    }
}
