<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
class LoginController extends Controller
{
    public function index()
    {
        return view('Login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request)
    {
        // $credentials = $request->validate([
        //     'email' => 'required|email:dns',
        //     'password' => 'required'
        // ]);

        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();
        //     if (Auth::user()->is_admin == 1) {
        //         return redirect()->intended('/dashboard/events');
        //     } else {
        //         return redirect()->intended('/');
        //     }
        // }

        // return back()->with('loginError', 'Login failed!');
        $response = Http::asForm()->post('http://apiwfl.herokuapp.com/api/login', [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);
        $response = $response->object();
        $token = $response->access_token;
        $role = $response->role;
        $id = $response->id;
        $company_id = $response->company_id;
        $foto_profil = $response->foto_profil;
        session(['token' => $token]);
        session(['role' => $role]);
        session(['id' => $id]);
        session(['company_id' => $company_id]);
        session(['foto_profil' => $foto_profil]);
        return redirect()->intended('/');
        // return back()->with('loginError', 'Login failed!');
    }

    public function logout(Request $request)
    {
        // $request->session()->invalidate();
        // $request->session()->regenerateToken();
        // $client = new Client();
        // $response = $client->post('http://localhost:8080/api/logout', [
        //     'headers' => [
        //         'Accept' => 'application/json',
        //         'Authorization' => 'Bearer ' . session('token'),
        //     ]
        // ]);
        // $data = json_decode($response->getBody(),true);
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('token'),
        ])->post('http://apiwfl.herokuapp.com/api/logout');
        $request->session()->flush();
        // Auth::logout();
        return redirect('/');
    }
}
