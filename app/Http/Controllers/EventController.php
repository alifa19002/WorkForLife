<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = Http::get('https://workforlife-be.my.id/api/event');
        $response = $response->object();
        return view('levelup.levelup', [
            'title' => 'Sharing',
            'events' => $response->data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create-event', [
            "title" => "Create Event Data",
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
        $request = Http::asform()->post("https://workforlife-be.my.id/api/event", [
            'nama' => $request->input('nama'),
            'harga' => $request->input('harga'),
            'deskripsi' => $request->input('deskripsi'),
            'tanggal_event' => $request->input('tanggal_event'),
            'link_conference' => $request->input('link_conference')
        ]);
        if ($request->status() == 200) {
            return redirect('/admin')->with('success', 'Event berhasil diunggah.');
        } else {
            return redirect('/event')->with('success', 'Event gagal diunggah.');
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
        $response = Http::get("https://workforlife-be.my.id/api/event/" . $id);
        $response = $response->object();
        return view('levelup.detailEvent', [
            'title' => 'Detail Event',
            'active' => 'event',
            'event' => $response->data
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
        $response = Http::get("https://workforlife-be.my.id/api/event/" . $id);
        $response = $response->object();
        return view('admin.edit-event', [
            'title' => 'Edit Event',
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
        // $rules = [
        //     'nama' => 'required',
        //     'harga' => 'required',
        //     'deskripsi' => 'required',
        //     'tanggal_event' => 'required',
        //     'link_conference' => 'required'
        // ];
        // $validatedData = $request->validate($rules);
        $request = Http::asform()->post("https://workforlife-be.my.id/api/event/".$id."?_method=PUT", [
            'nama' => $request->input('nama'),
            'harga' => $request->input('harga'),
            'deskripsi' => $request->input('deskripsi'),
            'tanggal_event' => $request->input('tanggal_event'),
            'link_conference' => $request->input('link_conference')
        ]);
        if ($request->status() == 200) {
            return redirect('/admin')->with('success', 'Event berhasil diupdate.');
        } else {
            $request = $request->object();
            return redirect('/admin')->with('success', 'Event gagal diupdate.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Http::delete("https://workforlife-be.my.id/api/event/" . $id);

        return redirect('/admin')->with('success', 'Event has been deleted!');
    }
}