<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MultipicController;
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

// for category route
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');
Route::put('/category/update/{id}', [CategoryController::class, 'UpdateCat'])->name('update.category');
Route::get('/category/restore/{id}', [CategoryController::class, 'restoreCat'])->name('restore.category');
Route::get('/category/remove/{id}', [CategoryController::class, 'RemoveCat'])->name('remove.category');
Route::get('/category/pdelete/{id}', [CategoryController::class, 'PDelete'])->name('pdelete.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'EditCat'])->name('edit.category');

//for brand route

Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'StoreBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'EditBrand'])->name('edit.brand');
Route::get('/brand/remove/{id}', [BrandController::class, 'RemoveBrand'])->name('remove.brand');
Route::post('/brand/update/{id}', [BrandController::class, 'UpdateBrand'])->name('update.brand');

// multi image route
Route::get('/multi/image', [BrandController::class, 'Multipic'])->name('multi.image');
Route::post('/multi/add', [BrandController::class, 'StoreImage'])->name('store.image');

