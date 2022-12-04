<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Report;
use Illuminate\Support\Facades\Http;

class ReportController extends Controller
{
    public function index($id)
    {
        return view('Reports.report', [
            "title" => "Report Posts",
            'posts' => Post::where('id', $id)->first(),
            'message' => NULL
        ]);
    }

    public function store(Request $request)
    {
        // Report::create([
        //     'alasan' => request('alasan'),
        //     'user_id' => request('user_id'),
        //     'postingan_id' => request('postingan_id')
        // ]);

        // return redirect('/posts');

        Http::asForm()->post("https://workforlife-be.my.id/api/report", [
            'alasan' => $request->input('alasan'),
            'user_id' => $request->input('user_id'),
            'postingan_id' => $request->input('postingan_id')
        ]);

        return redirect('/posts');
    }

    public function edit($id)
    {
        $response = Http::get("https://workforlife-be.my.id/api/report/" . $id);
        $response = $response->object();

        return view('Reports.editReport', [
            'title' => 'Edit Laporan',
            'report' => $response->data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'is_approved' => 'required',
        ];
        $validatedData = $request->validate($rules);
        Http::asform()->post("https://workforlife-be.my.id/api/report/".$id.'?_method=PUT', [
            'is_approved' => $request->input('is_approved')
        ]);
        //Report::where('id', $report->id)->update($validatedData);
        return redirect('/admin');
    }

    public function destroy($id)
    {
        // Report::destroy($report->id);
        // return redirect('/admin')->with('success', 'Report has been deleted!');

        Http::delete("https://workforlife-be.my.id/api/report/" . $id);
        return redirect('/admin')->with('success', 'Report has been deleted!');
    }
}
