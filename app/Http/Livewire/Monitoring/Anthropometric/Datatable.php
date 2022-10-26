<?php

namespace App\Http\Livewire\Monitoring\Anthropometric;

use Livewire\Component;
use App\Models\AnthropometricResult;

class Datatable extends Component
{
    protected $listeners = ['cariNorm'];

    public $norm = null;

    public function render()
    {
        $norm = $this->norm;
        $date = date('Ymd');

        //data anthropometric
        $anthropometric = AnthropometricResult::where('norm', $norm)->orderBy('id', 'DESC')->get();

        $data = [
            'anthropometric' => $anthropometric
        ];

        return view('livewire.monitoring.anthropometric.datatable', $data);
    }


    public function cariNorm($data)
    {
        $this->norm = $data['norm'];
    }
}
