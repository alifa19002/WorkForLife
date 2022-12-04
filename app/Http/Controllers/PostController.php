<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Http;
use App\Models\Report;
use Illuminate\Support\Facades\Storage;
use GuzzleHttp\Client;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $response = Http::get('http://workforlife-be.my.id/api/post', [
            'search' => $request->query('search'),
            'page' => $request->query('page')
        ]);
        $response = $response->object();
        return view('Posts.posts', [
            "title" => "Sharing",
            'posts' => $response->data,
            'page' => $response
            //'posts' => $response->data->latest()->filter(request(['search']))->paginate(10)->withQueryString(),
            //'reports' => Report::latest()->get(),
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Posts.upload', [
            "title" => "Upload Posts",
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
        // Post::create([
        //     'judul' => request('judul'),
        //     'deskripsi' => request('deskripsi'),
        //     'user_id' => request('user_id')
        // ]);
        $request = Http::asform()->post("http://workforlife-be.my.id/api/post", [
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'user_id' => $request->input('user_id')
        ]);
        if ($request->status()) {
            return redirect('/posts')->with('success', 'Postingan berhasil diunggah.');
        }
        return redirect('/uploadpost')->with('success', 'Postingan gagal diunggah.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Http::get("http://workforlife-be.my.id/api/post/" . $id);
        $response = $response->object();
        $response2 = Http::get('http://workforlife-be.my.id/api/posts');
        $response2 = $response2->object();
        return view('Posts.view', [
            'title' => 'Detail Post',
            'active' => 'post',
            'post' => $response->data,
            'latest_post' =>  $response2->data,
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
        $response = Http::get("http://workforlife-be.my.id/api/post/" . $id);
        $response = $response->object();

        return view('Posts.editPost', [
            'title' => 'Edit Post',
            'posts' => $response->data
            // 'posts' => $posts
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
        $rules = [
            'judul' => 'required|max:255',
            'deskripsi' => 'required',
        ];
        $validatedData["user_id"] = session()->get('id');
        $validatedData = $request->validate($rules);

        Http::asForm()->post("http://workforlife-be.my.id/api/post/" . $id . '?_method=PUT', [
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi')
        ]);

        return redirect('/posts');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Http::delete("http://workforlife-be.my.id/api/post/" . $id);

        return redirect('/posts')->with('success', 'Post has been deleted!');
    }
}
