@php
    $template = App\Models\SiteSetting::find(1);
@endphp
<header class="header-style header-fixed nav-on-top bg-dark">
    <div class="top-header xs-mx-none">
        <div class="container">
            <div class="row row-cols-md-2 row-cols-1">
                <div class="col">
                    <ul class="top-contact list-color-white">
                        <li><i class="fas fa-map-marker-alt me-1"></i>{{ $template->company_address }}</li>
                        <li><i class="fas fa-clock me-1"></i>Mon - Sat 9.00 - 18.00</li>
                        <li><i class="fas fa-phone me-1"></i><a
                                href="tel:{{ $template->support_phone }}">{{ $template->support_phone }}</a></li>

                    </ul>
                </div>
                <div class="col">

                    <ul class="nav-bar-top right list-color-white d-flex">

                        @auth
                        @if (Auth::user()->role=='user')
                            <li><a href="{{ route('dashboard') }}"><i class="fas fa-user me-1"></i> Dashboard</a></li>
                       @elseif (Auth::user()->role=='agent')                       
                            <li><a href="{{ route('agent.dashboard') }}"><i class="fas fa-user me-1"></i> Dashboard</a></li>
                         @elseif (Auth::user()->role=='admin')                       
                            <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-user me-1"></i> Dashboard</a></li>
                      
                            @endif
                            <li><a href="{{ route('user.logout') }}"><i class="fas fa-lock me-1"></i> Logout</a></li>
                        @else
                            <li> <a href="{{ route('login') }}"><i class="fas fa-user me-1"></i> Sign In</a></li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-nav">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <nav class="navbar navbar-expand-lg nav-secondary nav-primary-hover nav-line-active py-2">
                            <a href="{{ url('/') }}"><img src="{{ asset($template->logo) }}" alt=""></a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon flaticon-menu flat-small text-primary"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ms-auto">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                                    </li>

                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#">Property</a>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('rent.property') }}">Rent
                                                    Property</a></li>
                                            <li><a class="dropdown-item" href="{{ route('sale.property') }}">Sale
                                                    Property</a></li>
                                        </ul>
                                    </li>
                                    @if (!Auth::check())

                                        <li class="nav-item"><a class="nav-link"
                                                href="{{ url('/agent/login') }}"><span>Agent </span></a> </li>
                                    @endif
                                    <li class="nav-item"><a class="nav-link" href="{{ route('blog.list') }}"><span>Blog
                                            </span></a> </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#">Contact</a>
                                    </li>
                                </ul>
                                {{-- <a href="#" class="btn btn-primary add-listing-btn">+ Create Listing</a> --}}
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>
