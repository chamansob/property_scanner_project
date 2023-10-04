<x-frontend-layout>

    <!--============== Page title Start ==============-->
    <div class="full-row py-5">
        <div class="container">
            <div class="row">
                <div class="col inner-page-banner">
                    <h3 class="text-secondary">{{ ucfirst($agent->name) }}</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 bg-transparent p-0">
                            <li class="breadcrumb-item"><a href="i{{ url('/') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Agent</a></li>
                            <li class="breadcrumb-item active text-primary" aria-current="page">
                                {{ ucfirst($agent->name) }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!--============== Page title End ==============-->

    <!--============== Agent Details Start ==============-->
    <div class="full-row pt-0">
        <div class="container">
            <div class="row">
                @php
                    if (!empty($agent->photo)) {
                        $img = explode('.', $agent->photo);
                        $table_img = $img[0] . '_agent_avatar.' . $img[1];
                        $table_img = url($table_img);
                    } else {
                        $table_img = url('upload/no_image.jpg');
                    }
                @endphp
                <div class="col-12 agent-style-1 list-view agent-details">
                    <div class="entry-wrapper bg-white transation-this hover-shadow mb-4">
                        <div class="entry-thumbnail-wrapper w-lg-25 w-sm-100 transation  hover-img-zoom">
                            <div class="agent-level">
                                <span title="Agenet level">Agent</span>
                            </div>
                            <img src="{{ $table_img }}" alt="{{ ucfirst($agent->name) }}" class=" img-fluid h-100 ">
                        </div>
                        <div class="entry-content-wrapper w-lg-75 w-sm-100">
                            <div class="entry-header d-flex pb-2">
                                <div class="me-auto">
                                    <h6 class="agent-name text-dark mb-0"><a
                                            href="#">{{ ucfirst($agent->name) }}</a></h6>
                                    <span class="text-primary font-fifteen">From <span
                                            class="text-uppercase">{{ \Carbon\Carbon::parse($agent->created_at)->format('d M,Y ') }}</span></span>
                                </div>
                            </div>
                            <div class="enrey-content">
                                <p>{{ $agent->about }}</p>
                                <ul class="agent-contact py-1">
                                    <li><span>Mobile:</span><a
                                            href="tel:+971{{ $agent->phone }}">+971{{ $agent->phone }}</a></li>
                                    <li><span>Email:</span><a
                                            href="mailto:{{ $agent->email }}">{{ $agent->email }}</a></li>
                                    {{-- <li><span>Language:</span>English, French, Spanish</li> --}}
                                </ul>
                                {{-- <div class="social-media">
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-twitter"></i></a>
                                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                        <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                    </div> --}}
                            </div>
                            {{-- <div class="entry-footer d-flex align-items-center post-meta py-2 border-top">
                                    <div class="agent">
                                        <a href="#" class="d-flex text-general align-items-center">
                                            <img class="rounded-circle mr-2" src="assets/images/logo/1.png" alt="avata"><span>Company Name</span>
                                        </a>
                                    </div>
                                    <div class="customer-review d-flex ms-auto">
                                        <div class="agent-rating d-flex text-dark">
                                            <span title="Feedback Score">4.90 / 5</span>
                                            <div class="rating-star">
                                                <span style="width: 90%"></span>
                                            </div>
                                        </div>
                                        <span class="review-number">( 237 Review )</span>
                                    </div>
                                </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 order-xl-2">
                    <!-- Message Form -->
                    @auth
                        @if (Auth::user()->role == 'user')
                            <div class="widget widget_send_message mb-30">
                                <h5 class="mb-4">Send Message</h5>

                                @php
                                    $id = Auth::user()->id;
                                    $userData = App\Models\User::find($id);
                                @endphp

                                {{ Form::open(['route' => 'agent.details.message', 'class' => 'contact_message form-boder', 'method' => 'post']) }}
                                <div class="row g-3">
                                    <div class="col-md-12 col-sm-12">
                                        <input type="hidden" name="agent_id" value="{{ $agent->id }}">
                                        <input class="form-control" id="name" value="{{ $userData->name }}"
                                            name="msg_name" placeholder="Name" type="text" required>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <input class="form-control" id="email" value="{{ $userData->email }}"
                                            name="msg_email" placeholder="Email Address" type="email" required>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <input class="form-control" id="phone" value="{{ $userData->phone }}"
                                            name="msg_phone" placeholder="Phone Number" type="text" required>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <textarea class="form-control" id="message" rows="5" name="message" placeholder="Message"></textarea>
                                    </div>
                                    <div class="col-md-12 col-sm-6">
                                        <button class="btn btn-primary" id="send" value="send" type="submit">Send
                                            Message</button>
                                    </div>
                                </div>
                                {{ Form::close() }}

                                {{ Form::open(['route' => 'agent.details.message', 'class' => 'contact_message form-boder', 'method' => 'post']) }}
                                <div class="row g-3">
                                    <div class="col-md-12 col-sm-12">
                                        <input type="hidden" name="agent_id" value="{{ $agent->id }}">
                                        <input class="form-control" id="name" name="msg_name" placeholder="Name"
                                            type="text" required>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <input class="form-control" id="email" name="msg_email"
                                            placeholder="Email Address" type="email" required>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <input class="form-control" id="phone" name="msg_phone"
                                            placeholder="Phone Number" type="text" required>
                                    </div>
                                    <div class="col-md-12 col-sm-12">
                                        <textarea class="form-control" id="message" rows="5" name="message" placeholder="Message"></textarea>
                                    </div>
                                    <div class="col-md-12 col-sm-6">
                                        <button class="btn btn-primary" id="send" value="send"
                                            type="submit">Send Message</button>
                                    </div>
                                </div>
                                {{ Form::close() }}


                            </div>
                        @endif
                    @endauth


                    @php
                        $properties = App\Models\Property::where('status', '1')
                            ->limit(3)
                            ->get();
                        
                    @endphp
                    <!--============== Recent Property Widget Start ==============-->
                    {{-- <div class="widget widget_recent_property">
                            <h5 class="text-secondary mb-4">Recent Property</h5>
                            <ul>
                                 @foreach ($properties as $item)
                                     
                                      
                                <li>
                                    <img src="{{ asset($item->property_thumbnail) }}" alt="">
                                    <div class="thumb-body">
                                        <h6 class="listing-title"><a href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}">{{ $item->property_name }}</a></h6>
                                        <span class="listing-price">${{ number_format($item->lowest_price, 2) }}</span>
                                        <ul class="d-flex quantity font-fifteen">
                                            <li title="Area"><span><i
                                                        class="fa-solid fa-vector-square"></i></span>{{ $item->property_size }} {{ $item->propertysizes->name }}</li>

                                        </ul>
                                    </div>
                                </li>
                               @endforeach 
                            </ul>
                        </div> --}}
                </div>
                <div class="col-xl-8 order-xl-1">
                    <div class="entry-wrapper">
                        <!-- Agent Overview -->
                        {{-- <div class="agent-overview p-30 bg-white mb-50">
                                <h4 class="mb-4">Agent Overview</h4>
                                <p>Maecenas egestas quam et volutpat bibendum metus vulputate platea eleifend sed Integer dictum ultricies consectetuer nunc vivamus a. Eu mus justo magna lacinia purus sodales scelerisque. Sociosqu pede facilisi. Sociis pretium gravida auctor mus amet accumsan adipiscing id dignissim, potenti. Curae; massa ridiculus lobortis consectetuer condimentum mollis vulputate hymenaeos tellus egestas auctor dictumst imperdiet curae; quisque ut porta molestie dui duis blandit molestie etiam enim erat sociis lacinia litora phasellus sit. Ipsum Lacinia class enim pharetra interdum potenti tellus parturient. Potenti scelerisque erat facilisi mauris tortor, mattis euismod augue nascetur rutrum augue ipsum tortor cum Porta primis.</p>
                                <p>Praesent lectus facilisi tempor ridiculus arcu pharetra non tellus. Torquent nisl tempor. Magnis mollis lobortis nam, montes ut, consequat sed amet nullam, malesuada nascetur ornare sociosqu magna cum gravida quam tincidunt dapibus tellus felis nibh inceptos netus convallis facilisis torquent. Laoreet pulvinar ut. Fringilla lacus tellus lectus erat hac conubia eget quisque nisi aliquam nibh molestie nisi hymenaeos id phasellus metus duis inceptos arcu hendrerit ligula blandit lectus nisl fermentum sociosqu pretium eros libero.</p>
                            </div> --}}
                        <!-- Agent Properties -->
                        <div class="agent-properties">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-12">
                                    <div class="mix-tab">
                                        <ul class="d-table">
                                            <li data-filter="all">All Property
                                                ({{ $saleproperty->count() + $rentproperty->count() }})</li>
                                            <li data-filter=".sale">For Sale ({{ $saleproperty->count() }})</li>
                                            <li data-filter=".rent">For Rent ({{ $rentproperty->count() }}) </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="tab-content bg-white px-30 py-5">
                                        <div class="mix-element row row-cols-lg-2 row-cols-md-2 g-4 row-cols-1">
                                            @foreach ($property as $item)
                                                <!-- Property Grid -->
                                                <div class="col mix {{ strtolower($item->property_status) }}">
                                                    <div class="property-grid-3 property-block transation">
                                                        <div
                                                            class="overflow-hidden position-relative transation thumbnail-img rounded bg-secondary hover-img-zoom">
                                                            <div class="cata position-absolute">
                                                                <span class="sale bg-secondary text-white">For
                                                                    {{ ucfirst($item->property_status) }}</span>
                                                            </div>
                                                            <a href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}"
                                                                class="d-block">
                                                                <img src="{{ asset($item->property_thumbnail) }}"
                                                                    class="img-fluid img-thumbnail"></a>
                                                            <span
                                                                class="listing-price bg-dark">{{ MONEY }}{{ number_format($item->lowest_price, 2) }}
                                                                {{ $item->property_status =='rent' ? "( Yearly )":"( Only )" }}
                                                            </span>
                                                            <ul class="position-absolute quick-meta">
                                                                <li><a href="javascript:void(0)" title="Add Compare"
                                                                        class="action-btn {{ $item->compare($item->id) != 0 ? 'compactive' : '' }} proc_{{ $item->id }}"
                                                                        id="{{ $item->id }}"
                                                                        onclick="addToCompare(this.id)"><i
                                                                            class="flaticon-transfer flat-mini"></i></a>
                                                                </li>
                                                                <li><a href="javascript:void(0)" title="Add Wishlist"
                                                                        class="action-btn {{ $item->wishlist($item->id) != 0 ? 'wishactive' : '' }} pro_{{ $item->id }}"
                                                                        id="{{ $item->id }}"
                                                                        onclick="addToWishList(this.id)"><i
                                                                            class="flaticon-like-1 flat-mini"></i></a>
                                                                </li>
                                                                {{-- <li class="md-mx-none"><a class="quick-view" href="#quick-view" title="Quick View"><i class="flaticon-zoom-increasing-symbol flat-mini"></i></a></li> --}}
                                                            </ul>
                                                        </div>
                                                        <div class="post-content py-3 px-2">
                                                            <div
                                                                class="post-meta font-small text-uppercase list-color-general">
                                                                <a href="{{ url('property/type/' . $item->type->id) }}"
                                                                    class="listing-ctg"><i
                                                                        class="fa-solid fa-building"></i><span>{{ $item->type->type_name }}</span></a>
                                                            </div>
                                                            <h5 class="listing-title"><a
                                                                    href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}">{{ ucfirst($item->property_name) }}</a>
                                                            </h5>
                                                            <span class="listing-location"><i
                                                                    class="fas fa-map-marker-alt"></i>
                                                                {{ $item->address }}</span>
                                                            <ul class="d-flex quantity font-fifteen">
                                                                <li title="Beds"><span><i
                                                                            class="fa-solid fa-bed"></i></span>{{ $item->bedrooms }}
                                                                </li>
                                                                <li title="Baths"><span><i
                                                                            class="fa-solid fa-shower"></i></span>{{ $item->bathrooms }}
                                                                </li>
                                                                <li title="Area"><span><i
                                                                            class="fa-solid fa-vector-square"></i></span>{{ $item->property_size }}
                                                                    {{ $item->propertysizes->name }}</li>

                                                            </ul>
                                                            <p>{{ $item->short_descp }}</p>
                                                            <div class="entry-footer py-2 p-3 border-top">
                                                                <ul class="d-flex flex-row align-items-center justify-content-center  ">
                                                                    <li class="btn bg-dark me-3 rounded "><a href="tel:+971{{ $agent->phone }}" class="text-white"
                                                                            title="Call"><i
                                                                                class="flaticon-phone-call flat-mini me-1"></i>
                                                                            Call</a></li>
                                                                   <li class="btn bg-dark rounded"><a href="mailto:{{ $agent->email }}" class="text-white"
                                                                            title="Email"><i
                                                                                class="flaticon-envelope flat-mini me-1"></i>
                                                                            Email</a></li>

                                                                    
                                                                </ul>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        <!-- Pagination -->
                                        <div class="col-12 mt-5">
                                            <nav aria-label="Page navigation example">
                                                {{ $property->links('vendor.pagination.custom') }}
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <!-- Agent Review -->
                            <div class="agent-reviews bg-white p-30 mt-4">
                                <div class="row row-cols-1">
                                    <div class="col">
                                        <div id="comments" class="comments">
                                            <div class="comment-head mb-4 gap-4 d-flex align-items-center">
                                                <div class="comment-title">
                                                    <h3>10 User Reviews</h3>
                                                </div>
                                                <div class="user-rating">
                                                    <span class="d-inline-block py-2 font-mini text-warning">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                    </span>
                                                    <span class="d-inline-block py-2">(4.9 out of 5)</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <img src="assets/images/user2.jpg" class="me-3 rounded-circle" alt="...">
                                                <div class="media-body">
                                                    <div class="row d-flex align-items-center">
                                                        <h5 class="col-auto mb-0">Lee Sipes</h5>
                                                        <div class="col-auto">
                                                            <span class="d-inline-block font-mini text-warning">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </span>
                                                            <span class="d-inline-block">(5 out of 5)</span>
                                                        </div>
                                                    </div>
                                                    <div class="comments-date mb-2"><span>Posted On 21th May, 2019 - </span><a href="#">Replay</a></div>
                                                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla.
                                                        Donec lacinia congue felis in faucibus.</p>
                                                    <div class="media mt-4">
                                                        <img src="assets/images/user4.jpg" class="me-3 rounded-circle" alt="...">
                                                        <div class="media-body">
                                                            <div class="row d-flex align-items-center">
                                                                <h5 class="col-auto mb-0">Lee Sipes</h5>
                                                            </div>
                                                            <div class="comments-date mb-2"><span>Posted On 10th June, 2019 - </span><a href="#">Replay</a></div>
                                                            <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="media mt-4">
                                                <img src="assets/images/user3.jpg" class="me-3 rounded-circle" alt="...">
                                                <div class="media-body">
                                                    <div class="row d-flex align-items-center">
                                                        <h5 class="col-auto mb-0">Lee Sipes</h5>
                                                        <div class="col-auto">
                                                            <span class="d-inline-block font-mini text-warning">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </span>
                                                            <span class="d-inline-block">(5 out of 5)</span>
                                                        </div>
                                                    </div>
                                                    <div class="comments-date mb-2"><span>Posted On 10th June, 2019 - </span><a href="#">Replay</a></div>
                                                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="media mt-4">
                                                <img src="assets/images/user3.jpg" class="me-3 rounded-circle" alt="...">
                                                <div class="media-body">
                                                    <div class="row d-flex align-items-center">
                                                        <h5 class="col-auto mb-0">Lee Sipes</h5>
                                                        <div class="col-auto">
                                                            <span class="d-inline-block font-mini text-warning">
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                                <i class="fas fa-star"></i>
                                                            </span>
                                                            <span class="d-inline-block">(5 out of 5)</span>
                                                        </div>
                                                    </div>
                                                    <div class="comments-date mb-2"><span>Posted On 10th June, 2019 - </span><a href="#">Replay</a></div>
                                                    <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Comments Form --> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--============== Agent Details End ==============-->

</x-frontend-layout>
