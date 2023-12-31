@php
    $template = App\Models\SiteSetting::find(1);
@endphp
<header class="main-header">
    <!-- header-top -->
    <div class="header-top">
        <div class="top-inner clearfix">
            <div class="left-column pull-left">
                <ul class="info clearfix">
                    <li><i class="far fa-map-marker-alt"></i>{{ $template->company_address }}</li>
                    <li><i class="far fa-clock"></i>Mon - Sat 9.00 - 18.00</li>
                    <li><i class="far fa-phone"></i><a
                            href="tel:{{ $template->support_phone }}">{{ $template->support_phone }}</a></li>
                </ul>
            </div>
            <div class="right-column pull-right">
                <ul class="social-links clearfix">
                    <li><a href="{{ $template->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="{{ $template->twitter }}"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="{{ $template->pinterest }}"><i class="fab fa-pinterest-p"></i></a></li>
                    <li><a href="{{ $template->google }}"><i class="fab fa-google-plus-g"></i></a></li>
                    <li><a href="{{ $template->vimeo }}"><i class="fab fa-vimeo-v"></i></a></li>
                </ul>
                @auth
                    <div class="sign-box">
                        <ul class="social-links clearfix">
                            <li><a href="{{ route('dashboard') }}"><i class="fas fa-user"></i>Dashboard</a></li>

                        </ul>

                    </div>
                    <div class="sign-box">
                        <a href="{{ route('user.logout') }}"><i class="fas fa-lock"></i>Logout</a>
                    </div>
                @else
                    <div class="sign-box">
                        <a href="{{ route('login') }}"><i class="fas fa-user"></i>Sign In</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
          @if(Auth::check())           
        @if(Auth::user()->role=='user') 
         
        <!-- header-lower -->
        <div class="header-lower">
            <div class="outer-box">
                <div class="main-box">
                    <div class="logo-box">
                        <figure class="logo">
                            <a href="{{ url('/') }}"><img src="{{ asset($template->logo) }}"
                                    alt=""></a>
                        </figure>
                    </div>
                    <div class="menu-area clearfix">
                        <!--Mobile Navigation Toggler-->
                        <div class="mobile-nav-toggler">
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                            <i class="icon-bar"></i>
                        </div>
                        <nav class="main-menu navbar-expand-md navbar-light">
                            <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                <ul class="navigation clearfix">
                                    <li><a href="{{ url('/') }}"><span>Home</span></a> </li>
                                    <li><a href="{{ url('/') }}"><span>About Us </span></a> </li>

                                    <li class="dropdown"><a href="index.html"><span>Property</span></a>
                                        <ul>
                                            <li><a href="{{ route('rent.property') }}">Rent Property </a></li>
                                            <li><a href="{{ route('sale.property') }}">Sale Property</a></li>


                                        </ul>
                                    </li>
                                     @if(!Auth::check())                                      
                                     
                                    <li><a href="{{ url('/agent/login') }}"><span>Agent </span></a> </li>
                                    @endif
                                    <li><a href="{{ route('blog.list') }}"><span>Blog </span></a> </li>


                                    <li><a href="#"><span>Contact</span></a></li>

                                    <li>
                                        <a href="{{ route('agent.login') }}" class="btn btn-success"><span>+</span>Add
                                            Listing</a>
                                    </li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                    <div class="btn-box">
                        <a href="#" class="theme-btn btn-one"><span>+</span>Add Listing</a>
                    </div>
                </div>
            </div>
        </div>
       @endif
          @endif
       

        <!--sticky Header-->
        <div class="sticky-header">
            <div class="outer-box">
                <div class="main-box">
                    <div class="logo-box">
                        <figure class="logo"><a href="{{ url('/') }}"><img src="{{ asset($template->logo) }}"
                                    alt=""></a>
                        </figure>
                    </div>
                    <div class="menu-area clearfix">
                        <nav class="main-menu clearfix">
                            <!--Keep This Empty / Menu will come through Javascript-->
                        </nav>
                    </div>
                    <div class="btn-box">
                        <a href="#" class="theme-btn btn-one"><span>+</span>Add Listing</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
