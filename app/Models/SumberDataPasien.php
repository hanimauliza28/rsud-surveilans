<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\ApiInformasi;
use App\Helpers\Helpers;

class SumberDataPasien extends Model
{
    public function __construct()
    {
        $this->base_url = env('WS_INFORMASI');
        $this->helpers = new Helpers;
    }



    // Data SumberDataPasien
    public function sumberDataPasien($function, $url, $mode, $tanggal, $keyword, $poli = null)
    {
        // Url
        $url = $this->base_url.$url;

        // Mode
        $mode = $mode;

        if($function == 'pasienRawatJalan')
        {
            // Data
            if($poli)
            {
                $data = [
                    'tanggal' => $tanggal,
                    'poli' => $poli,
                    'keyword' => $keyword
                ];
            }else{
                $data = [
                    'tanggal' => $tanggal,
                    'keyword' => $keyword
                ];
            }
        }else{
            $data = [
                'error' => 'Tidak ada hasil untuk sumber data pasien yang anda pilih'
            ];
            return $data;
        }

        $this->apiInformasi = new ApiInformasi;
        $response = $this->apiInformasi->curlApiInformasi($url, $mode, $data);

        if ($response->code == 500) {
            return null;
        }

        if ($response->code != 200) {
            return null;
        }

        return $response->response;
    }
}
