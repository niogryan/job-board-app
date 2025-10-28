<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobPostController;

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
Route::get('/', [JobPostController::class, 'Home'])->name('home');
Route::get('Home', [JobPostController::class, 'Home'])->name('home');
Route::get('viewForm', [JobPostController::class, 'viewForm'])->name('viewform');
Route::post('submitJobPost',[JobPostController::class,'submitJobPost'])->name('submitjobpost');
Route::get('viewAdmin', [JobPostController::class, 'viewAdmin'])->name('viewadmin');
Route::get('approvePost/{id}', [JobPostController::class, 'approvePost'])->name('approvepost');
Route::get('spamPost/{id}', [JobPostController::class, 'spamPost'])->name('spampost');
Route::get('viewFullDetails/{src}/{id}',[JobPostController::class, 'viewFullDetails'])->name('viewfulldetails');
