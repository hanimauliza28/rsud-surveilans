<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorMutuLokal extends Model
{

    protected $table = 'indikator_mutu_lokal';
    protected $fillable = ['kategori_indikator_id', 'judul', 'definisi_operasional', 'kriteria_inklusi', 'kriteria_eksklusi', 'sumber_data', 'area_monitoring', 'standar', 'faktor_pengali', 'satuan', 'tipe_indikator_id', 'frekuensi_id', 'created_at', 'updated_at'];

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
        return $this->hasMany(SurveyLokal::class, 'indikator_mutu_id', 'id');
    }

    public function searchPerKategori($filterKeyword, $batasWaktuMulai, $batasWaktuSelesai)
    {
        $imut = IndikatorMutuLokal::when($filterKeyword, function($query) use($filterKeyword){
                                        $query->where('judul', 'LIKE', '%'.$filterKeyword.'%');
                                    })
                                    ->with(['survey' => function($query) use($batasWaktuMulai, $batasWaktuSelesai){
                                        return $query->whereDate('tanggal_survey', '>=', $batasWaktuMulai)->whereDate('tanggal_survey', '<=', $batasWaktuSelesai);
                                    }])
                                    ->get();
        return $imut;
    }
}
