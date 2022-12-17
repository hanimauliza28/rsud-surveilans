<?php

namespace App\Exports;

use App\Models\AntrianIgd;
use App\Helpers\HelperTime;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class AntrianIgdExport extends \PhpOffice\PhpSpreadsheet\Cell\StringValueBinder implements FromView, WithCustomValueBinder,ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    **/

    public function __construct(string $filterTanggal = null)
    {
        $this->filterTanggal = $filterTanggal;
        $this->helperTime = new HelperTime;
    }

    public function view(): View
    {

        $tanggal = $this->helperTime->splitFilterBatasWaktu($this->filterTanggal);

        $batasAtas = $tanggal['batasWaktuMulai'];
        $batasSelesai = $tanggal['batasWaktuSelesai'];
        $antrian = AntrianIgd::where('GRUP_ANTRI', '03')->whereDate('TGL_ANTRI', '>=', $batasSelesai)->whereDate('TGL_ANTRI', '<=', $batasSelesai)->orderBy('TGL_INPUT', 'ASC')->get();

        $data = [
            'tanggal' => $tanggal,
            'antrian' => $antrian
        ];

        return view('contents.form.registrasiAntrianIgd.export', $data);
    }
}
