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
                        <h6 class="card-title">Edit Permission</h6>
                        {!! Form::open([
                            'method' => 'put',
                            'route' => ['permission.update', $permission->id],
                            'class' => 'forms-sample',
                        ]) !!}<div class="row">

                            <div class="mb-3">

                                {!! Form::label('name', 'Permission Name', ['class' => 'form-label']) !!}

                                {!! Form::text('name', $value = $permission->name, [
                                    'class' => 'form-control',
                                    'placeholder' => 'Permission Name',
                                ]) !!}
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
                                    <option value="type" {{ $permission->group_name == 'type' ? 'selected' : '' }}>
                                        Property Type</option>
                                    <option value="country" {{ $permission->group_name == 'country' ? 'selected' : '' }}>Country
                                    </option>
                                    <option value="state" {{ $permission->group_name == 'state' ? 'selected' : '' }}>State
                                    </option>
                                    <option value="city" {{ $permission->group_name == 'city' ? 'selected' : '' }}>City
                                    </option>
                                     <option value="neighborhoodcities" {{ $permission->group_name == 'neighborhoodcities' ? 'selected' : '' }}>Neighborhood City
                                    </option>
                                    <option value="amenities"
                                        {{ $permission->group_name == 'amenities' ? 'selected' : '' }}>Amenities</option>
                                        <option value="facilities"
                                        {{ $permission->group_name == 'facilities' ? 'selected' : '' }}>Facilities</option>
                                    <option value="propertysize" {{ $permission->group_name == 'propertysize' ? 'selected' : '' }}>
                                        Property Size</option>
                                        <option value="plan" {{ $permission->group_name == 'plan' ? 'selected' : '' }}>
                                        Property Plan</option>
                                        <option value="property" {{ $permission->group_name == 'property' ? 'selected' : '' }}>
                                        Property</option>
                                         <option value="module" {{ $permission->group_name == 'module' ? 'selected' : '' }}>
                                        Module </option>
                                         <option value="budgetrange" {{ $permission->group_name == 'budgetrange' ? 'selected' : '' }}>
                                        Budget Range </option>
                                    <option value="history" {{ $permission->group_name == 'history' ? 'selected' : '' }}>
                                        Package History </option>
                                    <option value="message" {{ $permission->group_name == 'message' ? 'selected' : '' }}>
                                        Property Message </option>
                                    <option value="testimonials"
                                        {{ $permission->group_name == 'testimonials' ? 'selected' : '' }}>Testimonials
                                    </option>
                                    <option value="agent" {{ $permission->group_name == 'agent' ? 'selected' : '' }}>
                                        Manage Agent</option>
                                    <option value="category" {{ $permission->group_name == 'category' ? 'selected' : '' }}>
                                        Blog Category</option>
                                    <option value="post" {{ $permission->group_name == 'post' ? 'selected' : '' }}>Blog
                                        Post</option>
                                    <option value="comment" {{ $permission->group_name == 'comment' ? 'selected' : '' }}>
                                        Blog Comment</option>
                                    <option value="smtp" {{ $permission->group_name == 'smtp' ? 'selected' : '' }}>SMTP
                                        Setting</option>
                                    <option value="site" {{ $permission->group_name == 'site' ? 'selected' : '' }}>Site
                                        Setting</option>
                                    <option value="role" {{ $permission->group_name == 'role' ? 'selected' : '' }}>Role &
                                        Permission </option>
                                        <option value="role" {{ $permission->group_name == 'admin' ? 'selected' : '' }}>
                                        Admin </option>
                                         <option value="image_preset" {{ $permission->group_name == 'image_preset' ? 'selected' : '' }}>
                                        Image Preset  </option>
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
