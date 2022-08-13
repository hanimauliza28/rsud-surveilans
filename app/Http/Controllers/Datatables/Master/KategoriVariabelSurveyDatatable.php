<?php

namespace App\Http\Controllers\Datatables\Master;

use App\Http\Controllers\Controller;
use App\Models\KategoriVariabelSurvey;
use App\Models\HelperSurveilans;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Yajra\DataTables\Facades\DataTables;

class KategoriVariabelSurveyDatatable extends Controller
{

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $kategori = KategoriVariabelSurvey::query();

                return DataTables::of($kategori)
                ->addColumn('action', function ($kategori) {
                    return view('contents.master.kategoriVariabelSurvey.customColumn.action',\compact('kategori'));
                })
                ->rawColumns(['action'])
                    ->make(true);
    }
}
