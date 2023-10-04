 @php
      $states = App\Models\State::pluck('name', 'name')->toArray();
      $ptypes = App\Models\PropertyType::pluck('type_name', 'type_name')->toArray();
  @endphp
 <div class="full-row p-0 overlay-secondary" style="background-image: url('{{ asset('frontend/assets/images/slider/5.png') }}'); background-position: center center;">
            <div class="container">
                <div class="banner-search" style="padding-top: 30px; padding-bottom: 26px; height: 100vh;">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 position-relative text-center">
                            <h2 class="text-white font-400 py-5">Find Your Dream Home</h2>
                            <div class="row ring-offset-4">
                                <div class="col-lg-6 col-md-6 mb-4">
                                    <div class="text-center p-35 bg-dark text-white transation hover-shadow h-100 rounded">
                                        <span class="flaticon-network flat-medium text-primary"></span>
                                        <h5 class="mb-3 font-400"><a href="{{ route('agent.login') }}" class="d-block text-white hover-text-primary mt-4">Login</a></h5>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 mb-4">
                                    <div class="text-center p-35 bg-dark text-white transation hover-shadow h-100 rounded">
                                        <span class="flaticon-network flat-medium text-primary"></span>
                                        <h5 class="mb-3 font-400"><a href="{{ route('agent.register') }}" class="d-block text-white hover-text-primary mt-4">Register</a></h5>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>