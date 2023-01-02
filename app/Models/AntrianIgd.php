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
    protected $fillable = [
        'GRUP_ANTRI',
        'NO_ANTRI',
        'TGL_ANTRI',
        'TGL_INPUT',
        'NO_LOKET',
        'STATUS_PANGGIL',
        'STATUS_DILAYANI',
        'JAM_DILAYANI',
        'BUNYI',
        'JAM_SELESAI',
        'NOREGRS',
        'NAMAPAS',
        'NORMPAS',
        'KDBAGIAN',
        'NAMABAGIAN',
        'ERT',
        'LAMA_PELAYANAN',
        'TRIAGE',
    ];
    public $timestamps = false;

    public function __construct()
    {
        $this->helpers = new Helpers();
        $this->helpertime = new HelperTime();
    }

    public function jumlahPasienPatuh($prefix_noreg)
    {
        $sql =
            "SELECT  COUNT(*) AS 'jumlahpasien'
        FROM         ANTRI_NO
        WHERE AND  NOREGRS LIKE '" .
            $prefix_noreg .
            "%' AND ERT <= 300";

        $hasil = DB::connection('antrianigd')->select(DB::raw($sql));
        if (count($hasil) != 0) {
            $result['noreg'] = $prefix_noreg;
            $result['jumlahpasien'] = $hasil[0]->jumlahpasien;
            return $result;
        } else {
            return false;
        }
    }

    public function triageJumlah($tanggalAwal, $tanggalAkhir)
    {
        $sql =
            "SELECT TRIAGE, COUNT(*) AS JUMLAH FROM ANTRI_NO WHERE GRUP_ANTRI='03' AND (CAST(TGL_ANTRI AS date) >= '" .
            $tanggalAwal .
            "' AND CAST(TGL_ANTRI AS date) <= '" .
            $tanggalAkhir .
            "') GROUP BY  TRIAGE";

        $hasil = DB::connection('antrianigd')->select(DB::raw($sql));
        $data = [];

        foreach ($hasil as $antrian) {
            $data[$antrian->TRIAGE] = $antrian->JUMLAH;
        }

        return $data;
    }

    public function scrappingpasien($filterTanggal)
    {
        //check apa jenis perawatannya, RI atau RJ
        $sql = "SELECT GRUP_ANTRI, NO_ANTRI, TGL_ANTRI, TGL_INPUT, NO_LOKET, STATUS_PANGGIL, STATUS_DILAYANI, JAM_DILAYANI, BUNYI, JAM_SELESAI, NOREGRS, NAMAPAS, NORMPAS, ERT,
                LAMA_PELAYANAN, TRIAGE
                FROM ANTRI_NO
                WHERE (CAST(TGL_INPUT AS date) = '".$filterTanggal."') AND (GRUP_ANTRI = '03') AND NOREGRS <> ''";
        $hasil = DB::connection('antrianigd')->select($sql);
        if($hasil)
        {
            foreach($hasil as $antrian)
            {
                $sqlCheck = "SELECT TOP (1) NOREGRS, NOLANTAI, KDBAGIAN, KDGRPTRF, GRPKLS, GOLKLS, NOKMR, NOTT, KDJTHKLS, DIAGMASUK, DIAGAKHIR, TGLMASUK, JAMMASUK, STSPULANG, TGLPULANG, JAMPULANG,
                PASPRIBADI, DRPENGIRIM, PASIENDR, DRPENANGGUNGJWB, NOSJP, STSKAMAR, NOREGRSIBU, NORMPASIBU, NOSURATWAFAT, TGLWAFAT, NOLAPPOL, USLOGNM, ClientHost,
                DateEntry
                FROM REGISTRIRWI WHERE NOREGRS='".$antrian->NOREGRS."'";
                $hasilCheck = DB::connection('simrs')->select($sqlCheck);
                if($hasilCheck != [])
                {
                    $update = AntrianIgd::where('NOREGRS', $antrian->NOREGRS)->update(['JENIS' => 'RI']);
                }else{
                    $update = AntrianIgd::where('NOREGRS', $antrian->NOREGRS)->update(['JENIS' => 'RJ']);
                }
            }
        }
    }
}
