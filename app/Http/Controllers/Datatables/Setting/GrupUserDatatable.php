<?php

namespace App\Http\Controllers\Datatables\Setting;

use App\Http\Controllers\Controller;
use App\Models\GrupUser;
use App\Helpers\HelperSurveilans;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Yajra\DataTables\Facades\DataTables;

class GrupUserDatatable extends Controller
{

    public function __construct()
    {
        $this->helperSurveilans = new HelperSurveilans;
    }

    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

        $grupuser = GrupUser::query();

                return DataTables::of($grupuser)

                ->addColumn('action', function ($grupuser) {
                    return view('contents.setting.grupuser.action',\compact('grupuser'));
                })

                ->rawColumns(['action'])
                    ->make(true);
    }
}
