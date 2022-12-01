<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\ApiInformasi;
use App\Helpers\Helpers;
use Carbon\Carbon;

class RawatInap extends Model
{
    use HasFactory;

    protected $connection = 'simrs';
    protected $table = 'REGISTRIRWI';

    public function __construct()
    {
        $this->helpers = new Helpers();
        $this->apiInformasi = new ApiInformasi();
    }

    public function dataVisit($noReg)
    {
        $query = "SELECT B.NOREGRS, B.NOTINDAKAN, B.KDTINDAKAN, A.NAMAPMR, B.TGLPMR, CAST(B.TGLPMR AS DATE) AS 'TANGGAL', CAST(B.TGLPMR AS TIME) AS 'WAKTU'
        FROM MTINDAKAN A, TRTINDAKAN B
        WHERE B.NOREGRS LIKE '" .
            $noReg .
            "' AND A.KDTINDAKAN IN ('00083', '00084', '00085', '00086', '00087', '00088', '00089', '0316') AND A.KDTINDAKAN=B.KDTINDAKAN
            ORDER BY  B.TGLPMR ASC";

        $hasil = DB::connection('simrs')->select(DB::raw($query));

        if (count($hasil) != 0) {
            return $hasil;
        } else {
            return false;
        }
    }

    public function anamnesa()
    {
        return $this->hasMany(Anamnesa::class, 'NOREGRS', 'NOREGRS');
    }

    public function anamnesari()
    {
        return $this->hasMany(AnamnesaRi::class, 'NOREGRS', 'NOREGRS');
    }
}
