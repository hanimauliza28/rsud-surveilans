<?php

namespace App\Http\Controllers\Web\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Setting\GrupUserRequest;

use App\Helpers\HelperSurveilans;
use App\Helpers\Helpers;
use App\Models\Bagian;
use App\Models\BagianGrup;
use App\Models\GrupUser;

class GrupUserController extends Controller
{
    public function __construct()
    {
        $this->helperSurveilans = new HelperSurveilans();
        $this->helpers = new Helpers();
    }


    public function index()
    {

        $data = [
            'grupBagian' => BagianGrup::get()
        ];

        return view('contents.setting.grupuser.index', $data);

    }

    public function pilihanBagian(Request $request)
    {
        $kdgrupbagian = $request->kdgrupbagian;
        $bagian = Bagian::where(['GRPUNIT' => $kdgrupbagian, 'STSAKTIF' => 'Y'])->select('KDBAGIAN', 'GRPUNIT', 'NAMABAGIAN', 'NMPOLIBPJS', 'STSAKTIF')->get();
        return $this->helpers->retunJson(200, 'Data Bagian', $bagian);
    }

    public function store(GrupUserRequest $request)
    {
        $grupbagian = BagianGrup::where('GRPUNIT', $request->kdGrupBagian)->first();
        $namagrupbagian = $grupbagian->NMGUNIT ?? '';

        if($request->kdbagian)
        {
            $bagian = Bagian::where('KDBAGIAN', $request->kdBagian)->first();
            $namabagian = $bagian->NAMABAGIAN ?? '';
            $kdbagian = $bagian->KDBAGIAN ?? '';
        }

        $data = [
            'nama_grup' => $request->namaGrup,
            'kd_grup_bagian' => $request->kdgrupbagian ?? '',
            'grup_bagian' => $namagrupbagian ?? '',
            'kd_bagian' => $kdbagian ?? '',
            'nama_bagian' => $namabagian ?? ''
        ];

        $saveData = GrupUser::create($data);

        $saveData
            ? ($response = $this->helpers->retunJson(
                200,
                'User Grup Berhasil ditambahkan'
            ))
            : ($response = $this->helpers->retunJson(
                400,
                'User Grup Gagal ditambahkan'
            ));

        return $response;
    }

    public function edit($id)
    {
        $grupuser = GrupUser::where('id', $id)->first();

        $grupuser
            ? ($response = $this->helpers->retunJson(
                200,
                'Data Ditemukan',
                $grupuser
            ))
            : ($response = $this->helpers->retunJson(
                404,
                'Data Tidak Ditemukan'
            ));

        return $response;
    }

    public function update(GrupUserRequest $request, $id)
    {
        $grupbagian = BagianGrup::where('GRPUNIT', $request->kdGrupBagian)->first();
        $namagrupbagian = $grupbagian->NMGUNIT ?? '';

        if($request->kdBagian)
        {
            $bagian = Bagian::where('KDBAGIAN', $request->kdBagian)->first();
            $namabagian = $bagian->NAMABAGIAN ?? '';
            $kdbagian = $bagian->KDBAGIAN ?? '';
        }

        $data = [
            'nama_grup' => $request->namaGrup,
            'kd_grup_bagian' => $request->kdgrupbagian ?? '',
            'grup_bagian' => $namagrupbagian ?? '',
            'kd_bagian' => $kdbagian ?? '',
            'nama_bagian' => $namabagian ?? ''
        ];

        $saveData = GrupUser::where('id', $request->id)->update($data);

        $saveData
            ? ($response = $this->helpers->retunJson(
                200,
                'Grup User Berhasil diubah'
            ))
            : ($response = $this->helpers->retunJson(
                400,
                'Grup User Gagal diubah'
            ));

        return $response;
    }

    public function destroy($id)
    {
        $grupuser = GrupUser::where('id', $id)->first();

        $delete = $grupuser->destroy($id);

        $delete
            ? ($response = $this->helpers->retunJson(
                200,
                'Grup User berhasil dihapus'
            ))
            : ($response = $this->helpers->retunJson(
                400,
                'Grup User gagal dihapus'
            ));

        return $response;
    }
}
