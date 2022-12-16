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

                return '<label class="badge badge-'.$tema['theme'].' fs-7">'.$antrian->NO_ANTRI.'</label>';

            })
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
                if ($antrian->JAM_DILAYANI == null) {
                    return '<span class="badge badge-danger">Belum di Layani</span>';
                } else {
                    return date('H:i:s', strtotime($antrian->JAM_DILAYANI));
                }
            })
            ->editColumn('JAM_SELESAI', function ($antrian) use ($request) {
                if ($antrian->JAM_SELESAI == null) {
                    return '<span class="badge badge-danger">Belum Selesai</span>';
                } else {
                    return date('H:i:s', strtotime($antrian->JAM_SELESAI));
                }
            })

            ->editColumn('NAMAPAS', function ($antrian) use ($request) {
                if ($antrian->NAMAPAS) {
                    $namapasien =
                        $antrian->NAMAPAS .
                        '(' .
                        $antrian->NORMPAS .
                        ') <br>' .
                        $antrian->NOREGRS;
                } else {
                    $namapasien =
                        '<span class="badge badge-warning">Belum Ada Data</span>';
                }
                return $namapasien;
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

            ->addColumn('action', function ($antrian) {
                return view(
                    'contents.form.registrasiAntrianIgd.action',
                    \compact('antrian')
                );
            })
            ->rawColumns([
                'action',
                'NO_ANTRI',
                'STATUS_PANGGIL',
                'STATUS_DILAYANI',
                'JAM_DILAYANI',
                'JAM_SELESAI',
                'NAMAPAS',
                'EMERGENCYTIME',
                'LAMA_PELAYANAN'
            ])
            ->make(true);
    }
}
