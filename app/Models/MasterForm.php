<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterForm extends Model
{
    use HasFactory;

    protected $table = 'master_form';
    protected $fillable = ['indikator_mutu_id', 'jenis_indikator', 'judul', 'status', 'user_id', 'nip_pegawai'];

    public function indikatorMutu()
    {
        if($this->jenis_indikator == 'nasional'){
            return $this->belongsTo(IndikatorMutuNasional::class, 'indikator_mutu_id', 'id');
        }else{
            return $this->belongsTo(IndikatorMutuLokal::class, 'indikator_mutu_id', 'id');
        }
    }
}
