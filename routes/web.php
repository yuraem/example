<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\Admin\User\UserController;

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

Route::get('/', [IndexController::class, 'index']);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::group(['namespace' => 'Admin', 'prefix' =>'admin', 'name' => 'admin.'], function() {
Route::namespace('User')->prefix('user')->name('user.')->middleware(['auth'])->group( function() {
    Route::group(['namespace' => 'Main'], function(){
        Route::get('/', 'IndexController')->name('index');
    });
    Route::resource('/profil', 'ProfilController')->names('profil');
    Route::resource('/company', 'CompanyController')->names('company');
    Route::resource('/statistics', 'StatisticsController')->names('statistics');
    // Route::post('/company/{id}', 'CompanyController@showStat')->name('company.showStat');
    Route::post('/statistics/{id}', 'StatisticsController@showStat')->name('statistics.showStat');
    Route::get('/statistics/{id}/showAjax', 'StatisticsController@showAjax')->name('statistics.showAjax');
    Route::resource('/payout', 'PayoutController')->names('payout');   
    Route::post('/payout/store', 'PayoutController@store')->name('payout.store'); 
    Route::post('/payout/{id}/stat', 'PayoutController@showStat')->name('payout.showStat'); 
    Route::get('/payout/{id}/balance', 'PayoutController@showBalance')->name('payout.showBalance'); 
}); 

Route::namespace('Moder')->prefix('moder')->name('moder.')->middleware(['auth'])->group( function() {
    Route::group(['namespace' => 'Main'], function(){
        Route::get('/', 'IndexController')->name('index');
    });
    Route::resource('/profil', 'ProfilController')->names('profil');
    Route::resource('/company', 'CompanyController')->names('company');
    Route::post('/company/{id}', 'CompanyController@showStat')->name('company.showStat');
}); 

Route::namespace('Manager')->prefix('manager')->name('manager.')->middleware(['auth'])->group( function() {
    Route::group(['namespace' => 'Main'], function(){
        Route::get('/', 'IndexController')->name('index');
    });
    Route::resource('/profil', 'ProfilController')->names('profil');
    Route::resource('/company', 'CompanyController')->names('company');
    Route::resource('/statistics', 'StatisticsController')->names('statistics');
    Route::resource('/payout', 'PayoutController')->names('payout');   
    Route::get('/payout/{id}/balance', 'PayoutController@showBalance')->name('payout.showBalance'); 
    // Route::post('/company/{id}', 'CompanyController@showStat')->name('company.showStat');
    Route::post('/statistics/{id}', 'StatisticsController@showStat')->name('statistics.showStat');
    Route::get('/statistics/{id}/showAjax', 'StatisticsController@showAjax')->name('statistics.showAjax');
    Route::resource('/partners', 'PartnersController')->names('partners');
    Route::post('/partners/{id}', 'PartnersController@showStat')->name('partners.showStat');
    Route::get('/partners/{id}/showAjax', 'PartnersController@showAjax')->name('partners.showAjax');
});

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware(['status','auth'])->group( function() {
    Route::group(['namespace' => 'Main'], function(){
        Route::get('/', 'IndexController')->name('home');
    });

    Route::group(['namespace' => 'User'], function(){
        Route::resource('/user', 'UserController')->names('user');
    });
    Route::resource('/company', 'CompanyController')->names('company');
    Route::resource('/statistics', 'StatisticsController')->names('statistics');    
    Route::resource('/payout', 'PayoutController')->names('payout');   
    Route::post('/payout/store', 'PayoutController@store')->name('payout.store'); 
    Route::post('/payout/{id}/stat', 'PayoutController@showStat')->name('payout.showStat'); 
    Route::get('/payout/{id}/balance', 'PayoutController@showBalance')->name('payout.showBalance'); 
    Route::get('/statistics/{id}/comp', 'StatisticsController@showComp')->name('statistics.showComp');
    Route::get('/statistics/{id}/showAjax', 'StatisticsController@showAjax')->name('statistics.showAjax');
    Route::post('/statistics/{id}/stat', 'StatisticsController@showStat')->name('statistics.showStat');

});    

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    return "Cache is cleared";
});