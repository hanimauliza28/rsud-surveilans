<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilSurveyImutNasionalDetail extends Model
{
    use HasFactory;
    protected $table = 'hasil_survey_imut_nasional_detail';
    protected $fillable = [
        'hasil_survey_id',
        'variabel_survey_id',
        'sub_variabel',
        'value',
        'point'
    ];

    public function parent(){
        return $this->belongsTo(HasilSurveyImutNasional::class, 'hasil_survey_id', 'id');
    }

}
