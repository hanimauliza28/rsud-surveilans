<?php

namespace App\Http\Controllers\Datatables\Setting;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\HelperSurveilans;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Yajra\DataTables\Facades\DataTables;

class MenuDatatable extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {

     }
    public function __invoke(Request $request)
    {
        $filterJenisMenu = $request->filterJenisMenu;
        $filterSection = $request->filterSection;

        $menu = Menu::
        when($filterJenisMenu, function($query) use($filterJenisMenu){
            $query->where('section_menu', $filterJenisMenu);
        })
        ->when($filterSection, function($query) use($filterSection){
            $query->where('parent_menu', $filterSection);
        })
        ->with('parent');

        return DataTables::of($menu)
            ->editColumn('section_menu', function ($menu) {
                return $menu->section_menu == 'Y'
                    ? '<div class="badge badge-success">Ya</div>'
                    : '<div class="badge badge-danger">Tidak</div>';
            })

            ->editColumn('status', function ($menu) {
                return $menu->label_status;
            })

            ->editColumn('parent_menu', function ($menu) {
                return $menu->parent->nama_menu ?? '-';
            })

            ->addColumn('action', function ($menu) {
                return view('contents.setting.menu.action', \compact('menu'));
            })

            ->rawColumns(['action', 'section_menu', 'status'])
            ->make(true);
    }
}
