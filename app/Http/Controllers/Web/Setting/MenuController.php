<?php

namespace App\Http\Controllers\Web\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\HelperSurveilans;
use App\Helpers\Helpers;

use App\Models\Menu;

use App\Http\Requests\Form\MenuRequest;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->helperSurveilans = new HelperSurveilans();
        $this->helpers = new Helpers();
        $this->menu = new Menu;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listMenu = $this->menu->select('id', 'nama_menu', 'url')->where('section_menu', 'Y')->get();

        $data = [
            'jenisMenu' => $this->helperSurveilans->listJenisMenu(),
            'listMenu' => $listMenu
        ];

        $menu = Menu::where('parent_menu', '<>', null)->with('parent')->first();

        return view('contents.setting.menu.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MenuRequest $request)
    {
        $data = [
            'nama_menu' => $request->namaMenu,
            'url' => $request->url,
            'icon' => $request->icon,
            'parent_menu' => $request->parentMenu,
            'section_menu' => $request->sectionMenu,
            'urut' => $request->urut,
            'status' => $request->status
        ];

        $saveData = Menu::create($data);

        $saveData
            ? ($response = $this->helpers->retunJson(
                200,
                'Menu Berhasil ditambahkan'
            ))
            : ($response = $this->helpers->retunJson(
                400,
                'Menu Gagal ditambahkan'
            ));

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Data menu
        $menu = Menu::where('id', $id)->first();

        $menu
            ? ($response = $this->helpers->retunJson(
                200,
                'Sukses',
                $menu
            ))
            : ($response = $this->helpers->retunJson(
                404,
                'Menu Tidak Ditemukan'
            ));

        return $response;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MenuRequest $request, $id)
    {
        // Data
        $data = $request->except('_token');

        $data = [
            'nama_menu' => $request->namaMenu,
            'url' => $request->url,
            'icon' => $request->icon,
            'parent_menu' => $request->parentMenu,
            'section_menu' => $request->sectionMenu,
            'urut' => $request->urut,
            'status' => $request->status
        ];

        $saveData = Menu::where('id', $request->id)->update($data);

        $saveData
            ? ($response = $this->helpers->retunJson(
                200,
                'Menu Berhasil diubah'
            ))
            : ($response = $this->helpers->retunJson(
                400,
                'Menu Gagal diubah'
            ));

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::where('id', $id)->first();

        $delete = $menu->destroy($id);

        $delete
            ? ($response = $this->helpers->retunJson(
                200,
                'Menu berhasil dihapus'
            ))
            : ($response = $this->helpers->retunJson(
                400,
                'Menu gagal dihapus'
            ));

        return $response;
    }
}
