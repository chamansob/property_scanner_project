@if (!Auth::check())
<script>
    window.location = "/login";
</script>
@endif
<x-frontend-layout>
    @section('title')
    Property Details
    @endsection
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>


    <!--============== Pricing Start ==============-->
    <div class="full-row property-overview property-info py-30" >
        <div class="container">
            <div class="row">
                <div class="col-auto">
                    <div class="post-meta font-small text-uppercase list-color-primary">
                        <a href="#" class="listing-ctg"><i class="fa-solid fa-building"></i><span>{{
                                $property->type->type_name }}</span></a>
                    </div>
                    <h4 class="listing-title"><a href="#">{{ $property->property_name }}</a></h4>
                    <span class="listing-location"><i class="fas fa-map-marker-alt text-primary"></i>
                        {{ $property->address }}</span>
                    <a href="#" class="d-block text-light hover-text-primary font-small mb-2">( 100 People
                        Recommended )</a>
                </div>
                <div class="col-auto ms-auto xs-m-0 text-end xs-text-start pb-4">
                    <span class="listing-price">{{  MONEY }}{{ number_format($property->lowest_price, 2) }}{{ $property->property_status =='rent' ? "( Yearly )":"( Only )" }}</span>
                    <span class="text-white font-mini px-2 rounded product-status ms-auto xs-m-0 py-1 bg-primary"><i
                            class="fas fa-check"></i> Available</span>
                </div>
            </div>
        </div>
    </div>
    <!--============== Pricing End ==============-->

    <!--============== Property Slider Start ==============-->
    <div class="full-row pt-0">
        <div class="container">
            <div class="row g-0">
                @foreach ($multiImage as $multi)
                @php
                $img = explode('.', $multi->photo_name);
                $small_img = $img[0] . '_small.' . $img[1];
                @endphp
                <div class="col-3">
                    <div class="row row-cols-1 g-0">
                        <div class="col">
                            <div class="hover-img-zoom overflow-hidden transation">
                                <a href="{{ asset($multi->photo_name) }}" data-fancybox="gallery"
                                    data-caption="Caption for single image">
                                    <img class="transation" src="{{ asset($multi->photo_name) }}">
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--============== Property Slider End ==============-->

    <!--============== Property Details Start ==============-->
    <div class="full-row pt-0">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 order-xl-2">
                    <!-- Message Form -->                    
                    @auth
                    @if ($property->agent_id == null)
                    @php
                  
                        $image= !empty($admin->photo) ? url($admin->photo) : url('upload/no_image.jpg');
                        $role=$admin->role;
                        $name =$admin->name;
                        $email =$admin->email;
                        $phone =$admin->phone;
                    @endphp
                    @else
                    @php
                        $image=!empty($property->user->photo) ? url($property->user->photo) : url('upload/no_image.jpg');   
                        $role=$property->user->role;
                        $name =$property->user->name;
                        $email =$property->user->email;
                        $phone =$property->user->phone;
                    @endphp
                    @endif
                    <div class="widget widget_contact bg-white border p-30 shadow-one rounded mb-30">
                        <h5 class="mb-4">Listed By</h5>
                        <div class="media mb-3">
                            <img class="rounded-circle me-3" src="{{ $image }}" alt="avata">
                            <div class="media-body">
                                <div class="h6 mt-0">{{ ucfirst($name) }}</div>
                                <span class="d-flex"><a href="tel:{{ $phone }}">{{ $phone }}</a></span>
                                <span class="d-flex"><a href="mailto:{{ $email }}">{{ $email }}</a></span>
                            </div>
                        </div>
                        @php
                                $id = Auth::user()->id;
                                $userData = App\Models\User::find($id);
                            @endphp
                            {{ Form::open(['route' => 'property.message', 'method' => 'post', 'class' => 'quick-search form-icon-right']) }}
                                {!! Form::hidden('property_id', $value = $property->id) !!}
                                {!! Form::hidden('agent_id', $value = $property->agent_id == null ? null : $property->agent_id) !!}
                               
                       
                            <div class="form-row">
                                <div class="col-12 mb-10">
                                    <div class="form-group mb-0">
                                        {!! Form::text('msg_name', $value = $userData->name, ['class' => 'form-control', 'placeholder' => 'Your Name']) !!}
                                    </div>
                                </div>
                                <div class="col-12 mb-10">
                                    <div class="form-group mb-0">
                                        {!! Form::email('msg_email', $value = $userData->email, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Your Email',
                                    ]) !!}
                                    </div>
                                </div>
                                <div class="col-12 mb-10">
                                    <div class="form-group mb-0">
                                         {!! Form::text('msg_phone', $value = $userData->phone, [
                                        'class' => 'form-control',
                                        'placeholder' => 'Your Phone',
                                    ]) !!}
                                    </div>
                                </div>
                                <div class="col-12 mb-10">
                                    <div class="form-group mb-0">
                                       {!! Form::Textarea('message', $value = null, [
                                        'class' => 'form-control',
                                        'rows' => 2,
                                        'placeholder' => 'Message',
                                    ]) !!}
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-0">                                        
                                        {!! Form::submit('Send Message', ['class' => 'btn btn-primary w-100']) !!}
                                    </div>
                                </div>
                            </div>
                        {{ Form::close() }}
                    </div>
                   
                    
                      @endauth
                    <!--============== Recent Property Widget Start ==============-->
                    {{-- <div class="widget widget_recent_property">
                        <h5 class="text-secondary mb-4">Recent Property</h5>
                        <ul>
                            <li>
                                <img src="assets/images/thumbnaillist/01.jpg" alt="">
                                <div class="thumb-body">
                                    <h6 class="listing-title"><a href="property-single-1.html">Nirala Appartment</a>
                                    </h6>
                                    <span class="listing-price">$3200<small>( Monthly )</small></span>
                                    <ul class="d-flex quantity font-fifteen">
                                        <li title="Area"><span><i class="fa-solid fa-vector-square"></i></span>6500
                                            Sqft</li>

                                    </ul>
                                </div>
                            </li>
                            <li>
                                <img src="assets/images/thumbnaillist/02.jpg" alt="">
                                <div class="thumb-body">
                                    <h6 class="listing-title"><a href="property-single-1.html">Condo House</a></h6>
                                    <span class="listing-price">$11500<small>( Monthly )</small></span>
                                    <ul class="d-flex quantity font-fifteen">
                                        <li title="Area"><span><i class="fa-solid fa-vector-square"></i></span>2200
                                            Sqft</li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <img src="assets/images/thumbnaillist/03.jpg" alt="">
                                <div class="thumb-body">
                                    <h6 class="listing-title"><a href="property-single-1.html">Luxury Condos</a></h6>
                                    <span class="listing-price">$17000<small>( Monthly )</small></span>
                                    <ul class="d-flex quantity font-fifteen">
                                        <li title="Area"><span><i class="fa-solid fa-vector-square"></i></span>3500
                                            Sqft</li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <img src="assets/images/thumbnaillist/04.jpg" alt="">
                                <div class="thumb-body">
                                    <h6 class="listing-title"><a href="property-single-1.html">Small Appartment</a>
                                    </h6>
                                    <span class="listing-price">$5200<small>( Monthly )</small></span>
                                    <ul class="d-flex quantity font-fifteen">
                                        <li title="Area"><span><i class="fa-solid fa-vector-square"></i></span>1200
                                            Sqft</li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div> --}}
                    <!--============== Recent Property Widget End ==============-->
                </div>
                <div class="col-xl-8 order-xl-1">
                    <img src="{{ asset($property->property_thumbnail) }}" alt="{{ $property->property_name }}" class="w-100">
                    <div class="property-overview border summary rounded bg-white p-30 mb-30">
                        
                        <div class="row row-cols-1">
                            <div class="col">
                                <h5 class="mb-3">Description</h5>
                                {!! $property->long_descp !!}
                            </div>
                        </div>
                         <hr>
                        <div class="row mb-4">
                            <div class="col-12">
                                <ul class="quick-meta mt-4">
                                    <li><a href="javascript:void(0)" title="Add Compare"
                                            class="action-btn {{ $property->compare($property->id) != 0 ? 'compactive' : '' }} proc_{{ $property->id }}"
                                            id="{{ $property->id }}" onclick="addToCompare(this.id)"><i
                                                class="flaticon-transfer flat-mini"></i></a></li>
                                    <li><a href="javascript:void(0)" title="Add Wishlist"
                                            class="action-btn {{ $property->wishlist($property->id) != 0 ? 'wishactive' : '' }} pro_{{ $property->id }}"
                                            id="{{ $property->id }}" onclick="addToWishList(this.id)"><i
                                                class="flaticon-like-1 flat-mini"></i></a></li>
                                </ul>

                               

                            </div>
                        </div>
                    </div>

                    <div class="property-overview border rounded bg-white p-30 mb-30">
                        <div class="row row-cols-1">
                            <div class="col">
                                <h5 class="mb-3">Property Summary</h5>
                                <div class="table-striped overflow-x-scroll pb-2">
                                    <table class="w-100">
                                        <tbody>
                                            <tr>
                                                <td>Property Id :</td>
                                                <td>{{ $property->property_code }}</td>
                                                <td>Listing Type :</td>
                                                <td>For {{ $property->property_status }}</td>
                                            </tr>
                                            <tr>
                                                <td>Property Type:</td>
                                                <td>{{ ucfirst($property->type->type_name) }}</td>
                                                <td>Developer :</td>
                                                <td>{{ $property->postal_code }}</td>
                                            </tr>
                                            <tr>
                                                <td> BedRooms:</td>
                                                <td>{{ $property->bedrooms }}</td>
                                                <td>Bathrooms :</td>
                                                <td>{{ $property->bathrooms }}</td>
                                            </tr>
                                            <tr>
                                                <td>Property Size :</td>
                                                <td>{{ $property->property_size }}
                                                    {{ $property->propertysizes->name }}</td>
                                                <td></td>
                                                <td></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="property-overview border rounded bg-white p-30 mb-30">
                        <div class="row row-cols-1">
                            <div class="col">
                                <h5 class="mb-3">Property Amenities</h5>
                                <ul class="list-three-fold-width list-style-tick">
                                    @foreach ($property_amen as $amen)
                                    <li>{{ $amen->amenities_name }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="property-overview border rounded bg-white p-30 mb-30">
                        <div class="row row-cols-1">
                            <div class="col">
                                <h5 class="mb-3">Location</h5>
                                <div class="table-striped overflow-x-scroll pb-2">
                                    <table class="w-100">
                                        <tbody>
                                            <tr>
                                                <td>Address :</td>
                                                <td>{{ $property->address }}</td>
                                                <td>State/county :</td>
                                                <td>For {{ $property->state->name }}</td>
                                            </tr>
                                            <tr>
                                                <td>City:</td>
                                                <td>{{ ucfirst($property->city?->name) }}</td>
                                                <td>Developer :</td>
                                                <td>{{ $property->postal_code }}</td>
                                            </tr>
                                                                                   
                                        </tbody>
                                    </table>
                                   <hr>
                                    <strong>Google Map:</strong> <a href=" {{ $property->latitude }}" target="_blank">Link</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(!empty($property->property_video))
                    <div class="property-overview border rounded bg-white overflow-hidden mb-30">
                        <div class="row row-cols-1">
                            <div class="col">
                                <div class="mt-md-30 position-relative overlay-secondary">
                                    <img src="{{ !empty($property->property_thumbnail) ?  asset($property->property_thumbnail)  : asset('frontend/assets/images/background/bg-1.png') }}" alt="{{ $property->property_name }}" class="w-100">
                                    <a data-fancybox="" class="video-popup" href="{{ $property->property_video }}"
                                        title="video popup">
                                        <span class="flaticon-play-button bg-primary text-white xy-center"></span>
                                    </a>
                                    <div class="loader position-absolute xy-center">
                                        <div class="loader-inner ball-scale-multiple">
                                            <div style="background: var(--theme-primary-color);"></div>
                                            <div style="background: var(--theme-primary-color);"></div>
                                        </div><span class="tooltip">
                                            <b>ball-scale-multiple</b></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="property-overview border rounded bg-white p-30 mb-30">
                        <div class="row row-cols-1">
                            <div class="col">
                                <h5 class="mb-3">Nearby Places</h5>
                                <div class="tab-simple tab-action">

                                    <table class="w-100">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="font-fifteen w-75">Name</th>
                                                <th scope="col" class="font-fifteen w-25">Distance</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($facility as $item)
                                            <tr>
                                                <td>{{ $item->facility_name }}</td>
                                                <td>{{ $item->distance }} km</td>

                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="property-overview border rounded bg-white p-30 mb-30">
                        <div class="row row-cols-1">
                            <div class="col">
                                <h5 class="mb-4">Schedule A Tour</h5>

                                @php
                                if (Auth::check()) {
                                if (Auth::user()->role == 'user') {
                                $schedule = App\Models\Schedule::where('user_id', Auth::user()->id)
                                ->where('property_id', $property->id)
                                ->where('status', 0)
                                ->first();
                                // dd($schedule);
                                $schedule_count = $schedule?->count();
                                } else {
                                $schedule_count = 0;
                                }
                                } else {
                                $schedule_count = 0;
                                }
                                @endphp
                                @if ($schedule_count == 0)
                                <form action="{{ route('store.schedule') }}" class="contact_message form-boder"
                                    method="post" novalidate="novalidate">
                                    @csrf

                                    <input type="hidden" name="property_id" value="{{ $property->id }}">

                                    @if ($property->agent_id == null)
                                    <input type="hidden" name="agent_id" value="">
                                    @else
                                    <input type="hidden" name="agent_id" value="{{ $property->agent_id }}">
                                    @endif
                                    <div class="row g-3">
                                        <div class="col-md-6 col-sm-6 form-groups">
                                            
                                            <input class="form-control" name="tour_date" placeholder="Tour Date"
                                                id="datepicker" type="text">
                                        </div>
                                        <div class="col-md-6 col-sm-6 form-groups">
                                           
                                            <input class="form-control" type="text" name="tour_time"
                                                placeholder="Any Time">
                                        </div>
                                        <div class="col-md-12 col-sm-12">
                                            <textarea class="form-control" id="message" rows="5" name="message"
                                                placeholder="Message"></textarea>
                                        </div>
                                        <div class="col-md-12 col-sm-6">
                                            <button class="btn btn-primary" id="send" value="send" type="submit">Submit
                                                Now</button>
                                        </div>
                                    </div>
                                </form>
                                @else
                                <div class="alert alert-{{ $schedule->status == 0 ? 'danger' : 'success' }}">You
                                    already send a request and your request status is
                                    is <span
                                        class="badge rounded-pill bg-{{ $schedule->status == 0 ? 'danger' : 'success' }} text-white">{{
                                        $schedule->status == 0 ? 'Pendding' : 'Approved' }}</span>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--============== Property Details End ==============-->
 <script>
  $( function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });
  } );
  </script>
</x-frontend-layout>