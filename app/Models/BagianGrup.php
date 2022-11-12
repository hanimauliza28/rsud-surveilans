<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BagianGrup Extends Model
{
    use HasFactory;
    protected $connection = 'simrs';
    protected $table = 'GRUPBAGIAN';
}
