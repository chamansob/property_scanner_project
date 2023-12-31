<x-backend-layout>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Users</li>
                </li>
            </ol>
            <a href="{{ route('admin.user_add') }}" class="btn btn-inverse-info">Add User</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All Users </h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>  
                                        <th>Property Status</th>  
                                        <th>Budget</th>                                      
                                        <th>Status</th>                                      
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td><img class="wd-100 rounded-circle"
                                                    src="{{ !empty($user->photo) || file_exists(asset($user->photo)) ? asset($user->photo) : url('upload/no_image.jpg') }}"
                                                    alt="profile"></td>
                                            <td>{{ ucfirst($user->name) }}</td>
                                            <td>{{ ucfirst($user->userinsrest?->property_status) }}</td>
                                            <td>{{ ucfirst($user->userinsrest?->budget) }}</td>                                             
                                            <td> <a href="#" id="currentStatus{{ $user->id }}"><span
                                                        class="badge rounded-pill bg-{{ $user->status == 1 ? 'danger' : 'success' }}">{{ $user->status == 1 ? 'Deactive' : 'Active' }}</span></a>
                                            </td>
                                            

                                            <td>
                                                <form action="{{ route('admin.user_delete', $user->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('DELETE')

                                                    <a href="{{ route('admin.user_edit', $user->id) }}"
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
</x-backend-layout>
