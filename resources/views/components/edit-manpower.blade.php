
<div class="container-fluid">
    <div class="row">
        <div class="col">

        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Manpower</h4> 
                    {{-- <div class="alert alert-info">
                        <b>JTI No: </b> {{$jti->running_no}}
                    </div> --}}
                </div>
                <div class="card-body">
                    <form action="/confirm_edit_manpower" method="post" enctype="multipart/form-data" accept-charset='UTF-8'>
                        {{@csrf_field()}}

                        {{-- <p>{{$data->employment_type}}</p> --}}

                        <div class="form-group">
                            {{-- <label>Staff ID or References</label> --}}
                            <input type="text" value="{{$data->id}}" class="form-control" name="id" id="id" hidden>
                        </div>

                        <div class="form-group">
                            <label>Employment Type</label>
                            <select name="employment_type" class="form-control selectric">
                                <option value="Casual" <?php if($data->employment_type=="Casual") echo 'selected="selected"'; ?> >Casual</option>
                                <option value="Permanent" <?php if($data->employment_type=="Permanent") echo 'selected="selected"'; ?> >Permanent</option>
                              
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Staff ID or References</label>
                            <input type="text" value="{{$data->staff_id}}" class="form-control" name="staff_id" id="staff_id">
                        </div>
            
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" value="{{$data->staff_name}}" name="staff_name" id="staff_name" class="form-control">
                        </div>
            
                        <div class="form-group">
                            <label>Contact No</label>
                            <input type="text" value="{{$data->contact}}" name="contact" id="contact" class="form-control">
                        </div>
            
                        <button type="submit" class="btn btn-icon icon-left btn-success float-right"><i class="fas fa-check"></i>Confirm</button>
            
                    </form>
            
                </div>
            </div>
        </div>
    </div>
</div>




