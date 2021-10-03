
<x-guest-layout>

    <div class="py-12 antialiased bg-red-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!--Code start here -->

            @php $status= session('msgg'); @endphp
            @if ($status=='quantity')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Successfully Uploaded!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

                <div class="card">

                    <div class="card-header">
                        <h4>Upload Your Final Quotation File</h4>
                        
                    </div>
                    <div class="card-body">
                        <form action="/upload_quotation" method="post" enctype="multipart/form-data" accept-charset='UTF-8'>
                        {{@csrf_field()}}
                            <div class="form-group">
                                <label>Quotation No</label>
                                <input type="text" class="form-control" name="quote_no" value="{{$quote_no}}" readonly>
                                <small class="text-danger">* Non-Editable</small>
                            </div>

                            <div class="form-group">
                                <label>PO Attachment</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input form-control" id="file-upload" name="file-upload">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-icon icon-left btn-success float-right"><i class="fas fa-check"></i> Submit</button>

                        </form>
                    </div>
                </div>

            <!--Code end here -->
        </div>
    </div>
    
</x-guest-layout>


    


