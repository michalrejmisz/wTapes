<?php

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

//
//Route::get('/', function () {
//    return view('main');
//})->name('main');

//Route::get('/test', function () {
//    return view('main_original');
//});

//Route::get('/test2', function () {
//    return view('main');
//});

//Route::get('/', function () {
//    return view('main');
//})->name('main');
//Route::group(['prefix' => 'selected_lang'], function() {
//Route::group(['middleware' => 'Language'], function () {
//    Route::get('/change-language/{lang}', [\App\Http\Controllers\HomeController::class, 'changeLang']);
//
//    Route::get('/products/{id}', [App\Http\Controllers\HomeController::class, 'product_by_category'])->name('products_by_category');
//    Route::get('/products', [App\Http\Controllers\HomeController::class, 'products_all'])->name('products_all');
//
//    //Route::get('contact-us', [ContactController::class, 'index']);
//    Route::post('/', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.us.store');
//    Route::post('/products', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.us.store');
//});



if(!function_exists('parseLocale')) {
    function parseLocale()
    {
        $locale = request()->segment(1);
        if (in_array($locale, ['js', 'css'])) // for speed up :)
            return $locale;
        if (array_key_exists($locale, config('languages'))) {
            app()->setLocale($locale);
            return $locale;
        }
        app()->setLocale('pl');  // this default locale
        return '/';
    }
}

//Route::get('/', function () {
//    return view('main');
//})->name('pl');
//
//Route::get('/en/', function () {
//    return view('main');
//})->name('en');

/** Here route */
Route::prefix(parseLocale())->group(function () {
    Route::get('/', function () {
        return view('main');
    })->name('main');
    Route::get('/change-language/{lang}', [\App\Http\Controllers\HomeController::class, 'changeLang']);

    Route::get('/products/{id}', [App\Http\Controllers\HomeController::class, 'product_by_category'])->name('products_by_category');
    Route::get('/products', [App\Http\Controllers\HomeController::class, 'products_all'])->name('products_all');

    //Route::get('contact-us', [ContactController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.us.store');
    Route::post('/products', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.us.store');

});





Auth::routes(['register' => false, 'reset' => false]);
Route::group(['middleware' => 'auth'], function(){
    Route::get('/admin', function () {
        return view('dashboard.product.product');
    })->name('admin');
    Route::get('/dashboard/product', function (){
        return view('dashboard.product.product');
    })->name('dashboard.products.table');
    Route::get('/dashboard/product/create', [\App\Http\Controllers\ProductController::class, 'create']);
    Route::post('/dashboard/product', [\App\Http\Controllers\ProductController::class, 'store'])->name('products.store');
    Route::post('/dashboard/product/delete/{id}', [\App\Http\Controllers\ProductController::class, 'destroy'])->name('product.delete');
    Route::post('/dashboard/product/update/{id}', [\App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
    Route::post('/dashboard/product/edit/{id}', [\App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
    Route::get('/dashboard/product', [\App\Http\Controllers\ProductController::class, 'index'])->name('products.index');
});

