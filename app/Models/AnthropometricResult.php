<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnthropometricResult extends Model
{
    use HasFactory;

    protected $table = 'anthropometric_result';
    protected $fillable = [
        'tgl_survey',
        'norm',
        'noreg',
        'umur',
        'bb',
        'tb'
    ];
}
