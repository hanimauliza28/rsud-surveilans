<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\ApiKepegawaian;
use Spatie\Permission\Traits\HasRoles;

class Pegawai extends Model
{
    use HasRoles;

    protected $table = 'pegawai';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Data Semua Pegawai
    public function dataSemuaPegawai($start, $limit, $search = '')
    {
        // Url
        $urlLogin = 'data-pegawai/semua';

        // Mode
        $mode = 'GET';

        // Data
        $data = [
            'start' => $start,
            'limit' => $limit,
            'search' => $search
        ];

        $this->apiKepegawaian = new ApiKepegawaian;
        $response = $this->apiKepegawaian->curlApiKepegawaian($urlLogin, $mode, $data);

        if ($response->code == 500) {
            return null;
        }

        if ($response->code != 200) {
            return null;
        }

        return $response->response;
    }

    // Data Atasan Pegawai
    public function dataAtasanPegawai()
    {
        // Url
        $urlLogin = 'atasan-pegawai/semua';

        // Mode
        $mode = 'GET';

        $this->apiKepegawaian = new ApiKepegawaian;
        $response = $this->apiKepegawaian->curlApiKepegawaian($urlLogin, $mode);

        if ($response->code == 500) {
            return null;
        }

        if ($response->code != 200) {
            return null;
        }

        return $response->response;
    }

    // Data Pegawai Berdasarkan NIP
    public function pegawaiByNIP($nip)
    {
        // Url
        $urlLogin = 'data-pegawai';

        // Mode
        $mode = 'GET';

        // Data
        $data = [
            'nip' => $nip,
        ];

        $this->apiKepegawaian = new ApiKepegawaian;
        $response = $this->apiKepegawaian->curlApiKepegawaian($urlLogin, $mode, $data);

        if ($response->code == 500) {
            return null;
        }

        if ($response->code != 200) {
            return null;
        }

        return $response->response->pegawai;
    }

    // Tim Angka Kredit
    public function timAngkaKredit()
    {
        // Url
        $urlLogin = 'data-pegawai/tim-angka-kredit';

        // Mode
        $mode = 'GET';

        $this->apiKepegawaian = new ApiKepegawaian;
        $response = $this->apiKepegawaian->curlApiKepegawaian($urlLogin, $mode);

        if ($response->code == 500) {
            return null;
        }

        if ($response->code != 200) {
            return null;
        }

        return $response->response;
    }

    public function ubahPassword($nip, $password, $passwordKonfirmasi)
    {
        // Url
        $url = 'data-pegawai/ubah-password';

        // Mode
        $mode = 'POST';

        // Data
        $data = [
            'nip' => $nip,
            'password' => $password,
            'password_confirmation' => $passwordKonfirmasi,
        ];

        $this->apiKepegawaian = new ApiKepegawaian;
        $response = $this->apiKepegawaian->curlApiKepegawaian($url, $mode, $data);

        if ($response->code == 500) {
            return null;
        }

        if ($response->code <= 200 && $response->code >= 300) {
            return null;
        }

        return $response->response;
    }
}
