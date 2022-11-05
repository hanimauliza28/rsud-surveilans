<?php

namespace App\Http\Controllers\Datatables\Form;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AntrianIgd;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use App\Helpers\HelperTime;
use App\Helpers\HelperSurveilans;
use Carbon\Carbon;

class RegistrasiAntrianIgdDatatable extends Controller
{
    public function __construct()
    {
        $this->helperTime = new HelperTime;
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
        $filterTanggal = $request->filterTanggal;
        $filterTanggal = date('Y-m-d', strtotime($filterTanggal));
        $filterPanggil = $request->filterPanggil;
        $filterDilayani = $request->filterDilayani;

        $antrian = AntrianIgd::where('TGL_ANTRI', $filterTanggal)
            ->when($filterPanggil, function($query) use($filterPanggil){
                $query->where('STATUS_PANGGIL', $filterPanggil);
            })
            ->when($filterDilayani, function($query) use($filterDilayani){
                $query->where('STATUS_DILAYANI', $filterDilayani);
            });


        return DataTables::of($antrian)
            //hanya judul
            ->editColumn('STATUS_PANGGIL', function ($antrian) use ($request) {
                return view(
                    'contents.form.registrasiAntrianIgd.actionMulai',
                    \compact('antrian')
                );
            })
            ->editColumn('TGL_INPUT', function ($antrian) use ($request) {
                return date('H:i:s', strtotime($antrian->TGL_INPUT));
            })
            ->editColumn('STATUS_DILAYANI', function ($antrian) use ($request) {
                return view(
                    'contents.form.registrasiAntrianIgd.actionSelesai',
                    \compact('antrian')
                );
            })
            ->editColumn('JAM_DILAYANI', function ($antrian) use ($request) {
                if($antrian->JAM_DILAYANI == NULL)
                {
                    return '<span class="badge badge-danger">Belum di Layani</span>';
                }else{
                    return date('H:i:s', strtotime($antrian->JAM_DILAYANI));
                }

            })
            ->editColumn('JAM_SELESAI', function ($antrian) use ($request) {
                if($antrian->JAM_SELESAI == NULL)
                {
                    return '<span class="badge badge-danger">Belum Selesai</span>';
                }else{
                    return date('H:i:s', strtotime($antrian->JAM_SELESAI));
                }
            })

            ->editColumn('NAMAPAS', function ($antrian) use ($request) {
                if($antrian->NAMAPAS)
                {
                    $namapasien = $antrian->NAMAPAS.'('.$antrian->NORMPAS.') <br>'.$antrian->NOREGRS;
                }else{
                    $namapasien = '<span class="badge badge-warning">Belum Ada Data</span>';
                }
                return $namapasien;

            })


            ->addColumn('EMERGENCYTIME', function ($antrian) use ($request) {

                $date = new Carbon($antrian->TGL_INPUT, 'Asia/Jakarta');

                if($antrian->JAM_DILAYANI == NULL)
                {
                    $menit = "Menunggu";
                }else{
                    $menit = $date->diffInMinutes($antrian->JAM_DILAYANI);
                }

                return $menit;

            })

            ->addColumn('action', function ($antrian) {
                return view(
                    'contents.form.registrasiAntrianIgd.action',
                    \compact('antrian')
                );
            })
            ->rawColumns([
                'action',
                'STATUS_PANGGIL',
                'STATUS_DILAYANI',
                'JAM_DILAYANI',
                'JAM_SELESAI',
                'NAMAPAS'
            ])
            ->make(true);
    }
}