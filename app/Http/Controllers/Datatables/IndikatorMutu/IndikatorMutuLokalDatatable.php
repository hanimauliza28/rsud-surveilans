<?php

namespace App\Http\Controllers\Datatables\IndikatorMutu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\IndikatorMutuLokal;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;

class IndikatorMutuLokalDatatable extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $filterKategoriIndikator = $request->filterKategoriIndikator;

        $imut = IndikatorMutuLokal::with('frekuensi', 'kategori', 'tipe')
            ->when($filterKategoriIndikator, function($query) use($filterKategoriIndikator){
                $query->where('kategori_indikator_id', $filterKategoriIndikator);
            });
        return DataTables::of($imut)
            //hanya judul
            ->editColumn('hanyaJudul', function ($imut) use ($request) {
                return $imut->judul;
            })
            ->editColumn('judul', function ($imut) use ($request) {
                return view(
                    'contents.indikatorMutu.indikatorMutuLokal.customColumn.actionVariabel',
                    \compact('imut')
                );
            })
            ->addColumn('action', function ($imut) {
                return view(
                    'contents.indikatorMutu.indikatorMutuLokal.customColumn.action',
                    \compact('imut')
                );
            })
            ->addColumn('actionPilih', function ($imut) {
                return view(
                    'contents.indikatorMutu.indikatorMutuLokal.customColumn.actionPilih',
                    \compact('imut')
                );
            })
            ->rawColumns([
                'judul',
                'definisi_operasional',
                'action',
                'hanyaJudul',
                'actionPilih',
            ])
            ->make(true);
    }
}
