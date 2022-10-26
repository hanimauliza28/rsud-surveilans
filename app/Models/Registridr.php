<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\ApiInformasi;
use App\Helpers\Helpers;

class Registridr extends Model
{
    use HasFactory;

    protected $connection = 'simrs';
    protected $table = 'REGISTRIDR';

    public function __construct()
    {
        $this->helpers = new Helpers();
        $this->apiInformasi = new ApiInformasi();
    }
}
