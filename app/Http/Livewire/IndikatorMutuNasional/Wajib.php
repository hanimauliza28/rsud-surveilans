<?php

namespace App\Http\Livewire\IndikatorMutuNasional;

use Livewire\Component;
use App\Helpers\Helpers;
use App\Helpers\HelperTime;
use App\Models\IndikatorMutuNasional;

class Wajib extends Component
{
    protected $listeners = ['cariHasilImut'];

    public $filterKeyword = null;
    public $filterTanggal = null;

    public function render()
    {
        $helpers = new Helpers;
        $helperTime = new HelperTime;
        $indikatorMutuNasional = new IndikatorMutuNasional;
        $filterKeyword = $this->filterKeyword;
        $filterTanggal = $this->filterTanggal;
        $tanggal = date('Y-m-d', strtotime($filterTanggal));
        $dataMonth = $helperTime->monthNow($filterTanggal);
        $imut = $indikatorMutuNasional->searchPerKategori(3, $filterKeyword, $dataMonth['firstDay'], $dataMonth['lastDay']);

        $data = [
            'filterTanggal' => $filterTanggal,
            'date' => $dataMonth['date'],
            'dayInMonth' => $dataMonth['dayInMonth'],
            'month' => $dataMonth['month'],
            'year' => $dataMonth['year'],
            'imut' => $imut,
        ];

        return view('livewire.indikator-mutu-nasional.wajib', $data);
    }

    public function cariHasilImut($dataFilter)
    {
        $this->filterKeyword = $dataFilter['filterKeyword'];
        $this->filterTanggal = $dataFilter['filterTanggal'];
    }
}
