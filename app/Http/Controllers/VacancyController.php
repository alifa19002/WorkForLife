<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getData(Request $request)
    {
        // if ($request->has('page')) {
        //     $object = $request->query('page');
        // }
        // else{
        //     $object = 1;
        // }
        $response = Http::get('http://workforlife-be.my.id/api/loker', [
            'search' => $request->query('search'),
            'page' => $request->query('page')
        ]);
        $response = $response->object();
        $title = 'Lowongan Kerja';
        if ($request->input('category')) {
            $title = "Semua Lowongan Kerja";
        }
        return view('Loker.loker', [
            'title' => 'All Events' . $title,
            'active' => 'events',
            'lokers' => $response->data,
            'page' => $response

        ]);
    }

    // public function index()
    // {
    //     $title = 'Lowongan Kerja';
    //     if ($request->input('category')) {
    //         $title = "Semua Lowongan Kerja";
    //     }
    //     return view('Loker.loker', [
    //        'title' => 'All Events' . $title,
    //         'active' => 'events',
    //         'lokers' => Vacancy::latest()->filter($request->input(['search']))->paginate(6)->withQueryString()
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
        $response = Http::asform()->post("http://workforlife-be.my.id/api/loker", [
            'company_id' => $request->input('company_id'),
            'posisi' => $request->input('posisi'),
            'jobdesc' => $request->input('jobdesc'),
            'kriteria' => $request->input('kriteria'),
            'domisili' => $request->input('domisili'),
            'min_pengalaman' => $request->input('min_pengalaman'),
            'insentif' => $request->input('insentif'),
            'link_pendaftaran' => $request->input('link_pendaftaran'),
        ]);
        if ($response->status() == 200) {
            return redirect('/loker')->with('success', 'Loker berhasil diunggah.');
        }
        return redirect('/loker/upload')->with('success', 'Loker berhasil diunggah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Http::get('http://workforlife-be.my.id/api/loker/' . $id);
        $response = $response->object();

        return view('Loker.view', [
            'lokers' => $response->data,
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
        $response = Http::get("http://workforlife-be.my.id/api/loker/" . $id);
        $response = $response->object();

        return view('Loker.editLoker', [
            'title' => 'Edit Post',
            'lokers' => $response->data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'posisi' => 'required|max:255',
        ];
        $validatedData = $request->validate($rules);
        Http::asform()->post("http://workforlife-be.my.id/api/loker/" . $id . '?_method=PUT', [
            // 'company_id' => $request->input('company_id'),
            'posisi' => $request->input('posisi'),
            'jobdesc' => $request->input('jobdesc'),
            'kriteria' => $request->input('kriteria'),
            'domisili' => $request->input('domisili'),
            'min_pengalaman' => $request->input('min_pengalaman'),
            'insentif' => $request->input('insentif'),
            'link_pendaftaran' => $request->input('link_pendaftaran')
        ]);

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
        Http::delete("http://workforlife-be.my.id/api/loker/" . $vacancy->id);

        return redirect('/loker')->with('success', 'Loker Berhasil Dihapus');
    }
}
