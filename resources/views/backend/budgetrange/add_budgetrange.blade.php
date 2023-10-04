<x-backend-layout>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Budget Range</li>
                </li>
            </ol>
            <a href="{{ route('budgetrange.index') }}" class="btn btn-inverse-info">Show Budget Range</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Budget Range</h6>

                        {{ Form::open(['route' => 'budgetrange.store', 'class' => 'forms-sample', 'method' => 'post', 'files' => true]) }}
                        <div class="mb-3">
                            @php
                                $type = [1 => 'Buy', 2 => 'Sale'];
                            @endphp
                            {!! Form::label('range_id', 'Range Type', ['class' => 'form-label']) !!}

                            {!! Form::Select('range_id', $type, null, ['class' => 'form-control', 'placeholder' => 'Select Range Type']) !!}
                            @error('range_id')
                                <span class="text-danger pt-3">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">

                            {!! Form::label('start', 'Start-('.MONEY.')', ['class' => 'form-label']) !!}

                            {!! Form::text('start', $value = null, ['class' => 'form-control', 'placeholder' => 'Start']) !!}
                            @error('start')
                                <span class="text-danger pt-3">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">

                            {!! Form::label('end', 'End-('.MONEY.')', ['class' => 'form-label']) !!}

                            {!! Form::text('end', $value = null, ['class' => 'form-control', 'placeholder' => 'End']) !!}
                            @error('end')
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
