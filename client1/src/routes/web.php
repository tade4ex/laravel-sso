<?php

use App\Http\Controllers\OAuth2\OAuth2HandleProviderCallbackController;
use App\Http\Controllers\OAuth2\OAuth2RedirectToProviderController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Route::get('login', function () {
//    return view('welcome');
//});
Route::middleware(['auth', 'auth.oauth2'])->get('test', TestController::class)->name('home');
Route::get('login', OAuth2RedirectToProviderController::class)->name('login');
Route::get('auth/callback', OAuth2HandleProviderCallbackController::class)->name('auth-callback');

//$router->get('login', ['as' => 'login', 'uses' => 'SpotifyAuthController@redirectToProvider']);
//$router->get('login_callback', ['as' => 'login', 'uses' => 'SpotifyAuthController@handleProviderCallback']);
