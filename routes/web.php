<?php

use App\Http\Controllers\OperationController;
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


    Route::get('/manpower', [OperationController::class, "show_staff"])->name('manpower');
    Route::view('/manpower/new', "pages.manpower.manpower-new")->name('manpower.new');
    Route::post('/add_manpower', [OperationController::class, 'addManpower']);
    Route::get('/edit_manpower/{ref_id}', [OperationController::class, 'editManpower'])->name('edit_manpower');


    Route::get('/tracker', [OperationController::class, "tracker"])->name('tracker');

    
    Route::get('/user', [ UserController::class, "index_view" ])->name('user');
    Route::view('/user/new', "pages.user.user-new")->name('user.new');
    Route::view('/user/edit/{userId}', "pages.user.user-edit")->name('user.edit');

    Route::get('/jti_actual/{jti_no}', [JtiController::class, 'goToJtiActual'])->name('jti_actual');

    Route::get('/download_po/{jti_no}/po_doc/{filename}', function ($jti_no, $filename)
    {
        $filepath = '\/'.$jti_no.'\/po_doc/'.$filename;

        $path = public_path('jti_doc' . $filepath);

        if (!File::exists($path)) {
            abort(404);
        }

        $headers = array(
                'Content-Type',
                );

        $response = Response::download($path, $filename, $headers);

        return $response;
    })->name('download_po');

    Route::post('/confirm_jti/{jti_no}', [JtiController::class, 'confirmForm']);

});

Route::get('/jti/{quote_no}', [JtiController::class, 'getAllUser'])->where('quote_no', '.*')->name('jti_form');
Route::post('/submit_jti', [JtiController::class, 'submitForm']);

// url to download impact

