<?php

namespace App\Helpers;

class ApiInformasi
{
    public function __construct()
    {
        $this->urlApiInformasi = env('API_INFORMASI');
        $this->keyApiInformasi = env('API_INFORMASI_KEY');
    }

    public function curlApiInformasi($url, $mode, $data = '', $header = '')
    {
        // Koneksi API
        $userId = 'ApiInformasi';

        $secretKey = $this->keyApiInformasi;
        $mainUrl = $this->urlApiInformasi;

        $stamp = time();
        $keyNow = $userId.'&'.$stamp;

        $signature = hash_hmac('sha256', $keyNow, $secretKey, false);
        $encodedSignature = base64_encode($signature);

        // Header
        $header = [
            'Accept' => 'application/json',
            'X-userId' => $userId,
            'X-signature' => $encodedSignature,
            'X-stamp' => $stamp
        ];

        try {
            if ($mode == 'GET') {
                $response = \Http::withHeaders($header)->get($mainUrl.$url, $data);
            } else if ($mode == 'POST') {
                $response = \Http::withHeaders($header)->post($mainUrl.$url, $data);
            }

        } catch (\Throwable $th) {
            $response = json_encode([
                'code' => 500,
                'message' => 'error',
                'response' => [
                    'error' => 'Maaf terjadi error pada web service. Silahkan coba beberapa saat lagi'
                ]
            ]);
            return json_decode($response);
        }

        $hasilResponse = json_decode($response->getBody()->getContents());

        return $hasilResponse;
    }
}
