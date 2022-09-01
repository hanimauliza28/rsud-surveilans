<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ObjectPasien extends Model
{
    use HasFactory;
    protected $table = 'object_pasien';

    protected $fillable = [
        'no_reg',
        'nama_pasien',
        'norm',
        'kdbagian',
        'nama_bagian'
    ];

}
