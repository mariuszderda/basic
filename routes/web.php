<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

//    $users= User::all();
$users = DB::table('users')->get();

    return view('dashboard', compact('users'));
})->name('dashboard');

Route::get('/category/all', [\App\Http\Controllers\CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [\App\Http\Controllers\CategoryController::class, 'AddCat'])->name('store.category');
Route::delete('/category/remove/{id}', [\App\Http\Controllers\CategoryController::class, 'DestroyCat'])->name('destroy.category');
