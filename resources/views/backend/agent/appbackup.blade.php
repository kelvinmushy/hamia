<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
   @yield('top')
    <!-- Custom Css -->
    <link href="{{ asset('backend/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/jquery-jvectormap-2.0.3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/morris.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/color_skins.css') }}" rel="stylesheet">
 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- AdminBSB Themes -->
    <link href="{{ asset('backend/css/themes/theme-indigo.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
    
  @media (max-width: 768px) {
    #sidebar {
        margin-left: -250px;
        transform: rotateY(90deg);
    }
    #sidebar.active {
        margin-left: 0;
        transform: none;
    }
    #sidebarCollapse span:first-of-type,
    #sidebarCollapse span:nth-of-type(2),
    #sidebarCollapse span:last-of-type {
        transform: none;
        opacity: 1;
        margin: 5px auto;
    }
    #sidebarCollapse.active span {
        margin: 0 auto;
    }
    #sidebarCollapse.active span:first-of-type {
        transform: rotate(45deg) translate(2px, 2px);
    }
    #sidebarCollapse.active span:nth-of-type(2) {
        opacity: 0;
    }
    #sidebarCollapse.active span:last-of-type {
        transform: rotate(-45deg) translate(1px, -1px);
    }

}
</style>

</head>
<body class="theme-blue">
<div class="overlay"></div>
    <nav class="navbar">
    <div class="col-12">        
        <div class="navbar-header">
            <a href="javascript:void(0);" class="bars" id="sidebarCollapse"></a>
            <a class="navbar-brand" href="/" style="background-color:#2E8BC0;">
          <img src="{{ url('/images/logo/logo.png') }}"  style="height:50px;width:250px;margin-top:12px"/>
            
            </a>
        </div>
        <ul class="nav navbar-nav navbar-left">
            <li><a href="javascript:void(0);" class="ls-toggle-btn" data-close="true"><i class="zmdi zmdi-swap"></i></a></li>            
           
        </ul>
        <ul class="nav navbar-nav navbar-right">
         
           
            <li>
                <a  title="Sign Out" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      <i class="zmdi zmdi-power"></i>
                         </a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                       @csrf
                     </form>
            </li>
          
        </ul>
    </div>
</nav>
    @include('agent.sidebar')
        {{-- MAIN CONTENT SECTION --}}
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </section>
        @yield('bot')
   
     <script src="{{ asset('backend/plugins/node-waves/waves.js') }}"></script> 
    <script src="{{ asset('backend/js/libscripts.bundle.js') }}"></script>
   
    <script src="{{ asset('backend/js/morrisscripts.bundle.js') }}"></script>
    <script src="{{ asset('backend/js/jvectormap.bundle.js') }}"></script> 
    
    <script src="{{ asset('backend/js/countTo.bundle.js') }}"></script>
    <script src="{{ asset('backend/js/sparkline.bundle.js') }}"></script> 
    
    <script src="{{ asset('backend/js/mainscripts.bundle.js') }}"></script>
    <script src="{{ asset('backend/js/index.js') }}"></script> 


    <script src="https://unpkg.com/sweetalert2@7.19.3/dist/sweetalert2.all.js"></script>

        <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDP1zG7Nr" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
   
         $(document).ready(function () {
             $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
                $(this).toggleClass('active');
            });
        });
        </script>


    </body>
  </html>