<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.user', [
            'title' => 'Data User',
            'users' => User::orderBy('id', 'DESC')->get(),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.buat_user', [
            'title' => 'Data User',
            'active' => 'User',
            'active1' => 'Tambah User',
            'users' => User::orderBy('id', 'DESC')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->file('file') != null) {
            # code...
            $fileName = time() . $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs('storage/Image-profile', $fileName, 'public');
        }
        else{
            $path = null;
        }




        $data = [
            'username' => $request->username,
            'password' => $request->password,
            'name' => $request->name,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'role' => $request->role,
            'pic_profile' => $path,
        ];

        $data['password']= Hash::make($data['password']);
        // dd($data);


        User::create($data);
        return response()->json([
            'success'   => true
        ]);


    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {

        $user = User::where('username', $username)->value('id');

        $user = User::find($user);

        $data = [
            'users'  => $user,
            'title' => 'Data User',
            'active' => 'User',
            'username' => $username,
            'active1' => 'Edit User',
            // 'categories' => ItemRincianInduk::orderBy('id', 'DESC')->get(),
        ];

        // dd($data);


        return view('pages.edit_user', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request);
//
        $id = User::where('username', $request->username_old)->value('id');
        $users = User::findOrFail($id);

        if($request->old_pic_profile){
            Storage::delete('public/'.$request->old_pic_profile);
        }

        if ($request->file('file') != null) {
            # code...

            $fileName = time().'.png';
            // dd($fileName);
            $path = $request->file('file')->storeAs('storage/Image-profile', $fileName, 'public');
        }
        else{
            $path = null;
        }

        $input = [
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'pic_profile' => $path,
            'role' => $request->role,
            'no_hp' => $request->no_hp,
        ];

        $users->update($input);

        return response()->json([
            'success'   => true
        ]);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();

    }

    public function edit_profile($username){

        dd($username);
        $user = User::where('username', $username)->value('id');

        $user = User::find($user);

        $data = [
            'users'  => $user,
            'title' => 'Data User',
            'active' => 'User',
            'username' => $username,
            'active1' => 'Edit User',
            // 'categories' => ItemRincianInduk::orderBy('id', 'DESC')->get(),
        ];

        // dd($data);
        // $view = view('pages.edit_user', $data)->render();
        return view('pages.edit_user', $data);
        // echo response()->json(['html'=>$view]);

    }
    public function edit_password($username){

        $user = User::where('username', $username)->value('id');

        $user = User::find($user);

        $data = [
            'user'  => $user,
            'title' => 'Change Password',
            'active' => 'User',
            'username' => $username,
            'active1' => 'Edit User',
            // 'categories' => ItemRincianInduk::orderBy('id', 'DESC')->get(),
        ];

        // dd($data);


        return view('pages.edit_user', $data);

    }
}
