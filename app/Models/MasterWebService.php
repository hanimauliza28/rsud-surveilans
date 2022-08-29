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

    public function getLabelJenisFilterAttribute()
    {
        if ($this->jenis_filter == 'ranap') {
            return '<label class="badge badge-success">Rawat Inap</label>';
        } elseif ($this->jenis_filter == 'rajal') {
            return '<label class="badge badge-primary">Rawat Jalan</label>';
        } else {
            return '<label class="badge badge-danger">Belum Dipilih</label>';
        }
    }
}
