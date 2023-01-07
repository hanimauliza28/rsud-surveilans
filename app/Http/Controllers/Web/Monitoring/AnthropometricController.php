<?php

namespace App\Http\Controllers\Web\Monitoring;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Monitoring\SurveyAnthropometricRequest;

use App\Helpers\Helpers;
use App\Models\Bagian;
use App\Models\AnthropometricResult;

class AnthropometricController extends Controller
{
    public function __construct()
    {
        $this->anthropomeric2 = new AnthropometricResult();
        $this->bagian = new Bagian();

        $this->helpers = new Helpers();
    }
    public function index()
    {
        $data = [
            'bagian' => Bagian::whereIn('GRPUNIT', ['91', '93'])->get()
        ];

        return view('contents.monitoring.anthropometric.index', $data);
    }

    public function store(SurveyAnthropometricRequest $request)
    {
        $data = [
            'tgl_survey' => date('Y-m-d', strtotime($request->tanggalSurvey)),
            'norm' => $request->norm,
            'noreg' => $request->noreg ?? '',
            'umur' => $request->umur,
            'bb' => $request->bb,
            'tb' => $request->tb
        ];

        $saveData = AnthropometricResult::create($data);

        $saveData

            ? ($response = $this->helpers->retunJson(
                200,
                'Data Survey Berhasil ditambahkan'
            ))
            : ($response = $this->helpers->retunJson(
                400,
                'Data Survey Gagal ditambahkan'
            ));

        return $response;
    }



    public function edit($id)
    {
        $anthropometric = AnthropometricResult::where('id', $id)->first();

        $anthropometric
        ? ($response = $this->helpers->retunJson(
            200,
            'Sukses',
            $anthropometric
        ))
        : ($response = $this->helpers->retunJson(
            404,
            'Data Survey Anthropometric Tidak Ditemukan'
        ));

        return $response;

    }

    public function update(SurveyAnthropometricRequest $request, $id)
    {
        // Data
        $data = $request->except('_token');

        $data = [
            'tgl_survey' => date('Y-m-d', strtotime($request->tanggalSurvey)),
            'norm' => $request->norm,
            'noreg' => $request->noreg ?? '',
            'umur' => $request->umur,
            'bb' => $request->bb,
            'tb' => $request->tb
        ];

        $saveData = AnthropometricResult::where('id', $id)->update($data);

        $saveData
            ? ($response = $this->helpers->retunJson(
                200,
                'Data Survey Anthropometric Berhasil diubah'
            ))
            : ($response = $this->helpers->retunJson(
                400,
                'Data Survey Anthropometric Gagal diubah'
            ));

        return $response;
    }

    public function destroy($id)
    {
        $anthropometric = AnthropometricResult::where('id', $id)->first();

        $delete = $anthropometric->destroy($id);

        $delete
            ? ($response = $this->helpers->retunJson(
                200,
                'Data Survey Anthropometric berhasil dihapus'
            ))
            : ($response = $this->helpers->retunJson(
                400,
                'Data Survey Anthropometric gagal dihapus'
            ));

        return $response;
    }

}
