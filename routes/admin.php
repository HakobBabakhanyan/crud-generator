<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

use Illuminate\Support\Facades\Route;


Route::prefix('admin')->name('admin')->group(function (){



    // Authentication Routes...
    Route::get('login', 'Admin\Auth\LoginController@showAdminLoginForm')->name('.login');
    Route::post('login', 'Admin\Auth\LoginController@login')->name('.login');
    Route::post('logout', 'Auth\LoginController@logout')->name('.logout');

    // Registration Routes...
    Route::get('register', 'Admin\Auth\LoginController@showAdminLoginForm')->name('.register');
    Route::get('register', 'Admin\Auth\RegisterController@showAdminRegistrationForm')->name('.register');
    Route::post('register', 'Admin\Auth\RegisterController@register');

    // Password Reset Routes...
    Route::get('password/reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('.password.request');
    Route::post('password/email', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('.password.email');
    Route::get('password/reset/{token}', 'Admin\Auth\ResetPasswordController@showResetForm')->name('.password.reset');
    Route::post('password/reset', 'Admin\Auth\ResetPasswordController@reset');





    Route::middleware('auth:admin')->group(function (){
        Route::prefix('ck-editor')->group(function (){
//            Route::get('get-token', function(){
//                return response()->json(csrf_token());
//            });
            Route::post('upload-image','CkEDitorController@upload_image');
        });



        Route::get('/index', 'Admin\IndexController@index')->name('.index');
        Route::get('/table', 'Admin\IndexController@table');
        Route::get('/profile', 'Admin\UserController@profile')->name('.profile');
        Route::post('/profile/{admin}', 'Admin\UserController@profile_update')->name('.profile.update');

        Route::prefix('languages')->name('.languages')->group(function (){
            $controller ='Admin\LanguagesController';
            Route::get('list',$controller.'@list');
            Route::get('create',$controller.'@create')->name('.create');
            Route::post('create',$controller.'@store')->name('.create');
            Route::get('/{language}/update',$controller.'@update')->name('.update');
            Route::put('/{language}/update',$controller.'@edit')->name('.update');
            Route::delete('/{language}/delete',$controller.'@delete')->name('.delete');
        });


        Route::name('.')->group(function (){
            foreach (config('custom-config.crud') as $route){
                if(isset($route['images']) && $route['images']){
                    Route::get($route['route'].'/image/{image_id}/destroy',$route['controller'].'@imageDestroy')->name($route['route'].'.image.destroy');
                }
                if(isset($route['files']) && $route['files']){
                    Route::get($route['route'].'/file/{file_id}/destroy',$route['controller'].'@fileDestroy')->name($route['route'].'.file.destroy');
                }
                if(isset($route['sortable']) && $route['sortable']){
                    Route::put($route['route'].'/sortable',$route['controller'].'@sortable')->name($route['route'].'.sortable');
                }
                Route::resource($route['route'],$route['controller']);
            }
        });

        Route::prefix('crud/{name}')->name('.crud')->group(function (){
            Route::get('list','ChameleonController@list')->name('.list');
            Route::get('create','ChameleonController@create')->name('.create');
            Route::post('create','ChameleonController@store')->name('.create');
            Route::get('/{item}/update','ChameleonController@update')->name('.update');
            Route::put('/{item}/update','ChameleonController@edit')->name('.update');
            Route::delete('/{item}/delete','ChameleonController@delete')->name('.delete');

        });

        Route::prefix('images')->name('.image')->group(function (){
            Route::get('{model}/{id}/type/{type}/{multi?}','ChameleonController@imageType')->name('.type');
            Route::get('{model}/{id}/delete','ChameleonController@imageDelete')->name('.delete');
        });

    });

});

