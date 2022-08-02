<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterAttribute extends Model
{
    use HasFactory;
    protected $table = 'master_attribute';
    protected $fillable = ['element_id', 'attribute', 'value'];

    public function element(){
        return $this->belongsTo(MasterElement::class, 'element_id', 'id');
    }
}
