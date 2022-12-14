<?php

namespace App\Http\Controllers\Web\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helpers;
use App\Models\Pengumuman;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->helpers = new Helpers;
    }

    public function index()
    {
        $pengumuman = Pengumuman::where('status', 'Y')->first();
        $data = [
            'pengumuman' => $pengumuman
        ];

        return view('contents.home.index', $data);
    }

    public function query()
    {
        $db = new \App\Models\AntrianIgd;
        $hasil = $db->where('GRUP_ANTRI', '03')->whereDate("TGL_ANTRI", ">=", "2022-10-31")
        ->whereDate("TGL_ANTRI", "<=", "2022-12-31")->get();

        $data = [
            'hasil' => $hasil
        ];

        $response = $this->helpers->retunJson(
            200,
            'Success',
            $data
        );

        return $response;
    }
}
