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
        $this->helperTime = new HelperTime();
        $this->helperSurveilans = new HelperSurveilans();
        $this->antrianIgd = new AntrianIgd;
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

        //Scrapping Nomor Registrasi di RI atau RJ
        $scrappingPasien = $this->antrianIgd->scrappingpasien($filterTanggal);

        $antrian = AntrianIgd::where('TGL_ANTRI', $filterTanggal)->where('GRUP_ANTRI', '03')
            ->when($filterPanggil, function ($query) use ($filterPanggil) {
                $query->where('STATUS_PANGGIL', $filterPanggil);
            })
            ->when($filterDilayani, function ($query) use ($filterDilayani) {
                $query->where('STATUS_DILAYANI', $filterDilayani);
            });

        return DataTables::of($antrian)
            //hanya judul
            ->editColumn('NO_ANTRI', function ($antrian) use ($request) {
                $tema = $this->helperSurveilans->labelTriage($antrian->TRIAGE);

                return view(
                    'contents.form.registrasiAntrianIgd.noAntri',
                    \compact('antrian', 'tema')
                );
            })
            ->editColumn('STATUS_PANGGIL', function ($antrian) use ($request) {
                return view(
                    'contents.form.registrasiAntrianIgd.actionMulai',
                    \compact('antrian')
                );
            })

            ->editColumn('TGL_INPUT', function ($antrian) use ($request) {
                $tanggal = "'".date("Y-m-d", strtotime($antrian->TGL_INPUT))."'";
                $noAntrian = "'".$antrian->NO_ANTRI."'";
                return '<span class="" onclick="ubahTglInput('.$noAntrian.','.$tanggal.')">'.date('H:i:s', strtotime($antrian->TGL_INPUT)).'</span>';
            })

            ->editColumn('JAM_DILAYANI', function ($antrian) use ($request) {
                if ($antrian->JAM_DILAYANI == null) {
                    return '<span class="badge badge-danger fw-normal fs-9">Belum di Layani</span>';
                } else {
                    return date('H:i:s', strtotime($antrian->JAM_DILAYANI));
                }
            })

            ->editColumn('JAM_SELESAI', function ($antrian) use ($request) {
                if ($antrian->JAM_SELESAI == null) {
                    return '<span class="badge badge-danger fw-normal fs-9">Belum Selesai</span>';
                } else {
                    return date('H:i:s', strtotime($antrian->JAM_SELESAI));
                }
            })

            ->editColumn('NAMAPAS', function ($antrian) use ($request) {
                return view(
                    'contents.form.registrasiAntrianIgd.namaPasien',
                    \compact('antrian')
                );
            })

            ->addColumn('EMERGENCYTIME', function ($antrian) use ($request) {

                if($antrian->ERT > 300)
                {
                    return '<span class="badge badge-light-danger">'.gmdate('H:i:s', $antrian->ERT).'</span>';
                }else{
                    return '<span class="badge badge-light-success">'.gmdate('H:i:s', $antrian->ERT).'</span>';
                }

            })

            ->addColumn('LAMA_PELAYANAN', function ($antrian) use ($request) {
                return '<span class="badge badge-light-info">'.gmdate('H:i:s', $antrian->LAMA_PELAYANAN).'</span>';
            })

            ->rawColumns([
                'action',
                'NO_ANTRI',
                'STATUS_PANGGIL',
                'STATUS_DILAYANI',
                'TGL_INPUT',
                'JAM_DILAYANI',
                'JAM_SELESAI',
                'NAMAPAS',
                'EMERGENCYTIME',
                'LAMA_PELAYANAN'
            ])
            ->make(true);
    }
}
