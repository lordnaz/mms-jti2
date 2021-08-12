<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JtiPlan as JtiPlan;
use Session;

class DashboardController extends Controller
{
    //
    public function index(){

        $user_id = auth()->user()->id;
        $task_counter = JtiPlan::where('assign_to', $user_id)
                                ->where('new_flag', true)
                                ->count();

        Session::put('task_counter', $task_counter);

        return view('components.dashboard');
    }
}
