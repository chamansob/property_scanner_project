<nav class="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('agent.dashboard') }}" class="sidebar-brand">
            Admin<span>Panel</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('agent.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            @if (Auth::user()->status == 0)
                <li class="nav-item nav-category">Real Estate</li>
                <li class="nav-item {{ active_class('agent/properties/all') }} {{ active_class('agent/properties/create') }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#type" role="button" aria-expanded="{{ is_active_route('agent/properties/all') }} {{ is_active_route('agent/properties/create') }}"
                        aria-controls="type">
                        <i class="link-icon" data-feather="feather"></i>
                        <span class="link-title">Property</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ show_class('agent/properties/all') }} {{ show_class('agent/properties/create') }}" id="type">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('agent.properties') }}" class="nav-link {{ active_class('agent/properties/all') }}">All Property</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('agent.properties.create') }}" class="nav-link {{ active_class('agent/properties/create') }}">Add Property</a>
                            </li>

                        </ul>
                    </div>
                </li>
                <li class="nav-item {{ active_class('agent/buy/package') }}">
                    <a href="{{ route('agent.buy.package') }}" class="nav-link {{ active_class('agent/buy/package') }}">
                        <i class="link-icon" data-feather="briefcase"></i>
                        <span class="link-title">Buy Package</span>
                    </a>
                </li>
                <li class="nav-item {{ active_class('agent/buy/package_history') }}">
                    <a href="{{ route('agent.buy.package.package_history') }}" class="nav-link">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title">Package History </span>
                    </a>
                </li>
                <li class="nav-item {{ active_class('agent/property/message') }}">
                    <a href="{{ route('agent.property.message') }}" class="nav-link">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title">Property Message </span>
                    </a>
                </li>
                <li class="nav-item {{ active_class('agent/schedule/request') }}">
                    <a href="{{ route('agent.schedule.request') }}" class="nav-link">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title">Schedule Request </span>
                    </a>
                </li>
               <li class="nav-item {{ active_class('agent/details/'.Auth::id()) }}">
                    <a href="{{ url('agent/details/'.Auth::id()) }}" class="nav-link" target="_blank">
                        <i class="link-icon" data-feather="calendar"></i>
                        <span class="link-title">View Profile </span>
                    </a>
                </li>
            @endif


        </ul>
    </div>
</nav>
