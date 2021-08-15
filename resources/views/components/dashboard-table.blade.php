
<div class="card">
    <div class="card-header">
        <h4>Task List</h4>
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
                                    <div class="badge badge-success">Open</div>
                                @endif 
                            </td>
                            <td>
                                <a role="button" href="{{route('jti_actual', $post->running_no)}}" 
                                class="btn btn-icon btn-info" 
                                data-toggle="tooltip" 
                                data-placement="top" 
                                title="Check & verify">
                                    <i class="far fa-check-circle"></i>
                                    @if($post->new_flag == true)
                                        Confirm
                                    @else
                                        View
                                    @endif 
                                    
                                </a>

                                @if($post->new_flag != true)
                                    <a role="button" href="{{route('jti_actual', $post->running_no)}}" 
                                    class="btn btn-icon btn-warning" 
                                    data-toggle="tooltip" 
                                    data-placement="top" 
                                    title="Create & view tracker">
                                        <i class="fas fa-stream"></i>
                                        Tracker
                                    </a>
                                @endif
                                
                            
                                {{-- <a href="#" class="btn btn-icon btn-primary"><i class="far fa-edit"></i></a> --}}
                                {{-- <a href="#" class="btn btn-icon btn-info"><i class="fas fa-info-circle"></i></a> --}}
                                {{-- <a role="button" href="/user/edit/{{ $user->id }}" class="mr-3"><i class="fa fa-16px fa-pen"></i></a> --}}
                                {{-- <a role="button" x-on:click.prevent="deleteItem" href="#"><i class="fa fa-16px fa-trash text-red-500"></i></a> --}}
                            </td>
                        </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
