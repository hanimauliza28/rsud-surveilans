<?php

namespace App\Http\Controllers\Datatables\Setting;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use App\Models\HelperSurveilans;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Yajra\DataTables\Facades\DataTables;

class PengumumanDatatable extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {

     }
    public function __invoke(Request $request)
    {

        $pengumuman = Pengumuman::query();

        return DataTables::of($pengumuman)
            ->editColumn('created_at', function ($pengumuman) {
                return date('Y-m-d H:i:s', strtotime($pengumuman->created_at));
            })
            ->editColumn('status', function ($pengumuman) {
                return $pengumuman->label_status;
            })
            ->addColumn('action', function ($pengumuman) {
                return view('contents.setting.pengumuman.action', \compact('pengumuman'));
            })
            ->addColumn('actionAktifkan', function ($pengumuman) {
                return view('contents.setting.pengumuman.actionAktifkan', \compact('pengumuman'));
            })
            ->rawColumns(['action', 'status'])
            ->make(true);
    }
}
