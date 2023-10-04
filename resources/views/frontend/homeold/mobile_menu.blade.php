@php
    $template = App\Models\SiteSetting::find(1);
@endphp
<div class="mobile-menu">
    <div class="menu-backdrop"></div>
    <div class="close-btn"><i class="fas fa-times"></i></div>

    <nav class="menu-box">
        <div class="nav-logo"><a href="{{ url('/') }}"><img src="{{ asset('frontend/assets/images/logo-2.png') }}"
                                    alt=""></a></div>
        <div class="menu-outer">
            <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
        </div>
        <div class="contact-info">
            <h4>Contact Info</h4>
            <ul>
                <li>{{ $template->company_address }}</li>
                <li><a href="tel:{{ $template->support_phone }}">{{ $template->support_phone }}</a></li>
                <li><a href="mailto:{{ $template->email }}">{{ $template->email }}</a></li>
            </ul>
        </div>
        <div class="social-links">
            <ul class="clearfix">
                  <li><a href="{{ $template->facebook }}"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="{{ $template->twitter }}"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="{{ $template->pinterest }}"><i class="fab fa-pinterest-p"></i></a></li>
                    <li><a href="{{ $template->google }}"><i class="fab fa-google-plus-g"></i></a></li>
                    <li><a href="{{ $template->vimeo }}"><i class="fab fa-vimeo-v"></i></a></li>
                     </ul>
        </div>
    </nav>
</div>
