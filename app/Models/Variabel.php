<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variabel extends Model
{
    use HasFactory;
    protected $table = 'variabel';
    protected $fillable = ['indikator_mutu_id', 'jenis', 'tipe_variabel', 'indikator', 'satuan'];

    public function getTipeVariabelTextAttribute()
    {
        if($this->tipe_variabel == 'denumerator')
        {
            return 'Denumenator';
        }else{
            return 'Numerator';
        }
    }
}
