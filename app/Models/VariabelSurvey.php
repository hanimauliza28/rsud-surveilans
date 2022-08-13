<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariabelSurvey extends Model
{
    use HasFactory;

    protected $table = 'variabel_survey';
    protected $fillable = ['nama_variabel', 'nama', 'keterangan', 'kategori_variabel_survey_id', 'parent_id'];

    public function kategori()
    {
        return $this->belongsTo(KategoriVariabelSurvey::class, 'kategori_variabel_survey_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }
}
