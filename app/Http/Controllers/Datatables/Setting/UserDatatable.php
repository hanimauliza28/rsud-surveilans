<?php

namespace App\Http\Controllers\Datatables\Setting;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Helpers\HelperSurveilans;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Yajra\DataTables\Facades\DataTables;

class UserDatatable extends Controller
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

        $user = User::with('grupUser');

                return DataTables::of($user)

                ->addColumn('action', function ($user) {
                    return view('contents.setting.user.action',\compact('user'));
                })

                ->editColumn('grup_user_id', function ($user) {
                    return $user->grupUser->nama_grup;
                })

                ->editColumn('status', function ($user) {
                    return $this->helperSurveilans->labelStatusUser($user->status);
                })

                ->rawColumns(['action', 'level', 'status'])
                    ->make(true);
    }
}
