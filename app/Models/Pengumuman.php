<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;
    protected $table = 'pengumuman';
    protected $fillable = ['id', 'judul', 'status', 'isi'];

    public function getLabelStatusAttribute()
    {
        if($this->status == 'Y'){
            $result = '<span class="badge badge-success">Aktif</span>';
        }else{
            $result = '<span class="badge badge-danger">Tidak Aktif</span>';
        }
        return $result;
    }
}
