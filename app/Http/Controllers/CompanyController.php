<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Company.formperusahaan', [
            "title" => "Verifikasi Perusahaan",
            'active' => 'company',
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
        $rules = [
            'user_id' => 'required',
            'nama_perusahaan' => 'required|max:255',
            'namaCP' => 'required|max:50',
            'noCP' => 'required|numeric|digits_between:10,14',
            'email' => 'required|email:dns|unique:companies',
            'alamat' => 'required|max:255',
        ];
        // $validatedData = $request->validate($rules);
        Http::asForm()->post("http://workforlife-be.my.id/api/company", [
            'user_id' => $request->input('user_id'),
            'nama_perusahaan' => $request->input('nama_perusahaan'),
            'namaCP' => $request->input('namaCP'),
            'noCP' => $request->input('noCP'),
            'email' => $request->input('email'),
            'alamat' => $request->input('alamat'),
        ]);
        // $validatedData = $request->validate([
        //     'user_id' => 'required',
        //     'nama_perusahaan' => 'required|max:255',
        //     'namaCP' => 'required|max:50',
        //     'noCP' => 'required|numeric|digits_between:10,14',
        //     'email' => 'required|email:dns|unique:companies',
        //     'alamat' => 'required|max:255',
        // ]);

        // Company::create($validatedData);
        // $request->session()->flash('success', 'Registration successful, please login!');
        return redirect('/company')->with('success', 'Company Verification submitted, please wait for further info!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Http::delete("http://workforlife-be.my.id/api/admin/company/" . $id);

        return redirect('/admin')->with('success', 'Perusahaan Berhasil Dihapus');
    }
}
