<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterWebService extends Model
{
    use HasFactory;
    protected $table = 'master_web_service';
    protected $fillable = ['nama', 'nama_unik', 'url', 'type', 'jenis_service'];

    public function getNamaJenisServiceAttribute()
    {
        if($this->jenis_pasien == 'dataPasien')
        {
            return 'Data Service Pasien';
        }else{
            return 'Data Service Pelayanan';
        }
    }
}
