<?php

namespace App\Http\Controllers\Web\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\HelperSurveilans;
use App\Helpers\Helpers;

use App\Models\KategoriVariabelSurvey;

use App\Http\Requests\Master\KategoriVariabelSurveyRequest;

class KategoriVariabelSurveyController extends Controller
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
        $data = [];
        return view('contents.master.kategoriVariabelSurvey.index', $data);
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
    public function store(KategoriVariabelSurveyRequest $request)
    {
        $data = [
            'nama_kategori' => $request->namaKategori,
            'keterangan' => $request->keterangan,
        ];

        $saveData = KategoriVariabelSurvey::create($data);

        $saveData
            ? ($response = $this->helpers->retunJson(
                200,
                'Web Service Berhasil ditambahkan'
            ))
            : ($response = $this->helpers->retunJson(
                400,
                'Web Service Gagal ditambahkan'
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
        // Data KategoriVariabelSurvey
        $KategoriVariabelSurvey = KategoriVariabelSurvey::where('id', $id)->first();

        $KategoriVariabelSurvey
            ? ($response = $this->helpers->retunJson(
                200,
                'Sukses',
                $KategoriVariabelSurvey
            ))
            : ($response = $this->helpers->retunJson(
                404,
                'Web Service Tidak Ditemukan'
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
    public function update(KategoriVariabelSurveyRequest $request, $id)
    {
        // Data
        $data = $request->except('_token');

        $data = [
            'nama_kategori' => $request->namaKategori,
            'keterangan' => $request->keterangan,
        ];

        $saveData = KategoriVariabelSurvey::where('id', $request->id)->update($data);

        $saveData
            ? ($response = $this->helpers->retunJson(
                200,
                'Web Service Berhasil diubah'
            ))
            : ($response = $this->helpers->retunJson(
                400,
                'Web Service Gagal diubah'
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
        $KategoriVariabelSurvey = KategoriVariabelSurvey::where('id', $id)->first();

        $delete = $KategoriVariabelSurvey->destroy($id);

        $delete
            ? ($response = $this->helpers->retunJson(
                200,
                'Web Service berhasil dihapus'
            ))
            : ($response = $this->helpers->retunJson(
                400,
                'Web Service gagal dihapus'
            ));

        return $response;
    }
}
