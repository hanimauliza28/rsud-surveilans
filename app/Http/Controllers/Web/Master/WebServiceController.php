<?php

namespace App\Http\Controllers\Web\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\HelperSurveilans;
use App\Helpers\Helpers;

use App\Models\MasterWebService;

use App\Http\Requests\Master\WebServiceRequest;

class WebServiceController extends Controller
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
            'jenisWebService' => $this->helperSurveilans->survJenisWebService(),
        ];

        return view('contents.master.webService.index', $data);
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
    public function store(WebServiceRequest $request)
    {
        $data = [
            'nama' => $request->nama,
            'nama_unik' => $request->namaUnik,
            'url' => $request->url,
            'type' => $request->type,
            'jenis_service' => $request->jenisService,
        ];

        $saveData = MasterWebService::create($data);

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
        // Data webservice
        $webservice = MasterWebService::where('id', $id)->first();

        $webservice
            ? ($response = $this->helpers->retunJson(
                200,
                'Sukses',
                $webservice
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
    public function update(WebServiceRequest $request, $id)
    {
        // Data
        $data = $request->except('_token');

        $data = [
            'nama' => $request->nama,
            'nama_unik' => $request->namaUnik,
            'url' => $request->url,
            'type' => $request->type,
            'jenis_service' => $request->jenisService,
        ];

        $saveData = MasterWebService::where('id', $request->id)->update($data);

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
        $webservice = MasterWebService::where('id', $id)->first();

        $delete = $webservice->destroy($id);

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
