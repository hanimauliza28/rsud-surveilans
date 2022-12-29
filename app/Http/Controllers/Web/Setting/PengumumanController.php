<?php

namespace App\Http\Controllers\Web\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\HelperSurveilans;
use App\Helpers\Helpers;

use App\Models\Pengumuman;

use App\Http\Requests\Setting\PengumumanRequest;

class PengumumanController extends Controller
{
    public function __construct()
    {
        $this->helperSurveilans = new HelperSurveilans();
        $this->helpers = new Helpers();
        $this->pengumuman = new Pengumuman;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [
        ];

        return view('contents.setting.pengumuman.index', $data);
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
    public function store(PengumumanRequest $request)
    {
        $data = [
            'judul' => $request->judul,
            'isi' => $request->isi,
            'deskripsi_singkat' => $request->deskripsiSingkat,
            'status' => $request->status,
        ];

        if($request->status == 'Y')
        {
            $nonaktifkan = Pengumuman::where('status', 'Y')->update(['status' => 'N']);
        }

        $saveData = Pengumuman::create($data);

        $saveData
            ? ($response = $this->helpers->retunJson(
                200,
                'Pengumuman Berhasil ditambahkan'
            ))
            : ($response = $this->helpers->retunJson(
                400,
                'Pengumuman Gagal ditambahkan'
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

        $pengumuman = Pengumuman::where('id', $id)->first();

        $data = [
            'pengumuman' => $pengumuman
        ];

        return view('contents.setting.pengumuman.baca', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Data pengumuman
        $pengumuman = Pengumuman::where('id', $id)->first();

        $pengumuman
            ? ($response = $this->helpers->retunJson(
                200,
                'Pengumumann Ditemukan',
                $pengumuman
            ))
            : ($response = $this->helpers->retunJson(
                404,
                'Pengumuman Tidak Ditemukan'
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
    public function update(PengumumanRequest $request, $id)
    {
        // Data
        $data = $request->except('_token');

        $data = [
            'judul' => $request->judul,
            'isi' => $request->isi,
            'deskripsi_singkat' => $request->deskripsiSingkat,
            'status' => $request->status
        ];

        $saveData = Pengumuman::where('id', $request->id)->update($data);

        $saveData
            ? ($response = $this->helpers->retunJson(
                200,
                'Pengumuman Berhasil diubah'
            ))
            : ($response = $this->helpers->retunJson(
                400,
                'Pengumuman Gagal diubah'
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
        $pengumuman = Pengumuman::where('id', $id)->first();

        $delete = $pengumuman->destroy($id);

        $delete
            ? ($response = $this->helpers->retunJson(
                200,
                'Pengumuman berhasil dihapus'
            ))
            : ($response = $this->helpers->retunJson(
                400,
                'Pengumuman gagal dihapus'
            ));

        return $response;
    }

    public function updateStatus(Request $request)
    {
        $data = [
            'status' => $request->status
        ];

        if($request->status == 'Y')
        {
            $nonaktifkan = Pengumuman::where('status', 'Y')->update(['status' => 'N']);
        }

        $saveData = Pengumuman::where('id', $request->id)->update($data);

        $saveData
            ? ($response = $this->helpers->retunJson(
                200,
                'Status Tampil Berhasil diubah'
            ))
            : ($response = $this->helpers->retunJson(
                400,
                'Status Tampil Gagal diubah'
            ));

        return $response;

    }

}
