<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriVariabelSurvey extends Model
{
    use HasFactory;

    protected $table = 'kategori_variabel_survey';
    protected $fillable = ['nama_kategori', 'keterangan'];

    public function variabelSurvey()
    {
        return $this->hasMany(VariabelSurvey::class, 'kategori_variabel_survey_id', 'id');
    }
}
