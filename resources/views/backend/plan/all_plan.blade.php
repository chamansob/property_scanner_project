<x-backend-layout>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Property plan All</li>
                </li>
            </ol>
            <a href="{{ route('plan.create') }}" class="btn btn-inverse-info">Add Plan</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All Plans</h6>
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Days</th>
                                        <th>Name</th>
                                        <th>Discount(%)</th>
                                        <th>Properties</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                    @foreach ($plans as $plan)
                                    @php
                                        $validity= $plan->plan_validity >  30 ? 'danger' : 'primary';
                                        $validity= $plan->plan_validity==0 ? 'success' : $validity;
                                    @endphp
                                        <tr>
                                            <td>{{ $plan->id }}</td>
                                            <td><span
                                                    class="badge rounded-pill bg-{{ $validity }}">{{ $plan->plan_validity }}</span>
                                            </td>
                                            <td><i data-feather="{{ $plan->plan_icon }}"
                                                    class="icon-md text-success me-2"></i> <span
                                                    class="badge bg-{{ PACK[$plan->id] }}">{{ ucfirst($plan->plan_name) }}</span>
                                            </td>
                                            <td> {{ $plan->plan_discount }}</td>


                                            <td>{{ $plan->plan_credit }}</td>
                                            <td>{{ MONEY }}{{ $plan->plan_amount }}</td>
                                            <td>
                                                @if ($plan->status == 1)
                                                    {!! Form::open([
                                                        'method' => 'patch',
                                                        'route' => ['plan.status', $plan->id],
                                                        'class' => 'forms-sample',
                                                    ]) !!}
                                                    <button type="submit"
                                                        class="btn badge rounded-pill bg-danger">InActive
                                                    </button>

                                                    {{ Form::close() }}
                                                @else
                                                    {!! Form::open([
                                                        'method' => 'patch',
                                                        'route' => ['plan.status', $plan->id],
                                                        'class' => 'forms-sample',
                                                    ]) !!}

                                                    <button type="submit"
                                                        class="btn badge rounded-pill bg-success">Active
                                                    </button>

                                                    {{ Form::close() }}
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('plan.destroy', $plan->id) }}" method="POST">

                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('plan.edit', $plan->id) }}"
                                                        class="btn btn-inverse-warning">Edit</a>
                                                    <button plan="submit"
                                                        class="btn btn-inverse-danger btn-submit">Delete</button>
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
