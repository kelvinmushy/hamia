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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
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
    </style>
</head>

<body class="theme-blue">
    <div class="overlay"></div>
    <div id="container-grid" style="min-height:100vh; display:flex; flex-direction:column; justify-content:space-between;">
        @include('backend.agent.partials.navbar')
        
        @yield('content')
        
        <!-- Scripts -->
        <script type="text/javascript" src="{{ asset('frontend/js/jquery.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            // Toastr configuration
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