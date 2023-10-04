<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="unicoder">
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
    @if (Auth::check() && Auth::user()->role == 'agent')
        <script>
            window.location = "/agent/dashboard";
        </script>
    @elseif (Auth::check() && Auth::user()->role == 'admin')
        <script>
            window.location = "/admin/dashboard";
        </script>
    @else
    @endif
    <div id="page_wrapper" class="bg-light vh-100">
        <div class="container-fluid">
            <div class="row">
                <!-- sidebar -->
                @include('frontend.home.side_dashboard')
                <!-- sidebar end -->
                <div class="col-md-8 col-lg-9 col-xl-10 px-0 dashboard-body" style="height: 100vh; overflow-y: scroll;">
                    <!--============== Header Section Start ==============-->
                    @include('frontend.home.side_dashboard_header')
                    <!--============== Header Section End ==============-->

                    <!--============== Dashboard Start ==============-->
                    {{ $slot }}
                    <!--============== Dashboard end ==============-->

                    <!-- Footer -->
                    @include('frontend.home.side_dashboard_footer')
                </div>
            </div>
        </div>
    </div>

    <!-- Javascript Files -->
    <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/piechart/chart.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/range/tmpl.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/range/jquery.dependClass.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/range/draggable.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/range/jquery.slider.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/paraxify.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/custom.js') }}"></script>
    <!-- Add to Wishlist -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
    </script>
    <!-- // start load Wishlist Data  -->


    <script type="text/javascript">
        function compare() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/get-compare-property/",
                success: function(response) {
                    if (response.length > 0) {
                        var rows = "";
                        var rows_head = "";
                        var head = "";
                        var city = "";
                        var state = "";
                        var area = "";
                        var bedrooms = "";
                        var bathrooms = "";
                        var garage = "";
                        var action = "";
                        var amenitieslist = "";
                        var amenitiesnot = "";
                        var facilities = "";
                        var view = "";
                        //head with Image and name

                        $.each(response, function(key, value) {

                            head += ` <th><div class="clip-item">
                    <figure class="image-box"><img src="/${value.property.property_thumbnail}" alt=""></figure>
                    <div class="title">${value.property.property_name}</div>
                    <div class="price">$${value.property.lowest_price}</div>
                </div></th>`;
                            city += `<td>
                    <p>${value.property.city.name}</p>
                </td>`;
                            state += `<td>
                    <p>${value.property.state.name}</p>
                </td>`;
                            area += `<td>
                    <p>${value.property.property_size} Sq Ft</p>
                </td>`;
                            bedrooms += `<td>
                    <p>${value.property.bedrooms}</p>
                </td>`;
                            bathrooms += `<td>
                    <p>${value.property.bathrooms}</p>
                </td>`;
                            garage += `<td>
                    <p>${value.property.garage}</p>
                </td>`;
                            action += `<td>
                    <p><a href="javascript:void(0)" class="text-body" id="${value.id}" onclick="compareRemove(this.id)" ><i class="fa fa-trash"></i></a></p>
                </td>`;
                            view += `<td>
                    <p><a href="/property/details/${value.property.id}/${value.property.property_slug}" class="text-body" ><i class="fa fa-eye"></i></a></p>
                </td>`;
                            amenitiesnot = "";
                            amenitieslist += `<td>`;
                            $.each(value.property.amenities, function(key, value) {
                                amenitieslist +=
                                    `<p><i class="yes fas fa-check"></i> ${value.amenities_name}</p>`
                                console.log(value.amenities_name);
                            });


                            $.each(value.property.amenitiesNotIncluded, function(key, value) {
                                amenitiesnot +=
                                    `<p><i class="no fas fa-times"></i> ${value.amenities_name}</p>`
                                // console.log(value.amenities_name);
                            });
                            amenitieslist += amenitiesnot;
                            amenitieslist += `</td>`;

                            facilities += `<td>`;
                            $.each(value.property.facilities, function(key, value) {
                                facilities +=
                                    `<p> <strong>${value.facility_name}</strong> : (${value.distance} km)</p>`
                                // console.log(value.amenities_name);
                            });
                            facilities += `</td>`;
                        });

                        rows_head += ` <tr>
                <th>Property Info</th>${head}</tr>`;
                        rows += ` <tr>
                <td>
                    <p>State</p></td>${state}</tr>`;
                        rows += ` <tr>
                <td>
                    <p>City</p></td>${city}</tr>`;
                        rows += ` <tr>
                <td>
                    <p>Area</p></td>${area}</tr>`;
                        rows += ` <tr>
                <td>
                    <p>Rooms</p></td>${bedrooms}</tr>`;
                        rows += ` <tr>
                <td>
                    <p>Bathrooms</p></td>${bathrooms}</tr>`;
                        rows += ` <tr>
                <td>
                    <p>Garage</p></td>${garage}</tr>`;
                        rows += ` <tr>
                <td>
                    <p>Amenities</p></td>${amenitieslist} ${amenitiesnot}</tr>`;
                        rows += ` <tr>
                <td>
                    <p>Facilities</p></td>${facilities} </tr>`;
                        rows += ` <tr>
                <td>
                    View</td>${view} </tr>`;
                        rows +=
                            ` <tr>
                <td>
                    <p>Action</p></td>${action}</tr>`;
                        //End
                        $('#compare_head').html(rows_head);
                        $('#compare').html(rows);
                    } else {

                        rows += ` <tr>
                <td>
                    <p class="text-danger">No Property Found</p></td></tr>`;
                        $('#compare_head').html("");
                        $('#compare').html(rows);

                    }
                }
            })
        }
        compare();
        // Compare Remove Start 
        function compareRemove(id) {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/compare-remove/" + id,
                success: function(data) {
                    compare();
                    // Start Message 
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',

                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success,
                        })
                    } else {

                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error,
                        })
                    }
                    // End Message  
                }
            })
        }
        /// End Compare Remove  
    </script>
</body>

</html>
