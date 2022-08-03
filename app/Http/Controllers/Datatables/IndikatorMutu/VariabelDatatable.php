<?php

namespace App\Http\Controllers\Datatables\IndikatorMutu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Variabel;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class VariabelDatatable extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->variabel = new variabel;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $variabel       = Variabel::when($request->indikatorId, function($query) use($request){
                                $query->where('indikator_mutu_id', $request->indikatorId);
                            });

        return DataTables::of($variabel)
            ->addColumn('tipeVariabelIndikator', function($variabel){
                return $variabel->tipe_variabel_text;
            })
            ->addColumn('action', function ($variabel) {
                return view('contents.indikatorMutu.indikatorMutuNasional.customColumn.actionVariabelTable',\compact('variabel'));
            })
            ->rawColumns([])
            ->make(true);
    }

    public function getAttribute()
    {
        return Carbon::parse($this->tanggal_lahir)->format('dmY');
    }
}
