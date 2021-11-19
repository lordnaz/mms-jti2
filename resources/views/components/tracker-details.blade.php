@php
    // dd($data);

    // dd($list_user);
@endphp
<div class="card">
    {{-- <div class="card-header">
      <h4>Tickets {{ $data->running_no }}</h4>
    </div> --}}
    <div class="card-body">

        <div class="hero bg-whitesmoke text-dark border">
            <div class="hero-inner">
                <h2>Hi</h2>
                <p class="lead">Here is your JTI No <span class="badge badge-info">{{$data->running_no}}</span> for your references. Use below panel to update and communicate througout the whole processes.</p>
                <div class="mt-4">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-success btn-lg btn-icon icon-left">
                        <i class="fas fa-plus-circle"></i>Back To Task List
                    </a>
                </div>

                {{-- <div class="form-group">
                    <button type="submit" onclick="window.print()" class="btn btn-success icon-left btn-icon float-right"><i class="fas fa-file"></i> <span>Print</span>
                    </button>
                </div> --}}
            </div>
        </div>
        <br><br>

      <div class="tickets">
          
        <div class="ticket-items" id="ticket-items">
            <div class="bg-none" style="padding-bottom: 25px;">
                <div class="ticket-title">
                  <h4 class="section-title">Jump To</h4>
                </div>
            </div>

            @foreach ($job as $item)
                <div class="ticket-item border bg-whitesmoke" style="border-radius: 10px; margin-bottom: 15px;">
                    <div class="ticket-title">
                        {{-- <h4>{{ $item->job_type === "hello" ? "Hi" : "Goodbye" }}</h4> --}}
                        <a href="{{route('sub_tracker', $item->job_id)}}">
                            @if ($item->job_type === "packing_job")
                                <h4>PACKING</h4>
                            @elseif($item->job_type === "trucking_job")
                                <h4>TRUCKING</h4>
                            @elseif($item->job_type === "shipment_job")
                                <h4>SHIPMENT</h4>
                            @else
                                <h4>DESTINATION</h4>
                            @endif
                        </a>
                    </div>
                    <div class="ticket-desc">
                        <div><small>Job ID</small></div>
                        <div class="bullet"></div>
                        <div><small>{{ $item->job_id }}</small></div>
                    </div>
                    <br>
                    <div><small>STATUS: {{ $item->job_status }}</small></div>
                    @if ($item->job_status == "CREATED")
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-danger" role="progressbar" data-width="20%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                                <small>20%</small> 
                            </div>
                        </div>
                    @elseif($item->job_status == "ONGOING")
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-warning" role="progressbar" data-width="65%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                                <small>65%</small> 
                            </div>
                        </div>
                    @else
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" role="progressbar" data-width="100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
                                <small>100%</small> 
                            </div>
                        </div>
                    @endif
                    
                </div>
            @endforeach

        </div>

        <div class="ticket-content">
          <div class="ticket-header">
            <div class="ticket-sender-picture img-shadow">
              <img src="../assets/img/products/product-4-50.png" alt="image">
            </div>
            <div class="ticket-detail">
              <div class="ticket-title">
                <h4>JOB TICKET</h4>
              </div>
              <div class="ticket-info">
                <i>issued by &nbsp;</i><div class="font-weight-600">{{ $data->issued_by }}</div>
                <div class="bullet"></div>
                <i>assignee &nbsp;</i><div class="font-weight-600">{{ auth()->user()->find( $data->assign_to )->name }}</div>
                <div class="bullet"></div>
                <div class="text-primary font-weight-600">{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</div>
              </div>
            </div>
          </div>
          
          <div class="ticket-description">
            <div class="ticket-divider"></div>

            <div class="form-group">
                <label class="mt-2">
                    <input type="checkbox" id="assigneeSwitch" name="assigneeSwitch" class="custom-switch-input">
                    <span class="custom-switch-indicator"></span>
                    <span class="custom-switch-description"> Assign to new PIC?</span>
                </label>
            </div>

            <div id="assignee_panel">
                <form method="POST" action="{{ route('change_assignee', $data->running_no) }}">
                    @csrf

                    <div class="form-group col-md-6">
                        <label for="assignto" class="block text-sm font-medium text-gray-700">Assign new Assignee</label>

                        <select id="new_assignee" name="new_assignee" class="form-control selectric">
                            <option value="" selected="true" disabled="">Assign To</option>
                            @foreach($list as $user)

                                <option value="{{ $user->id }}">{{ $user->name }} @if($user->id == auth()->user()->id) <span style="color:red;"> (Yourself) </span> @endif</option>
    
                            @endforeach
                        </select>
                        <input type="text" class="form-control" name="assign_jti_no" value="{{ $data->running_no }}" hidden>

                        <div class="text-right" style="margin-top: 15px;">
                            <button type="submit" class="btn btn-warning text-dark">
                                Assign
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <h1 class="section-title">Master Completion Status</h1>
            

                <div class="row mt-4">
                    <div class="col-12 col-lg-12">
                        <div class="wizard-steps">

                            @foreach ($job as $item)
                                @if ($item->job_status == "CREATED")
                                    <div class="wizard-step wizard-step-danger">
                                        <div class="wizard-step-icon">
                                            <div class="wizard-step-label">
                                                <i class="far fa-clock"></i>
                                            </div>
                                            {{-- <i class="fas fa-check"></i> --}}
                                        </div>
                                        <div class="wizard-step-label">
                                            @if ($item->job_type === "packing_job")
                                                PACKING
                                            @elseif($item->job_type === "trucking_job")
                                                TRUCKING
                                            @elseif($item->job_type === "shipment_job")
                                                SHIPMENT
                                            @else
                                                DESTINATION
                                            @endif
                                        </div>
                                    </div>
                                @elseif($item->job_status == "ONGOING")
                                    <div class="wizard-step wizard-step-warning">
                                        <div class="wizard-step-icon">
                                            <div class="wizard-step-label">
                                                <i class="fas fa-shipping-fast"></i>
                                            </div>
                                            {{-- <i class="fas fa-check"></i> --}}
                                        </div>
                                        <div class="wizard-step-label">
                                            @if ($item->job_type === "packing_job")
                                                PACKING
                                            @elseif($item->job_type === "trucking_job")
                                                TRUCKING
                                            @elseif($item->job_type === "shipment_job")
                                                SHIPMENT
                                            @else
                                                DESTINATION
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="wizard-step wizard-step-success">
                                        <div class="wizard-step-icon">
                                            <div class="wizard-step-label">
                                                <i class="fas fa-check"></i>
                                            </div>
                                            {{-- <i class="fas fa-check"></i> --}}
                                        </div>
                                        <div class="wizard-step-label">
                                            @if ($item->job_type === "packing_job")
                                                PACKING
                                            @elseif($item->job_type === "trucking_job")
                                                TRUCKING
                                            @elseif($item->job_type === "shipment_job")
                                                SHIPMENT
                                            @else
                                                DESTINATION
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                
                            @endforeach
                            
                            {{-- <div class="wizard-step wizard-step-success">
                                <div class="wizard-step-icon">
                                    <i class="fas fa-shipping-fast"></i>
                                </div>
                                <div class="wizard-step-label">
                                    On-Going
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
                            </div> --}}
                        </div>
                    </div>
                </div>

            <div class="ticket-divider"></div>
                
            <h1 class="section-title">Material List</h1>

            <ul>
                @if ($data->material_list != "")
                    @foreach(explode(',', $data->material_list) as $lists) 
                        <li>{{$lists}}</li>
                    @endforeach
                @endif
            </ul>

            <div class="ticket-divider"></div>

            <h1 class="section-title">Equipment List</h1>

            <ol style="list-style-type: decimal;
            list-style-position: inside;
            -webkit-margin-before: 1em;
            -webkit-margin-after: 1em;
            -webkit-margin-start: 0px;
            -webkit-margin-end: 0px;
            -webkit-padding-start: 0px;">
                @if ($data->equipment_list != "")
                    @foreach(explode(',', $data->equipment_list) as $lists) 
                        <li>{{$lists}}</li>
                    @endforeach
                @endif
            </ol>
            
            <div class="ticket-divider"></div>

            <h1 class="section-title">JTI Details</h1>
            <br>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4" class="text-primary">Quotation No</label>
                    <input type="text" readonly class="form-control-plaintext" id="inputEmail4" value="{{ $data->quotation_no }}" placeholder="Email">
                    {{-- <small class="text-muted">You can cancel job with CREATED ticket status</small> --}}
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4" class="text-primary">JTI No</label>
                    <input type="text" readonly class="form-control-plaintext" id="inputPassword4" value="{{ $data->running_no }}" placeholder="Password">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4" class="text-primary">PO No</label>
                    <input type="text" readonly class="form-control-plaintext" id="inputEmail4" value="{{ $data->po_no }}" placeholder="Email">
                    <small class="text-muted">
                        <a href="/download_po/{{$data->po_path}}" class="text-danger icon-left">
                        <i class="fas fa-external-link-alt"></i> &nbsp;Download</a>
                    </small>
                    
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4" class="text-primary">PIC Name</label>
                    <input type="text" readonly class="form-control-plaintext" id="inputPassword4" value="{{ $data->pic_name }}" placeholder="Password">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4" class="text-primary">Company Name</label>
                    <input type="text" readonly class="form-control-plaintext" id="inputEmail4" value="{{ $data->company_name }}" placeholder="Email">
                    {{-- <small class="text-muted">You can cancel job with CREATED ticket status</small> --}}
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4" class="text-primary">Company Address</label>
                    <textarea id="description" name="description" rows="3" class="form-control-plaintext" readonly placeholder="Description">{{ $data->company_address }}</textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4" class="text-primary">Contact</label>
                    <input type="text" readonly class="form-control-plaintext" id="inputEmail4" value="{{ $data->contact }}" placeholder="Email">
                    {{-- <small class="text-muted">You can cancel job with CREATED ticket status</small> --}}
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4" class="text-primary">Volume</label>
                    <input type="text" readonly class="form-control-plaintext" id="inputPassword4" value="{{ $data->volume }}" placeholder="Password">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4" class="text-primary">Mode</label>
                    <input type="text" readonly class="form-control-plaintext" id="inputEmail4" value="{{ $data->mode }}" placeholder="Email">
                    {{-- <small class="text-muted">You can cancel job with CREATED ticket status</small> --}}
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4" class="text-primary">Special Instruction</label>
                    <textarea id="description" name="description" rows="3" class="form-control-plaintext" readonly placeholder="Description">{{ $data->special_instruction }}</textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4" class="text-primary">Period</label>
                    <input type="text" readonly class="form-control-plaintext" id="inputEmail4" value="{{ $data->period }}" placeholder="Email">
                    {{-- <small class="text-muted">You can cancel job with CREATED ticket status</small> --}}
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4" class="text-primary">Job Details</label>
                    <input type="text" readonly class="form-control-plaintext" id="inputPassword4" value="{{ $data->job_details }}" placeholder="Password">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4" class="text-primary">Destination (From)</label>
                    <input type="text" readonly class="form-control-plaintext" id="inputEmail4" value="{{ $data->from_destination }}" placeholder="Email">
                    {{-- <small class="text-muted">You can cancel job with CREATED ticket status</small> --}}
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4" class="text-primary">Destination (To)</label>
                    <input type="text" readonly class="form-control-plaintext" id="inputPassword4" value="{{ $data->to_destination }}" placeholder="Password">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4" class="text-primary">Manpower</label>
                    <input type="text" readonly class="form-control-plaintext" id="inputEmail4" value="{{ $data->manpower }}" placeholder="Email">
                    {{-- <small class="text-muted">You can cancel job with CREATED ticket status</small> --}}
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4" class="text-primary">Truck</label>
                    <input type="text" readonly class="form-control-plaintext" id="inputPassword4" value="{{ $data->trucks }}" placeholder="Password">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4" class="text-primary">Start Date</label>
                    <input type="text" readonly class="form-control-plaintext" id="inputEmail4" value="{{ \Carbon\Carbon::parse($data->start_date)->format('d/m/Y')}}" placeholder="Email">
                    {{-- <small class="text-muted">You can cancel job with CREATED ticket status</small> --}}
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4" class="text-primary">End Date</label>
                    <input type="text" readonly class="form-control-plaintext" id="inputPassword4" value="{{ \Carbon\Carbon::parse($data->end_date)->format('d/m/Y')}}" placeholder="Password">
                </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>