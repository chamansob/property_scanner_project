<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
<META NAME="ROBOTS" CONTENT="INDEX, FOLLOW">
<title>@yield('title') </title>
    <meta name="description" content="@yield('meta_description')" />
    <meta name="keywords" content="@yield('meta_keywords')" />
<link rel="shortcut icon" href="{{ asset('frontend/assets/images/favicon.ico') }}">

<!-- Google Font-->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300italic,300,100italic,100,400italic,500,500italic,700,900,900italic,700italic%7COswald:400,300,700' rel='stylesheet' type='text/css'>
<!-- Design Style -->
<link rel="stylesheet" type="text/css" href="{{ asset('agent/assets/css/scroll.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('agent/assets/css/style.css') }}" />
<!-- Icon -->
<link rel="stylesheet" type="text/css" href="{{ asset('agent/assets/css/font-awesome.css') }}" />
<!-- Portfolio Thumbnail / Slider -->
<link rel="stylesheet" type="text/css" href="{{ asset('agent/assets/css/portfolio.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('agent/assets/css/carousel.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('agent/assets/css/responsive.css') }}" />
<!-- Pie Chart / Skills -->
<script type="text/javascript" src="{{ asset('agent/assets/js//jquery-2.0.3.min.js') }}"></script>
<!-- Send Email -->
<script type="text/javascript" src="{{ asset('agent/assets/js//sendemail.js') }}"></script>
<!-- Progressbar / Skills-->
<script type="text/javascript" src="{{ asset('agent/assets/js//progressbar.js') }}"></script>
<!-- Portfolio-->
<script src="{{ asset('agent/assets/js//modernizr.custom.js') }}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<div id="container" class="container"> 
        <!-- Agent Details -->
      @yield('main')
        <!-- Agent Details end -->
</div>
<script type="text/javascript" src="{{ asset('agent/assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('agent/assets/js/head.min.js') }}"></script>
<!-- Portfolio Thumbnail --> 
<script type="text/javascript" src="{{ asset('agent/assets/js/imagesloaded.min.js') }}"></script> 
<script type="text/javascript" src="{{ asset('agent/assets/js/masonry.min.js') }}"></script> 
<script type="text/javascript" src="{{ asset('agent/assets/js/class_helper.js') }}"></script> 
<script type="text/javascript" src="{{ asset('agent/assets/js/grid_gallery.js') }}"></script> 
<!-- Portfolio Grid --> 
<script>
    new CBPGridGallery( document.getElementById( 'grid-gallery' ) );
</script>
<!-- Portfolio Slider--> 
<script type="text/javascript"  src="{{ asset('agent/assets/js/carousel.js') }}"></script> 
<script type="text/javascript" src="{{ asset('agent/assets/js/jquery.easypiechart.js') }}"></script> 
<script type="text/javascript" src="{{ asset('agent/assets/js/text.rotator.js') }}"></script>
<!-- Page Scrolling --> 
<script>
head.js(
		{ mousewheel : "{{ asset('agent/assets/js/jquery.mousewheel.js') }}" },
		{ mwheelIntent : "{{ asset('agent/assets/js/mwheelIntent.js') }}" },
		{ jScrollPane : "{{ asset('agent/assets/js/jquery.jscrollpane.min.js') }}" },
		{ history : "{{ asset('agent/assets/js/jquery.history.js') }}" },
		{ stringLib : "{{ asset('agent/assets/js/core.string.js') }}" },
		{ easing : "{{ asset('agent/assets/js/jquery.easing.1.3.js') }}" },
		{ smartresize : "{{ asset('agent/assets/js/jquery.smartresize.js') }}" },
		{ page : "{{ asset('agent/assets/js/jquery.page.js') }}" }
		);
</script>  
<!-- Fit Video --> 
<script type="text/javascript"  src="{{ asset('agent/assets/js/jquery.fitvids.js') }}"></script>
<!-- All Javascript Component--> 
<script src="{{ asset('agent/assets/js/settings.js') }}"></script>
</body>


</html>