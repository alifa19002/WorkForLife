<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getData()
    {
        $response = Http::get('http://localhost:8080/api/loker');
        $response = $response->object();

        $title = 'Lowongan Kerja';
        if (request('category')) {
            $title = "Semua Lowongan Kerja";
        }
        return view('loker.loker', [
            'title' => 'All Events' . $title,
            'active' => 'events',
            'lokers' => $response->data
        ]);
    }

    // public function index()
    // {
    //     $title = 'Lowongan Kerja';
    //     if (request('category')) {
    //         $title = "Semua Lowongan Kerja";
    //     }
    //     return view('loker.loker', [
    //        'title' => 'All Events' . $title,
    //         'active' => 'events',
    //         'lokers' => Vacancy::latest()->filter(request(['search']))->paginate(6)->withQueryString()
    //     ]);
        
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        return view('Loker.formloker', [
            'title' => 'Upload Lowongan Kerja',
            'message' => NULL
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
        Http::get("http://apiwfl.herokuapp.com/api/loker", [
            'company_id' => request('company_id'),
            'posisi' => request('posisi'),
            'jobdesc' => request('jobdesc'),
            'kriteria' => request('kriteria'),
            'domisili' => request('domisili'),
            'min_pengalaman' => request('min_pengalaman'),
            'insentif' => request('insentif'),
            'link_pendaftaran' => request('link_pendaftaran'),
        ]);

        return redirect('/loker')->with('success', 'Loker berhasil diunggah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function show(Vacancy $vacancy)
    {
        $response = Http::get('http://localhost:8080/api/loker'.$vacancy->id);
        $response = $response->object();

        return view('loker.view', [
            'loker' => $response,
            'title' => 'Detail Lowongan Kerja',
            'active' => 'loker'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $response = Http::get("http://apiwfl.herokuapp.com/api/loker/" . $id);
        $response = $response->object();

        return view('loker.editLoker', [
            'title' => 'Edit Post',
            'loker' => $response,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vacancy $vacancy)
    {
        $rules = [
            'posisi' => 'required|max:255',
        ];
        $validatedData = $request->validate($rules);
        Http::put("http://apiwfl.herokuapp.com/api/loker", $validatedData);

        return redirect('/loker');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacancy $vacancy)
    {
        Http::delete("http://apiwfl.herokuapp.com/api/loker/" . $vacancy->id);

        return redirect('/loker')->with('success', 'Vacancy has been deleted!');
    }
}
