<x-backend-layout>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <div class="page-content">
        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">All Plan</li>
                </li>
            </ol>
            <a href="{{ route('permission.index') }}" class="btn btn-inverse-info">Show All Permission</a>

        </nav>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Permission</h6>
                        {{ Form::open(['route' => 'permission.store', 'class' => 'forms-sample', 'method' => 'post']) }}
                        <div class="row">

                            <div class="mb-3">

                                {!! Form::label('name', 'Permission Name', ['class' => 'form-label']) !!}

                                {!! Form::text('name', $value = null, ['class' => 'form-control', 'placeholder' => 'Permission Name']) !!}
                                @error('name')
                                    <span class="text-danger pt-3">{{ $message }}</span>
                                @enderror

                            </div>

                        </div>
                        <div class="row">

                            <div class="mb-3">
                                {!! Form::label('plan_heading', 'Plan Heading', ['class' => 'form-label']) !!}
                                <select name="group_name" class="form-select" id="exampleFormControlSelect1">
                                    <option selected="" disabled="">Select Group</option>
                                    <option value="type">Property Type</option>
                                    <option value="propertysize">Property Size</option>
                                    <option value="module">Module</option>
                                    <option value="budgetrange">Budget Range</option>
                                    <option value="plan">Property Plan</option>
                                    <option value="country">Country</option>
                                    <option value="state">State</option>
                                    <option value="city">City</option>
                                    <option value="neighborhoodcities">Neighborhood City</option>
                                    <option value="amenities">Amenities</option>
                                    <option value="facilities">Facilities</option>
                                    <option value="property">Property</option>
                                    <option value="history">Package History </option>
                                    <option value="message">Property Message </option>
                                    <option value="testimonials">Testimonials</option>
                                    <option value="agent">Manage Agent</option>
                                    <option value="category">Blog Category</option>
                                    <option value="post">Blog Post</option>
                                    <option value="comment">Blog Comment</option>
                                    <option value="smtp">SMTP Setting</option>
                                    <option value="site">Site Setting</option>
                                    <option value="role">Role & Permission </option>
                                    <option value="admin">Admin </option>
                                    <option value="image_preset">Image Preset </option>
                                </select>
                                @error('group_name')
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

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    amenitis_name: {
                        required: true,
                    },

                },
                messages: {
                    amenitis_name: {
                        required: 'Please Enter Amenities Name',
                    },

                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
</x-backend-layout>
