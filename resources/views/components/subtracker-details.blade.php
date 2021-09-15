@php
    // dd($data);
@endphp
<div class="card">
    {{-- <div class="card-header">
      <h4>Tickets {{ $data->running_no }}</h4>
    </div> --}}
    <div class="card-body">

        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="mt-4">
                        <a href="{{route('tracker', $job->running_no)}}" class="btn btn-outline-danger btn-lg btn-icon icon-left">
                            <i class="fas fa-arrow-circle-left"></i>Back To Master Job Panel
                        </a>
                    </div>
                    <br><br>
            
                    <div class="tickets">

                    <div class="ticket-content">
                        <div class="ticket-header">
                            <div class="ticket-sender-picture img-shadow">
                            <img src="../assets/img/products/product-4-50.png" alt="image">
                            </div>
                            <div class="ticket-detail">
                                <div class="ticket-title">
                                    @if ($job->job_type === "packing_job")
                                        <h4>PACKING</h4>
                                    @elseif($job->job_type === "trucking_job")
                                        <h4>TRUCKING</h4>
                                    @elseif($job->job_type === "shipment_job")
                                        <h4>SHIPMENT</h4>
                                    @else
                                        <h4>DESTINATION</h4>
                                    @endif
                                </div>
                            <div class="ticket-info">
                                <i>Job ID &nbsp;</i><div class="font-weight-600">{{ $job->job_id }}</div>
                                {{-- <div class="bullet"></div> --}}
                                {{-- <i>JTI No &nbsp;</i><div class="font-weight-600">{{ $job->running_no }}</div> --}}
                                {{-- <div class="bullet"></div> --}}
                                {{-- <div class="text-primary font-weight-600">{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</div> --}}
                            </div>
                            </div>
                        </div>
                        
                        <div class="ticket-description">
                            {{-- <div class="ticket-divider"></div> --}}
                
                            <h1 class="section-title">Job Description & Details</h1>

                            @if ($job->job_type === "packing_job")
                                <ol style="list-style-type: decimal;
                                list-style-position: inside;
                                -webkit-margin-before: 1em;
                                -webkit-margin-after: 1em;
                                -webkit-margin-start: 0px;
                                -webkit-margin-end: 0px;
                                -webkit-padding-start: 0px;">

                                    @if ($data->pack_inter !== "")
                                        <li>
                                            <strong>International</strong>

                                            <ul>
                                                @foreach(explode(',', $data->pack_inter) as $lists) 
                                                    <li>&emsp;&emsp;{{$lists}}</li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <br>
                                    @endif

                                    @if($data->pack_domw !== "")
                                        <li>
                                            <strong>Domestic (Peninsular)</strong>

                                            <ul>
                                                @foreach(explode(',', $data->pack_dome) as $lists) 
                                                    <li>&emsp;&emsp;{{$lists}}</li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <br>
                                    @endif

                                    @if($data->pack_dome !== "")
                                        <li>
                                            <strong>Domestic (Sabah & Sarawak)</strong>

                                            <ul>
                                                @foreach(explode(',', $data->pack_domw) as $lists) 
                                                    <li>&emsp;&emsp;{{$lists}}</li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <br>
                                    @endif

                                    @if($data->pack_storage !== "")
                                        <li>
                                            <strong>Storage</strong>

                                            <ul>
                                                @foreach(explode(',', $data->pack_storage) as $lists) 
                                                    <li>&emsp;&emsp;{{$lists}}</li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <br>
                                    @endif

                                    @if($data->pack_other !== "")

                                        <li>
                                            <strong>Others</strong>

                                            <ul>
                                                @foreach(explode(',', $data->pack_other) as $lists) 
                                                    <li>&emsp;&emsp;{{$lists}}</li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endif
                                </ol>


                            @elseif($job->job_type === "trucking_job")

                                <ol style="list-style-type: decimal;
                                    list-style-position: inside;
                                    -webkit-margin-before: 1em;
                                    -webkit-margin-after: 1em;
                                    -webkit-margin-start: 0px;
                                    -webkit-margin-end: 0px;
                                    -webkit-padding-start: 0px;">
                                    <li>
                                        <strong>Trucking Tasks</strong>
                                    </li>

                                </ol>
                                


                            @elseif($job->job_type === "shipment_job")
                                <ol style="list-style-type: decimal;
                                list-style-position: inside;
                                -webkit-margin-before: 1em;
                                -webkit-margin-after: 1em;
                                -webkit-margin-start: 0px;
                                -webkit-margin-end: 0px;
                                -webkit-padding-start: 0px;">

                                    @if ($data->ship_import !== "")
                                        <li>
                                            <strong>Import</strong>

                                            <ul>
                                                @foreach(explode(',', $data->ship_import) as $lists) 
                                                    <li>&emsp;&emsp;{{$lists}}</li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <br>
                                    @endif

                                    @if($data->ship_export !== "")
                                        <li>
                                            <strong>Export</strong>

                                            <ul>
                                                @foreach(explode(',', $data->ship_export) as $lists) 
                                                    <li>&emsp;&emsp;{{$lists}}</li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <br>
                                    @endif

                                </ol>


                            @else
                                <ol style="list-style-type: decimal;
                                list-style-position: inside;
                                -webkit-margin-before: 1em;
                                -webkit-margin-after: 1em;
                                -webkit-margin-start: 0px;
                                -webkit-margin-end: 0px;
                                -webkit-padding-start: 0px;">

                                    @if ($data->destination !== "")
                                        <li>
                                            <strong>Destination</strong>

                                            <ul>
                                                @foreach(explode(',', $data->destination) as $lists) 
                                                    <li>&emsp;&emsp;{{$lists}}</li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <br>
                                    @endif

                                </ol>
                                
                            @endif

                            @if ($job->job_type === "packing_job" || $job->job_type === "shipment_job" || $job->job_type === "destination_job")

                                <div class="ticket-divider"></div>
                
                                <h1 class="section-title">Assigned Manpower</h1>
                                {{-- <form method="POST" action="{{ route('assign_printer', $data->ticket_id) }}"> --}}
                                @foreach ($workers as $worker)
                                    <figure class="avatar mr-2" style="margin-bottom: 15px; margin-top: 15px;">
                                        <img src="../assets/img/avatar/avatar-{{rand(1,5)}}.png" alt="..." title="{{$worker->asset_name}}">
                                        <a href="{{ route('remove_worker', ['asset_id' => $worker->asset_id, 'job_id' => $worker->job_id, 'jti_no' =>$job->running_no]) }}">
                                            <img src="../img/remove.png" class="avatar-icon" alt="..." title="Remove">
                                        </a>
                                    </figure>
                                @endforeach

                                <form method="POST" action="{{ route('assign_worker', $job->job_id) }}">
                                    @csrf
            
                                    <div class="form-group col-md-6">
                                        <label for="assignto" class="block text-sm font-medium text-gray-700">Assign staff to Job</label>
            
                                        @php
                                            $assignedWorkers = count($workers);
                                            $worker_arr = array();

                                            foreach ($workers as $val) {
                                                array_push($worker_arr, $val->asset_name);
                                            }

                                        @endphp
                                        <select id="worker_assign" name="worker_assign" class="form-control selectric">
                                            <option value="" selected="true" disabled="">Add Manpower</option>
                                            @foreach($manpower as $manpower)

                                                @if (in_array($manpower->staff_name, $worker_arr))
                                                    {{-- <option value="">{{ $manpower->staff_name }} Found!</option> --}}
                                                @else
                                                    <option value="{{ $manpower->id }}">{{ $manpower->staff_name }} ({{$manpower->employment_type}})</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <input type="text" class="form-control" name="assign_jti_no" value="{{ $job->running_no }}" hidden>
            
                                        <div class="text-right" style="margin-top: 15px;">
                                            <button type="submit" class="btn btn-warning text-dark">
                                                Assign
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @endif

                            @if ($job->job_type === "trucking_job")

                                <div class="ticket-divider"></div>
                    
                                <h1 class="section-title">Assigned Driver</h1>
                                {{-- <form method="POST" action="{{ route('assign_printer', $data->ticket_id) }}"> --}}
                                @foreach ($workers as $worker)
                                    <figure class="avatar mr-2" style="margin-bottom: 15px; margin-top: 15px;">
                                        <img src="../assets/img/avatar/avatar-{{rand(1,5)}}.png" alt="..." title="{{$worker->asset_name}}">
                                        <a href="{{ route('remove_worker', ['asset_id' => $worker->asset_id, 'job_id' => $worker->job_id, 'jti_no' =>$job->running_no]) }}">
                                            <img src="../img/remove.png" class="avatar-icon" alt="..." title="Remove">
                                        </a>
                                    </figure>
                                @endforeach

                                <form method="POST" action="{{ route('assign_worker', $job->job_id) }}">
                                    @csrf
            
                                    <div class="form-group col-md-6">
                                        <label for="assignto" class="block text-sm font-medium text-gray-700">Assign staff to Job</label>
            
                                        @php
                                            $assignedWorkers = count($workers);
                                            $worker_arr = array();

                                            foreach ($workers as $val) {
                                                array_push($worker_arr, $val->asset_name);
                                            }

                                        @endphp
                                        <select id="worker_assign" name="worker_assign" class="form-control selectric">
                                            <option value="" selected="true" disabled="">Add Driver</option>
                                            @foreach($manpower as $manpower)

                                                @if (in_array($manpower->staff_name, $worker_arr))
                                                    {{-- <option value="">{{ $manpower->staff_name }} Found!</option> --}}
                                                @else
                                                    <option value="{{ $manpower->id }}">{{ $manpower->staff_name }} ({{$manpower->employment_type}})</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <input type="text" class="form-control" name="assign_jti_no" value="{{ $job->running_no }}" hidden>
            
                                        <div class="text-right" style="margin-top: 15px;">
                                            <button type="submit" class="btn btn-warning text-dark">
                                                Assign
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <div class="ticket-divider"></div>
                
                                <h1 class="section-title">Assigned Transportation</h1>
                                
                            @endif
                            
                
                            <div class="ticket-divider"></div>
                
                            <h1 class="section-title">Job Status</h1>
                            
                            @if ($job->job_status == 'CREATED')
                                <div class="row mt-4">
                                    <div class="col-12 col-lg-12">
                                        <div class="wizard-steps">
                                            <div class="wizard-step wizard-step-success">
                                                <div class="wizard-step-icon">
                                                    <i class="fas fa-folder-plus"></i>
                                                </div>
                                                <div class="wizard-step-label">
                                                    Job Created
                                                </div>
                                            </div>
                                            <div class="wizard-step wizard-step-danger">
                                                <div class="wizard-step-icon">
                                                    <i class="fas fa-shipping-fast"></i>
                                                </div>
                                                <div class="wizard-step-label">
                                                    On-Going
                                                </div>
                                            </div>
                                            <div class="wizard-step wizard-step-danger">
                                                <div class="wizard-step-icon">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                                <div class="wizard-step-label">
                                                    Job Completed
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @elseif($job->job_status == 'ONGOING')
                                <div class="row mt-4">
                                    <div class="col-12 col-lg-12">
                                        <div class="wizard-steps">
                                            <div class="wizard-step wizard-step-success">
                                                <div class="wizard-step-icon">
                                                    <i class="fas fa-folder-plus"></i>
                                                </div>
                                                <div class="wizard-step-label">
                                                    Job Created
                                                </div>
                                            </div>
                                            <div class="wizard-step wizard-step-success">
                                                <div class="wizard-step-icon">
                                                    <i class="fas fa-shipping-fast"></i>
                                                </div>
                                                <div class="wizard-step-label">
                                                    On-Going
                                                </div>
                                            </div>
                                            <div class="wizard-step wizard-step-danger">
                                                <div class="wizard-step-icon">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                                <div class="wizard-step-label">
                                                    Job Completed
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="row mt-4">
                                    <div class="col-12 col-lg-12">
                                        <div class="wizard-steps">
                                            <div class="wizard-step wizard-step-success">
                                                <div class="wizard-step-icon">
                                                    <i class="fas fa-folder-plus"></i>
                                                </div>
                                                <div class="wizard-step-label">
                                                    Job Created
                                                </div>
                                            </div>
                                            <div class="wizard-step wizard-step-success">
                                                <div class="wizard-step-icon">
                                                    <i class="fas fa-shipping-fast"></i>
                                                </div>
                                                <div class="wizard-step-label">
                                                    On-Going
                                                </div>
                                            </div>
                                            <div class="wizard-step wizard-step-success">
                                                <div class="wizard-step-icon">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                                <div class="wizard-step-label">
                                                    Job Completed
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="form-group col-md-6">
                                <label for="assignto" class="block text-sm font-medium text-gray-700">Set Job Status</label>
                                <form method="POST" action="{{ route('set_job_status', $job->job_id) }}">
                                    @csrf

                                    <select id="set_job" name="set_job" class="form-control selectric">
                                        <option value="" selected="true" disabled="">Set Status</option>
                                        <option value="CREATED" @if($job->job_status == "CREATED") selected @endif>CREATED</option>
                                        <option value="ONGOING" @if($job->job_status == "ONGOING") selected @endif>ON-GOING</option>
                                        <option value="COMPLETED" @if($job->job_status == "COMPLETED") selected @endif>COMPLETED</option>
                                    </select>

                                    <input type="text" class="form-control" name="assign_jti_no" value="{{ $job->running_no }}" hidden>
        
                                    <div class="form-group text-right" style="margin-top: 15px;">
                                        <button type="submit" class="btn btn-primary">
                                            Update
                                        </button>
                                    </div>
                                </form>
                            </div>
                            

                            <div class="ticket-divider"></div>
                
                            <h1 class="section-title">Log & Trails</h1>

                            <form method="POST" action="{{ route('post_message') }}">
                                @csrf
                                <input type="text" class="form-control" name="post_job_id" value="{{ $job->job_id }}" hidden>
                                <input type="text" class="form-control" name="post_jti_no" value="{{ $job->running_no }}" hidden>
    
                                @trix(\App\Post::class, 'content', [ 'hideTools' => ['block-tools'] ])
    
                                <div class="form-group text-right" style="margin-top: 15px;">
                                    <button type="submit" class="btn btn-primary">
                                        Reply
                                    </button>
                                </div>
                            </form>

                            <div class="ticket-divider"></div>

                            <ul class="list-unstyled list-unstyled-border" style="margin-top: 15px;">

                                @foreach ($messages as $message)

                                    <li class="media">
                                        {{-- @if ($message->role == 'user')
                                            <img class="mr-3 rounded-circle" width="30" src="../assets/img/avatar/avatar-1.png" alt="avatar">
                                        @elseif($message->role == 'printer')
                                            <img class="mr-3 rounded-circle" width="30" src="../assets/img/avatar/avatar-4.png" alt="avatar">
                                        @else
                                            <img class="mr-3 rounded-circle" width="30" src="../assets/img/avatar/avatar-2.png" alt="avatar">
                                        @endif --}}
                                        <img class="mr-3 rounded-circle" width="30" src="../assets/img/avatar/avatar-2.png" alt="avatar">
                                        <div class="media-body">
                                            <div class="float-right text-primary"><i class="text-small text-muted">{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans()}}</i></div>
                                            <div class="media-title">{{ $message->poster_name }}</div>
                                            <span class="text-small text-muted">
                                                {!! $message->content !!}
                                            </span>
                                        </div>
                                    </li>
                                    
                                @endforeach
                            </ul>
                            
                
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

        
        

        
        </div>
    </div>
</div>