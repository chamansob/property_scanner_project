<x-backend-layout>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">SMTP Settings </li>
                </li>
            </ol>
            {{-- <a href="#" class="btn btn-inverse-info">Show All Blog </a> --}}

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Update SMTP Setting </h6>
                       
                            {!! Form::open([
                                'method' => 'patch',
                                'route' => ['update.smpt.setting', $setting->id],
                                'class' => 'forms-sample',
                                'id' => 'myForm',
                                'files' => true,
                            ]) !!}
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        {!! Form::label('mailer', 'Mailer', ['class' => 'form-label']) !!}

                                        {!! Form::text('mailer', $value = $setting->mailer, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Mailer',
                                        ]) !!}
                                        @error('mailer')
                                            <span class="text-danger pt-3">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        {!! Form::label('host', 'Host', ['class' => 'form-label']) !!}

                                        {!! Form::text('host', $value = $setting->host, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Host',
                                        ]) !!}
                                        @error('host')
                                            <span class="text-danger pt-3">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        {!! Form::label('port', 'Port', ['class' => 'form-label']) !!}

                                        {!! Form::text('port', $value = $setting->port, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Port',
                                        ]) !!}
                                        @error('port')
                                            <span class="text-danger pt-3">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div><!-- Col -->
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        {!! Form::label('username', 'Username', ['class' => 'form-label']) !!}

                                        {!! Form::text('username', $value = $setting->username, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Username',
                                        ]) !!}
                                        @error('username')
                                            <span class="text-danger pt-3">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                        {!! Form::label('password', 'Password', ['class' => 'form-label']) !!}

                                        {!! Form::text('password', $value = $setting->password, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Password',
                                        ]) !!}
                                        @error('password')
                                            <span class="text-danger pt-3">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-4">
                                    <div class="mb-3">
                                       @php
                                           $data = [
                                        'ssl' => 'SSL',
                                        'tls' => 'TLS',
                                    ];
                                       @endphp
                                        {!! Form::label('encryption', 'Encryption', ['class' => 'form-label']) !!}

                                        {!! Form::select('encryption', $data, $setting->encryption, [
                                            'class' => 'form-control',
                                            'placeholder' => 'Select Encryption',
                                        ]) !!}
                                        @error('encryption')
                                            <span class="text-danger pt-3">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div><!-- Col -->
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        {!! Form::label('from_name', 'From Name', ['class' => 'form-label']) !!}

                                        {!! Form::text('from_name', $value = $setting->from_name, [
                                            'class' => 'form-control',
                                            'placeholder' => 'From Name',
                                        ]) !!}
                                        @error('username')
                                            <span class="text-danger pt-3">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div><!-- Col -->
                                <div class="col-sm-6">
                                    <div class="mb-3">
                                        {!! Form::label('from_address', 'From Address', ['class' => 'form-label']) !!}

                                        {!! Form::text('from_address', $value = $setting->from_address, [
                                            'class' => 'form-control',
                                            'placeholder' => 'From Address',
                                        ]) !!}
                                        @error('from_address')
                                            <span class="text-danger pt-3">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div><!-- Col -->
                            </div>








                            <button type="submit" class="btn btn-primary me-2">Save Changes </button>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>
</x-backend-layout>
