<x-backend-layout>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Neighborhood Cities</li>
                </li>
            </ol>
            <a href="{{ route('neighborhoodcities.index') }}" class="btn btn-inverse-info">Show All Neighborhood Cities</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Neighborhood City</h6>

                        {{ Form::open(['route' => 'neighborhoodcities.store', 'class' => 'forms-sample', 'method' => 'post']) }}

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    {!! Form::label('country_id', 'Country Name', ['class' => 'form-label']) !!}

                                    {!! Form::Select('country_id', $countries, null, [
                                        'class' => 'form-control',
                                        'id' => 'countryinfo',
                                        'placeholder' => 'Select Country',
                                    ]) !!}

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    {!! Form::label('state_id', 'State Name', ['class' => 'form-label']) !!}

                                    {!! Form::Select('state_id', $states, null, [
                                        'class' => 'form-control',
                                        'id' => 'statesinfo',
                                        'placeholder' => 'Select State',
                                    ]) !!}

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    {!! Form::label('city_id', 'City Name', ['class' => 'form-label']) !!}

                                    {!! Form::Select('city_id', $cites, null, [
                                        'class' => 'form-control',
                                        'id' => 'cityinfo',
                                        'placeholder' => 'Select City',
                                    ]) !!}

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">

                                    {!! Form::label('name', 'Name', ['class' => 'form-label']) !!}

                                    {!! Form::text('name', $value = null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Name',
                                    ]) !!}
                                    @error('name')
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
    <script>
        $(document).ready(function() {
            $('#countryinfo').on('change', function() {
                var country_id = this.value;
                var crf = '{{ csrf_token() }}';
                $.ajax({
                    url: "{{ route('cities.states') }}",
                    type: "POST",
                    data: {
                        _token: crf,
                        country_id: country_id
                    },
                    cache: false,
                    success: function(result) {
                        $("#statesinfo").html(result);
                    }
                });
            });
            $('#statesinfo').on('change', function() {
                var state_id = this.value;
                var crf = '{{ csrf_token() }}';
                $.ajax({
                    url: "{{ route('neighborhoodcities.cities') }}",
                    type: "POST",
                    data: {
                        _token: crf,
                        state_id: state_id
                    },
                    cache: false,
                    success: function(result) {
                        $("#cityinfo").html(result);
                    }
                });
            });

        });
    </script>
</x-backend-layout>
