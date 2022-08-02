<?php

namespace App\Helpers;
use Carbon\Carbon;

class HelperForm {
    public function jenisElement()
    {
        $data = [
            [
                'text' => 'Isian Singkat',
                'value' => 'input'
            ],
            [
                'text' => 'Isian Panjang',
                'value' => 'textarea'
            ],

            [
                'text' => 'Pilihan Ganda',
                'value' => 'select'
            ]
        ];

        return collect($data);
    }

    public function attributeElement()
    {
        $data = [
            [
                'jenisElement' => 'Isian Singkat',
                'attribute' => [
                    [
                        'name' => 'name',
                        'value' => ''
                    ],
                    [
                        'name' => 'type',
                        'value' => 'input'
                    ],
                    [
                        'name' => 'class',
                        'value' => 'form-control'
                    ],
                    [
                        'name' => 'required',
                        'value' => 'required'
                    ],
                    [
                        'name' => 'placeholder',
                        'value' => ''
                    ],
                ]
            ]
        ];

        return collect($data);
    }

    public function sumberData()
    {
        $data = [
            [
                'value' => 'dataService',
                'text' => 'Data Service'
            ],
            [
                'value' => 'manual',
                'text' => 'Manual'
            ]
        ];

        return collect($data);
    }

    public function exampleDataService()
    {
        $data = [
            [
                'id' => 'jamPelayananPasien',
                'text' => 'Jam Pelayanan Pasien'
            ],
            [
                'id' => 'jamPelayananApotek',
                'text' => 'Jam Pelayanan Apotek'
            ],
        ];

        return collect($data);
    }
}
