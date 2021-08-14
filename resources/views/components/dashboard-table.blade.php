
<div class="card">
    <div class="card-header">
        <h4>Daily Summary</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped" id="table-1">
                <thead>
                    <tr>
                    <th class="text-center">
                        #
                    </th>
                    <th>JTI No</th>
                    <th>Quotation No</th>
                    <th>Start Date</th>
                    <th>Issuer</th>
                    <th>Assigned To</th>
                    <th>Status</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>
                                {{ $post->id }}
                            </td>
                            <td>
                                {{ $post->running_no }}
                            </td>
                            <td>
                                {{ $post->quotation_no }}
                            </td>
                            <td>
                                
                                {{ \Carbon\Carbon::parse($post->start_date)->format('d/m/Y')}}
                            </td>
                            <td>
                                {{ $post->issued_by }}
                            </td>
                            <td>
                                {{ $post->name }}
                            </td>
                            <td>
                                @if($post->new_flag == true)
                                    <div class="badge badge-danger">New</div>
                                @else
                                    <div class="badge badge-info">Open</div>
                                @endif 
                            </td>
                            <td><a href="#" class="btn btn-dark">Detail</a></td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
