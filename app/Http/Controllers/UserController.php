<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = "My Profile";
        // $user_id = request()->user()->id;
        // $profilUser = User::where('id', $user_id)->first();
        // $my_posts = Post::where('user_id', $user_id)->get();
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('token')
        ])->get('https://workforlife-be.my.id/api/profile');
            $response = $response->object();
            $profilUser = $response->profile;
            $my_posts = $response->post;
            $my_events = $response->events;
            return view('/user/profile', compact(['title', 'profilUser', 'my_posts', 'my_events']));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $title = "My Profile";
        // $id = auth()->user()->id;
        // $user = User::where('id', $id)->first();
        // $my_posts = Post::where('user_id', $id)->get();
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('https://workforlife-be.my.id/api/profile/'.$user);
        $response = $response->object();
        $profilUser = $response->profile;
        $my_posts = $response->post;
        return view('/user/profile', compact(['title', 'profilUser', 'my_posts']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($username)
    {
        $title = "Edit Profile";
        // $profilUser = User::where('username', $username)->first();
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('https://workforlife-be.my.id/api/profile/'.$username.'/edit');
        $profilUsers = $response->object();
        return view('/user/editProfile', compact(['title', 'profilUsers']));
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
        $id = session()->get('id');
        $profilUser = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->get('https://workforlife-be.my.id/api/profile/'.session()->get('username').'/edit');
        $profilUsers = $profilUser->object();
        $pass = null;
        $profil = null;
        // $username = null;
        $rules = [
            'nama' => 'required|max:255',
            'no_telp' => 'required|numeric|digits_between:10,14',
            'jk' => 'required|max:1',
            'posisi' => 'required|max:255',
            'perusahaan' => 'required|max:255',
        ];
        foreach($profilUsers as $profilUser){
        if ($request->username != $profilUser->username) {
            $rules['username'] = 'required|min:3|max:255|unique:users';
            // $username = $request->input('username');
        }
        if ($request->email != $profilUser->email) {
            $rules['email'] = 'required|email:dns|unique:users';
            // $email = $request->input('email');
        }
        
        if ($request->password != null) {
            $rules['password'] = 'required|min:3|max:255';
            $pass = Hash::make($request->password);
        }
        $validatedData = $request->validate($rules);
        // $validatedData['password'] = Hash::make($validatedData['password']);

        if ($request->file('foto_profil')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $profil = $request->file('foto_profil')->store('foto-profil');
        }
        }
        $validatedData['id'] = $id;
        // User::where('id', $id)->update($validatedData);
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('token'),
            ])
            ->asForm()->post("https://workforlife-be.my.id/api/profile/".session()->get('id').'?_method=PUT', [
            'nama' => $request->input('nama'),
            'username' => $request->input('username'),
            'no_telp' => $request->input('no_telp'),
            'email' => $request->input('email'),
            'jk' => $request->input('jk'),
            'posisi' => $request->input('posisi'),
            'password' => $pass,
            'perusahaan' => $request->input('perusahaan'),
            'foto_profil' => $profil,
        ]);
        $resp = $response->object();
        if($response->status()==200){
        $response = $resp->data;
        $username = $response->username;
        $foto_profil = $response->foto_profil;
        session(['username' => $username]);
        session(['foto_profil' => $foto_profil]);
        return redirect('/profile')->with('success', 'Profil berhasil diupdate!');
        }
        return redirect('/profile/'.session()->get('username').'/edit')->with('success', 'Profil berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
