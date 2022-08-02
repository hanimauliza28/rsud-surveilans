<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyNasional extends Model
{
    use HasFactory;

    protected $table = 'survey_nasional';
    protected $fillable = ['indikator_mutu_id', 'tanggal_survey', 'numerator', 'denumerator', 'user_id', 'sumber_data'];

    public function indikatorMutu()
    {
        return $this->belongsTo(IndikatorMutuNasional::class, 'indikator_mutu_id', 'id');
    }
}
