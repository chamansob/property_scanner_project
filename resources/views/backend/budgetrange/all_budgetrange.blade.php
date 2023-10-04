<x-backend-layout>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Budget Range</li>
                </li>
            </ol>
            <a href="{{ route('budgetrange.create') }}" class="btn btn-inverse-info">Add Budget Rang</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">All Budget Rang </h6>

                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Range</th>
                                        <th>Start</th> 
                                        <th>End</th>                                      
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($budgetranges as $budgetrange)
                                        <tr>
                                            <td>{{ $budgetrange->id }}</td>
                                           <td>{{ $budgetrange->range_id==1 ? 'Buy': 'Sale' }}</td>
                                            <td>{{ MONEY }} {{ !empty($budgetrange->start) ? $budgetrange->start : '-' }}</td>
                                           <td>{{ (MONEY) }} {{ !empty($budgetrange->end) ? $budgetrange->end : '-' }}</td>
                                            <td>
                                                @if ($budgetrange->status == 1)
                                                    {!! Form::open([
                                                        'method' => 'patch',
                                                        'route' => ['budgetrange.status', $budgetrange->id],
                                                        'class' => 'forms-sample',
                                                    ]) !!}
                                                    <button type="submit" class="btn badge rounded-pill bg-danger">InActive
                                                    </button>

                                                    {{ Form::close() }}
                                                @else
                                                    {!! Form::open([
                                                        'method' => 'patch',
                                                        'route' => ['budgetrange.status', $budgetrange->id],
                                                        'class' => 'forms-sample',
                                                    ]) !!}

                                                    <button type="submit" class="btn badge rounded-pill bg-success">Active
                                                    </button>

                                                    {{ Form::close() }}
                                                @endif
                                            </td>
                                            </td>
                                            <td>
                                                <form action="{{ route('budgetrange.destroy', $budgetrange->id) }}" method="POST">

                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="{{ route('budgetrange.edit', $budgetrange->id) }}"
                                                        class="btn btn-inverse-warning">Edit</a>
                                                    <button type="submit"
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
