<x-backend-agent-layout>
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
                                        <th>Plan Name</th>
                                        <th>Type</th>
                                        <th>Properties</th>
                                        <th>Amount</th>
                                        <th>Discount</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>                                  
                                    @foreach ($packagehistory as $packplan)                                    
                                        <tr>
                                            <td>{{ $packplan->id }} </td>
                                             <td><span class="badge rounded-pill border border-{{ ($packplan->order_by=='admin')?'danger':'warning' }} text-{{ ($packplan->order_by=='admin')?'danger':'warning' }}">{{ ucfirst($packplan->order_by) }}</span></td>
                                            <td><span
                                                    class="badge bg-{{ PACK[$packplan->plan?->id? $packplan->plan?->id : 0] }}">{{ ucfirst($packplan->package_name) }}</span>
                                            </td>
                                            <td><span
                                                    class="badge rounded-pill bg-{{ $packplan->plan->plan_type == 1 ? 'success' : 'primary' }}">{{ PLANTYPE[$packplan->plan->plan_type] }}</span>
                                            </td>
                                            <td>{{ ucfirst($packplan->package_credits) }}</td>
                                            <td>$ {{ ucfirst($packplan->package_amount) }}</td>
                                            <td>$ {{ ucfirst($packplan->package_discount) }}</td>
                                            <td>{{ $packplan->created_at->format('l d M Y') }}</td>

                                            <td>

                                                <a href="{{ route('agent.buy.package.package_invoice', $packplan->id) }}"
                                                    class="btn btn-inverse-warning"><i data-feather="download"></i> </a>
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
</x-backend-agent-layout>
