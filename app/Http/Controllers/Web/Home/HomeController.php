<?php

namespace App\Http\Controllers\Web\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helpers;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->helpers = new Helpers;
    }
    public function index()
    {
        return view('contents.home.index');
    }

    public function query()
    {
        $noreg = '202209030001';
        $hasil = new \App\Models\HasilSurveyImutNasional;
        // $data = [
        //     'hasil' => $hasil->with('object')->first(),
        // ];

        $data = [
            'hasil' => $hasil->whereHas('object', function($query) use($noreg){
                $query->where('no_reg', $noreg);
            })
            ->with([
                'detail' => function($query){
                    return $query->select('hasil_survey_id', 'variabel_survey_id', 'sub_variabel', 'value', 'point');
                }
            ])
            ->first()
        ];

        $response = $this->helpers->retunJson(
            200,
            'Success',
            $data
        );

        return $response;
    }
}
