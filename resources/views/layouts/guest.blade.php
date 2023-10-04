<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') </title>
    <meta name="description" content="@yield('meta_description')" />
    <meta name="keywords" content="@yield('meta_keywords')" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/favicon.ico') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Sen:wght@400;700&amp;display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,300;0,400;0,500;0,700;1,400&amp;display=swap"
        rel="stylesheet">

    <!-- Required style of the theme -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/webfonts/flaticon/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/layerslider.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/template.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/colors/color.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/loader.css') }}">
</head>

<body>

    <!-- preloader -->
    @include('frontend.home.preloader')
    <!-- preloader end -->

    <div id="page_wrapper">
        @include('frontend.home.header')
        {{ $slot }}
    </div>

    <!--============== Footer Section Start ==============-->
    @include('frontend.home.footer')
    <!--============== Footer Section End ==============-->

    <!--============== Copyright Section Start ==============-->
    @include('frontend.home.copywrite')
    <!--============== Copyright Section End ==============-->

    <!-- Scroll to top -->
    <div class="scroll-top-vertical xs-mx-none" id="scroll">Go Top <i class="ms-2 fa-solid fa-arrow-right-long"></i>
    </div>
    <!-- End Scroll To top -->


    <!-- Javascript Files -->
    <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-select.min.js') }}"></script>

    <script src="{{ asset('frontend/assets/js/custom.js') }}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js') }}">
    </script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>
    <!-- End of .page_wrapper -->

    <script>
        $(document).ready(function() {
            var x = $("#password");
            $("#formSwitch1").click(function() {
                console.log('check');
                if (x.attr('type') === "password") {
                    x.prop('type', 'text');
                } else {
                    x.prop('type', 'password');
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(function() {
            'use strict';

            $(function() {

                $('#loginform').validate({
                    rules: {
                        login: {
                            required: true,
                        },
                        password: {
                            required: true,
                        }


                    },
                    messages: {
                        login: {
                            required: 'Login Name is reuired',
                        },
                        password: {
                            required: 'Password is reuired',
                        }

                    },
                    errorElement: 'span',
                    errorPlacement: function(error, element) {
                        error.addClass('invalid-feedback');
                        element.closest('.form-group').append(error);
                    },
                    highlight: function(element, errorClass, validClass) {
                        $(element).addClass('is-invalid');
                    },
                    unhighlight: function(element, errorClass, validClass) {
                        $(element).removeClass('is-invalid');
                    },
                });

            });
        }); <
        /> <
        script type = "text/javascript" >
            $(function() {
                'use strict';

                $(function() {

                    $('#registerform').validate({
                        rules: {
                            name: {
                                required: true,
                            },
                            email: {
                                required: true,
                            },
                            phone: {
                                matches: "[0-9]+", // <-- no such method called "matches"!
                                minlength: 12,
                                maxlength: 14
                            },
                            password: {
                                required: true,
                                minlength: 5,
                            },
                            password_confirmation: {
                                minlength: 5,
                                equalTo: "#rpassword"
                            },
                            property_status: {
                                required: true,
                            },
                            budget: {
                                required: true,
                            }

                        },
                        messages: {
                            name: {
                                required: 'Username is reuired',
                            },
                            email: {
                                required: 'Email address is reuired',
                            },
                            phone: {
                                required: 'Phone number is reuired',
                            },
                            password: {
                                required: 'Password is reuired',
                            },
                            password_confirmation: {
                                required: 'Confirm Password is reuired',
                            }

                        },
                        errorElement: 'span',
                        errorPlacement: function(error, element) {
                            error.addClass('invalid-feedback');
                            element.closest('.form-group').append(error);
                        },
                        highlight: function(element, errorClass, validClass) {
                            $(element).addClass('is-invalid');
                        },
                        unhighlight: function(element, errorClass, validClass) {
                            $(element).removeClass('is-invalid');
                        },
                    });

                });
            });
    </script>
<script>
        $(document).ready(function() {
            $('#property_status').on('change', function() {
                var p_id = this.value;
                var crf = '{{ csrf_token() }}';
                $.ajax({
                     url: "{{ route('admin.propertybudget') }}",
                    type: "POST",
                    data: {
                        _token: crf,
                        p_id: p_id
                    },
                    cache: false,
                    success: function(result) {
                        $("#budget").html(result);
                    }
                });
            });
            

        });
    </script>
</body>

</html>
