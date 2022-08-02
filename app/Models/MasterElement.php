<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterElement extends Model
{
    use HasFactory;
    protected $table = 'master_element';
    protected $fillable = ['form_id', 'nama_inputan', 'nama_element', 'ref_element_id', 'index-order', 'created_at', 'updated_at'];

    public function form(){
        return $this->belongsTo(MasterForm::class, 'form_id', 'id');
    }
}
