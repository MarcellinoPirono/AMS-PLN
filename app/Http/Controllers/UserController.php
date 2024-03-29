<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

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
            'users' => User::orderBy('id', 'DESC')->whereNot('role', 'Admin')->get(),
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
        // dd($request);
        if ($request->file('file') != null) {
            # code...
            $fileName = time() . $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs('storage/Image-profile', $fileName, 'public');
        }
        else{
            $path = null;
        }




        $data = [
            'username' => $request->new_username,
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
    public function edit(Request $request)
    {
        // dd($request);
        $username = $request->username;
        $user = User::where('username', $request->username)->value('id');

        $user = User::find($user);
        // dd($username);

        $data = [
            'users'  => $user,
            'title' => 'Edit Data User',
            'active' => 'User',
            'old_username' => $username,
            'active1' => 'Edit User',
        ];

        // dd($data);


        return view('pages.edit_user', $data);
    }
    public function edit_view(Request $request)
    {
        // dd($request);
        $username = $request->username;
        $user = User::where('username', $request->username)->value('id');

        $user = User::find($user);
        // dd($username);

        $data = [
            'users'  => $user,
            'title' => 'Edit Data User',
            'active' => 'User',
            'old_username' => $username,
            'active1' => 'Edit User',
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

        // if (auth()->user()->role === 'Admin') {
        //     return redirect('user')->withSuccess('Data User Telah Diedit');
        // }
        // else{

        // }
        // return back()->withSuccess('Data User Telah Diedit');


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
        // dd($id);
        $user = User::find($id)->delete();

    }

    public function edit_password(){

        return response()->json([
            'success'   => true
        ]);


    }
    public function check_password(Request $request) {
        // $jenis_khs = $request->post('edit_jenis_khs');
        $username = auth()->user()->username;


        $id = User::where('username', $username)->value('id');
        $users = User::findOrFail($id);

         $data = [
            'password' => $request->new_password,
        ];

        $data['password']= Hash::make($data['password']);
        // dd($users);


        $users->update($data);

        // Alert::success('Ganti Password', 'Telah Berhasil');

        return redirect('/')->withSuccess('Ganti Password Telah Berhasil');
        // return response()->json([
        //     'success'   => true
        // ]);

    }
    public function reset_password(Request $request) {
        // $jenis_khs = $request->post('edit_jenis_khs');

        $users = User::findOrFail($request->id);

         $data = [
            'password' => $request->new_password1,
        ];

        $data['password']= Hash::make($data['password']);
        // dd($users);


        $users->update($data);

        // Alert::success('Reset Password', 'Telah Berhasil');

        return redirect('/user')->withSuccess('Reset Password Telah Berhasil');
        // return response()->json([
        //     'success'   => true
        // ]);

    }

    public function checkUsername(Request $request) {
        $username = $request->post('username');
        $checkUsername = User::where('username', $username)->get();

        if(count($checkUsername) > 0) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }
    }

    public function password_lama(Request $request) {
        $password_lama = $request->post('password_lama');
        // dd(auth()->user()->password);

        if(Hash::check($password_lama, auth()->user()->password) != auth()->user()->password) {
            echo json_encode(false);
        } else {
            echo json_encode(true);
        }

    }

    public function checkUsername_edit(Request $request) {
        $username = $request->post('username');
        $old_username = $request->post('old_username');
        $checkUsername = User::where('username', $username)->get();
        // dd($checkUsername, $old_username);

        if(count($checkUsername) > 0) {
            if($checkUsername[0]->username == $old_username) {
                echo json_encode(true);
            } else {
                echo json_encode(false);
            }
        } else {
            echo json_encode(true);
        }
    }
    public function not_found(){
        Alert::error('Mohon Maaf', 'Halaman Tidak Tersedia');

        return back();

    }
}
