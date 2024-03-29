<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VacancyController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\RegistrationEventController;
use App\Http\Middleware\AuthCustom;
use App\Models\Vacancy;

use Illuminate\Support\Facades\Artisan;

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

Route::get('/storage', function () {
    Artisan::call('storage:link');
});

Route::get('/',  [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
// Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/uploadpost', [PostController::class, 'create'])->middleware('token');
Route::post('/uploadpost', [PostController::class, 'store']);
Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{post:id}', [PostController::class, 'show']);
Route::get('/posts/{post:id}/edit', [PostController::class, 'edit']);
Route::put('/posts/{post:id}', [PostController::class, 'update']);
Route::delete('/posts/{post:id}', [PostController::class, 'destroy']);
Route::get('/report/{post:id}', [ReportController::class, 'index']);
Route::post('/report', [ReportController::class, 'store']);
Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);
Route::resource('/profile', UserController::class)->middleware('token');
Route::get('/profile/{username}', function ($username) {
    $title = "My Profile";
    $username = User::where('username', $username)->first()->username;
    $id = User::where('username', $username)->first()->id;
    $my_posts = Post::where('user_id', $id)->get();
    return view('/user/profile', compact(['title', 'my_posts']));
});

Route::get('/loker', [VacancyController::class, 'getData']);
Route::get('/loker/upload', [VacancyController::class, 'create'])->middleware('token');
Route::post('/loker/upload', [VacancyController::class, 'store']);
Route::get('/loker/{vacancy:id}', [VacancyController::class, 'show']);
Route::get('/loker/{vacancy:id}/edit', [VacancyController::class, 'edit']);
Route::put('/loker/{vacancy:id}', [VacancyController::class, 'update']);
Route::delete('/loker/{vacancy:id}', [VacancyController::class, 'destroy']);

Route::get('/form', function () {
    return view('loker.formloker');
});

Route::get('/company', [CompanyController::class, 'index']);
Route::post('/company/verify', [CompanyController::class, 'store']);
// Route::middleware([AuthCustom::class])->group(function(){
Route::get('/admin', [AdminController::class, 'index'])->middleware('token');
// });
Route::get('/admin/company/{company:id}/detail', [AdminController::class, 'show']);
Route::post('/admin/company/create', [AdminController::class, 'store'])->middleware('token');
Route::delete('/admin/company/delete/{company:id}', [CompanyController::class, 'destroy'])->middleware('token');

Route::get('/admin/report/{report:id}/detail', [ReportController::class, 'edit']);
Route::put('/admin/report/{report:id}', [ReportController::class, 'update']);
Route::delete('/admin/report/{id}', [ReportController::class, 'destroy']);

Route::get('/levelup', [EventController::class, 'index']);
Route::get('/levelup/event/{event:id}', [EventController::class, 'show']);
// Route::get('/levelup/event/{event:id}/daftar', function () {
//     return view('levelup.formdaftar');
// });
Route::get('/levelup/event/{event:id}/daftar', [RegistrationEventController::class, 'edit']);
Route::get('/levelup/event/1/suksesdaftar', function () {
    return view('levelup.suksesdaftar');
});
Route::get('/levelup/event/1/konfirmasi', function () {
    return view('levelup.konfirmasibayar');
});

Route::get('/registration', [RegistrationEventController::class, 'index']);
Route::post('/registration', [RegistrationEventController::class, 'store']);
Route::get('/registration/{id}', [RegistrationEventController::class, 'show']);
Route::put('/registration/{id}', [RegistrationEventController::class, 'update']);
Route::put('/confirm/{id}', [RegistrationEventController::class, 'confirm']);
Route::get('/payment/{id}', [RegistrationEventController::class, 'formPayment'])->name('formPayment');
Route::put('/payment/{id}', [RegistrationEventController::class, 'payment']);
Route::delete('/registration/{id}', [RegistrationEventController::class, 'destroy']);
Route::get('/event', [EventController::class, 'index']);
Route::get('/event/create', [EventController::class, 'create']);
Route::post('/event', [EventController::class, 'store']);
Route::get('/event/{id}', [EventController::class, 'show']);
Route::get('/event/{id}/edit', [EventController::class, 'edit']);
Route::put('/event/{id}', [EventController::class, 'update']);
Route::delete('/event/{id}', [EventController::class, 'destroy']);

Route::get('/payment/{id}/success', [RegistrationEventController::class, 'suksesdaftar']);