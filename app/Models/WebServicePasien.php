<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\Helpers;

class WebServicePasien extends Model
{
    use HasFactory;

    protected $table = 'master_web_service';
    protected $fillable = ['nama', 'nama_unik', 'url', 'type', 'jenis_Service'];

    public function __construct()
    {
        $this->helpers = new Helpers();
    }

    public function allPasien()
    {
        $data = [
            [
                'id' => 1,
                'namaPasien' => 'SUBKHI',
                'noReg' => '202208090001',
                'norm' => '405265'
            ],
            [
                'id' => 2,
                'namaPasien' => 'RAYATI',
                'noReg' => '202208090002',
                'norm' => '220775'
            ],
            [
                'id' => 1,
                'namaPasien' => 'BESARI',
                'noReg' => '202208090003',
                'norm' => '064027'
            ],
            [
                'id' => 1,
                'namaPasien' => 'KARTINI',
                'noReg' => '202208090004',
                'norm' => '200850'
            ],

        ];

        return $this->helpers->arrayToObject($data);
    }
}
