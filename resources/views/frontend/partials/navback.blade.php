<nav class="navbar navbar-dark navbar-expand bg-primary ">
 {{-- <a class="navbar-brand" href="#">ishipazuri</a>--}}
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
     <ul class="navbar-nav me-auto mb-2 mb-lg-0 m-auto">    

    <li class="active"><a href="{{ route('home') }}">Home</a></li>
      <li class="nav-item"><a href="{{ route('property') }}">Property</a></li>
      <li class="nav-item"><a href="{{ route('agents') }}">Agent</a></li>
    </ul>
    
    <ul class="nav navbar-nav navbar-right">
        
      @guest            
       <li class="nav-item"><a href="#" id="btnLogin">Sign In</a></li>
       <li class="nav-item"><a href="#" id="btnRegister">Sign Up</a></li>
       @else
           <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         {{ ucfirst(Auth::user()->username) }} Cosmas
          <i class="material-icons right">arrow_drop_down</i>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          @if(Auth::user()->role->id == 1)
            <a href="{{ route('agent.dashboard') }}" class="dropdown-item">
           <i class="fa fa-user"></i>Dashboard
            </a>
           @elseif(Auth::user()->role->id == 2)
          <a href="{{ route('agent.dashboard') }}" class="dropdown-item">
          <i class="fa fa-user"></i>Dashboard
          </a>

                               
           @endif
            <a class="dropdownitem dropdown-item" href="{{ route('logout') }}"
             onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
             <i class="fa fa-power-off"></i>{{ __('Logout') }}
            </a>

           <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             @csrf
         </form>
        </div>
      </li>
     @endguest
    
      
    </ul>
   
  </div>
</nav>

