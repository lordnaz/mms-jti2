<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JtiPlan as JtiPlan;
use Session;

class MyTaskController extends Controller
{

    public function index(){

        $user_id = auth()->user()->id;
        $task_counter = JtiPlan::where('assign_to', $user_id)
                                ->where('new_flag', true)
                                ->count();

        Session::put('task_counter', $task_counter);

        $jti_list = JtiPlan::orderBy('id', 'desc')
                            ->get();

        return view('components.my-task', compact('jti_list'));
    }
}
