<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JtiPlan as JtiPlan;
use App\Models\User as User;
use App\Models\JobDetails;
use App\Models\JtiWorker;
use App\Models\Manpower as Manpower;
use App\Models\Transport;

use App\Models\TrixAttachment;
use App\Models\TrixRichText;
use App\Models\Post;

class OperationController extends Controller
{
    public function show_staff(){

        $posts = Manpower::orderBy('id', 'desc')
                            ->where('is_active', true)
                            // ->join('users', 'users.id', '=', 'manpowers.created_by')
                            // ->select('manpowers.*', 'users.name')
                            ->get();

        return view('pages.jti.staff', compact('posts'));
        // return view('pages.jti.staff');
    }

    public function show_transport(){

        // // allow all project user can view task 
        $datas = Transport::orderBy('id', 'desc')
                            ->where('is_active', true)
                            // ->join('users', 'users.id', '=', 'manpowers.created_by')
                            // ->select('manpowers.*', 'users.name')
                            ->get();

        // return $posts;
        // die();

        return view('components.transport_main', compact('datas'));

    }

    public function addManpower(Request $req){

        $data = $req->input();

        $user_id = auth()->user()->id;

        // check jti if created
        $exists = Manpower::where('staff_name', $req->staff_name)->exists();

        if(!$exists){
            $currentdt = date('Y-m-d H:i:s');

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


    public function add_transport(Request $req){

        $data = $req->input();

        $user_id = auth()->user()->id;

        // check jti if created
        $exists = Transport::where('plate_no', $req->plate_no)->exists();

        if(!$exists){
            $currentdt = date('Y-m-d H:i:s');

            // update marketing jti db 
            $transport = new Transport;

            $transport->plate_no = $req->plate_no;
            $transport->description = $req->description;
            $transport->created_by = $user_id;
            $transport->is_active = true;
            $transport->created_at = $currentdt;
            $transport->updated_at = $currentdt;

            $transport->save();
        }

        return redirect()->route('transport');
    }

    public function editManpower($ref_id){

        $data = Manpower::where('id', $ref_id)
                                    ->get()
                                    ->first();

        return view('pages.manpower.manpower-edit', compact('data'));

        // return $ref_id;
        // die();

    }

    public function confirm_edit_manpower(Request $req){

        $data = $req->input();

        $currentdt = date('Y-m-d H:i:s');

        Manpower::where('id', $req->id)
                ->update([
                    'employment_type' => $req->employment_type,
                    'staff_id' => $req->staff_id,
                    'staff_name' => $req->staff_name,
                    'contact' => $req->contact,
                    'updated_at' => $currentdt
                ]);

        return redirect()->route('manpower');

    }

    public function remove_manpower($ref_id){

        $currentdt = date('Y-m-d H:i:s');

        Manpower::where('id', $ref_id)
                ->update([
                    'is_active' => false,
                    'updated_at' => $currentdt
                ]);

        return redirect()->route('manpower');
    }

    public function edit_transport($ref_id){

        $data = Transport::where('id', $ref_id)
                                    ->get()
                                    ->first();

        return view('components.transport-edit-main', compact('data'));

    }

    public function confirm_edit_transport(Request $req){

        $data = $req->input();

        $currentdt = date('Y-m-d H:i:s');

        Transport::where('id', $req->id)
                ->update([
                    'plate_no' => $req->plate_no,
                    'description' => $req->description,
                    'updated_at' => $currentdt
                ]);

        return redirect()->route('transport');
    }

    public function remove_transport($ref_id){

        $currentdt = date('Y-m-d H:i:s');

        Transport::where('id', $ref_id)
                ->update([
                    'is_active' => false,
                    'updated_at' => $currentdt
                ]);

        return redirect()->route('transport');
    }

    public function tracker($jti_no){

        // return $jti_no;
        // die();
        $data = JtiPlan::where('running_no', $jti_no)
                                    ->first();

        $job = JobDetails::where('running_no', $jti_no)
                            ->get();

        return view('pages.tracker.tracker', compact('data', 'job'));
        // return view('components.job_tracker_main', compact('post_data', 'ticket_collection', 'ticket_id', 'printers'));
    }

    public function set_job_status(Request $req, $job_id){

        $currentdt = date('Y-m-d H:i:s');

        JobDetails::where('job_id', $job_id)
                    ->update([
                        'job_status' => $req->set_job,
                        'updated_at' => $currentdt
                    ]);

        $posts = Post::create([
            'job_id' => $job_id,
            'running_no' => $req->assign_jti_no,
            'poster_name' => auth()->user()->name,
            'created_by' => auth()->user()->id
        ]);

        $postsId = $posts->id;

        TrixRichText::create([
            'field' => 'system',
            'model_type' => 'system',
            'model_id' => $postsId,
            'content' => '<div><i>[System Alert]&nbsp;</i><b>'.auth()->user()->name.'</b> has set job status (<span class="text-dark font-weight-bold">'.$job_id.'</span>) to <b class="text-primary">'.$req->set_job.'</b></div>'
        ]);

        return redirect()->route('sub_tracker', ['job_id' => $job_id]);
    }

    public function sub_tracker($job_id){

        $job = JobDetails::where('job_id', $job_id)
                            ->first();

        $data = JtiPlan::where('running_no', $job->running_no)
                            ->first();

        $manpower = Manpower::where('is_active', true)
                            ->get();

        $jtiworkers = JtiWorker::where('job_id', $job_id)
                            ->where('active', true)
                            ->get();

        // message 
        $post_data = TrixRichText::orderBy('id', 'desc')
                                    ->join('posts', 'posts.id', '=', 'trix_rich_texts.model_id')
                                    ->where('posts.job_id', $job_id)
                                    ->where('posts.running_no', $job->running_no)
                                    ->select('posts.poster_name', 'trix_rich_texts.*')
                                    ->get();

        // $jtiworkers = $jtiworkers->toArray();

        return view('pages.tracker.sub_tracker', compact('job', 'data', 'manpower', 'jtiworkers', 'post_data'));

    }

    public function assign_worker($job_id, Request $req){

        $data = $req->input();

        // return $data;

        // die();

        $currentdt = date('Y-m-d H:i:s');

        $manpower = Manpower::where('id', $req->worker_assign)
                            ->first();

        $check = JtiWorker::where('asset_id', $req->worker_assign)
                            ->where('job_id', $job_id)
                            ->exists();

        if($check){

            JtiWorker::where('asset_id', $req->worker_assign)
                ->where('job_id', $job_id)
                ->update(['active' => true]);

        }else{
            $assign = JtiWorker::create([
                'job_id' => $job_id,
                'asset_id' => $req->worker_assign,
                'asset_name' => $manpower->staff_name,
                'asset_type' => 'worker',
                'active' => true,
                'created_at' => $currentdt,
                'updated_at' => $currentdt
            ]);
        }


        $posts = Post::create([
            'job_id' => $job_id,
            'running_no' => $req->assign_jti_no,
            'poster_name' => auth()->user()->name,
            'created_by' => auth()->user()->id
        ]);

        $postsId = $posts->id;

        $staff = JtiWorker::where('asset_id', $req->worker_assign)
                            ->where('job_id', $job_id)
                            ->first();

        TrixRichText::create([
            'field' => 'system',
            'model_type' => 'system',
            'model_id' => $postsId,
            'content' => '<div><i>[System Alert]&nbsp;</i><b>'.$staff->asset_name.'</b> has been <span class="text-success font-weight-bold">Added</span> to the task by <b>'.auth()->user()->name.'</b></div>'
        ]);

        return redirect()->route('sub_tracker', ['job_id' => $job_id]);
    }

    public function remove_worker($asset_id, $job_id, $jti_no){

        JtiWorker::where('asset_id', $asset_id)
            ->where('job_id', $job_id)
            ->update(['active' => false]);

        $posts = Post::create([
            'job_id' => $job_id,
            'running_no' => $jti_no,
            'poster_name' => auth()->user()->name,
            'created_by' => auth()->user()->id
        ]);

        $postsId = $posts->id;

        $staff = JtiWorker::where('asset_id', $asset_id)
                            ->where('job_id', $job_id)
                            ->first();

        TrixRichText::create([
            'field' => 'system',
            'model_type' => 'system',
            'model_id' => $postsId,
            'content' => '<div><i>[System Alert]&nbsp;</i><b>'.$staff->asset_name.'</b> has been <span class="text-danger font-weight-bold">Removed</span> from the task by <b>'.auth()->user()->name.'</b></div>'
        ]);

        return redirect()->route('sub_tracker', ['job_id' => $job_id]);
    }

    public function post_message(Request $req){

        Post::create([
            'job_id' => $req->post_job_id,
            'running_no' => $req->post_jti_no,
            'poster_name' => auth()->user()->name,
            'created_by' => auth()->user()->id,
            'post-trixFields' => request('post-trixFields'),
            'attachment-post-trixFields' => request('attachment-post-trixFields')
        ]);

        return redirect()->route('sub_tracker', ['job_id' => $req->post_job_id]);

    }
}
