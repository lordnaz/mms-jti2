<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\JtiController;
use App\Http\Controllers\MyTaskController;
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
    if(auth()->user()){
        return redirect('dashboard');
    }else{
        // return view('auth.login');
        return redirect('login');
    }
});

Route::group([ "middleware" => ['auth:sanctum', 'verified'] ], function() {
    Route::get('/dashboard', [MyTaskController::class, "dashboard_view"])->name('dashboard');
    Route::get('/user', [ UserController::class, "index_view" ])->name('user');
    Route::view('/user/new', "pages.user.user-new")->name('user.new');
    Route::view('/user/edit/{userId}', "pages.user.user-edit")->name('user.edit');
});

Route::get('/jti/{quote_no}', [JtiController::class, 'getAllUser'])->where('quote_no', '.*')->name('jti_form');
Route::post('/submit_jti', [JtiController::class, 'submitForm']);
