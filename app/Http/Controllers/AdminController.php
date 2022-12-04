<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Post;
use App\Models\User;
use App\Models\Report;
use App\Models\Vacancy;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('https://workforlife-be.my.id/api/admin');
        $response = $response->object();

        return view('admin.rekap', [
            // 'title' => "Halaman Admin",
            // 'posts' => Post::latest()->get(),
            // 'lokers' => Vacancy::latest()->get(),
            // 'reports' => Report::latest()->get(),
            // 'companies' => Company::orderBy('id')->get(),
            'posts' => $response->post,
            'lokers' => $response->vacancy,
            'reports' => $response->report,
            'companies' => $response->company,
            'events' => $response->event,
            'registration' => $response->regEvent
        ]);
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
        // $validatedData = $request->validate([
        //     'nama' => 'required|max:255',
        //     'username' => ['required', 'min:3', 'max:255', 'unique:users'],
        //     'email' => 'required|email:dns|unique:users',
        //     'no_telp' => 'required|numeric|digits_between:10,14',
        //     'password' => 'required|min:5|max:255',
        //     'role' => 'required',
        //     'company_id' => 'required'
        // ]);

        // $validatedData['password'] = Hash::make($validatedData['password']);
        Http::asForm()->post("https://workforlife-be.my.id/api/admin/company/create", [
            'nama' => $request->input('nama'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'no_telp' => $request->input('no_telp'),
            'password' => $request->input('password'),
            'role' => $request->input('role'),
            'company_id' => $request->input('company_id')
        ]);
        


        return redirect('/admin')->with('success', 'Company account successfully made!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Http::get("https://workforlife-be.my.id/api/company/".$id);
        $response = $response->object();
        return view('admin.detail-company', [
            'title' => 'Detail Perusahaan',
            'active' => 'perusahaan',
            'company' => $response->data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
