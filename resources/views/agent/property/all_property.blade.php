<x-backend-agent-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Property All</li>
                </li>
            </ol>
            <a href="{{ route('agent.properties.create') }}" class="btn btn-inverse-info">Add Property</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Property All</h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>                                       
                                        <th>Info</th>   
                                        <th>Status</th>
                                        <th>Change</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($properties as $property)
                                        <?php
                                        $img = explode('.', $property->property_thumbnail);
                                        $table_img = $img[0] . '_small.' . $img[1]; ?>
                                        <tr>
                                            <td>{{ $property->id }}</td>
                                            <td><img src="{{ asset($table_img) }}"></td>
                                            <td>{{ ucfirst($property->property_name) }}</td>
                                             <td><strong class="text-primary">Name:</strong>{{ ucfirst($property->property_name) }}<br><strong class="text-info">Code:</strong>{{  $property->property_code }}<br><strong class="text-warning">Type:</strong>:{{ $property->type->type_name }}<br><strong class="text-danger">Status Type:</strong>{{ ucfirst($property->property_status) }}<br><strong class="text-primary">City:</strong>{{  $property->city?->name  }}<br><strong class="text-secondary">Created:</strong>{{ $property->created_at->format('d-m-Y g:i A ') }}<br><strong class="text-secondary">Updated:</strong>{{ $property->updated_at->format('d-m-Y g:i A ') }}</td>
                                            
                                            <td> <a href="#" id="currentStatus{{ $property->id }}"><span
                                                        class="badge rounded-pill bg-{{ $property->status == 0 ? 'danger' : 'success' }}">{{ $property->status == 0 ? 'Deactive' : 'Active' }}</span></a>
                                            </td>
                                             <td>
                                                <input data-id="{{ $property->id }}" class="toggle-class" type="checkbox"
                                                    data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                    data-on="Active" data-off="Deactive"
                                                    {{ $property->status == 1 ? 'checked' : '' }}>

                                            </td>
                                            <td>
                                                <form action="{{ route('agent.properties.delete', $property->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('DELETE')
                                                     <a href="{{ url('property/details/' . $property->id . '/' . $property->property_slug) }}"
                                                        class="btn btn-inverse-info" title="Public View"  target="_blank"> <i
                                                            data-feather="eye"></i> </a>
                                                    <a href="{{ route('agent.properties.show', $property->id) }}"
                                                        class="btn btn-inverse-info" title="List View"> <i
                                                            data-feather="monitor"></i> </a>
                                                    <a href="{{ route('agent.properties.edit', $property->id) }}"
                                                        class="btn btn-inverse-warning"><i data-feather="edit"></i> </a>

                                                    <button type="submit" class="btn btn-inverse-danger btn-submit"><i
                                                            data-feather="trash-2"></i> </button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    @if($properties->count()!=0)    
     <script type="text/javascript">
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var property_id = $(this).data('id');
                var crf = '{{ csrf_token() }}';
                $.ajax({
                    type: "PATCH",
                    dataType: "json",
                    url: '{{ route('property.status', $property->id) }}',
                    data: {
                        _token: crf,
                        'status': status,
                        'property_id': property_id
                    },
                    success: function(data) {
                        // console.log(data.success)
                        // Start Message 
                        if (status == 1) {
                            $('#currentStatus' + property_id).html('')
                            $('#currentStatus' + property_id).html(
                                '<span class="badge rounded-pill bg-success">Active</span>'
                            )

                        }
                        if (status == 0) {

                            $('#currentStatus' + property_id).html('')
                            $('#currentStatus' + property_id).html(
                                '<span class="badge rounded-pill bg-danger">Deactive</span>'
                            )
                        }
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            showConfirmButton: false,
                            timer: 3000
                        })
                        if ($.isEmptyObject(data.error)) {

                            Toast.fire({
                                type: 'success',
                                title: data.success,
                            })
                        } else {

                            Toast.fire({
                                type: 'error',
                                title: data.error,
                            })
                        }
                        // End Message   
                    }
                });
            })
        })
    </script>
    @endif
</x-backend-agent-layout>