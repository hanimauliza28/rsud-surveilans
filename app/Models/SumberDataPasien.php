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
        $this->apiInformasi = new ApiInformasi;
    }

    // Data SumberDataPasien
    public function sumberDataPasien($function, $url, $mode, $tanggal, $keyword, $kdbagian = null)
    {
        // Url
        $url = $this->base_url.$url;

        // Mode
        $mode = $mode;

        $data = '';

        if($function == 'pasienRawatJalan')
        {
            // Data
            if($kdbagian)
            {
                $data = [
                    'tanggal' => $tanggal,
                    'kdbagian' => $kdbagian,
                    'keyword' => $keyword
                ];
            }else{
                $data = [
                    'tanggal' => $tanggal,
                    'keyword' => $keyword
                ];
            }
        }

        $response = $this->apiInformasi->curlApiInformasi($url, $mode, $data);

        if ($response->code == 500) {
            return null;
        }

        if ($response->code != 200) {
            return null;
        }

        return $response->response;
    }

    public function bagian($GRPUNIT)
    {
        // Url
        $urls = 'bagian';
        $base_url = env('WS_INFORMASI');
        $url = $base_url.$urls;

        // Mode
        $mode = 'POST';
        $data = [
            'GRPUNIT' => $GRPUNIT
        ];

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
