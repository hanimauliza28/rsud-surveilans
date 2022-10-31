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
use App\Models\Variabel;
use App\Models\SurveyLokal;
use App\Models\SurveyNasional;

use App\Http\Requests\IndikatorMutu\IndikatorMutuNasionalRequest;

class IndikatorMutuNasionalWajibController extends Controller
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
        $imutNasionalManajemen = IndikatorMutuNasional::where('kategori_indikator_id', 3)->with('frekuensi', 'kategori', 'tipe')->get();
        $data = [
            'date' => $dataMonth['date'],
            'dayInMonth' => $dataMonth['dayInMonth'],
            'month' => $dataMonth['month'],
            'year' => $dataMonth['year'],
            'imut' => $imutNasionalManajemen,
        ];

        return view('contents.indikatorMutu.nasional.wajib.index', $data);

    }

    public function search(Request $request)
    {
        $filterKeyword = $request->filterKeyword;
        $filterBulan = $request->filterBulan;
        $dataMonth = $this->helperTime->monthNow($filterBulan);

        $imut = $this->indikatorMutuNasional->searchPerKategori(3, $filterKeyword, $dataMonth['firstDay'], $dataMonth['lastDay']);

        $data = [
            'date' => $dataMonth['date'],
            'dayInMonth' => $dataMonth['dayInMonth'],
            'month' => $dataMonth['month'],
            'year' => $dataMonth['year'],
            'imut' => $imut,
        ];

        $imut ?
            $response=$this->helpers->retunJson(200, 'Indikator Mutu Ditemukan', $data) :
            $response=$this->helpers->retunJson(404, 'Indikator Mutu Tidak Ditemukan');

            return view('contents.indikatorMutu.nasional.wajib.table', $data);
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
            $response=$this->helpers->retunJson(200, 'Data Indikator Mutu Berhasil ditambahkan') :
            $response=$this->helpers->retunJson(400, 'Data Indikator Mutu Gagal ditambahkan');

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

    public function variabel($id, Request $request)
    {
        $tanggal = $request->tanggal;
        $variabel['numerator'] = Variabel::where('indikator_mutu_id', $id)->where('jenis', 'nasional')->where('tipe_variabel', 'numerator')->first();
        $variabel['denumerator'] = Variabel::where('indikator_mutu_id', $id)->where('jenis', 'nasional')->where('tipe_variabel', 'denumerator')->first();
        $survey = SurveyNasional::where('indikator_mutu_id', $id)->where('tanggal_survey', $tanggal)->first();
        $variabel['nilaiNumerator'] = $survey->numerator ?? '';
        $variabel['nilaiDenumerator'] = $survey->denumerator ?? '';

        $variabel ?
            $response=$this->helpers->retunJson(200, 'Variabel Ditemukan', $variabel) :
            $response=$this->helpers->retunJson(404, 'Variabel Tidak Ditemukan');
        return $response;
   }

    public function storeNilai(Request $request)
    {
        $tanggal = $request->nilaiTahun.'-'.$request->nilaiBulan.'-'.$request->nilaiHari;

        $saveData = SurveyNasional::updateOrCreate(
            [
                'indikator_mutu_id' => $request->nilaiImutId,
                'tanggal_survey' => $tanggal
            ],
            [
                'indikator_mutu_id' => $request->nilaiImutId,
                'tanggal_survey' => $tanggal,
                'numerator' => $request->numerator,
                'denumerator' => $request->denumerator,
                'user_id' => 1,
                'sumber_data' => 'manual'
            ]

        );

        $saveData ?
            $response=$this->helpers->retunJson(200, 'Nilai Indikator Berhasil Disimpan', $saveData) :
            $response=$this->helpers->retunJson(404, 'Nilai Indikator Tidak Berhasil Disimpan');
        return $response;
    }

    public function datasurvey(){
        return view('contents.indikatorMutu.nasional.wajib.index', $data);
    }

}
