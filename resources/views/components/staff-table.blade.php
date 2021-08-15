
<div class="card">
    <div class="card-header">
        <h4>Manpower List</h4><br>
        
    </div>
    
    <div class="card-body">

        {{-- <a role="button" href="#" 
            class="btn btn-icon btn-dark float-left" 
            style="margin-bottom: 10px;">
            <i class="fas fa-plus"></i>
            Add Manpower
        </a> --}}
        <a role="button" href="{{route('manpower.new')}}" 
            class="btn btn-icon btn-success float-right" 
            style="margin-bottom: 15px;">
            <i class="fas fa-plus"></i>
            Add Manpower
        </a>
        <div class="table-responsive">
            <table class="table table-striped" id="table-1">
                <thead>
                    <tr>
                    <th class="text-center">
                        #
                    </th>
                    <th>Staff ID/References</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Type</th>
                    <th>Created By</th>
                    <th>Last Updated</th>
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
                                {{ $post->staff_id }}
                            </td>
                            <td>
                                {{ $post->staff_name }}
                            </td>
                            <td>
                                {{ $post->contact }}
                            </td>
                            <td>
                                @if($post->employment_type == "Permanent")
                                    <div class="badge badge-warning">Permanent</div>
                                @else
                                    <div class="badge badge-light">Casual</div>
                                @endif 
                            </td>
                            <td>
                                {{ $post->name }}
                            </td>
                            <td>
                                
                                {{ \Carbon\Carbon::parse($post->updated_at)->format('d/m/Y')}}
                            </td>
                            <td>
                                <a role="button" href="{{route('edit_manpower', $post->id)}}"
                                class="btn btn-icon btn-warning" 
                                data-toggle="tooltip" 
                                data-placement="top" 
                                title="Edit manpower">
                                    <i class="far fa-edit"></i>
                                    Edit
                                </a>
                                <a role="button" href="#" 
                                class="btn btn-icon btn-danger" 
                                data-toggle="tooltip" 
                                data-placement="top" 
                                title="Remove manpower">
                                    <i class="far fa-times-circle"></i>
                                    Remove
                                </a>
                                
                            
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
