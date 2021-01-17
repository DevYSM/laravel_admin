<?php

use Illuminate\Support\Facades\Artisan;
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


Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    Route::get('/', function () {

    });

});

// Trigger Auth Routes
Route::group(['prefix' => 'admin'], function () {
    Auth::routes([
        'register' => true,
        'reset' => false,
        'verify' => false,
    ]);
});
Route::group(['prefix' => 'admin', 'middleware' => ['web', 'auth']], function () {
    // Admin Routes
    Route::get('dashboard', 'HomeController@index')->name('admin.dashboard');

    //Start Services Routes
    Route::resource('sliders','Admin\SliderController')->except(['show']);
    Route::get('sliders/{slider}/status', 'Admin\SliderController@status')->name('sliders.status');
    //End Services Routes

    //Start Services Routes
    Route::resource('services','Admin\ServiceController')->except(['show']);
    Route::get('services/{service}/status', 'Admin\ServiceController@status')->name('services.status');
    //End Services Routes

    //Start projects Routes
    Route::resource('projects','Admin\ProjectController')->except(['show']);
    Route::get('projects/{project}/status', 'Admin\ProjectController@status')->name('projects.status');
    //End projects Routes

    //Start products Routes
    Route::resource('products','Admin\ProductController')->except(['show']);
    Route::get('products/{product}/status', 'Admin\ProductController@status')->name('products.status');
    //End products Routes

    //Start pages Routes
    Route::resource('pages','Admin\PageController')->except(['show']);
    Route::get('pages/{page}/status', 'Admin\PageController@status')->name('pages.status');
    //End pages Routes

    //Start pages Routes
    Route::resource('sections','Admin\SectionController')->except(['show']);
    Route::get('sections/{section}/status', 'Admin\SectionController@status')->name('sections.status');
    //End pages Routes

    //Start pages Routes
    Route::resource('configs','Admin\ConfigController')->except(['show']);
    Route::get('configs/{config}/status', 'Admin\ConfigController@status')->name('configs.status');
    //End pages Routes

    Route::post('ckeditor/upload', 'Admin\CKEditorController@upload')->name('ckeditor.image-upload');
});

Route::get('artisan', function () {
    Artisan::call('storage:link');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
});


