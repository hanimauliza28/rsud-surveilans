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
    protected $fillable = ['GRUP_ANTRI', 'NO_ANTRI', 'TGL_ANTRI', 'TGL_INPUT', 'NO_LOKET', 'STATUS_PANGGIL', 'STATUS_DILAYANI', 'JAM_DILAYANI', 'BUNYI', 'JAM_SELESAI', 'NOREGRS', 'NAMAPAS', 'NORMPAS', 'KDBAGIAN', 'NAMABAGIAN'];
    public $timestamps = false;

    public function __construct()
    {
        $this->helpers = new Helpers();
        $this->helpertime = new HelperTime();
    }

}
