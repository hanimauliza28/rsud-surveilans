<?php

namespace App\Helpers;
use Carbon\Carbon;
use stdClass;

class Helpers
{
    public function retunJson($code, $message, $response = null)
    {
        return response()->json(
            [
                'code' => $code,
                'message' => $message,
                'response' => $response,
            ],
            $code
        );
    }

    public function hari($hari)
    {
        $listHari = [
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
            6 => 'Sabtu',
            7 => 'Minggu',
        ];

        return $listHari[$hari];
    }

    public function listVariabel()
    {
        $data = [
            [
                'value' => 'numerator',
                'text' => 'Numerator',
            ],
            [
                'value' => 'denumerator',
                'text' => 'Denumerator',
            ],
        ];

        return collect($data);
    }

    function array_to_obj($array, &$obj)
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $obj->$key = new stdClass();
                $this->array_to_obj($value, $obj->$key);
            } else {
                $obj->$key = $value;
            }
        }
        return $obj;
    }

    function arrayToObject($array)
    {
        $object = new stdClass();
        return $this->array_to_obj($array, $object);
    }
}
