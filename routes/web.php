<?php

use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\ContactUs\ContactUsController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\WebsiteProfile\WebsiteProfileController;
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


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


//---------------------------------------Backoffice----------------------------------------------------

Route::get('/backoffice', function () {
    return view('dashboard.index');


})->middleware(['auth', 'verified'])->name('dashboard');

//Dashboard Routes
Route::group(['prefix' => 'backoffice','middleware' => ['auth', 'verified']], function () {

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    });

//------------- categories -------------
    Route::get('/categories/index', [CategoryController::class, 'index'])->name('dashboard.category.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('dashboard.category.create');
    Route::post('/categories/create', [CategoryController::class, 'store'])->name('dashboard.category.store');
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('dashboard.category.edit');
    Route::put('/categories/update/{id}', [CategoryController::class, 'update'])->name('dashboard.category.update');
    Route::delete('/categories/destroy/{id}', [CategoryController::class, 'destroy'])->name('dashboard.category.destroy');

//------------- End categories -------------

//------------- Products -------------
    Route::get('/products/index', [ProductController::class, 'index'])->name('dashboard.product.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('dashboard.product.edit');
    Route::post('/products/create', [ProductController::class, 'store'])->name('product.store');
    Route::put('/products/update/{id}', [ProductController::class, 'update'])->name('dashboard.product.update');
    Route::delete('/products/destroy/{id}', [ProductController::class, 'destroy'])->name('dashboard.product.destroy');

//------------- End Products -------------


//------------- ContactUs -------------
    Route::get('/contact/index', [ContactUsController::class, 'index'])->name('contact.index');
//------------- End ContactUs -------------

//------------- Website Profile -------------
    Route::get('/website-profile/index', [WebsiteProfileController::class, 'create'])->name('website_profile.create');
    Route::put('/website-profile/index', [WebsiteProfileController::class, 'update'])->name('website_profile.update');
//------------- End ContactUs -------------

});
//FrontEnd Routes
Route::get('/', [FrontendController::class, 'index'])->name('home.product.index');
Route::get('/menu', [FrontendController::class, 'menu'])->name('home.product.menu');
Route::get('/menu/{categoryfilter}', [FrontendController::class, 'filtermenu'])->name('home.product.filtermenu');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('home.product.show');

//------------- ContactUs -------------
Route::get('/contact', [ContactUsController::class, 'create'])->name('contact');
Route::post('/contact', [ContactUsController::class, 'store'])->name('contact.store');
//------------- End ContactUs -------------


Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');
Route::any('{query}', function() { return redirect('/'); })->where('query', '.*');
