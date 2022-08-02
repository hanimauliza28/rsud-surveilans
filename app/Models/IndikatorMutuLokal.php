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
}
