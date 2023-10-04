 @php
      $states = App\Models\State::pluck('name', 'name')->toArray();
      $ptypes = App\Models\PropertyType::pluck('type_name', 'type_name')->toArray();
  @endphp
 <div class="full-row p-0 overlay-secondary" style="background-image: url('{{ asset('frontend/assets/images/slider/5.png') }}'); background-position: center center;">
            <div class="container">
                <div class="banner-search" style="padding-top: 120px; padding-bottom: 120px;">
                    <div class="row">
                        <div class="col-lg-7 position-relative">
                            <h2 class="text-white font-400">Find Your Dream Home</h2>
                            <span class="h5 mb-50 d-table text-white font-400">From as low as $10 per day with limited time offer discounts.</span>
                            <span class="h6 mb-20 d-table text-white font-400">What are you looking for?</span>
                            <div class="row">
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="text-center p-35 bg-dark text-white transation hover-shadow h-100 rounded">
                                        <span class="flaticon-network flat-medium text-primary"></span>
                                        <h5 class="mb-3 font-400"><a href="#" class="d-block text-white hover-text-primary mt-4">Living House</a></h5>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="text-center p-35 bg-dark text-white transation hover-shadow h-100 rounded">
                                        <span class="flaticon-network flat-medium text-primary"></span>
                                        <h5 class="mb-3 font-400"><a href="#" class="d-block text-white hover-text-primary mt-4">Housing Land</a></h5>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 mb-4">
                                    <div class="text-center p-35 bg-dark transation hover-shadow h-100 rounded">
                                        <span class="flaticon-network flat-medium text-primary"></span>
                                        <h5 class="mb-3 font-400"><a href="#" class="d-block text-white hover-text-primary mt-4">Modern Office</a></h5>
                                    </div>
                                </div>
                            </div>
                            <p class="text-white">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div>
                        <div class="col-lg-4 offset-lg-1">
                            {{ Form::open(['route' => 'property.search', 'class' => 'bg-dark rounded shadow-sm quick-search p-20 p-xl-5 form-icon-right position-relative', 'method' => 'post']) }}

                            <form class="bg-dark rounded shadow-sm quick-search p-20 p-xl-5 form-icon-right position-relative" action="#" method="post">
                                <h5 class="down-line mb-4 text-white">Search Property</h5>
                                <div class="row row-cols-1 g-4">
                                    <div class="col">
                                        <input type="text" class="form-control" name="search" placeholder="Search by Property, Location or Landmark...">
                                        @error('search')
                                                          <span class="text-danger pt-3">{{ $message }}</span>
                                                      @enderror
                                    </div>
                                    <div class="col">
                                        <select class="form-control" name="type" required>
                                            <option value="0">Property Type</option>
											<option value="rent">Rent</option>
                                            <option value="sale">Sale</option>       
										</select>
                                    </div>
                                    <div class="col">
                                        <select class="form-control" name="state">
                                            <option value="0">Select Location</option>
											@foreach ($states as $state)
                                                              <option value="{{ $state }}">{{ $state }}
                                                              </option>
                                                          @endforeach
										</select>
                                    </div>
                                    <div class="col">
                                        <select class="form-control" name="ptype_id">
                                            <option value="0">All Type</option>
											 @foreach ($ptypes as $ptype)
                                                              <option value="{{ $ptype }}">{{ $ptype }}
                                                              </option>
                                                          @endforeach
										</select>
                                    </div>
                                    
                                    
                                    <div class="col mb-20">
                                        <div class="form-group mb-0">
                                            <button class="btn btn-primary w-100">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>