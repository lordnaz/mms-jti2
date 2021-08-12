
<x-guest-layout>

    <div class="py-12 antialiased bg-red-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!--Code start here -->

                <div class="card">

                    <div class="card-header">
                        <h4>{{$quotation->identifier}}</h4>
                        
                    </div>
                    <div class="card-body">
                        <form action="/submit_jti" method="post" enctype="multipart/form-data" accept-charset='UTF-8'>
                        {{@csrf_field()}}
                            <div class="form-group">
                                <label>PO No</label>
                                <input type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>PO Attachment</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input form-control" id="file-upload" name="file-upload">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Quotation No.</label>
                                <input readonly value="{{$quotation->identifier}}" type="text" name="quote_no" id="quote_no" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Company Name</label>
                                <input readonly value="{{$company->name}}" type="text" name="company_name" id="company_name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>PIC Name</label>
                                <input readonly value="{{$officer->fullname}}" type="text" name="pic_name" id="pic_name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Contact No.</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                    </div>
                                    <input readonly value="{{$officer->phoneno}}" type="text" name="contact" id="contact" class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Address</label>
                                <textarea readonly id="address" name="address" rows="3" class="form-control">{{$company->address}}, {{$company->postcode}}, {{$state->name}}, {{$country->name}}.</textarea>
                            </div>

                            <div class="form-group">
                                <label>Est. Volume</label>
                                <input type="number" name="est_volume" id="est_volume" autocomplete="given-name" class="form-control">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Mode</label>
                                <div class="selectgroup w-100">
                                    <label class="selectgroup-item">
                                        <input type="radio" name="value" value="Land" class="selectgroup-input" checked="">
                                        <span class="selectgroup-button">Land</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="value" value="Sea" class="selectgroup-input">
                                        <span class="selectgroup-button">Sea</span>
                                    </label>
                                    <label class="selectgroup-item">
                                        <input type="radio" name="value" value="Air" class="selectgroup-input">
                                        <span class="selectgroup-button">Air</span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Date Range</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-calendar"></i>
                                    </div>
                                    </div>
                                    <input type="text" name="dates" class="form-control daterange-cus">
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Period</label>
                                <input type="text" name="period" id="period" class="form-control">
                            </div>

                            <div class="form-group">
                                <!-- <legend class="text-base font-medium font-bold text-gray-900">Destination</legend> -->
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Destination (From)</label>
                                            <input type="text" name="from" id="from" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Destination (To)</label>
                                            <input type="text" name="to" id="to" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Job Detail Instruction</label>
                                <textarea id="job_instruction" name="job_instruction" rows="4" class="form-control"></textarea>
                            </div>

                            <div class="form-group">
                                <!-- <legend class="text-base font-medium font-bold text-gray-900">Destination</legend> -->
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Manpower Required</label>
                                            <input type="number" name="manpower" id="manpower" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                        <label>Trucks</label>
                                            <input type="number" name="trucks" id="trucks" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <x-jet-section-border />

                            <legend class="text-base font-medium font-bold text-gray-900">Job Description</legend>

                            <!-- <div class="badge badge-danger">1. PACKING</div> -->
                            <div class="form-group">
                                <div class="control-label">Toggle to choose required task</div>
                                <label class="mt-2">
                                    <input type="checkbox" id="packingSwitch" name="custom-switch-checkbox" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">1. PACKING</span>
                                </label>
                            </div>

                            <!-- <br><br> -->
                            <div id="packing_panel">
                                <div class="form-group">
                                    <label>1.1 - International</label>
                                    <select class="form-control selectric" multiple="">
                                        <option value="" selected="true" disabled="">Can choose multiple</option>
                                        <option value="inter_household">Household effects</option>
                                        <option value="inter_office">Office goods</option>
                                        <option value="inter_industry">Industrial Equipment</option>
                                        <option value="inter_vehicle">Vehicle</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>1.2 - Domestic (Sabah/ Sarawak)</label>
                                    <select class="form-control selectric" multiple="">
                                        <option value="" selected="true" disabled="">Can choose multiple</option>
                                        <option value="dome_household">Household effects</option>
                                        <option value="dome_office">Office goods</option>
                                        <option value="dome_industry">Industrial Equipment</option>
                                        <option value="dome_vehicle">Vehicle</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>1.3 - Domestic (Penisular Malaysia)</label>
                                    <select class="form-control selectric" multiple="">
                                        <option value="" selected="true" disabled="">Can choose multiple</option>
                                        <option value="domw_household">Household effects</option>
                                        <option value="domw_office">Office goods</option>
                                        <option value="domw_industry">Industrial Equipment</option>
                                        <option value="domw_vehicle">Vehicle</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>1.4 - Storage</label>
                                    <select class="form-control selectric" multiple="">
                                        <option value="" selected="true" disabled="">Can choose multiple</option>
                                        <option value="storage_household">Household effects</option>
                                        <option value="storage_office">Office goods</option>
                                        <option value="storage_industry">Industrial Equipment</option>
                                        <option value="storage_vehicle">Vehicle</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>1.5 - Others</label>
                                    <input type="text" name="others_details" id="others_details" class="form-control">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="control-label">Toggle to choose required task</div>
                                <label class="mt-2">
                                    <input type="checkbox" id="truckingSwitch" name="custom-switch-checkbox" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">2. TRUCKING</span>
                                </label>
                            </div>

                            <div class="form-group">
                                <div class="control-label">Toggle to choose required task</div>
                                <label class="mt-2">
                                    <input type="checkbox" id="shipmentSwitch" name="custom-switch-checkbox" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">3. SHIPMENT</span>
                                </label>
                            </div>

                            <div id="shipment_panel">
                                <div class="form-group">
                                    <label>3.1 - Export</label>
                                    <select class="form-control selectric" multiple="">
                                        <option value="" selected="true" disabled="">Can choose multiple</option>
                                        <option value="exp_container">Container (FCL)</option>
                                        <option value="exp_console">Console (LCL)</option>
                                        <option value="exp_airship">Air-shipment</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>3.2 - Import</label>
                                    <select class="form-control selectric" multiple="">
                                        <option value="" selected="true" disabled="">Can choose multiple</option>
                                        <option value="imp_container">Container (FCL)</option>
                                        <option value="imp_console">Console (LCL)</option>
                                        <option value="imp_airship">Air-shipment</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="control-label">Toggle to choose required task</div>
                                <label class="mt-2">
                                    <input type="checkbox" id="destinationSwitch" name="custom-switch-checkbox" class="custom-switch-input">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="custom-switch-description">4. DESTINATION</span>
                                </label>
                            </div>

                            <div id="destination_panel">
                                <div class="form-group">
                                    <label>4.1 - Destination</label>
                                    <select class="form-control selectric" multiple="">
                                        <option value="" selected="true" disabled="">Can choose multiple</option>
                                        <option value="exp_container">Unpack</option>
                                        <option value="exp_console">Rearrange</option>
                                    </select>
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

                            <div class="form-group">
                                <label>Equipment List</label>
                                <select class="form-control selectric" multiple="">
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
                            </div>

                            <x-jet-section-border />

                            <div class="form-group">
                                <label for="assignto" class="block text-sm font-medium text-gray-700">Assign to (Project Manager)</label>

                                <select id="assignto" name="assignto" class="form-control selectric">
                                    <option value="" selected="true" disabled="">Select Project Manager</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" @if($user->id == $user->name) selected @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label>Phone Number (US Format)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control phone-number">
                                </div>
                            </div>
                            <div class="form-group">
                            <label>Password Strength</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </div>
                                </div>
                                <input type="password" class="form-control pwstrength" data-indicator="pwindicator">
                            </div>
                            <div id="pwindicator" class="pwindicator">
                                <div class="bar"></div>
                                <div class="label"></div>
                            </div>
                            </div>
                            <div class="form-group">
                            <label>Currency</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                <div class="input-group-text">
                                    $
                                </div>
                                </div>
                                <input type="text" class="form-control currency">
                            </div>
                            </div>
                            <div class="form-group">
                            <label>Purchase Code</label>
                            <input type="text" class="form-control purchase-code" placeholder="ASDF-GHIJ-KLMN-OPQR">
                            </div>
                            <div class="form-group">
                            <label>Invoice</label>
                            <input type="text" class="form-control invoice-input">
                            </div>
                            <div class="form-group">
                            <label>Date</label>
                            <input type="text" class="form-control datemask" placeholder="YYYY/MM/DD">
                            </div>
                            <div class="form-group">
                            <label>Credit Card</label>
                            <input type="text" class="form-control creditcard">
                            </div>
                            <div class="form-group">
                            <label>Tags</label>
                            <input type="text" class="form-control inputtags">
                            </div>

                        </form>
                    </div>
                </div>

            
    
            <!--Code end here -->
        </div>
    </div>
    
</x-guest-layout>

<script>

$(function() {

    // initial state 
    $('#packing_panel, #shipment_panel, #destination_panel').hide();

    $('.daterange-cus').daterangepicker({
        locale: {format: 'YYYY-MM-DD'},
        drops: 'down',
        opens: 'right'
    });

    $('#packingSwitch').change(function() {
        // this will contain a reference to the checkbox   
        if (this.checked) {
            $('#packing_panel').show(500);
        } else {
            $('#packing_panel').hide(500);
        }
    });

    $('#shipmentSwitch').change(function() {
        // this will contain a reference to the checkbox   
        if (this.checked) {
            $('#shipment_panel').show(500);
        } else {
            $('#shipment_panel').hide(500);
        }
    });

    $('#destinationSwitch').change(function() {
        // this will contain a reference to the checkbox   
        if (this.checked) {
            $('#destination_panel').show(500);
        } else {
            $('#destination_panel').hide(500);
        }
    });



    
});

</script>
    


