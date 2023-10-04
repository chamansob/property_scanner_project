<x-backend-layout>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Cities</li>
                </li>
            </ol>
            <a href="{{ route('cities.create') }}" class="btn btn-inverse-info">Add City</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All Cities </h6>

                        <div class="table-responsive">
                            <table id="cities_ajax" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>                                       
                                        <th>Country Name</th>
                                        <th>State Name</th>
                                        <th>Name</th> 
                                        <th>Status</th> 
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
</x-backend-layout>
  <script>
        $(document).ready( function () {
            $('#cities_ajax').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('cities.ajax_load') }}",
                "columns": [
                    { "data": "id" },                    
                    { "data": "country" },
                    { "data": "state" },
                    { "data": "name" },
                    { "data": "status" },
                    { "data": "action" },
                ]
            });
        });
    </script>
    