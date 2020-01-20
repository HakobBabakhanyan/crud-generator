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



Route::middleware('languages')->prefix('{slug?}')->namespace('Site')->group(function (){
    Route::get('/','IndexController@index');
    Route::get('/{category}','IndexController@category');
    Route::get('/{category}/{sub_category}','IndexController@sub_category');
    Route::get('/{category}/{sub_category}/{item}','IndexController@item');
});

//Route::get('/director', function () {
//    return view('site.pages.director');
//});
//
//Route::get('/history', function () {
//    return view('site.pages.history');
//});


//Route::get('/structure', function () {
//    return view('site.pages.structure');
//});
//Route::get('/documentation', function () {
//    return view('site.pages.documentation');
//});
//Route::get('/staff', function () {
//    return view('site.pages.staff');
//});
//
//Route::get('/program', function () {
//    return view('site.pages.program');
//});
//Route::get('/kindergarten', function () {
//    return view('site.pages.kindergarten');
//});
//Route::get('/gallery', function () {
//    return view('site.pages.gallery');
//});
//
//Route::get('/cooperation', function () {
//    return view('site.pages.cooperation');
//});
//Route::get('/press-about-us', function () {
//    return view('site.pages.press-about-us');
//});
//Route::get('/open-day', function () {
//    return view('site.pages.open-day');
//});
//
//Route::get('/progress', function () {
//    return view('site.pages.progress');
//});
//Route::get('/students-graduates', function () {
//    return view('site.pages.students-graduates');
//});
//
//Route::get('/career', function () {
//    return view('site.pages.career');
//});
//Route::get('/trainer-send', function () {
//    return view('site.pages.trainer-send');
//});

//Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/test', 'Site\IndexController@index')->name('hoasdasdme');
