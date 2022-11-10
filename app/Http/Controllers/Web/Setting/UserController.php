<?php

namespace App\Http\Controllers\Web\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Helpers\HelperSurveilans;
use App\Helpers\Helpers;

use App\Models\User;

use App\Http\Requests\Setting\UserRequest;

class UserController extends Controller
{
    public function __construct()
    {
        $this->helperSurveilans = new HelperSurveilans();
        $this->helpers = new Helpers();
        $this->menu = new User;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'levelUser' => $this->helperSurveilans->listLevelUser(),
            'statusUser' => $this->helperSurveilans->listStatusUser()
        ];

        return view('contents.setting.user.index', $data);
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
    public function store(UserRequest $request)
    {
        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'status' => $request->status,
            'level' => $request->level
        ];
        if($request->password != '')
        {

            $data['password'] = bcrypt($request->password);
        }

        $saveData = User::create($data);

        $saveData
            ? ($response = $this->helpers->retunJson(
                200,
                'User Berhasil ditambahkan'
            ))
            : ($response = $this->helpers->retunJson(
                400,
                'User Gagal ditambahkan'
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
        $menu = User::where('id', $id)->first();

        $menu
            ? ($response = $this->helpers->retunJson(
                200,
                'Sukses',
                $menu
            ))
            : ($response = $this->helpers->retunJson(
                404,
                'User Tidak Ditemukan'
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
    public function update(UserRequest $request, $id)
    {
        // Data
        $data = $request->except('_token');

        $data = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'status' => $request->status,
            'level' => $request->level
        ];

        if($request->password != '')
        {

            $data['password'] = bcrypt($request->password);
        }

        $saveData = User::where('id', $request->id)->update($data);

        $saveData
            ? ($response = $this->helpers->retunJson(
                200,
                'User Berhasil diubah'
            ))
            : ($response = $this->helpers->retunJson(
                400,
                'User Gagal diubah'
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
        $menu = User::where('id', $id)->first();

        $delete = $menu->destroy($id);

        $delete
            ? ($response = $this->helpers->retunJson(
                200,
                'User berhasil dihapus'
            ))
            : ($response = $this->helpers->retunJson(
                400,
                'User gagal dihapus'
            ));

        return $response;
    }
}
