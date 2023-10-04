<div class="full-row bg-dark">
            <div class="container">
                <div class="row">
                    <div class="col mb-4">
                        <div class="align-items-center d-flex">
                            <div class="me-auto">
                                <h2 class="d-table text-white">Recent Properties</h2>
                            </div>
                            <a href="property-grid-v1.html" class="ms-auto btn-link">View All Properties</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="3block-carusel nav-disable owl-carousel">
                            @php
                $properties = App\Models\Property::where('featured', 1)
                    ->where('status', 1)
                    ->limit(3)
                    ->get();
                
                // dd($property);
                
            @endphp
             @foreach ($properties as $property)
                            <div class="item">
                                <!-- Property Grid -->
                                <div class="property-grid-1 property-block bg-white transation-this">
                                    <div class="overflow-hidden position-relative transation thumbnail-img bg-secondary hover-img-zoom">
                                        <div class="cata position-absolute"><span class="sale bg-secondary text-white">For {{ ucfirst($property->property_status) }}</span></div>
                                        <a href="#"><img src="{{ asset($property->property_thumbnail) }}" alt="Image Not Found!"></a>
                                        <a href="#" class="listing-ctg text-white"><i class="fa-solid fa-building"></i><span>{{ucfirst( $property->type->type_name) }}</span></a>
                                        <ul class="position-absolute quick-meta">
                                            <li><a href="javascript:void(0)" title="Add Compare" class="action-btn {{ $property->compare($property->id) != 0 ? 'compactive' : '' }} proc_{{ $property->id }}" id="{{ $property->id }}" onclick="addToCompare(this.id)"><i class="flaticon-transfer flat-mini"></i></a></li>
                                            <li><a href="javascript:void(0)" title="Add Wishlist" class="action-btn {{ $property->wishlist($property->id) != 0 ? 'wishactive' : '' }} pro_{{ $property->id }}" id="{{ $property->id }}" onclick="addToWishList(this.id)"><i class="flaticon-like-1 flat-mini"></i></a></li>
                                            {{-- <li class="md-mx-none"><a class="quick-view" href="#quick-view" title="Quick View"><i class="flaticon-zoom-increasing-symbol flat-mini"></i></a></li> --}}
                                        </ul>
                                    </div>
                                    <div class="property_text p-4">
                                        <span class="listing-price">{{  MONEY }}{{ number_format($property->lowest_price, 2) }} {{  $property->property_status =='rent' ? "( Yearly )":"( Only )"  }}</span>
                                        <h5><a class="font-700 text-secondary" href="{{ url('property/details/' . $property->id . '/' . $property->property_slug) }}">{{ ucfirst($property->property_name) }}</a></h5>
                                        <span class="listing-location"><i class="fas fa-map-marker-alt"></i> {{ $property->address }}</span>
                                        <ul class="d-flex quantity font-fifteen">
                                            <li title="Beds"><span><i class="fa-solid fa-bed"></i></span>{{ $property->bedrooms }}</li>
                                            <li title="Baths"><span><i class="fa-solid fa-shower"></i></span>{{ $property->bathrooms }}</li>
                                            <li title="Area"><span><i class="fa-solid fa-vector-square"></i></span>{{ $property->property_size }} {{ $property->propertysizes->name}}</li>                                            
                                        </ul>
                                    </div>
                                    <div class="d-flex align-items-center post-meta mt-2 py-3 px-4 border-top">
                                        <div class="agent">
                                            <a href="#" class="d-flex text-general align-items-center"><img class="rounded-circle me-2" src="{{ !empty($property->user->photo) ? asset($property->user->photo) : url('upload/no_image.jpg') }}" alt="avata"><span>{{ isset($property->user->name) ? $property->user->name : 'Admin' }}</span></a>
                                        </div>
                                        <div class="post-date ms-auto"><span>{{ \Carbon\Carbon::parse($property->created_at)->format('d/m/Y')}}</span></div>
                                    </div>
                                </div>
                            </div>
                   @endforeach          
                        </div>
                    </div>
                </div>
            </div>
        </div>