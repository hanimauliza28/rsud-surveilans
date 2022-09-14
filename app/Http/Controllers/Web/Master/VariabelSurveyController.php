<?php

namespace App\Http\Controllers\Web\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\HelperSurveilans;
use App\Helpers\Helpers;

use App\Models\VariabelSurvey;
use App\Models\KategoriVariabelSurvey;

use App\Http\Requests\Master\VariabelSurveyRequest;

class VariabelSurveyController extends Controller
{
    public function __construct()
    {
        $this->helperSurveilans = new HelperSurveilans();
        $this->helpers = new Helpers();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'kategoriVariabelSurvey' => KategoriVariabelSurvey::get(),
            'variabelSurveyParent' => VariabelSurvey::get()
        ];
        return view('contents.master.variabelSurvey.index', $data);
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
    public function store(VariabelSurveyRequest $request)
    {
        $data = [
            'parent_id' => $request->parentId,
            'nama_variabel' => $request->namaVariabel,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'kategori_variabel_survey_id' => $request->kategoriVariabelSurvey
        ];

        $saveData = VariabelSurvey::create($data);

        $saveData
            ? ($response = $this->helpers->retunJson(
                200,
                'Variabel Survey Berhasil ditambahkan'
            ))
            : ($response = $this->helpers->retunJson(
                400,
                'Variabel Survey Gagal ditambahkan'
            ));

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
        // Data VariabelSurvey
        $variabelSurvey = VariabelSurvey::where('id', $id)->first();

        $variabelSurvey
            ? ($response = $this->helpers->retunJson(
                200,
                'Sukses',
                $variabelSurvey
            ))
            : ($response = $this->helpers->retunJson(
                404,
                'Variabel Survey Tidak Ditemukan'
            ));

        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VariabelSurveyRequest $request, $id)
    {
        // Data
        $data = $request->except('_token');

        $data = [
            'parent_id' => $request->parentId,
            'nama_variabel' => $request->namaVariabel,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'kategori_variabel_survey_id' => $request->kategoriVariabelSurvey
        ];

        $saveData = VariabelSurvey::where('id', $request->id)->update($data);

        $saveData
            ? ($response = $this->helpers->retunJson(
                200,
                'Variabel Survey Berhasil diubah'
            ))
            : ($response = $this->helpers->retunJson(
                400,
                'Variabel Survey Gagal diubah'
            ));

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
        $variabelSurvey = VariabelSurvey::where('id', $id)->first();

        $delete = $variabelSurvey->destroy($id);

        $delete
            ? ($response = $this->helpers->retunJson(
                200,
                'Variabel Survey berhasil dihapus'
            ))
            : ($response = $this->helpers->retunJson(
                400,
                'Variabel Survey gagal dihapus'
            ));

        return $response;
    }
}
