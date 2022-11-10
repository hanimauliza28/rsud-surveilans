<?php

namespace App\Http\Controllers\Web\Form;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\HelperSurveilans;
use App\Helpers\Helpers;

use App\Models\AntrianIgd;
use Carbon\Carbon;

class RegistrasiAntrianIgdController extends Controller
{

    public function __construct()
    {
        $this->helpers = new Helpers;
        $this->helperSurveilas = new HelperSurveilans;

        $this->antrianIgd = new AntrianIgd;
    }
    public function index()
    {
        $filterPanggil = [
            [
                'value' => 'P',
                'text' => 'Panggil'
            ],
            [
                'value' => 'T',
                'text' => 'Tunda'
            ],
            [
                'value' => 'S',
                'text' => 'Sudah'
            ]
        ];

        $filterDilayani = [
            [
                'value' => 'Y',
                'text' => 'Sudah di Layani'
            ],
            [
                'value' => 'N',
                'text' => 'Belum di Layani'
            ]
        ];

        $data = [
            'filterPanggil' => $filterPanggil,
            'filterDilayani' => $filterDilayani,
            // 'indikator' => $this->antrianIgd->indikator()
        ];

        return view('contents.form.registrasiAntrianIgd.index', $data);
    }

    public function store(Request $request)
    {
        $data = [
            'NOREGRS' => $request->dataPasienNoreg,
            'NAMAPAS' => $request->dataPasienNama,
            'NORMPAS' => $request->dataPasienNorm
        ];

        $where = [
            'GRUP_ANTRI' => $request->grupAntri,
            'NO_ANTRI' => $request->noAntri,
            'TGL_ANTRI' => $request->tglAntri
        ];

        $saveData = AntrianIgd::where($where)->update($data);

        $saveData
            ? ($response = $this->helpers->retunJson(
                200,
                'Nomor Registrasi Berhasil di Masukkan'
            ))
            : ($response = $this->helpers->retunJson(
                400,
                'Nomor Registrasi Gagal di Masukkan'
            ));

        return $response;
    }

    public function editWaktu(Request $request)
    {
        $GRUP_ANTRI = $request->grupAntri;
        $NO_ANTRI = $request->noAntri;
        $TGL_ANTRI = $request->tglAntri;

        $where = [
            'GRUP_ANTRI' => $request->grupAntri,
            'NO_ANTRI' => $request->noAntri,
            'TGL_ANTRI' => $request->tglAntri
        ];

        $antrian = AntrianIgd::where($where)->first();

        if($antrian)
        {

            if($request->parameterIsian == 'JAM_DILAYANI')
            {
                $jamDilayani = $antrian->JAM_DILAYANI;
                if($jamDilayani != NULL)
                {
                    $tanggal = substr($jamDilayani, 0, 10);
                    $jam = substr($jamDilayani, 11, 8);
                }else{
                    $tanggal = date('Y-m-d');
                    $jam = date('H:i:s');
                }

                $data = [
                    'antrian' => $antrian,
                    'tanggal' => $tanggal,
                    'jam' => $jam,
                    'antrian' => $antrian
                ];

                $response = $this->helpers->retunJson(
                    200,
                    'Data Antrian Berhasil di Ambil', $data
                );

            }else{

                $jamSelesai = $antrian->JAM_SELESAI;
                if($jamSelesai != NULL)
                {
                    $tanggal = substr($jamSelesai, 0, 10);
                    $jam = substr($jamSelesai, 11, 8);
                }else{
                    $tanggal = date('Y-m-d');
                    $jam = date('H:i:s');
                }

                $data = [
                    'antrian' => $antrian,
                    'tanggal' => $tanggal,
                    'jam' => $jam
                ];

                $response = $this->helpers->retunJson(
                    200,
                    'Data Antrian Berhasil di Ambil', $data
                );
            }

        }else{
            $response = $this->helpers->retunJson(
                400,
                'Data Antrian Gagal di Ambil'
            );
        }

        return $response;

    }
    public function storeWaktu(Request $request)
    {
        $parameter = $request->parameterIsian;
        $waktu = date('Y-m-d H:i:s', strtotime($request->tanggal.' '.$request->jam));

        $where = [
            'GRUP_ANTRI' => $request->grupAntriWaktu,
            'NO_ANTRI' => $request->noAntriWaktu,
            'TGL_ANTRI' => $request->tglAntriWaktu
        ];

        $antrian = AntrianIgd::where($where)->first();

        $jamdatang = strtotime($antrian->TGL_INPUT);

        if($parameter == 'JAM_DILAYANI'){
            if(strtotime($waktu) < $jamdatang)
            {
                return $this->helpers->retunJson(
                    400,
                    'Jam Dilayani Tidak Boleh Lebih Kecil dari Jam Datang'
                );
            }
            $task = 'Mulai Dilayani';

            $date = new Carbon($antrian->TGL_INPUT, 'Asia/Jakarta');
            $menit = $date->diffInSeconds($waktu);

            $data = [
                'JAM_DILAYANI' => $waktu,
                'STATUS_PANGGIL' => 'P',
                'ERT' => $menit
            ];

        }else{
            $mulaidilayani = strtotime($antrian->JAM_DILAYANI);

            if(strtotime($waktu) < $jamdatang  && strtotime($waktu) > $mulaidilayani)
            {
                return $this->helpers->retunJson(
                    400,
                    'Jam Selesai Tidak Boleh Lebih Kecil dari Jam Datang dan Jam Mulai Dilayani'
                );
            }

            $date = new Carbon($antrian->JAM_DILAYANI, 'Asia/Jakarta');
            $menit = $date->diffInSeconds($waktu);

            $task = 'Selesai Dilayani';
            $data = [
                'JAM_SELESAI' => $waktu,
                'STATUS_PANGGIL' => 'S',
                'LAMA_PELAYANAN' => $menit,
                'STATUS_DILAYANI' => 'Y'
            ];
        }


        $saveData = AntrianIgd::where($where)->update($data);

        $saveData
            ? ($response = $this->helpers->retunJson(
                200,
                $task.' Berhasil di Masukkan'
            ))
            : ($response = $this->helpers->retunJson(
                400,
                $task.' Nomor Registrasi Gagal di Masukkan'
            ));

        return $response;
    }

    public function antrian(Request $request)
    {

        $noreg = $request->dataPasien->dataNoreg;
    }
}
