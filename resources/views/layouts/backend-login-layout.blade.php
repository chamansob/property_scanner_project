<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login Page</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/core/core.css') }}">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('backend/assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/demo2/style.css') }}">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.png') }}" />
</head>

<body>
    <div class="main-wrapper">

  {{ $slot }}
</div>

<!-- core:js -->
<script src="{{ asset('backend/assets/vendors/core/core.js') }}"></script>
<!-- endinject -->

<!-- Plugin js for this page -->
    <script src="{{ asset('backend/assets/vendors/jquery-validation/jquery.validate.min.js') }}"></script>
    
<!-- End plugin js for this page -->

<!-- inject:js -->
<script src="{{ asset('backend/assets/vendors/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/template.js') }}"></script>
<!-- endinject -->

<!-- Custom js for this page -->
<!-- End custom js for this page -->
<script>
  $(document).ready(function() {
var x = $("#password");
 $("#formSwitch1").click(function(){
    console.log('check');
  if (x.attr('type') === "password") {
	    x.prop('type','text');
	  } else {
	    x.prop('type','password');
	  }
});
});

</script>
</body>
</html>