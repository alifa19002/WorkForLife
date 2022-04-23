<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UploadPostsController;
use App\Http\Controllers\VacancyController;
use App\Models\Vacancy;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',  [HomeController::class, 'index']);
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/logout', function () {
    return view('logout');
});
Route::get('/uploadpost', [UploadPostsController::class, 'index'])->middleware('auth');
Route::post('/uploadpost', [UploadPostsController::class, 'store']);
Route::get('/posts/{post:id}/edit', [UploadPostsController::class, 'edit']);
Route::put('/posts/{post:id}', [UploadPostsController::class, 'update']);
Route::get('/report/{post:id}', [UploadPostsController::class, 'index']);
Route::post('/report/{post:id}', [UploadPostsController::class, 'store']);
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);
Route::resource('/profile', UserController::class)->middleware('auth');
Route::get('/profile/{username}', function ($username) {
    $title = "My Profile";
    $username = User::where('username', $username)->first()->username;
    $id = User::where('username', $username)->first()->id;
    $my_posts = Post::where('user_id', $id)->get();
    return view('/user/profile', compact(['title', 'my_posts']));
});

Route::get('/loker', [VacancyController::class, 'index']);
Route::get('/loker/{vacancy:id}', [VacancyController::class, 'show']);
