<?php

namespace App\Http\Controllers\Web\IndikatorMutu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helpers;

use App\Models\IndikatorMutuLokal;
use App\Models\RefKategoriIndikator;
use App\Models\RefFrekuensi;
use App\Models\RefTipeIndikator;

use App\Http\Requests\IndikatorMutu\IndikatorMutuLokalRequest;

class IndikatorMutuLokalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->helpers = new Helpers;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'kategoriIndikator' => RefKategoriIndikator::get(),
            'frekuensi' => RefFrekuensi::get(),
            'tipeIndikator' => RefTipeIndikator::get(),
            'tipeVariabel' => $this->helpers->listVariabel()
        ];

        return view('contents.indikatorMutu.indikatorMutuLokal.index', $data);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        // Data Indikator Mutu
        $imut = IndikatorMutuLokal::where('id', $id)->with('frekuensi', 'kategori', 'tipe')->first();

        $imut ?
            $response=$this->helpers->retunJson(200, 'Indikator Mutu Ditemukan', $imut) :
            $response=$this->helpers->retunJson(404, 'Indikator Mutu Tidak Ditemukan');

        return $response;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IndikatorMutuLokalRequest $request)
    {
        $data = [
            'kategori_indikator_id' => $request->kategoriIndikator,
            'judul' => $request->judulIndikator,
            'definisi_operasional' => $request->definisiOperasional,
            'kriteria_inklusi' => $request->kriteriaInklusi,
            'kriteria_eksklusi' => $request->kriteriaEksklusi,
            'sumber_data' => $request->sumberData,
            'area_monitoring' => $request->areaMonitoring,
            'standar' => $request->standar,
            'faktor_pengali' => $request->faktorPengali,
            'satuan' => $request->satuan,
            'tipe_indikator_id' => $request->tipeIndikator,
            'frekuensi_id' => $request->frekuensi
        ];

        $saveData = IndikatorMutuLokal::create($data);

        $saveData ?
            $response=$this->helpers->retunJson(200, 'Indikator Mutu Berhasil ditambahkan') :
            $response=$this->helpers->retunJson(400, 'Indikator Mutu Gagal ditambahkan');

        return $response;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Data imut
        $imut = IndikatorMutuLokal::where('id', $id)->first();

        $imut ?
            $response=$this->helpers->retunJson(200, 'Sukses', $imut) :
            $response=$this->helpers->retunJson(404, 'Indikator Mutu Tidak Ditemukan');

        return $response;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IndikatorMutuLokalRequest $request, $id)
    {
        // Data
        $data = $request->except(
            '_token'
        );

        $data = [
            'kategori_indikator_id' => $request->kategoriIndikator,
            'judul' => $request->judulIndikator,
            'definisi_operasional' => $request->definisiOperasional,
            'kriteria_inklusi' => $request->kriteriaInklusi,
            'kriteria_eksklusi' => $request->kriteriaEksklusi,
            'sumber_data' => $request->sumberData,
            'area_monitoring' => $request->areaMonitoring,
            'standar' => $request->standar,
            'faktor_pengali' => $request->faktorPengali,
            'satuan' => $request->satuan,
            'tipe_indikator_id' => $request->tipeIndikator,
            'frekuensi_id' => $request->frekuensi
        ];

        $saveData = IndikatorMutuLokal::where('id', $request->id)->update($data);

        $saveData ?
            $response=$this->helpers->retunJson(200, 'Indikator Mutu Lokal Berhasil diubah') :
            $response=$this->helpers->retunJson(400, 'Indikator Mutu Lokal Gagal diubah');

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imut = IndikatorMutuLokal::where('id', $id)->first();

        $delete = $imut->destroy($id);

        $delete ?
            $response=$this->helpers->retunJson(200, 'Data hubungan keluarga berhasil dihapus') :
            $response=$this->helpers->retunJson(400, 'Data hubungan keluarga gagal dihapus');

        return $response;
    }


    public function manajemen()
    {
        return view('contents.indikatorMutu.lokal.manajemen.index');

    }
    public function klinik()
    {
        return view('contents.indikatorMutu.lokal.klinik.index');

    }
    public function wajib()
    {
        return view('contents.indikatorMutu.lokal.wajib.index');

    }
}
