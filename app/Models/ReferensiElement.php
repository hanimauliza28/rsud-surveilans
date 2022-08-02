<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferensiElement extends Model
{
    use HasFactory;

    protected $table = 'referensi_element';
    protected $fillable = ['nama_element', 'script', 'created_at', 'updated_at'];

    public function referensiElement()
    {
        return $this->hasMany(ReferensiElement::class, 'ref_element_id', 'id');
    }
}
