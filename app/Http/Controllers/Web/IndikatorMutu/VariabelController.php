<?php

namespace App\Http\Controllers\Web\IndikatorMutu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helpers;

use App\Models\Variabel;

use App\Http\Requests\IndikatorMutu\VariabelRequest;

class VariabelController extends Controller
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
        return view('contents.indikatorMutu.variabel.index');

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
    public function store(VariabelRequest $request)
    {
        $data = [
            'indikator_mutu_id' => (int)$request->indikatorId,
            'tipe_variabel' => $request->tipeVariabel,
            'jenis' => $request->jenis ?? 'nasional',
            'indikator' => $request->indikatorVariabel,
            'satuan' => $request->satuanVariabel
        ];

        $saveData = Variabel::updateOrCreate(
            ['tipe_variabel' =>  $request->tipeVariabel, 'indikator_mutu_id' => (int)$request->indikatorId],
            $data

        );

        $saveData ?
            $response=$this->helpers->retunJson(200, 'Variabel Berhasil ditambahkan') :
            $response=$this->helpers->retunJson(400, 'Variabel Gagal ditambahkan');

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
        $imut = Variabel::where('id', $id)->first();

        $imut ?
            $response=$this->helpers->retunJson(200, 'Sukses', $imut) :
            $response=$this->helpers->retunJson(404, 'Data Variabel Tidak Ditemukan');

        return $response;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(VariabelRequest $request, $id)
    {
        // Data
        $data = $request->except(
            '_token'
        );

        $data = [
            'indikator_mutu_id' => $request->indikatorId,
            'jenis' => $request->jenis ?? 'nasional',
            'tipe_variabel' => $request->tipeVariabel,
            'indikator' => $request->indikatorVariabel,
            'satuan' => $request->satuanVariabel
        ];

        $saveData = Variabel::where('id', $request->id)->update($data);

        $saveData ?
            $response=$this->helpers->retunJson(200, 'Data Variabel Berhasil diubah') :
            $response=$this->helpers->retunJson(400, 'Data Variabel Gagal diubah');

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
        $imut = Variabel::where('id', $id)->first();

        $delete = $imut->destroy($id);

        $delete ?
            $response=$this->helpers->retunJson(200, 'Data Variabel berhasil dihapus') :
            $response=$this->helpers->retunJson(400, 'Data Variabel gagal dihapus');

        return $response;
    }

}
