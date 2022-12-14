<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class IndikatorMutuNasional extends Model
{
    protected $table = 'indikator_mutu_nasional';
    protected $fillable = ['kategori_indikator_id', 'judul', 'nama_function', 'definisi_operasional', 'kriteria_inklusi', 'kriteria_eksklusi', 'sumber_data', 'area_monitoring', 'standar', 'faktor_pengali', 'satuan', 'tipe_indikator_id', 'frekuensi_id', 'created_at', 'updated_at'];

    public function frekuensi()
    {
        return $this->belongsTo(RefFrekuensi::class, 'frekuensi_id', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(RefKategoriIndikator::class, 'kategori_indikator_id', 'id');
    }

    public function tipe()
    {
        return $this->belongsTo(RefTipeIndikator::class, 'tipe_indikator_id', 'id');
    }

    public function survey()
    {
        return $this->hasMany(SurveyNasional::class, 'indikator_mutu_id', 'id');
    }

    public function hasilSurvey()
    {
        return $this->belongsToMany(VariabelSurvey::class,'hasil_survey_imut_nasional', 'indikator_mutu_id', 'variabel_survey_id')->using(HasilSurveyImutNasional::class);
    }

    public function searchPerKategori($kategoriId, $filterKeyword, $batasWaktuMulai, $batasWaktuSelesai)
    {
        $imut = IndikatorMutuNasional::where('kategori_indikator_id', $kategoriId)
                                    ->when($filterKeyword, function($query) use($filterKeyword){
                                        $query->where('judul', 'LIKE', '%'.$filterKeyword.'%');
                                    })
                                    ->with(['survey' => function($query) use($batasWaktuMulai, $batasWaktuSelesai){
                                        return $query->whereDate('tanggal_survey', '>=', $batasWaktuMulai)->whereDate('tanggal_survey', '<=', $batasWaktuSelesai);
                                    }])
                                    ->get();

        // $imut = DB::table('indikator_mutu_nasional')
        //     ->join('survey_nasional', 'indikator_mutu_nasional.id', '=', 'survey_nasional.indikator_mutu_id')
        //     ->select('indikator_mutu_nasional.id', 'indikator_mutu_nasional.judul', 'survey_nasional.tanggal_survey', 'survey_nasional.numerator', 'survey_nasional.denumerator')
        //     ->get();

        return $imut;
    }

}
