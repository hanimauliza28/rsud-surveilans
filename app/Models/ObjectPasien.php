<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectPasien extends Model
{
    use HasFactory;
    protected $table = 'object_pasien';

    protected $fillable = [
        'no_reg',
        'nama_pasien',
        'norm',
        'kdbagian',
        'nama_bagian'
    ];

    // public function hasilSurvey()
    // {
    //     return $this->hasMany(HasilSurveyImutNasional::class, 'object_id', 'id');
    // }

    public function hasilSurvey()
    {
        return $this->morphOne(HasilSurveyImutNasional::class, 'object');
    }

}
