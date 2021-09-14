
<div class="card">
    <div class="card-header">
        <h4>Transportation List</h4><br>
        
    </div>
    
    <div class="card-body">

        {{-- <a role="button" href="#" 
            class="btn btn-icon btn-dark float-left" 
            style="margin-bottom: 10px;">
            <i class="fas fa-plus"></i>
            Add Manpower
        </a> --}}
        <a role="button" href="{{route('transport.new')}}" 
            class="btn btn-icon btn-success float-right" 
            style="margin-bottom: 15px;">
            <i class="fas fa-plus"></i>
            Add Transport
        </a>
        <div class="table-responsive">
            <table class="table table-striped" id="transport_table">
                <thead>
                    <tr>
                    <th class="text-center">
                        #
                    </th>
                    <th>Plate No</th>
                    <th>Description</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $index = 1;
                    @endphp
                    @foreach ($datas as $post)
                        <tr>
                            <td>
                                {{ $index }}
                            </td>
                            <td>
                                {{ $post->plate_no }}
                            </td>
                            <td>
                                {{ $post->description }}
                            </td>
                            <td>
                                {{ auth()->user()->find($post->created_by)->name }}
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($post->created_at)->format('d/m/Y')}}
                            </td>
                            <td>
                                <a role="button" href="{{route('edit_transport', $post->id)}}"
                                class="btn btn-icon btn-warning" 
                                data-toggle="tooltip" 
                                data-placement="top" 
                                title="Edit manpower">
                                    <i class="far fa-edit"></i>
                                    Edit
                                </a>
                                <a role="button" href="{{route('remove_transport', $post->id)}}" 
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

                        @php
                            $index++;
                        @endphp
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
