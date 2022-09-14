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

    public function pasienEmergency()
    {
        $waktuBooking = date('Y-m-d H:i:s', strtotime('+5 minutes', strtotime(date('Y-m-d H:i:s'))));
        $waktuPelayanan = date('Y-m-d H:i:s');

        $waktuTanggap = strtotime($waktuBooking) - strtotime($waktuPelayanan);

        $data = [
            'waktuBooking' => date('Y-m-d H:i:s', strtotime('+5 minutes', strtotime(date('Y-m-d H:i:s')))),
            'waktuPelayanan' => date('Y-m-d H:i:s'),
            'waktuTanggap' => $waktuTanggap
        ];

        return collect($data);

    }

    public function waktuTungguRawatJalan()
    {
        $waktuDatang = date('Y-m-d H:i:s', strtotime('+87 minutes', strtotime(date('Y-m-d H:i:s'))));
        $waktuDilayani = date('Y-m-d H:i:s');

        $waktuTanggu = strtotime($waktuDatang) - strtotime($waktuDilayani);

        $data = [
            'waktuDatang' => date('Y-m-d H:i:s', strtotime('+5 minutes', strtotime(date('Y-m-d H:i:s')))),
            'waktuDilayani' => date('Y-m-d H:i:s'),
            'waktuTunggu' => $waktuTanggu
        ];

        return collect($data);

    }

}
