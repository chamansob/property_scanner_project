<x-backend-layout>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Users</li>
                </li>
            </ol>
            <a href="{{ route('admin.users') }}" class="btn btn-inverse-info">All Users</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add User</h6>

                        {{ Form::open(['route' => 'admin.user_store', 'class' => 'forms-sample', 'method' => 'post']) }}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">

                                    {!! Form::label('name', 'user Name', ['class' => 'form-label']) !!}

                                    {!! Form::text('name', $value = null, ['class' => 'form-control', 'placeholder' => 'user Name']) !!}
                                    @error('name')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">

                                    {!! Form::label('email', 'user Email', ['class' => 'form-label']) !!}

                                    {!! Form::email('email', $value = null, ['class' => 'form-control', 'placeholder' => 'user Email']) !!}
                                    @error('email')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">

                                    {!! Form::label('phone', 'user Phone', ['class' => 'form-label']) !!}

                                    {!! Form::text('phone', $value = null, ['class' => 'form-control', 'placeholder' => 'user Phone']) !!}
                                    @error('phone')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">

                                    {!! Form::label('password', 'Password', ['class' => 'form-label']) !!}

                                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'user Password']) !!}
                                    @error('password')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">

                                    {!! Form::label('address', 'user Address', ['class' => 'form-label']) !!}

                                    {!! Form::textarea('address', $value = null, [
                                        'class' => 'form-control',
                                        'rows' => 3,
                                        'placeholder' => 'user Address',
                                    ]) !!}
                                    @error('address')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>

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
