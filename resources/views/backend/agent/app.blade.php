<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <meta name="description" content="@yield('meta_description')">
    <meta name="keywords" content="@yield('meta_keyword')">
    <meta name="author" content="hamiafasta">

    <!-- CSS Links -->
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/color_css.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/css/bootstrap-select.css') }}" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @yield('top')

    <style>
        #btnSell {
            background-color: #ffffff;
            color: #dd4b39;
            border-radius: 12px;
        }

        /* Toastr customization */
        .toast-top-right {
            top: 70px;
        }

        .toast-success {
            background-color: #28a745;
        }

        /* Ensure that the dropdown menu is hidden initially */
        #mradiMenu {
            display: none;
        }

        /* Style for the arrow icon to show when menu is expanded */
        #arrow.open {
            transform: rotate(180deg);
            /* Flip the arrow */
        }

        /* Improved Dashboard Styling */
        .agent-dashboard {
            background-color: #f8f9fa;
            min-height: 100vh;
        }

        .agent-title {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 2px solid #eaeaea;
        }

        .sidebar-item a {
            color: #34495e;
            font-weight: 500;
            padding: 10px 15px;
            border-radius: 4px;
            transition: all 0.3s ease;
            display: block;
        }

        .sidebar-item a:hover {
            color: #fff;
            background-color: #3498db;
            text-decoration: none;
        }

        .card {
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 25px;
            border: none;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            font-weight: 600;
            padding: 15px 20px;
        }

        .table {
            width: 100%;
        }

        .table th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #2c3e50;
        }

        .btn-primary {
            background-color: #3498db;
            border-color: #3498db;
            padding: 8px 20px;
            font-weight: 500;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        .form-control {
            border-radius: 4px;
            border: 1px solid #ddd;
            padding: 10px 15px;
            height: auto;
        }

        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        /* Action Links */
        .action-link {
            color: #3498db;
            margin: 0 5px;
            transition: all 0.2s;
        }

        .action-link:hover {
            text-decoration: none;
            color: #2980b9;
        }

        .action-link.delete {
            color: #e74c3c;
        }

        .action-link.delete:hover {
            color: #c0392b;
        }

        /* Sidebar Menu Style */
        .sidebar-menu {
            padding-left: 0;
        }

        .sidebar-item {
            padding-left: 15px;
            /* Ensure the items are aligned */
        }

        .sidebar-item .nav-link {
            padding-left: 15px;
            /* Ensure the links are aligned with the icon */
        }

        /* Collapse submenu padding */
        .sidebar-item .collapse .nav-link {
            padding-left: 30px !important;
            /* Add more left padding for submenu items */
        }

        .sidebar-item a {
            text-decoration: none;
            font-size: 16px;
            color: #343a40;
            transition: color 0.3s ease;
        }

      

        .sidebar-item i {
            font-size: 18px;
        }

       
        /* Hover effect on sidebar items */
        .sidebar-item:hover {
            background-color: #f1f3f5;
            border-radius: 5px;
        }

      

        /* Make the collapse icon toggle bigger */
        .nav-link[data-bs-toggle="collapse"] {
            font-size: 18px;
            font-weight: 500;
        }

        .nav-link[data-bs-toggle="collapse"]:hover {
            cursor: pointer;
        }

        /* Icon and link alignment */
        .d-flex.align-items-center {
            display: flex;
            align-items: center;
        }

        .me-2 {
            margin-right: 10px;
        }


        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .container {
                margin-top: 15px;
            }

            .agent-title {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body class="theme-blue">
    <div class="overlay"></div>
    <div id="container-grid"
        style="min-height:100vh; display:flex; flex-direction:column; justify-content:space-between;">
        @include('backend.agent.partials.navbar')

        @yield('content')

        <!-- Scripts -->
        <script type="text/javascript" src="{{ asset('frontend/js/jquery.min.js') }}"></script>

        <!-- Bootstrap 5 JS and Popper.js (for collapsible) -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- Bootstrap 5 JS and Popper.js (for collapsible) -->

        <script>
            // Toastr configuration
            // JavaScript to ensure the dropdown works
            var myDropdown = new bootstrap.Dropdown(document.getElementById('mradiDropdown'));

            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            // Display success message if exists
            @if(Session::has('success'))
                toastr.success("{{ Session::get('success') }}");
            @endif

            // Display error messages if exist
            @if($errors->any())
                @foreach($errors->all() as $error)
                    toastr.error("{{ $error }}");
                @endforeach
            @endif

            // Display warning message if exists
            @if(Session::has('warning'))
                toastr.warning("{{ Session::get('warning') }}");
            @endif

            // Display info message if exists
            @if(Session::has('info'))
                toastr.info("{{ Session::get('info') }}");
            @endif
        </script>

        @yield('bot')
    </div>
</body>

</html>