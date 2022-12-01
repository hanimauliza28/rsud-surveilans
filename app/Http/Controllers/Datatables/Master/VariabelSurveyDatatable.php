<?php

namespace App\Http\Controllers\Datatables\Master;

use App\Http\Controllers\Controller;
use App\Models\VariabelSurvey;
use App\Models\HelperSurveilans;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Yajra\DataTables\Facades\DataTables;

class VariabelSurveyDatatable extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $variabel = VariabelSurvey::with('parent', 'kategori');
        return DataTables::of($variabel)
            ->addColumn('namaKategori', function ($variabel) {
                return $variabel->kategori->keterangan ?? '';
            })
            ->addColumn('namaParent', function ($variabel) {
                return $variabel->parent->nama_kategori ?? '';
            })
            ->addColumn('action', function ($variabel) {
                return view(
                    'contents.master.variabelSurvey.customColumn.action',
                    \compact('variabel')
                );
            })
            ->rawColumns(['action'])
            // ->make(true)
            ->toJson();
    }
}
