<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Homepage;
use App\Livewire\Reservation;
use App\Livewire\ReservationConfirm;
use App\Livewire\Management;
use App\Livewire\Todo;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', Homepage::class)->name('home');


Route::get('/homepage', Homepage::class)->name('home');

Route::get('/reserve', Reservation::class)->name('reserve');

Route::get('/todo', Todo::class)->name('todo');

Route::get('/reserve-confirm/{reservation_id}', ReservationConfirm::class)->name('reserve-confirm');

Route::get('/management', Management::class)->name('management')->middleware('auth');

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('homepage');
