<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyLokal extends Model
{
    use HasFactory;

    protected $table = 'survey_lokal';
    protected $fillable = ['indikator_mutu_id', 'tanggal_survey', 'numerator', 'denumerator', 'user_id', 'sumber_data'];

}
