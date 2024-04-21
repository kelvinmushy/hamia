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

     
     <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
     <link href="{{ asset('frontend/css/main.css') }}" rel="stylesheet">
     <link href="{{ asset('frontend/css/color_css.css') }}" rel="stylesheet">
     <link href="{{ asset('frontend/css/bootstrap-select.css') }}" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" integrity="sha512-rRQtF4V2wtAvXsou4iUAs2kXHi3Lj9NE7xJR77DE7GHsxgY9RTWy93dzMXgDIG8ToiRTD45VsDNdTiUagOFeZA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
      
    @yield('top')
 
  

    {{-- <link href="{{ asset('frontend/css/styles.css') }}" rel="stylesheet"> --}}
</head>

<body class="theme-blue">
<div class="overlay"></div>
<div id="container-grid" style="min-height:100vh; display:flex; flex-direction:column; 
            justify-content:space-between;">
    {{-- MAIN NAVIGATION BAR --}}
    @include('frontend.partials.navbar')
      <div class="d-block d-sm-none" style="margin-top:80px;"></div>
     <div class="container-fluid d-none d-sm-block">
      <div class="row bg-deep-orange " style="height:300px" >
        <div class="col-md-12">
          
    <p style="margin-top:100px;font-size:40px;" class="text-center">
    <b>The #1 site real estate<br> professionals trust* </b></p> 
        </div>
         
      </div>
     </div>

    {{-- SLIDER SECTION --}}
    {{-- @if(Request::is('/'))
    @include('frontend.partials.slider')
    @endif --}}

    {{-- SEARCH BAR --}}
    {{-- @include('frontend.partials.search') --}}

    {{-- MAIN CONTENT --}}
   
        <div class="container-fluid">
        @yield('content')
        </div>
  

    @include('frontend.partials.footer')

    </div>
   <div> @include('auth.modal.login')</div>
 
    @yield('bot')
   
    <script type="text/javascript" src="{{ asset('frontend/js/jquery.min.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


</body>
<script>

$(document).ready(function(){

$('#btnLogin').on('click',function(){
    $('#modal-login').modal('show');
    $('#form-login')[0].reset();
    $('.modal-title').text('Sign In');
})

$('#btnClient').on('click',function(){
    $('#modal-login').modal('show');
    $('#form-login')[0].reset();
    $('.modal-title').text('Sign In');
})
 $('#btnRegister').on('click',function(){
    $('#modal-register').modal('show');
    $('#form-register')[0].reset();
    $('.modal-title').text('Sign Up');
})
 $('#btnSell').on('click',function(){
    $('#modal-register').modal('show');
    $('#form-register')[0].reset();
    $('.modal-title').text('Sign Up');
})
  @if (count($errors) > 0)
   
        $( document ).ready(function() {
            $('#modal-login').modal('show');
            $('.modal-title').html('Sign In');
        });
   
@endif

})
</script>
</html>
<div class="modal fade" id="modal-register" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
  <h5 class="modal-title" id="exampleModalLabel">Sign Up</h5>
       
      </div>
     <form method="POST" action="{{ route('register') }}">
                        @csrf
      <div class="modal-body">
                     <div class="row">
                            <div class="col-md-12">
                               <a href="{{ url('login/google') }}" class="google btn" style="background-color: #dd4b39;
                                color: white;">
                                <i class="zmdi zmdi-google-plus">
                                </i> Registering with Google
                               </a>
                            </div>
                        </div>
        <div class="row">
             <div class="col-md-12">
             <div class="form-group">
                                <label for="name">{{ __('Name') }}</label>
                                <input id="name" type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="helper-text" data-error="wrong" data-success="right">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
             </div>
             <div class="form-group">
                                <label for="email">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="helper-text" data-error="wrong" data-success="right">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
               </div>
               <div class="form-group">
                                <label for="password">{{ __('Password') }}</label>
                                <input id="password" type="password" class=" form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" name="password" required>
                                
                                @if ($errors->has('password'))
                                <span class="helper-text" data-error="wrong" data-success="right">
                                    <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
               </div>
               <div class="form-group">
                                <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" name="password_confirmation" required class="form-control">
                            </div>
             </div>

        </div>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
       <button type="submit" class="btn btn-sm btn-primary">Sign Up</button>
      </div>
    </form>
    </div>
  </div>
</div>