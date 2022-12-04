<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function index()
    {
        $post = Http::get('https://workforlife-be.my.id/api/posts');
        $loker = Http::get('https://workforlife-be.my.id/api/lokers');
        $post = $post->object();
        $loker = $loker->object();
        return view('index', [
            'title' => 'Home',
            'active' => 'home',
            'posts' => $post->data,
            'latest_loker' => $loker->data
        ]);
    }
}
