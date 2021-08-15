<div class="card">
    <div class="card-header">
        <h4>JTI No :</h4> <span class="badge badge-pill badge-primary"><b>{{$jti->running_no}}</b></span>
        {{-- <div class="alert alert-info">
            <b>JTI No: </b> {{$jti->running_no}}
        </div> --}}
    </div>
    <div class="card-body">
        <form action="/confirm_jti/{{$jti->running_no}}" method="post" enctype="multipart/form-data" accept-charset='UTF-8'>
            {{@csrf_field()}}
            <div class="form-group">
                <label>PO No</label>
                <input readonly type="text" value="{{$jti->po_no}}" class="form-control" name="po_no">
            </div>

            <div class="form-group">
                <label>PO Attachment</label>
                <br>
                <a href="/download_po/{{$jti->po_path}}" class="btn btn-outline-danger btn-lg btn-icon icon-left">
                    <i class="fas fa-external-link-alt"></i> &nbsp;Download</a>
            </div>

            <div class="form-group">
                <label>Quotation No.</label>
                <input readonly value="{{$jti->quotation_no}}" type="text" name="quote_no" id="quote_no" class="form-control">
            </div>

            <div class="form-group">
                <label>Company Name</label>
                <input readonly value="{{$jti->company_name}}" type="text" name="company_name" id="company_name" class="form-control">
            </div>

            <div class="form-group">
                <label>PIC Name</label>
                <input readonly value="{{$jti->pic_name}}" type="text" name="pic_name" id="pic_name" class="form-control">
            </div>

            <div class="form-group">
                <label>Contact No.</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <i class="fas fa-phone"></i>
                        </div>
                    </div>
                    <input value="{{$jti->contact}}" type="text" name="contact" id="contact" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label>Address</label>
                <textarea id="address" name="address" rows="3" class="form-control">{{$jti->company_address}}</textarea>
            </div>

            <div class="form-group">
                <label>Est. Volume</label>
                <input value="{{$jti->volume}}" type="number" name="est_volume" id="est_volume" autocomplete="given-name" class="form-control">
            </div>

            <div class="form-group">
                <label>Mode</label>
                {{-- <input value="{{$jti->mode}}" type="text" name="mode" id="mode" autocomplete="given-name" class="form-control"> --}}
                <select id="mode" name="mode" autocomplete="mode" class="form-control selectric">
                    <option value="Land" <?php if($jti->mode=="Land") echo 'selected="selected"'; ?> >Land</option>
                    <option value="Sea" <?php if($jti->mode=="Sea") echo 'selected="selected"'; ?> >Sea</option>
                    <option value="Air" <?php if($jti->mode=="Air") echo 'selected="selected"'; ?> >Air</option>
                </select>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Start Date</label>
                            <input readonly type="text" value="{{ \Carbon\Carbon::parse($jti->start_date)->format('d/m/Y')}}" name="from" id="from" class="form-control">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>End Date</label>
                            <input readonly type="text" value="{{ \Carbon\Carbon::parse($jti->end_date)->format('d/m/Y')}}" name="to" id="to" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Period</label>
                <input readonly type="text" value="{{$jti->period}}" name="period" id="period" class="form-control">
            </div>

            <div class="form-group">
                <!-- <legend class="text-base font-medium font-bold text-gray-900">Destination</legend> -->
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Destination (From)</label>
                            <input type="text" readonly value="{{$jti->from_destination}}" name="from" id="from" class="form-control">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Destination (To)</label>
                            <input type="text" readonly value="{{$jti->to_destination}}" name="to" id="to" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Job Detail Instruction</label>
                <textarea readonly id="job_details" name="job_details" rows="4" class="form-control">{{$jti->job_details}}</textarea>
            </div>

            <div class="form-group">
                <!-- <legend class="text-base font-medium font-bold text-gray-900">Destination</legend> -->
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Manpower Required</label>
                            <input type="number" value="{{$jti->manpower}}" name="manpower" id="manpower" class="form-control">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                        <label>Trucks</label>
                            <input type="number" value="{{$jti->trucks}}" name="trucks" id="trucks" class="form-control">
                        </div>
                    </div>
                </div>
            </div>

            <x-jet-section-border />

            <legend class="text-base font-medium font-bold text-gray-900">Job Description</legend>

            <!-- <div class="badge badge-danger">1. PACKING</div> -->
            <div class="form-group">
                {{-- <div class="control-label">Toggle to choose required task</div> --}}
                <div class="alert alert-info">
                    <b>Note!</b> Toggling are disabled, Task are pre-set by the Sales team.
                </div>
                <label class="mt-2">
                    <input type="checkbox" id="packingSwitch" name="packingSwitch" class="custom-switch-input" disabled>
                    <span class="custom-switch-indicator"></span>
                    <span class="custom-switch-description">1. PACKING</span>
                </label>
            </div>

            <!-- <br><br> -->
            <div id="packing_panel">
                <div class="form-group">
                    <label>1.1 - International</label>
                    <input readonly type="text" value="{{$jti->pack_inter}}" name="pack_inter" id="pack_inter" class="form-control">
                    {{-- <select name="pack_inter[]" id="pack_inter" value="$pack_inter" class="form-control selectric" multiple="">
                        <option value="" selected="true" disabled="">Can choose multiple</option>
                        <option value="inter_household">Household effects</option>
                        <option value="inter_office">Office goods</option>
                        <option value="inter_industry">Industrial Equipment</option>
                        <option value="inter_vehicle">Vehicle</option>
                    </select> --}}
                </div>

                <div class="form-group">
                    <label>1.2 - Domestic (Sabah/ Sarawak)</label>
                    <input readonly type="text" value="{{$jti->pack_dome}}" name="pack_dome" id="pack_dome" class="form-control">
                    {{-- <select name="pack_dome[]" class="form-control selectric" multiple="">
                        <option value="" selected="true" disabled="">Can choose multiple</option>
                        <option value="dome_household">Household effects</option>
                        <option value="dome_office">Office goods</option>
                        <option value="dome_industry">Industrial Equipment</option>
                        <option value="dome_vehicle">Vehicle</option>
                    </select> --}}
                </div>

                <div class="form-group">
                    <label>1.3 - Domestic (Penisular Malaysia)</label>
                    <input readonly type="text" value="{{$jti->pack_domw}}" name="pack_domw" id="pack_domw" class="form-control">
                    {{-- <select name="pack_domw[]" class="form-control selectric" multiple="">
                        <option value="" selected="true" disabled="">Can choose multiple</option>
                        <option value="domw_household">Household effects</option>
                        <option value="domw_office">Office goods</option>
                        <option value="domw_industry">Industrial Equipment</option>
                        <option value="domw_vehicle">Vehicle</option>
                    </select> --}}
                </div>

                <div class="form-group">
                    <label>1.4 - Storage</label>
                    <input readonly type="text" value="{{$jti->pack_storage}}" name="pack_storage" id="pack_storage" class="form-control">
                    {{-- <select name="pack_storage[]" class="form-control selectric" multiple="">
                        <option value="" selected="true" disabled="">Can choose multiple</option>
                        <option value="storage_household">Household effects</option>
                        <option value="storage_office">Office goods</option>
                        <option value="storage_industry">Industrial Equipment</option>
                        <option value="storage_vehicle">Vehicle</option>
                    </select> --}}
                </div>

                <div class="form-group">
                    <label>1.5 - Others</label>
                    <input readonly type="text" value="{{$jti->pack_other}}" name="pack_other" id="pack_other" class="form-control">
                    {{-- <input type="text" name="pack_other" id="others_details" class="form-control"> --}}
                </div>
            </div>
            
            <div class="form-group">
                <div class="control-label">Toggle to choose required task</div>
                <label class="mt-2">
                    <input type="checkbox" id="truckingSwitch" name="truckingSwitch" class="custom-switch-input" disabled>
                    <span class="custom-switch-indicator"></span>
                    <span class="custom-switch-description">2. TRUCKING</span>
                </label>
            </div>

            <div class="form-group">
                <div class="control-label">Toggle to choose required task</div>
                <label class="mt-2">
                    <input type="checkbox" id="shipmentSwitch" name="shipmentSwitch" class="custom-switch-input" disabled>
                    <span class="custom-switch-indicator"></span>
                    <span class="custom-switch-description">3. SHIPMENT</span>
                </label>
            </div>

            <div id="shipment_panel">
                <div class="form-group">
                    <label>3.1 - Export</label>
                    <input readonly type="text" value="{{$jti->ship_export}}" name="ship_export" id="ship_export" class="form-control">
                    {{-- <select name="ship_export[]" class="form-control selectric" multiple="">
                        <option value="" selected="true" disabled="">Can choose multiple</option>
                        <option value="exp_container">Container (FCL)</option>
                        <option value="exp_console">Console (LCL)</option>
                        <option value="exp_airship">Air-shipment</option>
                    </select> --}}
                </div>

                <div class="form-group">
                    <label>3.2 - Import</label>
                    <input readonly type="text" value="{{$jti->ship_import}}" name="ship_import" id="ship_import" class="form-control">
                    {{-- <select name="ship_import[]" class="form-control selectric" multiple="">
                        <option value="" selected="true" disabled="">Can choose multiple</option>
                        <option value="imp_container">Container (FCL)</option>
                        <option value="imp_console">Console (LCL)</option>
                        <option value="imp_airship">Air-shipment</option>
                    </select> --}}
                </div>
            </div>

            <div class="form-group">
                <div class="control-label">Toggle to choose required task</div>
                <label class="mt-2">
                    <input type="checkbox" id="destinationSwitch" name="destinationSwitch" class="custom-switch-input" disabled>
                    <span class="custom-switch-indicator"></span>
                    <span class="custom-switch-description">4. DESTINATION</span>
                </label>
            </div>

            <div id="destination_panel">
                <div class="form-group">
                    <label>4.1 - Destination</label>
                    <input readonly type="text" value="{{$jti->destination}}" name="destination" id="destination" class="form-control">
                    {{-- <select name="destination[]" class="form-control selectric" multiple="">
                        <option value="" selected="true" disabled="">Can choose multiple</option>
                        <option value="exp_container">Unpack</option>
                        <option value="exp_console">Rearrange</option>
                    </select> --}}
                </div>
            </div>
            
            <x-jet-section-border />

            <legend class="text-base font-medium font-bold text-gray-900">Material Required</legend>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Boxes - S [19 x 14 x 14"]</label>
                        <input type="number" name="m1" id="m1" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Boxes - M [17 x 17 x 17"]</label>
                        <input type="number" name="m2" id="m2" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Boxes - M [18 x 18 x 18"]</label>
                        <input type="number" name="m3" id="m3" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Boxes - L [ 19 x 19 x 30"]</label>
                        <input type="number" name="m4" id="m4" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Boxes - [21 x 20 x 20"]</label>
                        <input type="number" name="m5" id="m5" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Empty Boxes (USED)</label>
                        <input type="number" name="m6" id="m6" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Corrugated Paper Roll</label>
                        <input type="number" name="m7" id="m7" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Wardrobe / Hanging Ctn</label>
                        <input type="number" name="m8" id="m8" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Air-Bubblepack</label>
                        <input type="number" name="m9" id="m9" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>PE Foam</label>
                        <input type="number" name="m10" id="m10" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>White Tape (Eco)</label>
                        <input type="number" name="m11" id="m11" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>OPP Tape -"KLCCUH"</label>
                        <input type="number" name="m12" id="m12" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>OPP Tape (Brown)</label>
                        <input type="number" name="m13" id="m13" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Masking Tape</label>
                        <input type="number" name="m14" id="m14" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Fragile Tape</label>
                        <input type="number" name="m15" id="m15" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Stretch Film</label>
                        <input type="number" name="m16" id="m16" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Newsprint Paper</label>
                        <input type="number" name="m17" id="m17" class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Steel Strapping Rope</label>
                        <input type="number" name="m18" id="m18" class="form-control">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Sticker Color</label>
                        <input type="number" name="m19" id="m19" class="form-control">
                    </div>
                </div>
            </div>

            <x-jet-section-border />

            <legend class="text-base font-medium font-bold text-gray-900">Equipment</legend>

            {{-- <div class="form-group">
                <label>Equipment List</label>
                <textarea id="equipmentList" name="equipmentList" rows="3" class="form-control">{{$jti->equipment_list}}</textarea>
                <select name="equipmentList[]" class="form-control selectric" multiple="">
                    <option value="" selected="true" disabled="">Can choose multiple</option>
                    <option value="Two Wheel Trolley">Two Wheel Trolley</option>
                    <option value="Four Wheel Trolley">Four Wheel Trolley</option>
                    <option value="Tools Set / Hand Drill Set">Tools Set / Hand Drill Set</option>
                    <option value="Weight Scale">Weight Scale</option>
                    <option value="Tape Measure">Tape Measure</option>
                    <option value="Pallet Jack">Pallet Jack</option>
                    <option value="Wooden / Plastic pallet">Wooden / Plastic pallet</option>
                    <option value="Ramp [ Wooden / Steel ]">Ramp [ Wooden / Steel ]</option>
                    <option value="Plywood Sheets">Plywood Sheets</option>
                    <option value="Canvas">Canvas</option>
                    <option value="Cutter Seal">Cutter Seal</option>
                    <option value="Wood (kocai / 2-3)">Wood (kocai / 2-3)</option>
                    <option value="Crane - 5 / 10 / 20 / 40 tonage">Crane - 5 / 10 / 20 / 40 tonage</option>
                    <option value="Forklift">Forklift</option>
                </select>
            </div> --}}

            <div class="grid grid-cols-6 gap-3">
                <div class="col-span-6 sm:col-span-2 flex">
                    <div class="flex items-center h-5">
                        <input id="e1" name="e1" type="checkbox" value="Two Wheel Trolley" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="e1" class="font-medium text-gray-700">Two Wheel Trolley</label>
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-2 flex">
                    <div class="flex items-center h-5">
                        <input id="e2" name="e2" type="checkbox" value="Four Wheel Trolley" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="e2" class="font-medium text-gray-700">Four Wheel Trolley</label>
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-2 flex">
                    <div class="flex items-center h-5">
                        <input id="e3" name="e3" type="checkbox" value="Tools Set / Hand Drill Set" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="e3" class="font-medium text-gray-700">Tools Set / Hand Drill Set</label>
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-2 flex">
                    <div class="flex items-center h-5">
                        <input id="e4" name="e4" type="checkbox" value="Weight Scale" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="e4" class="font-medium text-gray-700">Weight Scale</label>
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-2 flex">
                    <div class="flex items-center h-5">
                        <input id="e5" name="e5" type="checkbox" value="Tape Measure" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="e5" class="font-medium text-gray-700">Tape Measure</label>
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-2 flex">
                    <div class="flex items-center h-5">
                        <input id="e6" name="e6" type="checkbox" value="Pallet Jack" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="e6" class="font-medium text-gray-700">Pallet Jack</label>
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-2 flex">
                    <div class="flex items-center h-5">
                        <input id="e7" name="e7" type="checkbox" value="Wooden / Plastic pallet" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="e7" class="font-medium text-gray-700">Wooden / Plastic pallet</label>
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-2 flex">
                    <div class="flex items-center h-5">
                        <input id="e8" name="e8" type="checkbox" value="Ramp [ Wooden / Steel ]" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="e8" class="font-medium text-gray-700">Ramp [ Wooden / Steel ]</label>
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-2 flex">
                    <div class="flex items-center h-5">
                        <input id="e9" name="e9" type="checkbox" value="Plywood Sheets" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="e9" class="font-medium text-gray-700">Plywood Sheets</label>
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-2 flex">
                    <div class="flex items-center h-5">
                        <input id="e10" name="e10" type="checkbox" value="Canvas" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="e10" class="font-medium text-gray-700">Canvas</label>
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-2 flex">
                    <div class="flex items-center h-5">
                        <input id="e11" name="e11" type="checkbox" value="Cutter Seal" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="e11" class="font-medium text-gray-700">Cutter Seal</label>
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-2 flex">
                    <div class="flex items-center h-5">
                        <input id="e12" name="e12" type="checkbox" value="Wood (kocai / 2-3)" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="e12" class="font-medium text-gray-700">Wood (kocai / 2-3)</label>
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-2 flex">
                    <div class="flex items-center h-5">
                        <input id="e13" name="e13" type="checkbox" value="Crane - 5 / 10 / 20 / 40 tonage" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="e13" class="font-medium text-gray-700">Crane - 5 / 10 / 20 / 40 tonage</label>
                    </div>
                </div>

                <div class="col-span-6 sm:col-span-2 flex">
                    <div class="flex items-center h-5">
                        <input id="e14" name="e14" type="checkbox" value="Forklift" class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="e14" class="font-medium text-gray-700">Forklift</label>
                    </div>
                </div>

            </div>

            <x-jet-section-border />

            <div class="form-group">
                <label for="assignto" class="block text-sm font-medium text-gray-700">Assign to (Project Manager)</label>
                <input readonly value="{{$jti->name}}" type="text" name="assignto" id="assignto" class="form-control">
            </div>

            <div class="form-group">
                <label>Issued By</label>
                <input readonly value="{{$jti->issued_by}}" type="text" name="sales_guy" id="sales_guy" class="form-control">
                <p class="mt-2 text-sm text-red-500">
                    Sales person name
                </p>
            </div>

            <div class="form-group">
                <label>Special Instruction</label>
                <textarea readonly id="special_instruct" name="special_instruct" rows="3" class="form-control">{{$jti->special_instruction}}</textarea>
            </div>
            
            <button type="submit" class="btn btn-icon icon-left btn-success float-right"><i class="fas fa-check"></i>Confirm</button>

        </form>

    </div>
</div>


