<x-backend-layout>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Facilities</li>
                </li>
            </ol>
            <a href="{{ route('facilities.index') }}" class="btn btn-inverse-info">Show All Facilities</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Facilities</h6>
                        {{ Form::open(['route' => 'facilities.store', 'class' => 'forms-sample', 'method' => 'post']) }}

                        <div class="mb-3">

                           
                            {!! Form::label('facility_name', 'Facility Name', ['class' => 'form-label']) !!}

                            {!! Form::text('facility_name', $value = null, [
                                'class' => 'form-control',
                                'placeholder' => 'Facility Name',
                            ]) !!}
                            @error('facility_name')
                                <span class="text-danger pt-3">{{ $message }}</span>
                            @enderror
                        </div>
                        {!! Form::submit('Submit', ['class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0']) !!}
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>

    </div>
</x-backend-layout>
