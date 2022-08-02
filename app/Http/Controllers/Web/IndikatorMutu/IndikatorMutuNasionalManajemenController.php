<?php

namespace App\Http\Controllers\Web\IndikatorMutu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helpers;
use App\Helpers\HelperTime;
use Carbon\Carbon;

use App\Models\IndikatorMutuNasional;
use App\Models\RefKategoriIndikator;
use App\Models\RefFrekuensi;
use App\Models\RefTipeIndikator;

use App\Http\Requests\IndikatorMutu\IndikatorMutuNasionalRequest;

class IndikatorMutuNasionalManajemenController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    $this->helpers = new Helpers;
        $this->helperTime = new HelperTime;
        $this->indikatorMutuNasional = new IndikatorMutuNasional;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataMonth = $this->helperTime->monthNow();
        $imutNasionalManajemen = IndikatorMutuNasional::where('kategori_indikator_id', 1)->with('frekuensi', 'kategori', 'tipe')->get();
        $data = [
            'date' => $dataMonth['date'],
            'dayInMonth' => $dataMonth['dayInMonth'],
            'month' => $dataMonth['month'],
            'year' => $dataMonth['year'],
            'imut' => $imutNasionalManajemen,
        ];

        return view('contents.indikatorMutu.nasional.manajemen.index', $data);

    }

    public function search(Request $request)
    {
        $filterKeyword = $request->filterKeyword;
        $filterBulan = $request->filterBulan;
        $batasWaktu = $this->monthNow($filterBulan);

        $imut = $this->indikatorMutuNasional->searchPerKategori(1, $filterKeyword, $batasWaktu['batasWaktuMulai'], $batasWaktu['batasWaktuSelesai']);

        $imut ?
            $response=$this->helpers->retunJson(200, 'Indikator Mutu Ditemukan', $imut) :
            $response=$this->helpers->retunJson(404, 'Indikator Mutu Tidak Ditemukan');

        return $response;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IndikatorMutuNasionalRequest $request)
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

        $saveData = IndikatorMutuNasional::create($data);

        $saveData ?
            $response=$this->helpers->retunJson(200, 'data Indikator Mutu Berhasil ditambahkan') :
            $response=$this->helpers->retunJson(400, 'data Indikator Mutu Gagal ditambahkan');

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
        $imut = IndikatorMutuNasional::where('id', $id)->first();

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
    public function update(IndikatorMutuNasionalRequest $request, $id)
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

        $saveData = IndikatorMutuNasional::where('id', $request->id)->update($data);

        $saveData ?
            $response=$this->helpers->retunJson(200, 'Indikator Mutu Nasional Berhasil diubah') :
            $response=$this->helpers->retunJson(400, 'Indikator Mutu Nasional Gagal diubah');

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
        $imut = IndikatorMutuNasional::where('id', $id)->first();

        $delete = $imut->destroy($id);

        $delete ?
            $response=$this->helpers->retunJson(200, 'Data Indikator Mutu berhasil dihapus') :
            $response=$this->helpers->retunJson(400, 'Data Indikator Mutu gagal dihapus');

        return $response;
    }


    public function view($id)
    {
        // Data Indikator Mutu
        $imut = IndikatorMutuNasional::where('id', $id)->with('frekuensi', 'kategori', 'tipe')->first();

        $imut ?
            $response=$this->helpers->retunJson(200, 'Indikator Mutu Ditemukan', $imut) :
            $response=$this->helpers->retunJson(404, 'Indikator Mutu Tidak Ditemukan');

        return $response;
    }

}
