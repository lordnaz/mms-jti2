
<div class="container-fluid">
    <div class="row">
        <div class="col">

        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Add New Transport</h4> 
                    {{-- <div class="alert alert-info">
                        <b>JTI No: </b> {{$jti->running_no}}
                    </div> --}}
                </div>
                <div class="card-body">
                    <form action="/add_transport" method="post" enctype="multipart/form-data" accept-charset='UTF-8'>
                        {{@csrf_field()}}

                        {{-- <div class="form-group">
                            <label>Employment Type</label>
                            <select name="employment_type" class="form-control selectric">
                                <option value="" selected="true" disabled="">Choose Type</option>
                                <option value="Casual">Casual</option>
                                <option value="Permanent">Permanent</option>
                            </select>
                        </div> --}}

                        <div class="form-group">
                            <label>Plate No</label>
                            <input type="text" class="form-control" name="plate_no" id="plate_no">
                        </div>
            
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="description" name="description" rows="3" class="form-control" placeholder="Example: Lorry 1 Ton / Car / Motorcycle..."></textarea>
                        </div>
            
                        <button type="submit" class="btn btn-icon icon-left btn-success float-right"><i class="fas fa-check"></i>Confirm</button>
            
                    </form>
            
                </div>
            </div>
        </div>
    </div>
</div>




