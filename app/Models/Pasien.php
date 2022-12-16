<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\ApiInformasi;
use App\Helpers\Helpers;
use Carbon\Carbon;

class Pasien extends Model
{
    use HasFactory;

    protected $connection = 'simrs';
    protected $table = 'MPASIENRS';

    public function __construct()
    {
        $this->helpers = new Helpers();
        $this->apiInformasi = new ApiInformasi();
    }

    public function getUsiaAttribute()
    {
        return Carbon::parse($this->TGLLAHIR)->diff(Carbon::now())->format('%y Tahun, %m Bulan, %d Hari');
    }

    public function getUsiaBulanAttribute()
    {
        $tahun = Carbon::parse($this->TGLLAHIR)->diff(Carbon::now())->format('%y');
        $bulan = Carbon::parse($this->TGLLAHIR)->diff(Carbon::now())->format('%m');
        $tahunBulan = $tahun*12;
        $totalBulan = $bulan+$tahunBulan;
        return $totalBulan;
    }


    public function cariByNormNamapas($cari = null, $bagian = null)
    {
        $whereCari = '';
        $whereBagian = '';

        if ($cari != '' && $bagian == '') {

            $whereCari =
                "WHERE (NORMPAS LIKE '%" .
                $cari .
                "%' OR NMPASIEN LIKE '%" .
                $cari .
                "%')";

            $sql = 'SELECT TOP 50 * FROM MPASIENRS ' . $whereCari . '';

        } elseif($cari == '' && $bagian != ''){

            $whereBagian = "AND C.REGBAGIAN = ".$bagian;

            $date = date('Ymd');
            $sql = "SELECT
            A.NMPASIEN, A.NORMPAS, A.NOJAMINAN, A.ALAMATPAS, B.NOREGRS, C.KDDOKTER, C.REGBAGIAN, D.NAMABAGIAN
            FROM MPASIENRS A, REGISTRIPAS B, REGISTRIDR C, BAGIAN D
            WHERE A.NORMPAS=B.NORMPAS AND B.NOREGRS=C.NOREGRS AND C.REGBAGIAN=D.KDBAGIAN AND (C.NOREGRS LIKE '".$date."%') ".$whereBagian;

        }elseif($cari != '' && $bagian != '') {
            $whereCari =
                " AND (A.NORMPAS LIKE '%" .
                $cari .
                "%' OR A.NMPASIEN LIKE '%" .
                $cari .
                "%')";

            $whereBagian = "AND C.REGBAGIAN = ".$bagian;

            $date = date('Ymd');
            $sql = "SELECT
            A.NMPASIEN, A.NORMPAS, A.NOJAMINAN, A.ALAMATPAS, B.NOREGRS, C.KDDOKTER, C.REGBAGIAN, D.NAMABAGIAN
            FROM MPASIENRS A, REGISTRIPAS B, REGISTRIDR C, BAGIAN D
            WHERE A.NORMPAS=B.NORMPAS AND B.NOREGRS=C.NOREGRS AND C.REGBAGIAN=D.KDBAGIAN AND (C.NOREGRS LIKE '".$date."%') ".$whereCari." ".$whereBagian;

        }else{

            $date = date('Ymd');
            $sql = "SELECT
            A.NMPASIEN, A.NORMPAS, A.NOJAMINAN, A.ALAMATPAS, B.NOREGRS, C.KDDOKTER, C.REGBAGIAN, D.NAMABAGIAN
            FROM MPASIENRS A, REGISTRIPAS B, REGISTRIDR C, BAGIAN D
            WHERE A.NORMPAS=B.NORMPAS AND B.NOREGRS=C.NOREGRS AND C.REGBAGIAN=D.KDBAGIAN AND (C.NOREGRS LIKE '".$date."%') ";
        }

        $hasil = DB::connection('simrs')->select(DB::raw($sql));

        if (count($hasil) != 0) {
            return $hasil;
        } else {
            return false;
        }
    }

    public function jumlahPasienIgd($tanggalAwal, $tanggalAkhir)
    {
        $query = "SELECT
        (SELECT COUNT(*) as jumlah
          FROM [DBRS_BATANG].[dbo].[REGISTRIDR] as REGISTRIDR
          WHERE REGISTRIDR.REGBAGIAN='9501'
          AND CAST(REGISTRIDR.DATEENTRY AS date) >= '".$tanggalAwal."'
          AND CAST(REGISTRIDR.DATEENTRY AS date) <= '".$tanggalAkhir."') as igd,

        (SELECT COUNT(*) as jumlah
          FROM [DBRS_BATANG].[dbo].[REGISTRIDR] as REGISTRIDR,
          [DBRS_BATANG].[dbo].[REGISTRIRWI] as REGISTRIRWI
          WHERE REGISTRIDR.REGBAGIAN='9501'
          AND CAST(REGISTRIDR.DATEENTRY AS date) >= '".$tanggalAwal."'
          AND CAST(REGISTRIDR.DATEENTRY AS date) <= '".$tanggalAkhir."'
          AND REGISTRIDR.NOREGRS=REGISTRIRWI.NOREGRS) AS igdranap,

         (SELECT COUNT(*) as jumlah
          FROM [DBRS_BATANG].[dbo].[REGISTRIDR] as REGISTRIDR
          LEFT JOIN DBRS_BATANG.dbo.REGISTRIRWI AS REGISTRIRWI ON REGISTRIDR.NOREGRS=REGISTRIRWI.NOREGRS
          WHERE REGISTRIDR.REGBAGIAN='9501'
          AND CAST(REGISTRIDR.DATEENTRY AS date) >= '".$tanggalAwal."'
          AND CAST(REGISTRIDR.DATEENTRY AS date) <= '".$tanggalAkhir."'
          AND REGISTRIRWI.NOREGRS IS NULL) AS igdrajal
          ";


        $hasil = DB::connection('simrs')->select(DB::raw($query));
        return $hasil;

    }
}
