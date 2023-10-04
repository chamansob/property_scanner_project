<header class="header-unfix border-bottom bg-white">
                        <div class="main-nav xs-p-0">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12">
                                        <nav class="navbar navbar-expand-lg nav-primary nav-primary-hover nav-line-active px-3">
                                            <div class="navbar-collapse justify-content-between sm-ml-0">
                                                <ul class="navbar-nav sm-mx-none">
                                                   
                                                </ul>
                                                <ul class="navbar-nav user-option">
                                                   <li class="nav-item dropdown">
                                                        <a class="nav-link" href="#"><img src="{{ !empty(Auth::user()->photo) ? asset(Auth::user()->photo) : url('upload/no_image.jpg') }}" alt=""> Hi, {{ Auth::user()->name }}</a>
                                                        <ul class="dropdown-menu">
                                                           
                                                           <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-link :href="route('logout')" class="dropdown-item"
                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        <i class="flaticon-lock flat-mini pe-2"></i>
                        {{ __('logout') }}
                    </x-link>
                </form>
                                                        </ul>
                                                    </li>
                                                   
                                                    
                                                </ul>
                                            </div>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </header>