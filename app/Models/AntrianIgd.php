<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

use App\Helpers\Helpers;
use App\Helpers\HelperTime;


class AntrianIgd extends Model
{
    use HasFactory;
    use HasFactory;

    protected $connection = 'antrianigd';
    protected $table = 'ANTRI_NO';
    protected $fillable = ['GRUP_ANTRI', 'NO_ANTRI', 'TGL_ANTRI', 'TGL_INPUT', 'NO_LOKET', 'STATUS_PANGGIL', 'STATUS_DILAYANI', 'JAM_DILAYANI', 'BUNYI', 'JAM_SELESAI', 'NOREGRS', 'NAMAPAS', 'NORMPAS', 'KDBAGIAN', 'NAMABAGIAN', 'ERT', 'LAMA_PELAYANAN'];
    public $timestamps = false;

    public function __construct()
    {
        $this->helpers = new Helpers();
        $this->helpertime = new HelperTime();
    }

    public function jumlahPasienPatuh($prefix_noreg)
    {
        $sql = "SELECT  COUNT(*) AS 'jumlahpasien'
        FROM         ANTRI_NO
        WHERE   NOREGRS LIKE '".$prefix_noreg."%' AND ERT <= 300";

        $hasil = DB::connection('antrianigd')->select(DB::raw($sql));
        if (count($hasil) != 0) {
            $result['noreg'] = $prefix_noreg;
            $result['jumlahpasien'] = $hasil[0]->jumlahpasien;
            return $result;
        } else {
            return false;
        }
    }

}
