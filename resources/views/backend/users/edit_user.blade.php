<x-backend-layout>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                </li>
            </ol>
            <a href="{{ route('admin.users') }}" class="btn btn-inverse-info">All User</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Edit User</h6>
                        {!! Form::open([
                            'method' => 'put',
                            'route' => ['admin.user_update'],
                            'files' => true,
                            'class' => 'forms-sample',
                        ]) !!}
                        <div class="mb-3">
                            <img class="wd-70 rounded-circle" id="showImage"
                                src="{{ !empty($user->photo) ? asset($user->photo) : url('upload/no_image.jpg') }}"
                                alt="profile">
                        </div>
                        <div class="mb-3">
                            <x-input-label for="photo" :value="__('Photo')" />
                            <x-text-input id="photo" class="form-control" type="file" name="photo"
                                id="image" />
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">



                                    {!! Form::label('username', 'user Username', ['class' => 'form-label']) !!}

                                    {!! Form::text('username', $value = $user->username, [
                                        'class' => 'form-control',
                                        'placeholder' => 'user Username',
                                    ]) !!}
                                    @error('username')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    {!! Form::hidden('user_id', $value = $user->id) !!}


                                    {!! Form::label('name', 'user Name', ['class' => 'form-label']) !!}

                                    {!! Form::text('name', $value = $user->name, ['class' => 'form-control', 'placeholder' => 'user Name']) !!}
                                    @error('name')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">

                                    {!! Form::label('email', 'user Email', ['class' => 'form-label']) !!}

                                    {!! Form::email('email', $value = $user->email, ['class' => 'form-control', 'placeholder' => 'user Email']) !!}
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

                                    {!! Form::text('phone', $value = $user->phone, ['class' => 'form-control', 'placeholder' => 'user Phone']) !!}
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

                                    {!! Form::textarea('address', $value = $user->address, [
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



                        <div class="mb-3">
                            <?php
                            $status = [
                                '0' => 'Active',
                                '1' => 'Inactive',
                            ];
                            ?>
                            {!! Form::label('status', 'Status', ['class' => 'form-label']) !!}

                            {!! Form::Select('status', $status, $user->status, [
                                'class' => 'form-control',
                                'placeholder' => 'Select Status',
                            ]) !!}
                            @error('status')
                                <span class="text-danger pt-3">{{ $message }}</span>
                            @enderror
                        </div>
                        {!! Form::submit('Update', ['class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0']) !!}
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>

    </div>
</x-backend-layout>
