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
        // dd($request);
        // $file =$request->file('file')-;
        if ($request->file('file') != null) {
            # code...
            $fileName = time() . $request->file('file')->getClientOriginalName();
            $path = $request->file('file')->storeAs('storage/Image-profile', $fileName, 'public');
        }
        else{
            $path = null;
        }
        // $requestData["file"] = '/storage/' . $path;
        // dd($requestData["file"]);


        // $path = Storage::putFile('public/storage', $request->file('file'), 'public');
        // dd($path);


        // $filename = hexdec(uniqid()) . '.' . $file->extension();
        // $path1 = 'public/storage/Image-profile/'.$filename.'';


        // Storage::disk('local')->put($path1);


        // dd($filename);


        // $filename = hexdec(uniqid()) . '.' . $file->extension();
        // // $folder = uniqid() . '-' . now()->timestamp;

        // $file->storeAs('profile-image/', $filename);


        // dd($file);
        // $data = $request->validate([
        //     'name' => 'required|min:5',
        //     'username'=> 'required|min:3|max:255|unique:users',
        //     'email' => 'required|email:dns|unique:users',
        //     'password' =>'required|min:5|max:255',

        // ]);
        // dd($file);






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

        // Session::push('folder', $folder); //save session  folder
        // // folder = [item1, item2, item3];
        // Session::push('filename', $filename);

        // Session::push('folder', $folder); //save session  folder
        // // folder = [item1, item2, item3];
        // Session::push('filename', $filename); //save session filename
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
    public function update(Request $request, $username_old)
    {
        // dd($request->old_pic_profile);
//
        $id = User::where('username', $username_old)->value('id');
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
}
