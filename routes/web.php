<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [ContactController::class, 'index'])->name('contact');
Route::get('/add_contact', [ContactController::class, 'create'])->name('createContact');
Route::post('/add_contact', [ContactController::class, 'add_contact'])->name('storeContact');

Route::get('/delete_contact/{id}', [ContactController::class, 'remove_contact'])->name('deleteContact');

Route::get('/search', [ContactController::class, 'search_contact'])->name('search');