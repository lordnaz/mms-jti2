<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;
use App\Models\JtiPlan as JtiPlan;
use Session;

class MyTaskController extends Controller
{

    public function dashboard_view(){

        $user_id = auth()->user()->id;
        $task_counter = JtiPlan::where('assign_to', $user_id)
                                ->where('new_flag', true)
                                ->count();

        Session::put('task_counter', $task_counter);

        // allow all project user can view task 
        $posts = JtiPlan::orderBy('id', 'desc')
                            ->join('users', 'users.id', '=', 'jti_plans.assign_to')
                            ->select('jti_plans.*', 'users.name', 'users.email')
                            ->get();

        return view('dashboard', compact('posts'));
    }

}
