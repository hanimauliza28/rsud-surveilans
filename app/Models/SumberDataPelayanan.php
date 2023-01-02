<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\ApiInformasi;
use App\Helpers\Helpers;

class SumberDataPelayanan extends Model
{
    public function __construct()
    {
        $this->helpers = new Helpers;
        $this->apiInformasi = new ApiInformasi;
    }

    public function waktuLayananRajal($noreg = null)
    {
        // $url = $this->base_url.$url;
        // $mode = $mode;

        // $data = [
        //     'tanggal' => $tanggal,
        //     'keyword' => $keyword
        // ];

        // $response = $this->apiInformasi->curlApiInformasi($url, $mode, $data);

        // if ($response->code == 500) {
        //     return null;
        // }

        // if ($response->code != 200) {
        //     return null;
        // }

        // return $response->response;
        return '30';
    }

    public function pasienEmergency($noreg)
    {
        $antrianIgd = AntrianIgd::where('NOREGRS', $noreg)->first();

        if($antrianIgd)
        {

            $waktuBooking = $antrianIgd->TGL_INPUT;
            $waktuPelayanan = $antrianIgd->JAM_DILAYANI;

            // $waktuTanggap = strtotime($waktuBooking) - strtotime($waktuPelayanan);
            $waktuTanggap = $antrianIgd->ERT;

            $data = [
                'waktuBooking' => $waktuBooking,
                'waktuPelayanan' => $waktuPelayanan,
                'waktuTanggap' => $waktuTanggap
            ];
        }else{
            $data = [
                'waktuBooking' => '',
                'waktuPelayanan' => '',
                'waktuTanggap' => ''
            ];
        }


        return collect($data);

    }

    public function waktuTungguRawatJalan($noReg)
    {
        // $waktuDatang = date('Y-m-d H:i:s', strtotime('+87 minutes', strtotime(date('Y-m-d H:i:s'))));
        // $waktuDilayani = date('Y-m-d H:i:s');

        // $waktuTanggu = strtotime($waktuDatang) - strtotime($waktuDilayani);

        // $data = [
        //     'waktuDatang' => date('Y-m-d H:i:s', strtotime('+5 minutes', strtotime(date('Y-m-d H:i:s')))),
        //     'waktuDilayani' => date('Y-m-d H:i:s'),
        //     'waktuTunggu' => $waktuTanggu
        // ];

        // return collect($data);


        $url = 'waktu-tunggu-pasien-rawat-jalan';

        // Mode
        $mode = 'POST';
        $data = [
            'noreg' => $noReg
        ];
        $apiInformasi = new ApiInformasi;
        $response = $apiInformasi->curlApiInformasi($url, $mode, $data);
        if ($response->code == 500) {
            return $response;
        }

        if ($response->code != 200) {
            return $response;
        }

        return $response->response;


    }

    // public function pasienJadwalOperasi()
    // {

    // }
}
