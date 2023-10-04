<x-backend-layout>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">


        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Package History</li>
                </li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All Package Plan </h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Pay by</th>
                                        <th>Photo</th>
                                        <th>Agent Name</th>
                                        <th>Name</th>
                                        <th>Properites</th>
                                        <th>Amount</th>
                                        <th>Discount</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($packagehistory as $packplan)
                                        <tr>
                                            <td>{{ $packplan->id }}</td>
                                            <td><span class="badge rounded-pill border border-{{ ($packplan->order_by=='admin')?'danger':'warning' }} text-{{ ($packplan->order_by=='admin')?'danger':'warning' }}">{{ ucfirst($packplan->order_by) }}</span></td>
                                            <td><img class="wd-100 rounded-circle"
                                                    src="{{ !empty($packplan->user->photo) || file_exists(asset($packplan->user->photo)) ? asset($packplan->user->photo) : url('upload/no_image.jpg') }}"
                                                    alt="profile"></td>
                                            <td>{{ ucfirst($packplan->user->name) }}</td>

                                            <td><span
                                                    class="badge bg-{{ PACK[$packplan->plan?->id ? $packplan->plan?->id : 0] }}">{{ ucfirst($packplan->package_name) }}</span>
                                            </td>
                                            <td>{{ ucfirst($packplan->package_credits) }}</td>
                                            <td>$ {{ ucfirst($packplan->package_amount) }}</td>
                                            <td>$ {{ ucfirst($packplan->package_discount) }}</td>
                                            <td>{{ $packplan->created_at->format('d-m-y h:i:A') }}</td>

                                            <td>
                                               <form action="{{ route('admin.package_history.delete', $packplan->id) }}"
                                                    method="POST">

                                                    @csrf
                                                    @method('DELETE')
                                                     <a href="{{ route('admin.package_invoice', $packplan->id) }}"
                                                    class="btn btn-inverse-warning"><i data-feather="download"></i> </a>
                                                     
                                                    <button type="submit"
                                                        class="btn btn-inverse-danger btn-submit"><i data-feather="trash"></i></button>
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
