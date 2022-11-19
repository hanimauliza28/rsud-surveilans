<?php

namespace App\Http\Livewire\Setting;

use Livewire\Component;

use App\models\Menu;

class HakAksesGrupUser extends Component
{
    protected $listeners = ['refresh'];

    public $grupUserId = null;

    public function render()
    {
        $grupUserId = $this->grupUserId;

        $menu = Menu::where('section_menu', 'Y')
            ->with([
                'children' => function ($query) use ($grupUserId) {
                    $query->orderBy('urut', 'asc')->with([
                        'children' => function ($query) {
                            $query->orderBy('urut', 'asc');
                        },
                        'grupUser' => function ($query) use ($grupUserId) {
                            $query->where('grup_user_id', $grupUserId);
                        },
                    ]);
                },
                'grupUser' => function ($query) use ($grupUserId) {
                    $query->where('grup_user_id', $grupUserId);
                },
            ])
            ->get();

        $data = [
            'grupUserId' => $grupUserId,
            'menu' => $menu,
        ];

        return view('livewire.setting.hak-akses-grup-user', $data);
    }

    public function refresh($data)
    {
        $this->grupUserId = $data['grupUserId'];
    }
}
