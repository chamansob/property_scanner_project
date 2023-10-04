<x-backend-layout>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Modules</li>
                </li>
            </ol>
            <a href="{{ route('modules.index') }}" class="btn btn-inverse-info">Show All Modules</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Module</h6>

                        {{ Form::open(['route' => 'modules.store', 'class' => 'forms-sample', 'method' => 'post', 'files' => true]) }}
                        
                        <div class="mb-3">

                            {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}

                            {!! Form::text('name', $value = null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
                            @error('name')
                                <span class="text-danger pt-3">{{ $message }}</span>
                            @enderror
                        </div>
                         <div class="mb-3">

                            {!! Form::label('heading', 'Heading', ['class' => 'form-label']) !!}

                            {!! Form::text('heading', $value = null, ['class' => 'form-control', 'placeholder' => 'Heading']) !!}
                           
                        </div>
                        <div class="mb-3">

                            {!! Form::label('link', 'Link', ['class' => 'form-label']) !!}

                            {!! Form::text('link', $value = null, ['class' => 'form-control', 'placeholder' => 'Link']) !!}
                           
                        </div>
                        <div class="mb-3">

                            {!! Form::label('small_text', 'Small text', ['class' => 'form-label']) !!}

                            {!! Form::textarea('small_text', $value = null, ['class' => 'form-control','rows'=>3, 'placeholder' => 'Small Text']) !!}
                           
                        </div>
                        <div class="row">

                            <div class="mb-3">
                                {!! Form::label('image', 'Image', ['class' => 'form-label']) !!}

                                {!! Form::file('image', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Main Thumbnail',
                                    'onchange' => 'mainThamUrl(this)',
                                ]) !!}
                                @error('image')
                                    <span class="text-danger pt-3">{{ $message }}</span>
                                @enderror
                                <img src="" id="mainThmb">

                            </div>

                        </div>
                         <div class="mb-3">

                            {!! Form::label('text', 'Text', ['class' => 'form-label']) !!}

                            {!! Form::textarea('text', $value = null, ['class' => 'form-control', 'placeholder' => 'Text']) !!}
                           
                        </div>
                        {!! Form::submit('Submit', ['class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0']) !!}
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>

    </div>
</x-backend-layout>
