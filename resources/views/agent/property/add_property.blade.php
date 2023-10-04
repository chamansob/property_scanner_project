<x-backend-agent-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <div class="page-content">

        <nav class="page-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Property</li>
                </li>
            </ol>
            <a href="{{ route('agent.properties') }}" class="btn btn-inverse-info">Show All Property</a>

        </nav>

        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Add Property Type</h6>
                        {{ Form::open(['route' => 'agent.properties.store', 'class' => 'forms-sample', 'id' => 'myForm', 'method' => 'post', 'files' => true]) }}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    {!! Form::label('property_name', 'Property Name(<span class="errors">*</span>)', ['class' => 'form-label'],false) !!}

                                    {!! Form::text('property_name', $value = null, ['class' => 'form-control', 'placeholder' => 'Property Name']) !!}
                                    @error('property_name')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">

                                    {!! Form::label('property_status', 'Property Status(<span class="errors">*</span>)', ['class' => 'form-label'],false) !!}
                                    <?php
                                    $status = [
                                        'rent' => 'Rent',
                                        'sale' => 'Sale',
                                    ];
                                    ?>
                                    {!! Form::Select('property_status', $status, null, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Select Status',
                                    ]) !!}
                                    @error('property_status')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">

                                    {!! Form::label('lowest_price', 'Listing Price(<span class="errors">*</span>)', ['class' => 'form-label'],false) !!}

                                    {!! Form::text('lowest_price', $value = null, ['class' => 'form-control', 'placeholder' => 'Listing Price']) !!}
                                    @error('lowest_price')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">

                                    {!! Form::label('max_price', 'Special Price', ['class' => 'form-label'],false) !!}

                                    {!! Form::text('max_price', $value = null, ['class' => 'form-control', 'placeholder' => 'Special Price']) !!}
                                    @error('max_price')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-3">

                                    {!! Form::label('property_thambnail', 'Main Thumbnail(<span class="errors">*</span>)', ['class' => 'form-label'],false) !!}

                                    {!! Form::file('property_thumbnail', [
                                        'class' => 'form-control',
                                        'placeholder' => 'Main Thumbnail',
                                        'onchange' => 'mainThamUrl(this)',
                                    ]) !!}
                                    @error('property_thumbnail')
                                        <span class="text-danger pt-3">{{ $message }}</span>
                                    @enderror
                                    <img src="" id="mainThmb">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-3">

                                    {!! Form::label('multi_img', 'Multiple Image', ['class' => 'form-label'],false) !!}

                                    {!! Form::file('multi_img[]', [
                                        'class' => 'form-control',
                                        'id' => 'multiImg',
                                        'multiple' => true,
                                        'placeholder' => 'Multiple Image',
                                    ]) !!}
                                    <div class="row mt-3 gap-2" id="preview_img"> </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">

                                <div class="mb-3">

                                    {!! Form::label('bedrooms', 'BedRooms(<span class="errors">*</span>)', ['class' => 'form-label'],false) !!}

                                    {!! Form::number('bedrooms', $value = null, ['class' => 'form-control', 'placeholder' => 'BedRooms']) !!}

                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">

                                <div class="mb-3">

                                    {!! Form::label('bathrooms', 'Bathrooms(<span class="errors">*</span>)', ['class' => 'form-label'],false) !!}

                                    {!! Form::number('bathrooms', $value = null, ['class' => 'form-control', 'placeholder' => 'Bathrooms']) !!}

                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    {!! Form::label('garage', 'Maid Room', ['class' => 'form-label'],false) !!}

                                    {!! Form::number('garage', $value = null, ['class' => 'form-control', 'placeholder' => 'Maid Room']) !!}

                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    {!! Form::label('garage_size', 'Parkings', ['class' => 'form-label'],false) !!}

                                    {!! Form::number('garage_size', $value = null, ['class' => 'form-control', 'placeholder' => 'Parkings']) !!}

                                </div>
                            </div><!-- Col -->

                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="mb-3">

                                    {!! Form::label('address', 'Address', ['class' => 'form-label'],false) !!}

                                    {!! Form::text('address', $value = null, ['class' => 'form-control', 'placeholder' => 'Address']) !!}

                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    {!! Form::label('states', 'State(<span class="errors">*</span>)', ['class' => 'form-label'],false) !!}
                                    {!! Form::Select('states', $state, null, [
                                        'class' => 'form-control',
                                        'id' => 'states',
                                        'placeholder' => 'Select State',
                                    ]) !!}

                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-3">
                                <div class="mb-3">
                                    {!! Form::label('city', 'City', ['class' => 'form-label'],false) !!}

                                    {!! Form::Select('city', [], null, [
                                        'class' => 'form-control',
                                        'id' => 'cities_list',
                                        'placeholder' => 'Select city',
                                    ]) !!}
                                </div>
                            </div><!-- Col -->

                            <div class="col-sm-3">
                                <div class="mb-3">
                                    {!! Form::label('postal_code', 'Developer', ['class' => 'form-label'],false) !!}

                                    {!! Form::text('postal_code', $value = null, ['class' => 'form-control', 'placeholder' => 'Developer']) !!}

                                </div>
                            </div><!-- Col -->

                        </div>
                      <div class="row">

                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            {!! Form::label('property_size', 'Property Size(<span class="errors">*</span>)', ['class' => 'form-label'],false) !!}

                                            {!! Form::text('property_size', $value = null, [
                                                'class' => 'form-control',
                                                'id' => 'property_size',
                                                'placeholder' => 'Property Size',
                                            ]) !!}
                                            @error('property_size')
                                                <span class="text-danger pt-3">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            {!! Form::label('propertysizes', 'Property Sizes', ['class' => 'form-label', 'id' => 'propertysizes']) !!}

                                            {!! Form::Select('propertysizes', $propertysizes, null, [
                                                'class' => 'form-control',
                                            ]) !!}

                                        </div>
                                    </div>
                                </div>

                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    {!! Form::label('property_video', 'Property Video Url', ['class' => 'form-label'],false) !!}

                                    {!! Form::text('property_video', $value = null, ['class' => 'form-control', 'placeholder' => 'Property Video Url']) !!}

                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-4">
                                <div class="mb-3">
                                    {!! Form::label('neighborhood', 'Neighborhood', ['class' => 'form-label'],false) !!}

                                    {!! Form::Select('neighborhood', [], null, [
                                        'class' => 'form-control',
                                        'id' => 'neighborhoodcityinfo',
                                        'placeholder' => 'Select Neighborhood city',
                                    ]) !!}
                                   
                                </div>
                            </div><!-- Col -->

                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    {!! Form::label('latitude', 'Google Map Link', ['class' => 'form-label'],false) !!}

                                    {!! Form::text('latitude', $value = null, ['class' => 'form-control', 'placeholder' => 'Google Map Link']) !!}
                                    <div class="pt-2"><a href="https://www.google.com/maps/"
                                            target="_blank">Go
                                            Google Map</a></div>

                                </div>
                            </div><!-- Col -->
                            </div>
                             {{-- <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-3">
                                    {!! Form::label('longitude', 'Longitude', ['class' => 'form-label'],false) !!}

                                    {!! Form::text('longitude', $value = null, ['class' => 'form-control', 'placeholder' => 'Longitude']) !!}
                                    <div class="pt-2"><a href="https://www.latlong.net/convert-address-to-lat-long.html"
                                            target="_blank">Go
                                            here to get Longitude from address</a></div>

                                </div>
                            </div><!-- Col --> --}}
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="mb-3 form-group">
                                    {!! Form::label('ptype_id', 'Property Type(<span class="errors">*</span>)', ['class' => 'form-label'],false) !!}

                                    {!! Form::Select('ptype_id', $type, null, [
                                        'class' => 'form-control js-example-basic-single',
                                        'placeholder' => 'Select Property Type',
                                    ]) !!}

                                </div>
                            </div><!-- Col -->
                            <div class="col-sm-6">
                                <div class="mb-3 form-group">
                                    {!! Form::label('amenities_id', 'Property Amenities(<span class="errors">*</span>)', ['class' => 'form-label'],false) !!}
                                    {!! Form::select('amenities_id[]', $value = $amenities, null, [
                                        'class' => 'form-control js-example-basic-multiple',
                                        'multiple' => true,
                                    ]) !!}


                                </div>
                            </div><!-- Col -->


                        </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                                {!! Form::label('short_descp', 'Short Description(<span class="errors">*</span>)', ['class' => 'form-label'],false) !!}

                                {!! Form::Textarea('short_descp', $value = null, [
                                    'class' => 'form-control',
                                    'rows' => 2,
                                    'placeholder' => 'Short Description',
                                ]) !!}

                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-12">
                            <div class="mb-3">
                                {!! Form::label('long_descp', 'Long Description', ['class' => 'form-label'],false) !!}

                                {!! Form::Textarea('long_descp', $value = null, [
                                    'class' => 'form-control',                                   
                                    'rows' => 2,
                                    'placeholder' => 'Long Description',
                                ]) !!}

                            </div>
                        </div><!-- Col -->


                        <!-- Facilities Option Started -->
                        <div class="row add_item">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    {!! Form::label('facility_name', 'Facilities', ['class' => 'form-label'],false) !!}

                                    <select name="facility_name[]" id="facility_name" class="form-control">
                                        <option value="">Select Facility</option>
                                        <option value="Hospital">Hospital</option>
                                        <option value="SuperMarket">Super Market</option>
                                        <option value="School">School</option>
                                        <option value="Entertainment">Entertainment</option>
                                        <option value="Pharmacy">Pharmacy</option>
                                        <option value="Airport">Airport</option>
                                        <option value="Railways">Railways</option>
                                        <option value="Bus Stop">Bus Stop</option>
                                        <option value="Beach">Beach</option>
                                        <option value="Mall">Mall</option>
                                        <option value="Bank">Bank</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="distance" class="form-label"> Distance </label>
                                    <input type="text" name="distance[]" id="distance" class="form-control"
                                        placeholder="Distance (Km)">
                                </div>
                            </div>
                            <div class="form-group col-md-4" style="padding-top: 30px;">
                                <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add More..</a>
                            </div>
                        </div>
                        <!---End Facilities Option Started-->





                        <!--========== Start of add multiple class with ajax ==============-->
                        <div style="visibility: hidden">
                            <div class="whole_extra_item_add" id="whole_extra_item_add">
                                <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                                    <div class="container mt-2">
                                        <div class="row">

                                            <div class="form-group col-md-4">
                                                <label for="facility_name">Facilities</label>
                                                <select name="facility_name[]" id="facility_name" class="form-control">
                                                    <option value="">Select Facility</option>
                                                    <option value="Hospital">Hospital</option>
                                                    <option value="SuperMarket">Super Market</option>
                                                    <option value="School">School</option>
                                                    <option value="Entertainment">Entertainment</option>
                                                    <option value="Pharmacy">Pharmacy</option>
                                                    <option value="Airport">Airport</option>
                                                    <option value="Railways">Railways</option>
                                                    <option value="Bus Stop">Bus Stop</option>
                                                    <option value="Beach">Beach</option>
                                                    <option value="Mall">Mall</option>
                                                    <option value="Bank">Bank</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="distance">Distance</label>
                                                <input type="text" name="distance[]" id="distance"
                                                    class="form-control" placeholder="Distance (Km)">
                                            </div>
                                            <div class="form-group col-md-4" style="padding-top: 20px">
                                                <span class="btn btn-success btn-sm addeventmore"><i
                                                        class="fa fa-plus-circle">Add</i></span>
                                                <span class="btn btn-danger btn-sm removeeventmore"><i
                                                        class="fa fa-minus-circle">Remove</i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <!----For Section-------->

                        <!--========== End of add multiple class with ajax ==============-->
                        {!! Form::submit('Submit', ['class' => 'btn btn-outline-primary btn-icon-text mb-2 mb-md-0']) !!}
                        {{ Form::close() }}

                    </div>
                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            var counter = 0;
            $(document).on("click", ".addeventmore", function() {
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", ".removeeventmore", function(event) {
                $(this).closest("#whole_extra_item_delete").remove();
                counter -= 1
            });
        });
    </script>
    <!--========== End of add multiple class with ajax ==============-->

    <script type="text/javascript">
        $(function() {
            'use strict';

            // $.validator.setDefaults({
            //     submitHandler: function() {
            //         alert("submitted!");
            //     }
            // });
            $(function() {
                $('#short_descp').maxlength({
    alwaysShow: true,
    warningClass: "badge mt-1 bg-success",
    limitReachedClass: "badge mt-1 bg-danger"
  });
  
                $('#myForm').validate({
                    rules: {
                        property_name: {
                            required: true,
                        },
                        property_status: {
                            required: true,
                        },
                        lowest_price: {
                            required: true,
                        },
                        
                        property_thumbnail:{
                            required: true,
                            extension: "jpeg|jpg|png|gif|webp"
                        },
                        bedrooms: {
                            required: true,
                        },  
                         bathrooms: {
                            required: true,
                        },                       
                        states: { 
                            required: true,
                        },                        
                        ptype_id: {
                              required: true,
                        },
                        property_size: {
                            required: true,
                        },
                        propertysizes: {
                            required: true,
                        },
                        property_type: {
                            required: true,
                        },
                        "amenities_id[]": {
                            required: true,
                        },
                        short_descp:{
                             required: true,
                        }
                        

                    },
                    messages: {
                        property_name: {
                            required: 'Please Enter Property Name',
                        },
                        property_status: {
                            required: 'Please Select Property Status',
                        },
                        lowest_price: {
                            required: 'Please Enter Lowest Price',
                        },
                      
                         bedrooms: {
                            required: 'Please Enter Bedrooms',
                        }, 
                        bathrooms:{
                            required: 'Please Enter bathrooms',
                        },                     
                         states: {
                            required: 'Please Select State Name',
                        },
                                
                        ptype_id: {
                            required: 'Please Select Property Type',
                        },                        
                        property_size: {
                            required: 'Please Enter Property Size',
                        },
                        propertysizes: {
                            required: 'Please Enter Property Sizes',
                        },
                        property_type: {
                            required: 'Please Enter Property Type',
                        },                        
                        "amenities_id[]":{ 
                            required: 'Please Enter Property Amenities',
                        },
                        short_descp:{
                             required: 'Please Enter Short Description',
                        }
                        
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
        });
    </script>


    <script type="text/javascript">
        function mainThamUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThmb').attr('src', e.target.result).width(80).height(80);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $('#states').on('change', function() {
                var state_id = this.value;
                var crf = '{{ csrf_token() }}';
                $.ajax({
                    url: "states",
                    type: "POST",
                    data: {
                        _token: crf,
                        state_id: state_id
                    },
                    cache: false,
                    success: function(result) {
                        $("#cities_list").html(result);
                    }
                });
            });
            $('#cities_list').on('change', function() {
                var city_id = this.value;
                var crf = '{{ csrf_token() }}';
                $.ajax({
                    url: "{{ route('allneighborhoodcities') }}",
                    type: "POST",
                    data: {
                        _token: crf,
                        city_id: city_id
                    },
                    cache: false,
                    success: function(result) {
                        $("#neighborhoodcityinfo").html(result);
                    }
                });
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change                
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png|webp)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass(
                                            'thumb img-responsive border border-1')
                                        .attr('src',
                                            e.target.result).width(100)
                                        .height(80); //create image element 
                                    $('#preview_img').append(
                                        img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>
</x-backend-agent-layout>
