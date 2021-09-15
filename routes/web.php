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
    Route::post('/confirm_edit_manpower', [OperationController::class, 'confirm_edit_manpower'])->name('confirm_edit_manpower');
    Route::get('/remove_manpower/{ref_id}', [OperationController::class, 'remove_manpower'])->name('remove_manpower');

    Route::get('/tracker/{jti_no}', [OperationController::class, "tracker"])->name('tracker');

    Route::get('/sub_tracker/{job_id}', [OperationController::class, "sub_tracker"])->name('sub_tracker');
    Route::post('/assign_worker/{job_id}', [OperationController::class, 'assign_worker'])->name('assign_worker');
    Route::get('/remove_worker/{asset_id}/{job_id}/{jti_no}', [OperationController::class, "remove_worker"])->name('remove_worker');

    // later add for transport 
    Route::get('/transport', [OperationController::class, "show_transport"])->name('transport');
    Route::view('/transport/new', "components.transport-new")->name('transport.new');
    Route::post('/add_transport', [OperationController::class, 'add_transport']);
    Route::get('/edit_transport/{ref_id}', [OperationController::class, 'edit_transport'])->name('edit_transport');
    Route::post('/confirm_edit_transport', [OperationController::class, 'confirm_edit_transport'])->name('confirm_edit_transport');
    Route::get('/remove_transport/{ref_id}', [OperationController::class, 'remove_transport'])->name('remove_transport');

    Route::post('/set_job_status/{job_id}', [OperationController::class, "set_job_status"])->name('set_job_status');

    // for audit trails 
    Route::post('/post_message', [ OperationController::class, "post_message" ])->name('post_message');

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

