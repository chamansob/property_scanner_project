<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Agent Dashboard</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->

    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/core/core.css') }}">


    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">


    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <!-- End plugin css for this page -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/flatpickr/flatpickr.min.css') }}">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('backend/assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/demo2/style.css') }}">
    <!-- End layout styles -->

    <!-- Toastr styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.png') }}" />
    <!-- Toggle styles -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

</head>

<body>
    <div class="main-wrapper">

        <!-- partial:partials/_sidebar.html -->
        @include('agent.body.sidebar')

        <!-- partial -->

        <div class="page-wrapper">

            <!-- partial:partials/_navbar.html -->
            // @include('agent.body.header')
            <!-- partial -->

             {{ $slot }}

            <!-- partial:partials/_footer.html -->
            @include('agent.body.footer')
            <!-- partial -->

        </div>
    </div>

    <!-- core:js -->
    <script src="{{ asset('backend/assets/vendors/core/core.js') }}"></script>
    <!-- endinject -->

    <!-- Plugin js for this page -->
    <script src="{{ asset('backend/assets/vendors/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>
    <!-- Plugin js for this page -->
    <script src="{{ asset('backend/assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="{{ asset('backend/assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/template.js') }}"></script>
    <!-- endinject -->
    <script src="{{ asset('backend/assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>

    <!-- Custom js for this page -->
    <script src="{{ asset('backend/assets/js/dashboard-dark.js') }}"></script>
    <!-- End custom js for this page -->

    <!-- Toastr js for this page -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
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
    <!-- End custom js for this page -->
    <!-- Sweet Alert Plugin js for this page -->
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@10') }}"></script>
    <script src="{{ asset('backend/assets/js/code.js') }}"></script>
    <!-- End Sweet Alert js for this page -->
    <!-- Datatable Plugin js for this page -->
    <script src="{{ asset('backend/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('backend/assets/js/data-table.js') }}"></script>
    <!-- End Datatable custom js for this page -->
    <script src="{{ asset('backend/assets/vendors/tinymce/tinymce.min.js') }}"></script>
    <!-- Custom js for this page -->
    {{-- <script src="{{ asset('backend/assets/js/form-validation.js') }}"></script> --}}
    <script src="{{ asset('backend/assets/js/select2.js') }}"></script>
    <script src="{{ asset('backend/assets/js/tags-input.js') }}"></script>
    <script src="{{ asset('backend/assets/js/tinymce.js') }}"></script>
    <!-- Toggle Style js for this page -->
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</body>

</html>
