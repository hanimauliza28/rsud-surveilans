<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilSurveyImutNasional extends Model
{
    use HasFactory;
    protected $table = 'hasil_survey_imut_nasional';
    protected $fillable = [
        'id_object',
        'jenis_object',
        'tgl_survey',
        'indikator_mutu_id',
        'numerator',
        'denumerator',
        'score',
        'surveyor',
    ];

    public function object()
{
    return $this->morphTo(__FUNCTION__, 'jenis_object', 'id_object');
}

    public function detail()
    {
        return $this->hasMany(HasilSurveyImutNasionalDetail::class, 'hasil_survey_id', 'id');
    }

    // public function  object()
    // {
    //     return $this->belongsTo(ObjectPasien::class, 'id_object', 'id');
    //     if($this->jenis_object == 'pasien')
    //     {
    //         return $this->belongsTo(ObjectPasien::class, 'id_object', 'id');
    //     }
    // }
}
