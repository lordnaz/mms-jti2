<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JtiPlan as JtiPlan;
use App\Models\User as User;

use App\Models\Manpower as Manpower;

class OperationController extends Controller
{
    public function show_staff(){

        // $user_id = auth()->user()->id;
        // $task_counter = JtiPlan::where('assign_to', $user_id)
        //                         ->where('new_flag', true)
        //                         ->count();

        // Session::put('task_counter', $task_counter);

        // // allow all project user can view task 
        $posts = Manpower::orderBy('id', 'desc')
                            ->where('is_active', true)
                            ->join('users', 'users.id', '=', 'manpowers.created_by')
                            ->select('manpowers.*', 'users.name')
                            ->get();

        return view('pages.jti.staff', compact('posts'));
        // return view('pages.jti.staff');
    }

    public function addManpower(Request $req){

        $data = $req->input();

        $user_id = auth()->user()->id;

        // check jti if created
        $exists = Manpower::where('staff_name', $req->staff_name)->exists();

        if(!$exists){
            $currentdt = date('d-m-Y H:i:s');

            // update marketing jti db 
            $manpower = new Manpower;

            $manpower->employment_type = $req->employment_type;
            $manpower->staff_id = $req->staff_id;
            $manpower->staff_name = $req->staff_name;
            $manpower->contact = $req->contact;
            $manpower->created_by = $user_id;
            $manpower->is_active = true;
            $manpower->created_at = $currentdt;
            $manpower->updated_at = $currentdt;

            $manpower->save();
        }

        return redirect()->route('manpower');
    }

    public function editManpower($ref_id){

        $data = Manpower::where('id', $ref_id)
                                    ->get()
                                    ->first();

        return view('pages.manpower.manpower-edit', compact('data'));

        // return $ref_id;
        // die();

    }
}
