@extends('frontend.frontend_agent_view')
@section('main')
@section('title')
    {{ $agent->name }}
@endsection
 @php
$template = App\Models\SiteSetting::find(1);
@endphp
<!-- Left Menu / Logo-->
<aside class="menu" id="menu">
    <div class="logo">
        <!-- Logo image-->
        <img src="{{ url('upload/template/thumbnail/logo_white.png') }}" width="140" height="140" alt="" />
        <!-- Logo name-->
        <span>Andrew Smith</span>
    </div>
    <!-- Mobile Navigation-->
    <a href="#menu1" class="menu-link"></a>
    <!-- Left Navigation-->
    <nav id="menu1" role="navigation">
        <a href="#chapterintroduction"><span id="link_introduction" class="active">Home</span></a>
        <a href="#chapterabout"><span id="link_about">About</span></a> 
        {{-- <a href="#chapterskills"><span id="link_skills">Skills</span></a>
        <a href="#chapterexperience"><span id="link_experience">Experience</span></a> 
        <a href="#chaptereducation"><span  id="link_education">Education</span></a> 
        <a href="#chapterportfolio"><span id="link_portfolio">Portfolio</span></a>
        <a href="#chaptercontact"><span id="link_contact">Contact</span></a>
        <a href="blog.html"><span id="link_blog">Blog</span></a> --}}
    </nav>
    {{-- <div class="social"> <a href="https://www.facebook.com/" target="_blank" class="facebook"><i
                class="fa fa-facebook"></i></a> <a href="https://twitter.com/" target="_blank" class="twitter"><i
                class="fa fa-twitter"></i></a> <a href="https://plus.google.com/" target="_blank" class="google-plus"><i
                class="fa fa-google-plus"></i></a> </div> --}}
                 
    <div class="copyright"> {{ $template->copyright }} </div>
</aside>
<!-- Go to top link for mobile device -->
<a href="#menu" class="totop-link">Go to the top</a>
<div class="content-scroller">
    <div class="content-wrapper">

        <!-- Introduction -->
        <article class="content introduction noscroll" id="chapterintroduction">
            <div class="inner">
                <h2><span>HEllo, I'm</span><br>
                    {{ $agent->name }}</h2>
                <span class="title">--------------------</span>
            </div>
            <div id="owl-demo" class="owl-carousel">
                <div class="item"><img src="{{ asset('agent/assets/images/profile.jpg') }}" alt="" /></div>
            </div>
        </article>

        <!-- About -->
        <article class="content about white-bg" id="chapterabout">
            <div class="inner">
                <h2>About</h2>
                <div class="title-divider"></div>
                <div class="about-con">
                    <ul>
                        <li>Name: {{ ucfirst($agent->name) }}</li>
                        <li>Email: <a href="mailto:{{ $agent->email }}">{{ $agent->email }}</a></li>
                        <li>Phone: (123) - {{ $agent->phone }}</li>
                    </ul>
                    <h3>Professional Profile</h3>
                    <p>{{ $agent->about }}</p>
                      </div>
            </div>
        </article>

      
       

        <!-- Introduction -->
        <article class="content introduction-end" id="chapterthankyou">
            <div class="inner">
                <div class="introduction-end-con margin-top50">
                    <h3><strong>Andrew Smith</strong></h3>
                    <div id="rotate" class="rotate">
                        <div><span>awesome.</span></div>
                        <div><span>invincible.</span></div>
                        <div><span>unbeatable.</span></div>
                        <div><span>indestructible.</span></div>
                    </div>
                </div>
            </div>
        </article>
    </div>
    <!-- content-wrapper -->
</div>
<!-- content-scroller -->
@endsection
