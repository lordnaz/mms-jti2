
<div class="container-fluid">
    <div class="row">
        <div class="col">

        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Create New Manpower</h4> 
                    {{-- <div class="alert alert-info">
                        <b>JTI No: </b> {{$jti->running_no}}
                    </div> --}}
                </div>
                <div class="card-body">
                    <form action="/add_manpower" method="post" enctype="multipart/form-data" accept-charset='UTF-8'>
                        {{@csrf_field()}}

                        <div class="form-group">
                            <label>Employment Type</label>
                            <select name="employment_type" class="form-control selectric">
                                <option value="" selected="true" disabled="">Choose Type</option>
                                <option value="Casual">Casual</option>
                                <option value="Permanent">Permanent</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Staff ID or References</label>
                            <input type="text" class="form-control" name="staff_id" id="staff_id">
                        </div>
            
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="staff_name" id="staff_name" class="form-control">
                        </div>
            
                        <div class="form-group">
                            <label>Contact No</label>
                            <input type="text" name="contact" id="contact" class="form-control">
                        </div>
            
                        <button type="submit" class="btn btn-icon icon-left btn-success float-right"><i class="fas fa-check"></i>Confirm</button>
            
                    </form>
            
                </div>
            </div>
        </div>
    </div>
</div>




