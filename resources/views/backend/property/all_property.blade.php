<x-backend-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Property All</li>
                </li>
            </ol>
            <a href="{{ route('properties.create') }}" class="btn btn-inverse-info">Add Property</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Property All</h6>

                        <div class="table-responsive">
                            <table id="property_ajax" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
										<th>Upload By</th>                                      
                                        <th>Info</th>                                      
                                        <th>Status</th>
                                        <th>Change</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
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
    $(document).ready( function () {
            $('#property_ajax').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('admin.property.ajax_load') }}",
                "drawCallback": function( settings ) {
        feather.replace();
         $('.toggle-class').bootstrapToggle();
          $('.toggle-class').change(function()
            {
               
                var status = $(this).prop('checked') == true ? 1 : 0;
                var property_id = $(this).data('id');
                var crf = '{{ csrf_token() }}';
                var url = "{{ route('properties.status', ':property_id') }}";
	            url = url.replace(':property_id', property_id);
                $.ajax({
                    type: "PATCH",
                    dataType: "json",
                    url: url,
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
    },
                "columns": [
                    { "data": "id" },                    
                    { "data": "image" },
                    { "data": "uploadby" },
                    { "data": "info" },
                    { "data": "status" },
                    { "data": "change" },
                    { "data": "action" },
                ]
            });
        });
       
    </script>
    @endif
</x-backend-layout>
