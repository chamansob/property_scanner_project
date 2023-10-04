<x-backend-layout>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Roles</li>
                </li>
            </ol>
            <a href="{{ route('roles.index') }}" class="btn btn-inverse-info">Show All Roles</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Role</h6>
                        {{ Form::open(['route' => 'roles.store', 'class' => 'forms-sample', 'method' => 'post']) }}
                        <div class="row">

                            <div class="mb-3">

                                {!! Form::label('name', 'Role Name', ['class' => 'form-label']) !!}

                                {!! Form::text('name', $value = null, ['class' => 'form-control', 'placeholder' => 'Role Name']) !!}
                                @error('name')
                                    <span class="text-danger pt-3">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>


                        {!! Form::submit('Submit', ['class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0']) !!}
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>

    </div>
</x-backend-layout>
