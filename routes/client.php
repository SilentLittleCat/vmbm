<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
//
Route::get('test', 'TestController@index');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('client.login');
Route::post('login','Auth\LoginController@login');
Route::get('register','Auth\RegisterController@showRegistrationForm');
Route::post('register','Auth\RegisterController@register');
Route::get('logout', 'Auth\LoginController@logout');
//Route::get('noauth', 'Auth\LoginController@noauth');
Route::get('changePassword', 'Auth\ResetPasswordController@showChangeForm')->middleware(['auth.client']);
Route::post('changePassword', 'Auth\ResetPasswordController@changePassword')->middleware(['auth.client']);


Route::group(['middleware' => ['auth.client']], function() {

    $uri =  request()->path();
    $uri = str_replace('client/' ,'', $uri);
    $uri = str_replace('client' ,'', $uri);
    if ($uri == '') {
        Route::any('/', ['as' => 'client',
            'uses' => 'Base\IndexController@index']);
    } else {
        $aUri = $baseUri = explode('/', $uri);
        if (count($aUri) > 1) {
            unset($aUri[count($aUri) - 1]);
            $file = app_path() . '/Http/Controllers/Client/' . implode("/", $aUri) . "Controller.php";
            if (file_exists($file)) {
                $controller = implode("\\", $aUri) . "Controller";
                $action = $controller . "@" . $baseUri[count($aUri)];
                Route::any($uri, ['as' => 'client',
                    'uses' => $action]);
            }
        }

    }

});