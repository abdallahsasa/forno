<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\CategoryController;
use \App\Http\Controllers\ProductController;
use \App\Http\Controllers\MessageController;
use \App\Http\Controllers\WebsiteProfileController;
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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('index');
});
Route::get('/soon', function () {
    return view('coming_soon');
});


//------------- Message -------------
Route::get('/contact', [MessageController::class, 'create']);
Route::post('/contact', [MessageController::class, 'store'])->name('contact.store');
//------------- End Message -------------


//---------------------------------------Backoffice----------------------------------------------------


Route::get('/backoffice', function () {
    return view('dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

//Dashboard Routes
//, 'middleware' => ['auth', 'verified']
Route::group(['prefix' => 'backoffice'], function () {

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    });

//------------- categories -------------
    Route::get('/categories/index', [CategoryController::class, 'index']);
    Route::get('/categories/create', [CategoryController::class, 'create']);
//------------- End categories -------------

//------------- Products -------------
    Route::get('/products/index', [ProductController::class, 'index'])->name('dashboard.product.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('/products/edit', [ProductController::class, 'edit'])->name('dashboard.product.edit');
    Route::post('/products/create', [ProductController::class, 'store'])->name('product.store');
    Route::put('/products/update', [ProductController::class, 'update'])->name('product.update');
//------------- End Products -------------


//------------- Message -------------
    Route::get('/contact/index', [MessageController::class, 'index'])->name('contact.index');
//------------- End Message -------------

//------------- Website Profile -------------
    Route::get('/website-profile/index', [WebsiteProfileController::class, 'create'])->name('website_profile.create');
    Route::post('/website-profile/index', [WebsiteProfileController::class, 'store'])->name('website_profile.store');
//------------- End Message -------------

});
