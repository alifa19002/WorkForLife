<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class RegistrationEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //
    }

    public function confirm(Request $request, $id)
    {
        Http::asForm()->post("https://workforlife-be.my.id/api/registration/" . $id . '?_method=PUT', [
            'status_bayar' => $request->input('status_bayar')
        ]);

        return redirect('/admin');
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
        $response = Http::asform()->post("https://workforlife-be.my.id/api/registration", [
            'event_id' => $request->input('event_id'),
            'user_id' => $request->input('user_id')
        ]);
        if ($response->status() == 200) {
            return redirect()->route('formPayment', [$response->object()->id])->with('success','Pendaftaran Berhasil');
        } else {
            return redirect ('/levelup')->with('success','Pendaftaran Gagal');
        }
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
        $response = Http::get("https://workforlife-be.my.id/api/event/" . $id);
        $response = $response->object();
        return view('levelup.formdaftar', [
            'title' => 'Detail Event',
            'active' => 'event',
            'event' => $response->data,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function payment(Request $request, $id)
    {
        $uploadPath = public_path('storage/bukti_bayar');
        if ($request->hasFile('bukti_bayar')) {
            $file = $request->file('bukti_bayar');
            $uniqueFileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($uploadPath, $uniqueFileName);
            $imagePath = 'bukti_bayar/' . $uniqueFileName;
        } else {
            $imagePath = NULL;
        }

        Http::asForm()->post("https://workforlife-be.my.id/api/payment/" . $id . '?_method=PUT', [
            'bukti_bayar' => $imagePath
        ]);

        return view('levelup.suksesdaftar');
    }

    public function suksesdaftar()
    {   

    }

    public function formPayment($id)
    {
        $response = Http::get("https://workforlife-be.my.id/api/registration/" . $id);
        $response = $response->object();
        return view('levelup.konfirmasibayar', [
            'title' => 'Pembayaran',
            'data' => $response->data
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Http::delete("https://workforlife-be.my.id/api/post/" . $id);
        return redirect('/')->with('success', 'Pendaftaran Berhasil Dihapus');
    }
}
