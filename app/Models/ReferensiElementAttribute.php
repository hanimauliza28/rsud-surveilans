<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferensiElementAttribute extends Model
{
    use HasFactory;

    protected $table = 'ref_element_attribute';
    protected $fillable = ['ref_element_id', 'nama_attribute', 'default_value', 'created_at', 'updated_at'];

    public function referensiElement()
    {
        return $this->belongsTo(ReferensiElement::class, 'ref_element_id', 'id');
    }

}
