<x-backend-layout>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <a href="{{ route('permission.create') }}" class="btn btn-inverse-info"> Add Permission </a>
                &nbsp; &nbsp; &nbsp;
                <a href="{{ route('import.permission') }}" class="btn btn-inverse-warning"> Import </a>
                &nbsp; &nbsp; &nbsp;
                <a href="{{ route('export') }}" class="btn btn-inverse-danger"> Export </a>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Permission All </h6>

                        <div class="table-responsive">
                            <table id="permission_ajax" class="table">
                                <thead>
                                    <tr>
                                        <th>Sl </th>
                                        <th>Permission Name </th>
                                        <th>Group Name </th>
                                        <th>Action </th>
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
            $('#permission_ajax').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('permission.ajax_load') }}",
                "columns": [
                    { "data": "sl" },                    
                    { "data": "name" },
                    { "data": "group_name" },                   
                    { "data": "action" },
                ]
            });
        });
    </script>
