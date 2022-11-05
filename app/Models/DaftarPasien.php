<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\ApiInformasi;
use App\Helpers\Helpers;
use App\Helpers\HelperTime;

class DaftarPasien extends Model
{
    use HasFactory;

    protected $connection = 'simrs';
    protected $table = 'REGISTRIDR';

    public function __construct()
    {
        $this->helpers = new Helpers();
        $this->helpertime = new HelperTime();
        $this->apiInformasi = new ApiInformasi();
    }

    public function pasienIgd($tanggal, $keyword)
    {
        //Format Tanggal
        $prefix_noreg = $this->helpertime->formatTanggalNoreg($tanggal);
        $cariKeyword = '';

        if($keyword != '')
        {
            $cariKeyword = " AND (A.NMPASIEN LIKE '%".$keyword."%' OR B.NOREGRS LIKE '%".$keyword."%' OR B.NORMPAS LIKE '%".$keyword."%')";
        }

        $sql = "SELECT A.NMPASIEN, A.NORMPAS, A.NOJAMINAN, A.ALAMATPAS, B.NOREGRS, C.KDDOKTER, C.REGBAGIAN, D.NAMABAGIAN
        FROM        MPASIENRS AS A INNER JOIN
                    REGISTRIPAS AS B ON A.NORMPAS = B.NORMPAS INNER JOIN
                    REGISTRIDR AS C ON B.NOREGRS = C.NOREGRS INNER JOIN
                    BAGIAN AS D ON C.REGBAGIAN = D.KDBAGIAN
        WHERE     (D.KDBAGIAN = '9501') AND (C.NOREGRS LIKE '".$prefix_noreg."%') ".$cariKeyword."
        ORDER BY B.NOREGRS ASC";

        $hasil = DB::connection('simrs')->select(DB::raw($sql));

        if (count($hasil) != 0) {
            return $hasil;
        } else {
            return false;
        }
    }

    public function pasienRawatInap($tanggal, $keyword, $kdbagian, $status)
    {
        $cariStatus = '';
        $cariTanggal = '';
        $cariBagian = '';
        $cariKeyword = '';


        if($tanggal != '')
        {
            $prefix_noreg = $this->helpertime->formatTanggalNoreg($tanggal);
            $cariTanggal = " AND B.NOREGRS LIKE '".$prefix_noreg."%'";
        }

        //filtering
        if($status != '')
        {
            if ($status == 'dalamPerawatan') {
                $cariStatus = " AND C.STSPULANG='I'";
                if ($tanggal) {
                    $cariTanggal = " AND C.TGLMASUK >= '" . $tanggal . "'";
                    // $cariTanggal = '';
                }
            } elseif ($status == 'pulang') {
                $cariStatus = " AND (C.STSPULANG='A' OR C.STSPULANG='B' OR C.STSPULANG='E')";
                if ($tanggal) {
                    $cariTanggal = " AND C.TGLPULANG='" . $tanggal . "'";
                }
            } elseif ($status == 'rujuk') {
                $cariStatus = " AND (C.STSPULANG='C' OR C.STSPULANG='D')";
                if ($tanggal) {
                    $cariTanggal = " AND C.TGLPULANG='" . $tanggal . "'";
                }
            } elseif ($status == 'meninggal') {
                $cariStatus = " AND (C.STSPULANG='F' OR C.STSPULANG='G')";
                if ($tanggal) {
                    $cariTanggal = " AND C.TGLPULANG='" . $tanggal . "'";
                }
            }else{

            }
        }

        if ($kdbagian != '') {
            $cariBagian = " AND C.KDBAGIAN='" . $kdbagian . "'";
        }

        if($keyword != '')
        {
            $cariKeyword = " AND (A.NMPASIEN LIKE '%".$keyword."%' OR B.NOREGRS LIKE '%".$keyword."%' OR B.NORMPAS LIKE '%".$keyword."%')";
        }




        $sql = "SELECT A.NMPASIEN, A.NORMPAS, A.NOJAMINAN, A.ALAMATPAS, A.TGLLAHIR, B.NOREGRS, C.KDBAGIAN, D.NAMABAGIAN
        FROM        MPASIENRS AS A INNER JOIN
                    REGISTRIPAS AS B ON A.NORMPAS = B.NORMPAS INNER JOIN
                    REGISTRIRWI AS C ON C.NOREGRS = B.NOREGRS INNER JOIN
                    BAGIAN AS D ON C.KDBAGIAN = D.KDBAGIAN
        WHERE     (D.GRPUNIT = '93') ". $cariBagian . $cariKeyword . $cariStatus . $cariTanggal .
        "ORDER BY B.NOREGRS DESC";

        $hasil = DB::connection('simrs')->select(DB::raw($sql));

        if (count($hasil) != 0) {
            return $hasil;
        } else {
            return false;
        }
    }

    public function pasienRawatJalan($tanggal, $keyword, $kdbagian)
    {
        //Format Tanggal
        $prefix_noreg = $this->helpertime->formatTanggalNoreg($tanggal);
        $cariBagian = '';
        $cariKeyword = '';

        if ($kdbagian != '') {
            $cariBagian = " AND D.KDBAGIAN='" . $kdbagian . "'";
        }

        if($keyword != '')
        {
            $cariKeyword = " AND (A.NMPASIEN LIKE '%".$keyword."%' OR B.NOREGRS LIKE '%".$keyword."%' OR B.NORMPAS LIKE '%".$keyword."%')";
        }

        $sql = "SELECT A.NMPASIEN, A.NORMPAS, A.NOJAMINAN, A.ALAMATPAS, B.NOREGRS, C.KDDOKTER, C.REGBAGIAN, D.NAMABAGIAN
        FROM        MPASIENRS AS A INNER JOIN
                    REGISTRIPAS AS B ON A.NORMPAS = B.NORMPAS INNER JOIN
                    REGISTRIDR AS C ON B.NOREGRS = C.NOREGRS INNER JOIN
                    BAGIAN AS D ON C.REGBAGIAN = D.KDBAGIAN
        WHERE     (D.GRPUNIT = '91') AND (C.NOREGRS LIKE '".$prefix_noreg."%') ". $cariBagian . $cariKeyword ."
        ORDER BY B.NOREGRS ASC";

        $hasil = DB::connection('simrs')->select(DB::raw($sql));

        if (count($hasil) != 0) {
            return $hasil;
        } else {
            return false;
        }
    }

}
