<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterElementOption extends Model
{
    use HasFactory;
    protected $table = 'master_element_option';
    protected $fillable = ['master_element_id', 'jenis_option', 'value', 'text', 'created_at', 'updated_at'];

    public function form(){
        return $this->belongsTo(MasterForm::class, 'form_id', 'id');
    }
}
