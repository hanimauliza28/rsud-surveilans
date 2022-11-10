<?php

namespace App\Exports;

use App\Models\AntrianIgd;
use Maatwebsite\Excel\Concerns\FromCollection;

class AntrianIgdExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return AntrianIgd::all();
    }
}
