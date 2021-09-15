
<div class="container-fluid">
    <div class="row">
        <div class="col">

        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Transport</h4> 

                </div>
                <div class="card-body">
                    <form action="/confirm_edit_transport" method="post" enctype="multipart/form-data" accept-charset='UTF-8'>
                        {{@csrf_field()}}

                        <div class="form-group">
                            {{-- <label>Staff ID or References</label> --}}
                            <input type="text" value="{{$data->id}}" class="form-control" name="id" id="id" hidden>
                        </div>

                        <div class="form-group">
                            <label>Plate No</label>
                            <input type="text" class="form-control" value="{{$data->plate_no}}" name="plate_no" id="plate_no">
                        </div>
            
                        <div class="form-group">
                            <label>Description</label>
                            <textarea id="description" name="description" rows="3" class="form-control" placeholder="Example: Lorry 1 Ton / Car / Motorcycle...">{{$data->description}}</textarea>
                        </div>
            
                        <button type="submit" class="btn btn-icon icon-left btn-success float-right"><i class="fas fa-check"></i>Update</button>
            
                    </form>
            
                </div>
            </div>
        </div>
    </div>
</div>







