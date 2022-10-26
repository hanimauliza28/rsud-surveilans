<?php

namespace App\Http\Controllers\Datatables\Monitoring;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AnthropometricResult;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class AnthropometricDatatable extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $norm = $request->norm;

        $anthropometric = AnthropometricResult::where('norm', $norm);

        return DataTables::of($anthropometric)
            ->addColumn('action', function ($anthropometric) {
                return view('contents.monitoring.anthropometric.customColumn.action', \compact('anthropometric')
                );
            })
            ->editColumn('tgl_survey', function($anthropometric){
                return $anthropometric->tgl_survey;
            })
            ->rawColumns([
                'action',
            ])
            ->make(true);
    }
}
