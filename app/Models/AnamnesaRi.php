<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnamnesaRi extends Model
{
    use HasFactory;
    protected $connection = 'simrs';
    protected $table = 'ANAMNESA_RI';
}
