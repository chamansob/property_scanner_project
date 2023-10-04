  @php
      $template = App\Models\SiteSetting::find(1);
  @endphp
  <div class="col-md-4 col-lg-3 col-xl-2 px-0">
      <div class="dashboard-nav-area bg-secondary">
          <a class="navbar-brand w-100 d-table px-20 py-3 mb-3" href="{{ url('/') }}"><img
                  src="{{ asset($template->logo) }}" alt="dashboard logo"></a>
          <div class="collaps-dashboard m-3 px-3 rounded bg-white text-secondary clearfix d-md-none">
              <span>Open Dashboard Navigation</span>
              <span class="flaticon-menu text-secondary flat-mini float-end"></span>
          </div>
          <nav class="dashboard-nav nav-light pb-3" id="navbarSupportedContent">
              <ul class="navbar-nav left-collaps-nav">
                  <li class="text-white pb-2 pt-4 px-20">Overview</li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('dashboard') }}"><i class="flaticon-home flat-mini pe-2"></i>
                          Dashboard</a>
                  </li>
                  {{-- <li class="nav-item">
                                    <a class="nav-link" href="dashboard-message.html"><i class="flaticon-email flat-mini pe-2"></i> Message</a>
                                </li> --}}
                  {{-- <li class="text-white pb-2 pt-4 px-20">Manage Listing</li>
                                <li class="nav-item db-dropdown">
                                    <a class="nav-link dropdown-toggle" href="#"><i class="flaticon-home flat-mini pe-2"></i> My Properties</a>
                                    <ul class="db-dropdown-menu">
                                        <li class="nav-item"><a class="nav-link" href="dashboard-listing.html">General Listing</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#">Element Listing</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#">Management</a></li>
                                    </ul>
                                </li> --}}
                  {{-- <li class="nav-item">
                                    <a class="nav-link" href="dashboard-favorite.html"><i class="flaticon-like-1 flat-mini pe-2"></i> My Favorite</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="dashboard-submit-property.html"><i class="flaticon-arrow flat-mini pe-2"></i> Submit Property</a>
                                </li>
                                <li class="nav-item db-dropdown">
                                    <a class="nav-link dropdown-toggle" href="#"><i class="flaticon-chat-1 flat-mini pe-2"></i> Reviews</a>
                                    <ul class="db-dropdown-menu">
                                        <li class="nav-item"><a class="nav-link" href="#">Customer Reviews</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#">Public Reviews</a></li>
                                    </ul>
                                </li> --}}
                  <li class="text-white pb-2 pt-4 px-20">Account Settings</li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('user.profile') }}"><i
                              class="flaticon-user flat-mini pe-2"></i> Personal Profile</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('user.schedule.request') }}"><i
                              class="flaticon-survey flat-mini pe-2"></i> Schedule Request</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('user.wishlist') }}"><i
                              class="flaticon-star flat-mini pe-2"></i> WishList</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('user.compare') }}"><i
                              class="flaticon-contract flat-mini pe-2"></i> Compare</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="{{ route('user.change.password') }}"><i
                              class="flaticon-locked flat-mini pe-2"></i> Change Password</a>
                  </li>
                  <li class="nav-item">

                      <form method="POST" action="{{ route('logout') }}">
                          @csrf

                          <x-link :href="route('logout')" class="nav-link"
                              onclick="event.preventDefault();
                                                this.closest('form').submit();">
                              <i class="flaticon-transfer flat-mini pe-2"></i>
                              {{ __('Log Out') }}
                          </x-link>
                      </form>
                  </li>
              </ul>
          </nav>
      </div>
  </div>
